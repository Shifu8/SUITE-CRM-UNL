<?php
/**
 * Script de verificación - Confirma que los permisos ACL están correctamente configurados
 */
if (!defined('sugarEntry')) { define('sugarEntry', true); }
chdir(__DIR__ . '/../public/legacy');
require_once('include/entryPoint.php');
global $db;

echo "========================================\n";
echo "  VERIFICACIÓN DEL FLUJO CRM\n";
echo "========================================\n\n";

// ---- VERIFICAR CONTRASEÑAS ----
echo "=== CONTRASEÑAS ===\n";
$md5pass = md5('crm123');
$r = $db->query("SELECT user_name, user_hash FROM users WHERE deleted=0 ORDER BY user_name");
$all_ok = true;
while ($row = $db->fetchByAssoc($r)) {
    $ok = password_verify(strtolower($md5pass), $row['user_hash']);
    echo "  " . ($ok ? "✅" : "❌") . " {$row['user_name']}: " . ($ok ? "crm123 OK" : "FALLO - hash no coincide") . "\n";
    if (!$ok) $all_ok = false;
}
echo $all_ok ? "\n  ✅ Todos los passwords son crm123\n" : "\n  ❌ Algunos passwords no coinciden\n";

// ---- VERIFICAR ROLES Y USUARIOS ----
echo "\n=== USUARIOS Y ROLES ===\n";
$r = $db->query("SELECT u.user_name, u.first_name, u.last_name, u.is_admin, r.name as role_name 
    FROM users u 
    LEFT JOIN acl_roles_users ru ON ru.user_id=u.id AND ru.deleted=0 
    LEFT JOIN acl_roles r ON r.id=ru.role_id AND r.deleted=0 
    WHERE u.deleted=0 ORDER BY r.name, u.user_name");
while ($row = $db->fetchByAssoc($r)) {
    $admin_flag = $row['is_admin'] ? "[ADMIN]" : "";
    echo "  ✅ {$row['user_name']} ({$row['first_name']} {$row['last_name']}) → " . ($row['role_name'] ?: "(sin rol)") . " $admin_flag\n";
}

// ---- VERIFICAR LEADS POR ASESOR ----
echo "\n=== LEADS ASIGNADOS A ASESORES ===\n";
$asesores = ['cmendoza', 'arivas'];
foreach ($asesores as $uname) {
    $r = $db->query("SELECT COUNT(*) as cnt FROM leads l JOIN users u ON l.assigned_user_id=u.id WHERE u.user_name='$uname' AND l.deleted=0");
    $row = $db->fetchByAssoc($r);
    echo "  " . ($row['cnt'] > 0 ? "✅" : "⚠️") . " $uname: {$row['cnt']} leads\n";
}

// Verificar que directores NO tienen leads asignados
$directores = ['rfigueroa', 'gsuing'];
foreach ($directores as $uname) {
    $r = $db->query("SELECT COUNT(*) as cnt FROM leads l JOIN users u ON l.assigned_user_id=u.id WHERE u.user_name='$uname' AND l.deleted=0");
    $row = $db->fetchByAssoc($r);
    echo "  " . ($row['cnt'] == 0 ? "✅" : "⚠️") . " $uname: {$row['cnt']} leads (debería ser 0)\n";
}

// ---- VERIFICAR PERMISOS ACL ----
echo "\n=== PERMISOS ACL POR ROL ===\n";

$role_checks = [
    'Asesor de Admisiones' => [
        'Leads.list'      => 75,  // Owner only
        'Contacts.list'   => -99, // Denied
        'Campaigns.list'  => -99, // Denied
    ],
    'Marketing' => [
        'Campaigns.list'  => 89,  // Full
        'Leads.list'      => 89,  // Full read
        'Leads.edit'      => -99, // No edit
        'Contacts.list'   => -99, // Denied
    ],
    'Dirección de Posgrado' => [
        'Leads.list'      => 89,  // Full view
        'Contacts.list'   => 89,  // Full view
        'Leads.delete'    => -99, // No delete
    ],
    'Director de Maestría' => [
        'Contacts.list'   => 75,  // Owner only
        'Leads.list'      => -99, // Denied
        'Campaigns.list'  => -99, // Denied
    ],
    'Administración' => [
        'Leads.list'      => 89,  // Full
        'Contacts.list'   => 89,  // Full
        'Campaigns.list'  => 89,  // Full
    ],
];

foreach ($role_checks as $role_name => $checks) {
    echo "\n  [Rol: $role_name]\n";
    $role_r = $db->query("SELECT id FROM acl_roles WHERE name='$role_name' AND deleted=0");
    $role_row = $db->fetchByAssoc($role_r);
    if (!$role_row) {
        echo "    ❌ Rol no encontrado!\n";
        continue;
    }
    $role_id = $role_row['id'];
    
    foreach ($checks as $check_key => $expected_access) {
        list($module, $action) = explode('.', $check_key);
        // Correct join: acl_roles_actions (role_id, action_id, access_override) → acl_actions (category, name)
        $r = $db->query("SELECT ra.access_override FROM acl_roles_actions ra 
            JOIN acl_actions a ON ra.action_id=a.id 
            WHERE ra.role_id='$role_id' AND a.category='$module' AND a.name='$action' AND ra.deleted=0 AND a.deleted=0");
        $row = $db->fetchByAssoc($r);
        $actual = $row ? (int)$row['access_override'] : 'NO ENCONTRADO';
        $match = $actual === $expected_access;
        
        $access_label = [89 => 'SI(89)', 75 => 'OWNER(75)', -99 => 'NO(-99)'];
        $expected_str = $access_label[$expected_access] ?? $expected_access;
        $actual_str = isset($access_label[$actual]) ? $access_label[$actual] : $actual;
        
        echo "    " . ($match ? "✅" : "❌") . " $module.$action: esperado=$expected_str actual=$actual_str\n";
    }
}

// ---- VERIFICAR CAMPO maestria EN CONTACTS ----
echo "\n=== CAMPO maestria_interesada_c EN CONTACTS ===\n";
$r = $db->query("SHOW COLUMNS FROM contacts_cstm LIKE 'maestria_interesada_c'");
$row = $db->fetchByAssoc($r);
echo "  " . ($row ? "✅" : "❌") . " contacts_cstm.maestria_interesada_c: " . ($row ? "EXISTE" : "NO EXISTE") . "\n";

// Verificar vardef
$vardef_file = 'custom/Extension/modules/Contacts/Ext/Vardefs/maestria_interesada_c.php';
echo "  " . (file_exists($vardef_file) ? "✅" : "❌") . " Vardef Contacts.maestria_interesada_c: " . (file_exists($vardef_file) ? "EXISTE" : "NO EXISTE") . "\n";

// Verificar logic hook
$hook_file = 'custom/modules/Contacts/logic_hooks.php';
echo "  " . (file_exists($hook_file) ? "✅" : "❌") . " Logic hook auto-asignación: " . (file_exists($hook_file) ? "REGISTRADO" : "NO EXISTE") . "\n";

// ---- VERIFICAR WORKFLOWS ----
echo "\n=== WORKFLOWS ===\n";
$r = $db->query("SELECT name, status, base_module FROM aow_work_flow WHERE deleted=0 ORDER BY name");
$cnt = 0;
while ($row = $db->fetchByAssoc($r)) {
    echo "  ✅ WF: '{$row['name']}' | status={$row['status']} | module={$row['base_module']}\n";
    $cnt++;
}
if ($cnt == 0) echo "  ⚠️  No hay workflows activos\n";

// ---- VERIFICAR LEADS (muestra) ----
echo "\n=== DISTRIBUCIÓN DE LEADS ===\n";
$r = $db->query("SELECT u.user_name, lc.maestria_interesada_c, COUNT(l.id) as cnt 
    FROM leads l 
    JOIN users u ON l.assigned_user_id=u.id 
    LEFT JOIN leads_cstm lc ON l.id=lc.id_c
    WHERE l.deleted=0 
    GROUP BY u.user_name, lc.maestria_interesada_c
    ORDER BY u.user_name");
while ($row = $db->fetchByAssoc($r)) {
    $maestria = $row['maestria_interesada_c'] ?: '(sin maestría)';
    echo "  {$row['user_name']}: {$row['cnt']} leads - $maestria\n";
}

// ---- VERIFICAR CONTACTOS ----
echo "\n=== CONTACTOS ===\n";
$r = $db->query("SELECT u.user_name, COUNT(c.id) as cnt 
    FROM contacts c JOIN users u ON c.assigned_user_id=u.id 
    WHERE c.deleted=0 GROUP BY u.user_name");
while ($row = $db->fetchByAssoc($r)) {
    echo "  {$row['user_name']}: {$row['cnt']} contactos\n";
}

echo "\n========================================\n";
echo "  FIN DE VERIFICACIÓN\n";
echo "========================================\n";
