<?php
/**
 * fix_passwords_correct.php
 * Genera el hash CORRECTO que usa SuiteCRM:
 *   password_hash(strtolower(md5($password)), PASSWORD_DEFAULT)
 * y lo aplica a todos los usuarios activos.
 * También limpia el lockout de preferencias.
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
    die("Error de conexion: " . $e->getMessage() . "\n");
}

$newPassword = 'crm123';

// Hash CORRECTO según SuiteCRM: password_hash(strtolower(md5($pass)), PASSWORD_DEFAULT)
$md5ofPass   = md5($newPassword);                                    // e6032a45118887b87d9206bc013e22ed
$correctHash = password_hash(strtolower($md5ofPass), PASSWORD_DEFAULT);

echo "=== CORRECCIÓN DE CONTRASEÑAS (hash correcto SuiteCRM) ===\n";
echo "Contraseña  : $newPassword\n";
echo "MD5         : $md5ofPass\n";
echo "Hash bcrypt : $correctHash\n";
echo "Verificación: " . (password_verify(strtolower($md5ofPass), $correctHash) ? '✅ OK' : '❌ FALLO') . "\n\n";

// =====================================================
// 1. ACTUALIZAR HASH EN TABLA users
// =====================================================
$stmt = $pdo->prepare("
    UPDATE users
    SET user_hash = :hash,
        pwd_last_changed = NOW(),
        system_generated_password = 0
    WHERE deleted = 0
");
$stmt->execute([':hash' => $correctHash]);
echo "✅ Contraseñas actualizadas: {$stmt->rowCount()} usuario(s)\n\n";

// =====================================================
// 2. LIMPIAR loginfailed Y lockout EN user_preferences
// =====================================================
echo "=== LIMPIANDO INTENTOS FALLIDOS ===\n";

$users = $pdo->query("SELECT id, user_name FROM users WHERE deleted = 0 ORDER BY user_name")->fetchAll(PDO::FETCH_ASSOC);

foreach ($users as $u) {
    $uid   = $u['id'];
    $uname = $u['user_name'];

    $pref = $pdo->prepare("SELECT id, contents FROM user_preferences WHERE assigned_user_id = :uid AND category = 'global' AND deleted = 0");
    $pref->execute([':uid' => $uid]);
    $prefRow = $pref->fetch(PDO::FETCH_ASSOC);

    if ($prefRow) {
        $decoded = base64_decode($prefRow['contents']);
        $data    = @unserialize($decoded);

        if (is_array($data)) {
            $data['loginfailed']     = '0';
            $data['lockout']         = '';
            $data['loginexpiration'] = '0';

            $newContents = base64_encode(serialize($data));

            $pdo->prepare("UPDATE user_preferences SET contents = :c, date_modified = NOW() WHERE id = :id")
                ->execute([':c' => $newContents, ':id' => $prefRow['id']]);
            echo "  ✅ $uname → intentos fallidos=0, lockout limpiado\n";
        } else {
            echo "  ⚠️  $uname → no se pudo deserializar preferencias\n";
        }
    } else {
        echo "  ℹ️  $uname → sin preferencias (no hay lockout que limpiar)\n";
    }
}

// =====================================================
// 3. CONFIG: deshabilitar bloqueo por intentos
// =====================================================
echo "\n=== DESACTIVANDO LOCKOUT EN config ===\n";

$lockoutSettings = [
    ['category' => 'Users', 'name' => 'lockoutexpirationtype',   'value' => '0'],
    ['category' => 'Users', 'name' => 'lockoutexpirationlogin',  'value' => '0'],
    ['category' => 'Users', 'name' => 'lockoutexpirationtime',   'value' => '0'],
];

foreach ($lockoutSettings as $s) {
    $chk = $pdo->prepare("SELECT COUNT(*) FROM config WHERE category = :cat AND name = :nm");
    $chk->execute([':cat' => $s['category'], ':nm' => $s['name']]);
    if ((int)$chk->fetchColumn() > 0) {
        $pdo->prepare("UPDATE config SET value = :v WHERE category = :cat AND name = :nm")
            ->execute([':v' => $s['value'], ':cat' => $s['category'], ':nm' => $s['name']]);
    } else {
        $pdo->prepare("INSERT INTO config (category, name, value) VALUES (:cat, :nm, :v)")
            ->execute([':cat' => $s['category'], ':nm' => $s['name'], ':v' => $s['value']]);
    }
    echo "  ✅ config[{$s['category']}][{$s['name']}] = {$s['value']}\n";
}

// =====================================================
// 4. RESUMEN FINAL
// =====================================================
echo "\n=== RESUMEN DE USUARIOS ===\n";
$rows = $pdo->query("SELECT user_name, first_name, last_name, status FROM users WHERE deleted = 0 ORDER BY user_name")->fetchAll(PDO::FETCH_ASSOC);
foreach ($rows as $r) {
    $icon = $r['status'] === 'Active' ? '✅' : '⛔';
    echo "  $icon {$r['user_name']} ({$r['first_name']} {$r['last_name']}) [{$r['status']}]\n";
}

echo "\n";
echo "🎉 ¡Listo! Todos los usuarios activos pueden entrar con: crm123\n";
echo "🔓 Bloqueo por intentos desactivado.\n";
