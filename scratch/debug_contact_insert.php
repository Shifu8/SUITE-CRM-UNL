<?php
/**
 * Debug: probar insert de un contacto simple
 */
if (!defined('sugarEntry')) { define('sugarEntry', true); }
chdir(__DIR__ . '/../public/legacy');
require_once('include/entryPoint.php');
global $db;

$date = date('Y-m-d H:i:s');
$id = create_guid();
$rfigueroa_id = '3fdf1beb-c004-475e-95c8-3b940581c8d7';

echo "Testing direct insert...\n";
echo "ID: $id\n";

// Test simple insert
$sql = "INSERT INTO contacts 
    (id, first_name, last_name, phone_mobile, title,
     assigned_user_id, created_by, modified_user_id, date_entered, date_modified, deleted,
     lead_source, do_not_call, email_opt_out)
    VALUES 
    ('$id', 'Test', 'Contacto', '0991111111', 'Aspirante',
     '$rfigueroa_id', '1', '1', '$date', '$date', 0,
     'Web Site', 0, 0)";

echo "SQL: $sql\n\n";

$result = $db->query($sql);
echo "Result: " . ($result ? "OK" : "FAILED") . "\n";

if ($db->checkError()) {
    echo "DB Error: " . $db->getLastError() . "\n";
}

// Check if it was inserted
$r = $db->query("SELECT id, first_name, last_name FROM contacts WHERE id='$id'");
$row = $db->fetchByAssoc($r);
echo "Found in DB: " . ($row ? "{$row['first_name']} {$row['last_name']}" : "NOT FOUND") . "\n";

// Check table structure
echo "\n=== CONTACTS TABLE KEY COLUMNS ===\n";
$r2 = $db->query("SHOW COLUMNS FROM contacts WHERE Field IN ('id','first_name','last_name','assigned_user_id','deleted','account_id')");
while ($col = $db->fetchByAssoc($r2)) {
    echo "  {$col['Field']}: {$col['Type']} NULL={$col['Null']} Default={$col['Default']}\n";
}

// Try using BeanFactory
echo "\n=== Testing BeanFactory method ===\n";
$contact = BeanFactory::newBean('Contacts');
$contact->first_name = 'BeanFactory';
$contact->last_name = 'TestContact';
$contact->phone_mobile = '0992222222';
$contact->title = 'Aspirante de Prueba';
$contact->assigned_user_id = $rfigueroa_id;
$contact->created_by = '1';
$contact->modified_user_id = '1';
$contact->lead_source = 'Web Site';
$contact->description = 'Contacto de prueba via BeanFactory';
$contact->maestria_interesada_c = 'Maestría en Ingeniería de Software';

$saved_id = $contact->save();
echo "BeanFactory save result: $saved_id\n";

// Check
$r3 = $db->query("SELECT COUNT(*) as cnt FROM contacts WHERE deleted=0");
$row3 = $db->fetchByAssoc($r3);
echo "Total contacts now: {$row3['cnt']}\n";

// Delete test contacts
$db->query("UPDATE contacts SET deleted=1 WHERE first_name IN ('Test','BeanFactory') AND last_name IN ('Contacto','TestContact')");
echo "Test contacts cleaned up.\n";
