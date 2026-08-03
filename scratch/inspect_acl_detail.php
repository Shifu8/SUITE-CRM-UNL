<?php
if (!defined('sugarEntry')) {
    define('sugarEntry', true);
}

chdir(__DIR__ . '/../public/legacy');
require_once('include/entryPoint.php');

global $db;

echo "=== ACL ROLES DETAIL ===\n";
$roles = [
    '23f2a45a-23a1-45ae-84fb-15ee124b30ea' => 'Dirección de Posgrado',
    '898050eb-9310-4772-afbc-252208c1198d' => 'Asesor de Admisiones',
    '9b26597c-b61c-45ef-968d-31bd393fa20f' => 'Marketing',
    'db0adf27-2462-498d-8479-995f813dedea' => 'Director de Maestría',
    '2e14280b-d720-45de-be13-9c79da6823e7' => 'Administración',
];

foreach ($roles as $rid => $rname) {
    echo "\n--- Role: $rname ($rid) ---\n";
    $r2 = $db->query("SELECT category, aclaccess, name FROM acl_actions WHERE role_id='$rid' AND deleted=0 ORDER BY category, name");
    $cnt = 0;
    while ($row = $db->fetchByAssoc($r2)) {
        echo "  {$row['category']}.{$row['name']} => {$row['aclaccess']}\n";
        $cnt++;
    }
    if ($cnt == 0) echo "  (no ACL actions configured)\n";
}

echo "\n=== PASSWORDS ===\n";
$r = $db->query("SELECT user_name, user_hash FROM users WHERE deleted=0 ORDER BY user_name");
while ($row = $db->fetchByAssoc($r)) {
    $hash = $row['user_hash'] ?? '(empty)';
    echo "{$row['user_name']}: " . substr($hash, 0, 30) . "...\n";
}

echo "\n=== CONTACTS - Sample ===\n";
$r = $db->query("SELECT id, first_name, last_name, assigned_user_id, description FROM contacts WHERE deleted=0 LIMIT 10");
while ($row = $db->fetchByAssoc($r)) {
    echo "Contact: {$row['first_name']} {$row['last_name']} | assigned_to: {$row['assigned_user_id']}\n";
}

echo "\n=== LEADS - Sample ===\n";
$r = $db->query("SELECT id, first_name, last_name, assigned_user_id, lead_source, status FROM leads WHERE deleted=0 LIMIT 10");
while ($row = $db->fetchByAssoc($r)) {
    echo "Lead: {$row['first_name']} {$row['last_name']} | source: {$row['lead_source']} | status: {$row['status']} | assigned_to: {$row['assigned_user_id']}\n";
}

echo "\n=== CUSTOM FIELDS ON LEADS ===\n";
$r = $db->query("SHOW COLUMNS FROM leads_cstm");
if ($r) {
    while ($row = $db->fetchByAssoc($r)) {
        echo "  {$row['Field']}\n";
    }
} else {
    echo "  (no leads_cstm table or empty)\n";
}

echo "\n=== CUSTOM FIELDS ON CONTACTS ===\n";
$r = $db->query("SHOW COLUMNS FROM contacts_cstm");
if ($r) {
    while ($row = $db->fetchByAssoc($r)) {
        echo "  {$row['Field']}\n";
    }
} else {
    echo "  (no contacts_cstm table or empty)\n";
}

echo "\nDone.\n";
