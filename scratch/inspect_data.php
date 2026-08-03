<?php
if (!defined('sugarEntry')) { define('sugarEntry', true); }
chdir(__DIR__ . '/../public/legacy');
require_once('include/entryPoint.php');
global $db;

// Check leads data for maestria values
$r = $db->query("SELECT maestria_interesada_c, COUNT(*) as cnt FROM leads l JOIN leads_cstm lc ON l.id=lc.id_c WHERE l.deleted=0 GROUP BY maestria_interesada_c ORDER BY cnt DESC");
echo "=== MAESTRIA VALUES IN LEADS ===\n";
while ($row = $db->fetchByAssoc($r)) {
    echo "  '{$row['maestria_interesada_c']}': {$row['cnt']}\n";
}

$r2 = $db->query("SELECT COUNT(*) as total FROM leads WHERE deleted=0");
$row2 = $db->fetchByAssoc($r2);
echo "\nTotal leads: {$row2['total']}\n";

$r3 = $db->query("SELECT COUNT(*) as total FROM contacts WHERE deleted=0");
$row3 = $db->fetchByAssoc($r3);
echo "Total contacts: {$row3['total']}\n";

// Check workflows
$r4 = $db->query("SELECT id, name, status, run_when FROM aow_work_flow WHERE deleted=0");
echo "\n=== WORKFLOWS ===\n";
$cnt = 0;
while ($row = $db->fetchByAssoc($r4)) {
    echo "  WF: {$row['name']} | status={$row['status']} | run_when={$row['run_when']}\n";
    $cnt++;
}
if ($cnt == 0) echo "  (none)\n";

// Check if contacts_cstm has maestria field
$r5 = $db->query("SHOW COLUMNS FROM contacts_cstm");
echo "\n=== CONTACTS_CSTM COLUMNS ===\n";
while ($row = $db->fetchByAssoc($r5)) {
    echo "  {$row['Field']}\n";
}

// Check lead status values
$r6 = $db->query("SELECT DISTINCT status FROM leads WHERE deleted=0 ORDER BY status");
echo "\n=== LEAD STATUS VALUES ===\n";
while ($row = $db->fetchByAssoc($r6)) {
    echo "  '{$row['status']}'\n";
}

// Check leads assigned per user
$r7 = $db->query("SELECT u.user_name, u.first_name, u.last_name, COUNT(l.id) as lead_count 
    FROM users u LEFT JOIN leads l ON l.assigned_user_id=u.id AND l.deleted=0 
    WHERE u.deleted=0 GROUP BY u.id ORDER BY lead_count DESC");
echo "\n=== LEADS PER USER ===\n";
while ($row = $db->fetchByAssoc($r7)) {
    echo "  {$row['user_name']} ({$row['first_name']} {$row['last_name']}): {$row['lead_count']} leads\n";
}

// Check contacts assigned per user
$r8 = $db->query("SELECT u.user_name, COUNT(c.id) as cnt 
    FROM users u LEFT JOIN contacts c ON c.assigned_user_id=u.id AND c.deleted=0 
    WHERE u.deleted=0 GROUP BY u.id ORDER BY cnt DESC");
echo "\n=== CONTACTS PER USER ===\n";
while ($row = $db->fetchByAssoc($r8)) {
    echo "  {$row['user_name']}: {$row['cnt']} contacts\n";
}

// Check user tabs/roles
$r9 = $db->query("SELECT u.user_name, r.name as role_name FROM users u 
    JOIN acl_roles_users ru ON ru.user_id=u.id AND ru.deleted=0 
    JOIN acl_roles r ON r.id=ru.role_id AND r.deleted=0 
    WHERE u.deleted=0 ORDER BY u.user_name");
echo "\n=== USER -> ROLE ASSIGNMENTS ===\n";
while ($row = $db->fetchByAssoc($r9)) {
    echo "  {$row['user_name']} => {$row['role_name']}\n";
}

// Check if there's a field for num_seguimientos on leads
$r10 = $db->query("SHOW COLUMNS FROM leads_cstm");
echo "\n=== LEADS_CSTM COLUMNS ===\n";
while ($row = $db->fetchByAssoc($r10)) {
    echo "  {$row['Field']}\n";
}

echo "\nDone.\n";
