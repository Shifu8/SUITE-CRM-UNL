<?php
if (!defined('sugarEntry')) {
    define('sugarEntry', true);
}

chdir(__DIR__ . '/../public/legacy');
require_once('include/entryPoint.php');

global $db;

$ctorres = BeanFactory::newBean('Users');
$ctorres->retrieve_by_string_fields(['user_name' => 'ctorres']);

if ($ctorres && !empty($ctorres->id)) {
    echo "User ctorres found: ID " . $ctorres->id . "\n";
    
    // Check user_preferences
    $res = $db->query("SELECT category, contents FROM user_preferences WHERE assigned_user_id='{$ctorres->id}' AND deleted=0");
    while ($row = $db->fetchByAssoc($res)) {
        echo "Preference Category: " . $row['category'] . "\n";
        if ($row['category'] == 'Home') {
            echo "Home Contents:\n";
            $contents = base64_decode($row['contents']);
            $unserialized = unserialize($contents);
            print_r($unserialized);
        }
    }
} else {
    echo "User ctorres not found.\n";
}

// Check all campaigns
echo "\n--- Campaigns in DB ---\n";
$cRes = $db->query("SELECT id, name, status, campaign_type, date_start, date_end, assigned_user_id FROM campaigns WHERE deleted=0");
while ($cRow = $db->fetchByAssoc($cRes)) {
    echo "Campaign ID: {$cRow['id']} | Name: {$cRow['name']} | Status: {$cRow['status']} | Type: {$cRow['campaign_type']} | Start: {$cRow['date_start']} | End: {$cRow['date_end']}\n";
}

// Check all users
echo "\n--- Users in DB ---\n";
$uRes = $db->query("SELECT id, user_name, first_name, last_name, is_admin FROM users WHERE deleted=0");
while ($uRow = $db->fetchByAssoc($uRes)) {
    echo "User ID: {$uRow['id']} | Username: {$uRow['user_name']} | Name: {$uRow['first_name']} {$uRow['last_name']} | Admin: {$uRow['is_admin']}\n";
}
