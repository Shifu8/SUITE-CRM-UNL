<?php
if (!defined('sugarEntry')) { define('sugarEntry', true); }
chdir(__DIR__ . '/../public/legacy');
require_once('include/entryPoint.php');
global $db;

echo "Contactos por usuario:\n";
$r = $db->query("SELECT u.user_name, COUNT(c.id) as cnt FROM contacts c JOIN users u ON c.assigned_user_id=u.id WHERE c.deleted=0 GROUP BY u.user_name ORDER BY cnt DESC");
while ($row = $db->fetchByAssoc($r)) {
    echo "  {$row['user_name']}: {$row['cnt']}\n";
}

$r2 = $db->query("SELECT COUNT(*) as total FROM contacts WHERE deleted=0");
$row2 = $db->fetchByAssoc($r2);
echo "Total: {$row2['total']}\n";

// Check first 5 contacts
$r3 = $db->query("SELECT first_name, last_name, assigned_user_id FROM contacts WHERE deleted=0 LIMIT 5");
echo "\nMuestra de contactos:\n";
while ($row = $db->fetchByAssoc($r3)) {
    echo "  {$row['first_name']} {$row['last_name']} => {$row['assigned_user_id']}\n";
}

// Verificar en contacts_cstm
$r4 = $db->query("SELECT c.first_name, c.last_name, cc.maestria_interesada_c FROM contacts c LEFT JOIN contacts_cstm cc ON c.id=cc.id_c WHERE c.deleted=0 LIMIT 10");
echo "\nContactos con maestría:\n";
while ($row = $db->fetchByAssoc($r4)) {
    echo "  {$row['first_name']} {$row['last_name']}: {$row['maestria_interesada_c']}\n";
}
