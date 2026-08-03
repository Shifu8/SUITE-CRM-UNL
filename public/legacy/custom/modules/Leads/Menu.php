<?php
if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}

global $mod_strings, $app_strings;

$module_menu = array();

if (ACLController::checkAccess('Leads', 'edit', true)) {
    $module_menu[] = array(
        "index.php?module=Leads&action=EditView&return_module=Leads&return_action=DetailView",
        "Crear Cliente Potencial",
        "Create",
        'Leads'
    );
}

if (ACLController::checkAccess('Leads', 'list', true)) {
    $module_menu[] = array(
        "index.php?module=Leads&action=index&return_module=Leads&return_action=DetailView",
        "Ver Clientes Potenciales",
        "List",
        'Leads'
    );
}

if (ACLController::checkAccess('Leads', 'edit', true)) {
    $module_menu[] = array(
        "index.php?module=Leads&action=ImportVCard",
        "Crear Cliente Potencial desde vCard",
        "Create_Lead_Vcard",
        'Leads'
    );
}

if (ACLController::checkAccess('Leads', 'import', true)) {
    $module_menu[] = array(
        "index.php?module=Import&action=Step1&import_module=Leads&return_module=Leads&return_action=index",
        "Importar Clientes Potenciales",
        "Import",
        'Leads'
    );
}
