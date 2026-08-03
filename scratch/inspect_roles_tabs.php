<?php
if (!defined('sugarEntry')) {
    define('sugarEntry', true);
}

chdir(__DIR__ . '/../public/legacy');
require_once('include/entryPoint.php');

global $db;

echo "--- ROLES IN SUITECRM ---\n";
$rRes = $db->query("SELECT id, name, description FROM acl_roles WHERE deleted=0");
while ($rRow = $db->fetchByAssoc($rRes)) {
    echo "Role ID: {$rRow['id']} | Name: {$rRow['name']}\n";
    $uRes = $db->query("SELECT u.user_name, u.first_name, u.last_name FROM acl_roles_users ru JOIN users u ON ru.user_id=u.id WHERE ru.role_id='{$rRow['id']}' AND ru.deleted=0");
    while ($uRow = $db->fetchByAssoc($uRes)) {
        echo "   -> Assigned User: {$uRow['user_name']} ({$uRow['first_name']} {$uRow['last_name']})\n";
    }
}

echo "\n--- SYSTEM TAB GROUPING / MODULE TABS ---\n";
require_once('modules/MySettings/TabController.php');
$tabs = new TabController();
print_r($tabs->get_system_tabs());

