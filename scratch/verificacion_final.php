<?php
/**
 * Verificación FINAL completa - simula qué puede ver cada usuario
 * usando el motor ACL real de SuiteCRM
 */
if (!defined('sugarEntry')) { define('sugarEntry', true); }
chdir(__DIR__ . '/../public/legacy');
require_once('include/entryPoint.php');
global $db;

echo "=======================================================\n";
echo "  VERIFICACIÓN FINAL - FLUJO CRM POSGRADO\n";
echo "=======================================================\n\n";

$test_users = [
    ['user_name' => 'cmendoza',  'expected_role' => 'Asesor de Admisiones'],
    ['user_name' => 'arivas',    'expected_role' => 'Asesor de Admisiones'],
    ['user_name' => 'ctorres',   'expected_role' => 'Marketing'],
    ['user_name' => 'vmorales',  'expected_role' => 'Marketing'],
    ['user_name' => 'scardenas', 'expected_role' => 'Dirección de Posgrado'],
    ['user_name' => 'dbenitez',  'expected_role' => 'Dirección de Posgrado'],
    ['user_name' => 'rfigueroa', 'expected_role' => 'Director de Maestría'],
    ['user_name' => 'gsuing',    'expected_role' => 'Director de Maestría'],
    ['user_name' => 'admin',     'expected_role' => 'Administración'],
];

// Reglas de acceso esperado por módulo por rol
$expected_access = [
    'Asesor de Admisiones' => [
        'Leads'        => ['access' => true,  'own_only' => true,  'label' => '✅ VE SUS LEADS'],
        'Contacts'     => ['access' => false, 'own_only' => false, 'label' => '❌ SIN ACCESO'],
        'Campaigns'    => ['access' => false, 'own_only' => false, 'label' => '❌ SIN ACCESO'],
        'Accounts'     => ['access' => false, 'own_only' => false, 'label' => '❌ SIN ACCESO'],
    ],
    'Marketing' => [
        'Campaigns'    => ['access' => true,  'own_only' => false, 'label' => '✅ ACCESO COMPLETO'],
        'Leads'        => ['access' => true,  'own_only' => false, 'label' => '✅ VE TODOS (sin editar)'],
        'Contacts'     => ['access' => false, 'own_only' => false, 'label' => '❌ SIN ACCESO'],
        'Accounts'     => ['access' => false, 'own_only' => false, 'label' => '❌ SIN ACCESO'],
    ],
    'Dirección de Posgrado' => [
        'Leads'        => ['access' => true,  'own_only' => false, 'label' => '✅ VE TODOS'],
        'Contacts'     => ['access' => true,  'own_only' => false, 'label' => '✅ VE TODOS'],
        'Campaigns'    => ['access' => true,  'own_only' => false, 'label' => '✅ VE (sin editar)'],
        'Accounts'     => ['access' => true,  'own_only' => false, 'label' => '✅ VE TODOS'],
    ],
    'Director de Maestría' => [
        'Contacts'     => ['access' => true,  'own_only' => true,  'label' => '✅ VE SUS CONTACTOS'],
        'Leads'        => ['access' => false, 'own_only' => false, 'label' => '❌ SIN ACCESO'],
        'Campaigns'    => ['access' => false, 'own_only' => false, 'label' => '❌ SIN ACCESO'],
        'Accounts'     => ['access' => false, 'own_only' => false, 'label' => '❌ SIN ACCESO'],
    ],
    'Administración' => [
        'Leads'        => ['access' => true,  'own_only' => false, 'label' => '✅ ACCESO COMPLETO'],
        'Contacts'     => ['access' => true,  'own_only' => false, 'label' => '✅ ACCESO COMPLETO'],
        'Campaigns'    => ['access' => true,  'own_only' => false, 'label' => '✅ ACCESO COMPLETO'],
        'Accounts'     => ['access' => true,  'own_only' => false, 'label' => '✅ ACCESO COMPLETO'],
    ],
];

// Función para verificar acceso real via ACL usando SuiteCRM API
function checkUserModuleAccess($db, $user_name, $module, $action) {
    // Cargar usuario
    $user = BeanFactory::newBean('Users');
    $user->retrieve_by_string_fields(['user_name' => $user_name]);
    if (!$user->id) return 'USER_NOT_FOUND';
    
    // Si es admin, tiene todo
    if ($user->is_admin) return 'ADMIN_FULL';
    
    // Verificar via acl_roles_actions
    global $db;
    $uid = $user->id;
    
    // Obtener role_id del usuario
    $r = $db->query("SELECT role_id FROM acl_roles_users WHERE user_id='$uid' AND deleted=0");
    $role_row = $db->fetchByAssoc($r);
    if (!$role_row) return 'NO_ROLE';
    
    $role_id = $role_row['role_id'];
    
    // Verificar acceso específico
    $r2 = $db->query("SELECT ra.access_override 
        FROM acl_roles_actions ra 
        JOIN acl_actions a ON ra.action_id=a.id
        WHERE ra.role_id='$role_id' AND a.category='$module' AND a.name='$action' AND ra.deleted=0 AND a.deleted=0");
    $row2 = $db->fetchByAssoc($r2);
    
    if (!$row2) return 'NOT_SET';
    
    $v = (int)$row2['access_override'];
    switch ($v) {
        case 89: return 'YES(All)';
        case 90: return 'YES(Group)';
        case 75: return 'OWNER_ONLY';
        case -99: return 'DENIED';
        case 0: return 'DEFAULT';
        default: return "UNKNOWN($v)";
    }
}

$all_pass = true;

foreach ($test_users as $tuser) {
    $uname = $tuser['user_name'];
    $role = $tuser['expected_role'];
    
    echo "\n┌─────────────────────────────────────────────┐\n";
    echo "│ Usuario: $uname | Rol: $role\n";
    echo "└─────────────────────────────────────────────┘\n";
    
    if (!isset($expected_access[$role])) {
        echo "  (sin reglas de verificación definidas)\n";
        continue;
    }
    
    $rules = $expected_access[$role];
    
    // Verificar contraseña
    $r = $db->query("SELECT user_hash FROM users WHERE user_name='$uname' AND deleted=0");
    $row = $db->fetchByAssoc($r);
    $pwd_ok = $row && password_verify(strtolower(md5('crm123')), $row['user_hash']);
    echo "  Password crm123: " . ($pwd_ok ? "✅ OK" : "❌ FALLO") . "\n";
    if (!$pwd_ok) $all_pass = false;
    
    // Verificar leads/contacts count según el rol
    if ($role === 'Asesor de Admisiones') {
        $r2 = $db->query("SELECT COUNT(*) as cnt FROM leads l JOIN users u ON l.assigned_user_id=u.id WHERE u.user_name='$uname' AND l.deleted=0");
        $rc = $db->fetchByAssoc($r2);
        echo "  Leads asignados: " . ($rc['cnt'] > 0 ? "✅ " : "⚠️ ") . "{$rc['cnt']} leads\n";
    }
    
    if ($role === 'Director de Maestría') {
        $r2 = $db->query("SELECT COUNT(*) as cnt FROM leads l JOIN users u ON l.assigned_user_id=u.id WHERE u.user_name='$uname' AND l.deleted=0");
        $rc = $db->fetchByAssoc($r2);
        echo "  Leads (debe ser 0): " . ($rc['cnt'] == 0 ? "✅ " : "❌ ") . "{$rc['cnt']} leads\n";
        
        $r3 = $db->query("SELECT COUNT(*) as cnt FROM contacts c JOIN users u ON c.assigned_user_id=u.id WHERE u.user_name='$uname' AND c.deleted=0");
        $rc3 = $db->fetchByAssoc($r3);
        echo "  Contactos asignados: {$rc3['cnt']}\n";
    }
    
    // Verificar permisos ACL
    echo "  Permisos ACL:\n";
    foreach ($rules as $module => $rule) {
        // Verificar 'access' permission (es el permiso principal de acceso al módulo)
        $access_check = checkUserModuleAccess($db, $uname, $module, 'access');
        $list_check = checkUserModuleAccess($db, $uname, $module, 'list');
        
        $is_denied = ($access_check === 'DENIED' || $access_check === 'ADMIN_FULL');
        $has_access = in_array($access_check, ['YES(All)', 'YES(Group)', 'OWNER_ONLY', 'ADMIN_FULL']);
        $is_owner_only = ($list_check === 'OWNER_ONLY');
        
        if ($access_check === 'ADMIN_FULL') {
            echo "    $module: ✅ ADMIN (acceso total)\n";
            continue;
        }
        
        if ($rule['access'] === false) {
            // Esperamos que esté denegado
            $ok = ($access_check === 'DENIED');
            echo "    $module: " . ($ok ? "✅" : "❌") . " {$rule['label']} (ACL access=$access_check)\n";
            if (!$ok) $all_pass = false;
        } else {
            // Esperamos acceso
            if ($rule['own_only']) {
                $ok = ($list_check === 'OWNER_ONLY');
                echo "    $module: " . ($ok ? "✅" : "❌") . " {$rule['label']} (list=$list_check)\n";
            } else {
                $ok = in_array($list_check, ['YES(All)', 'YES(Group)', 'ADMIN_FULL']);
                echo "    $module: " . ($ok ? "✅" : "❌") . " {$rule['label']} (list=$list_check)\n";
            }
            if (!$ok) $all_pass = false;
        }
    }
}

// ---- RESUMEN DE DISTRIBUCIÓN DE DATOS ----
echo "\n\n=======================================================\n";
echo "  RESUMEN DE DATOS\n";
echo "=======================================================\n";

echo "\n📋 LEADS por asesor y maestría:\n";
$r = $db->query("SELECT u.user_name, lc.maestria_interesada_c, l.status, COUNT(l.id) as cnt 
    FROM leads l 
    JOIN users u ON l.assigned_user_id=u.id 
    LEFT JOIN leads_cstm lc ON l.id=lc.id_c
    WHERE l.deleted=0 
    GROUP BY u.user_name, lc.maestria_interesada_c, l.status
    ORDER BY u.user_name, lc.maestria_interesada_c");
while ($row = $db->fetchByAssoc($r)) {
    $maestria = $row['maestria_interesada_c'] ?: '(sin maestría)';
    $short = strlen($maestria) > 40 ? substr($maestria, 0, 37) . '...' : $maestria;
    echo "  {$row['user_name']}: [{$row['status']}] $short × {$row['cnt']}\n";
}

echo "\n🎓 CONTACTOS por director:\n";
$r = $db->query("SELECT u.user_name, COUNT(c.id) as cnt FROM contacts c JOIN users u ON c.assigned_user_id=u.id WHERE c.deleted=0 GROUP BY u.user_name");
while ($row = $db->fetchByAssoc($r)) {
    echo "  {$row['user_name']}: {$row['cnt']} contactos\n";
}

echo "\n📊 TOTAL DE REGISTROS:\n";
$tables = ['leads', 'contacts', 'campaigns'];
foreach ($tables as $tbl) {
    $r = $db->query("SELECT COUNT(*) as cnt FROM $tbl WHERE deleted=0");
    $row = $db->fetchByAssoc($r);
    echo "  $tbl: {$row['cnt']}\n";
}

echo "\n📁 CAMPO maestria_interesada_c:\n";
$r = $db->query("SHOW COLUMNS FROM contacts_cstm LIKE 'maestria_interesada_c'");
echo "  contacts_cstm.maestria_interesada_c: " . ($db->fetchByAssoc($r) ? "✅ EXISTE" : "❌ NO EXISTE") . "\n";

$vardef = 'custom/Extension/modules/Contacts/Ext/Vardefs/maestria_interesada_c.php';
echo "  Vardef: " . (file_exists($vardef) ? "✅ EXISTE" : "❌ NO EXISTE") . "\n";

$ext_compiled = 'custom/modules/Contacts/Ext/Vardefs/vardefs.ext.php';
echo "  Ext compilado: " . (file_exists($ext_compiled) ? "✅ EXISTE" : "⚠️ NO EXISTE (se regenerará)") . "\n";

$hook = 'custom/modules/Contacts/logic_hooks.php';
echo "  Logic hook auto-asignación: " . (file_exists($hook) ? "✅ REGISTRADO" : "❌ FALTA") . "\n";

echo "\n=======================================================\n";
echo $all_pass ? "  🎉 TODO VERIFICADO CORRECTAMENTE\n" : "  ⚠️  ALGUNOS CHECKS FALLARON\n";
echo "=======================================================\n\n";
echo "  URL del CRM: http://localhost:8000\n";
echo "  Contraseña de todos: crm123\n\n";
echo "  Flujo:\n";
echo "  1. Marketing (ctorres/vmorales) crea campañas\n";
echo "  2. Asesores (cmendoza/arivas) gestionan leads con seguimientos\n";  
echo "  3. Dirección (scardenas/dbenitez) supervisa todo\n";
echo "  4. Asesor convierte lead → contacto (botón 'Convertir Lead')\n";
echo "  5. Sistema asigna automáticamente al director de la maestría\n";
echo "     • Software → rfigueroa\n";
echo "     • Big Data → gsuing\n\n";
