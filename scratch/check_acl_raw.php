<?php
/**
 * Verificar estructura real de ACL en SuiteCRM
 */
if (!defined('sugarEntry')) { define('sugarEntry', true); }
chdir(__DIR__ . '/../public/legacy');
require_once('include/entryPoint.php');
global $db;

echo "=== TABLAS ACL DISPONIBLES ===\n";
$r = $db->query("SHOW TABLES LIKE 'acl%'");
while ($row = $db->fetchByAssoc($r)) {
    $tbl = array_values($row)[0];
    echo "  $tbl\n";
}

echo "\n=== SHOW TABLES LIKE '%role%' ===\n";
$r = $db->query("SHOW TABLES LIKE '%role%'");
while ($row = $db->fetchByAssoc($r)) {
    $tbl = array_values($row)[0];
    echo "  $tbl\n";
    // Show columns
    $r2 = $db->query("SHOW COLUMNS FROM $tbl");
    while ($col = $db->fetchByAssoc($r2)) {
        echo "      {$col['Field']} {$col['Type']}\n";
    }
}

echo "\n=== ACLRole class inspection ===\n";
if (class_exists('ACLRole')) {
    $role = BeanFactory::newBean('ACLRoles');
    echo "  ACLRole module: " . $role->module_name . "\n";
    echo "  ACLRole table: " . $role->table_name . "\n";
    
    // Load a specific role
    $role->retrieve('898050eb-9310-4772-afbc-252208c1198d');
    echo "  Role name: " . $role->name . "\n";
    
    // Check ACL actions via the role object
    if (method_exists($role, 'getRoleActions')) {
        $actions = $role->getRoleActions($role->id);
        echo "  Actions count: " . count($actions) . "\n";
        foreach (array_slice($actions, 0, 3, true) as $mod => $data) {
            echo "    Module: $mod => " . json_encode($data) . "\n";
        }
    }
}
