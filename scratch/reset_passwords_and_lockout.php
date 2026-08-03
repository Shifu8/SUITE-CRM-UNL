<?php
/**
 * Script: reset_passwords_and_lockout.php
 * Acceso directo a MySQL vía PDO (sin bootstrap de SuiteCRM)
 * - Resetea contraseñas de TODOS los usuarios activos a "crm123"
 * - Limpia loginfailed y lockout en user_preferences
 * - Inserta config para deshabilitar bloqueo por intentos
 */

$host   = '127.0.0.1';
$port   = 3306;
$dbname = 'suitecrm8';
$user   = 'root';
$pass   = 'root';

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die("❌ Error de conexión: " . $e->getMessage() . "\n");
}

$newPassword = 'crm123';
$newHash     = password_hash($newPassword, PASSWORD_BCRYPT);

echo "=== RESET DE CONTRASEÑAS ===\n";
echo "Contraseña: $newPassword\n";
echo "Hash bcrypt: $newHash\n\n";

// =====================================================
// 1. ACTUALIZAR CONTRASEÑAS EN LA TABLA users
// =====================================================
$stmt = $pdo->prepare("
    UPDATE users
    SET user_hash = :hash,
        pwd_last_changed = NOW(),
        system_generated_password = 0
    WHERE deleted = 0 AND status = 'Active'
");
$stmt->execute([':hash' => $newHash]);
$affected = $stmt->rowCount();
echo "✅ Contraseñas actualizadas en tabla users: $affected registro(s)\n\n";

// =====================================================
// 2. LIMPIAR loginfailed Y lockout EN user_preferences
//    El contenido es base64(php_serialize(array))
// =====================================================
echo "=== LIMPIANDO INTENTOS FALLIDOS EN PREFERENCIAS ===\n";

$users = $pdo->query("SELECT id, user_name FROM users WHERE deleted = 0 ORDER BY user_name")->fetchAll(PDO::FETCH_ASSOC);

foreach ($users as $u) {
    $uid      = $u['id'];
    $uname    = $u['user_name'];

    // Buscar su preferencia global
    $pref = $pdo->prepare("SELECT id, contents FROM user_preferences WHERE assigned_user_id = :uid AND category = 'global' AND deleted = 0");
    $pref->execute([':uid' => $uid]);
    $prefRow = $pref->fetch(PDO::FETCH_ASSOC);

    if ($prefRow) {
        $decoded = base64_decode($prefRow['contents']);
        $data    = @unserialize($decoded);

        if (is_array($data)) {
            // Limpiar valores de bloqueo
            $data['loginfailed']      = '0';
            $data['lockout']          = '';
            $data['loginexpiration']  = '0';

            $newContents = base64_encode(serialize($data));

            $upd = $pdo->prepare("UPDATE user_preferences SET contents = :c, date_modified = NOW() WHERE id = :id");
            $upd->execute([':c' => $newContents, ':id' => $prefRow['id']]);
            echo "  ✅ $uname → loginfailed=0, lockout='' limpiados\n";
        } else {
            echo "  ⚠️  $uname → no se pudo deserializar las preferencias\n";
        }
    } else {
        // No tiene preferencias globales, no hay lockout que limpiar
        echo "  ℹ️  $uname → sin preferencias globales (no hay lockout)\n";
    }
}

// =====================================================
// 3. DESHABILITAR BLOQUEO POR INTENTOS EN config.php
// =====================================================
echo "\n=== DESACTIVANDO LOCKOUT EN config.php ===\n";
$configFile = __DIR__ . '/../public/legacy/config.php';
if (file_exists($configFile)) {
    $configContent = file_get_contents($configFile);
    $changed = false;

    // Clave lockoutexpirationtype: 0 = desactivado
    $keysToZero = ['lockoutexpirationtype', 'lockoutexpirationlogin', 'lockoutexpirationtime'];
    foreach ($keysToZero as $key) {
        if (preg_match("/'$key'\s*=>/", $configContent)) {
            $new = preg_replace(
                "/('" . preg_quote($key, '/') . "'\s*=>\s*)('[^']*'|\d+)/",
                "$1'0'",
                $configContent
            );
            if ($new !== $configContent) {
                $configContent = $new;
                $changed = true;
                echo "  ✅ config.php: '$key' => '0'\n";
            } else {
                echo "  ℹ️  config.php: '$key' ya tiene valor correcto o no cambia\n";
            }
        } else {
            echo "  ℹ️  config.php: '$key' no encontrado (puede no estar configurado)\n";
        }
    }

    if ($changed) {
        file_put_contents($configFile, $configContent);
        echo "  ✅ config.php guardado con cambios\n";
    } else {
        echo "  ✅ config.php no necesitaba cambios de lockout\n";
    }
} else {
    echo "  ⚠️  config.php no encontrado en: $configFile\n";
}

// =====================================================
// 4. INSERTAR/ACTUALIZAR EN TABLA config DE LA BD
// =====================================================
echo "\n=== ACTUALIZANDO config EN BASE DE DATOS ===\n";
$lockoutSettings = [
    ['category' => 'Users', 'name' => 'lockoutexpirationtype',   'value' => '0'],
    ['category' => 'Users', 'name' => 'lockoutexpirationlogin',  'value' => '0'],
    ['category' => 'Users', 'name' => 'lockoutexpirationtime',   'value' => '0'],
];
foreach ($lockoutSettings as $s) {
    $chk = $pdo->prepare("SELECT id FROM config WHERE category = :cat AND name = :nm");
    $chk->execute([':cat' => $s['category'], ':nm' => $s['name']]);
    $exists = $chk->fetch();
    if ($exists) {
        $pdo->prepare("UPDATE config SET value = :v WHERE category = :cat AND name = :nm")
            ->execute([':v' => $s['value'], ':cat' => $s['category'], ':nm' => $s['name']]);
        echo "  ✅ Actualizado config[{$s['category']}][{$s['name']}] = {$s['value']}\n";
    } else {
        $pdo->prepare("INSERT INTO config (category, name, value) VALUES (:cat, :nm, :v)")
            ->execute([':cat' => $s['category'], ':nm' => $s['name'], ':v' => $s['value']]);
        echo "  ✅ Insertado config[{$s['category']}][{$s['name']}] = {$s['value']}\n";
    }
}

// =====================================================
// 5. VERIFICACIÓN FINAL
// =====================================================
echo "\n=== RESUMEN FINAL DE USUARIOS ===\n";
$finalUsers = $pdo->query("
    SELECT u.user_name, u.first_name, u.last_name, u.status
    FROM users u
    WHERE u.deleted = 0
    ORDER BY u.user_name
")->fetchAll(PDO::FETCH_ASSOC);

foreach ($finalUsers as $u) {
    echo "  👤 {$u['user_name']} ({$u['first_name']} {$u['last_name']}) [{$u['status']}]\n";
}

echo "\n";
echo "🎉 ¡Listo! Todos los usuarios pueden entrar con: crm123\n";
echo "🔓 Intentos fallidos limpiados en todos los usuarios.\n";
echo "🛡️  Bloqueo por intentos desactivado.\n";
echo "\n";
echo "📋 Lista de usuarios:\n";
foreach ($finalUsers as $u) {
    if ($u['status'] === 'Active') {
        echo "   • {$u['user_name']} → crm123\n";
    }
}
