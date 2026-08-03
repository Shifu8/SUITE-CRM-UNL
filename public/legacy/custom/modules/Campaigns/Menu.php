<?php
if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}

global $mod_strings, $app_strings;

$module_menu = array();

if (ACLController::checkAccess('Campaigns', 'edit', true)) {
    $module_menu[] = array(
        "index.php?module=Campaigns&action=WizardHome&return_module=Campaigns&return_action=index",
        "Crear Campaña",
        "Create",
        'Campaigns'
    );
}

if (ACLController::checkAccess('Campaigns', 'list', true)) {
    $module_menu[] = array(
        "index.php?module=Campaigns&action=index&return_module=Campaigns&return_action=index",
        "Ver Campañas",
        "List",
        'Campaigns'
    );
}

if (ACLController::checkAccess('EmailTemplates', 'edit', true)) {
    $module_menu[] = array(
        "index.php?module=EmailTemplates&action=EditView&return_module=EmailTemplates&return_action=DetailView",
        "Nueva Plantilla de Email",
        "View_Create_Email_Templates",
        "Emails"
    );
}

if (ACLController::checkAccess('EmailTemplates', 'list', true)) {
    $module_menu[] = array(
        "index.php?module=EmailTemplates&action=index",
        "Ver Plantillas de Email",
        "View_Email_Templates",
        'Emails'
    );
}

if (ACLController::checkAccess('Campaigns', 'edit', true)) {
    $module_menu[] = array(
        "index.php?module=Campaigns&action=WebToLeadCreation&return_module=Campaigns&return_action=index",
        "Formulario Web a Cliente Potencial",
        "Create_Person_Form"
    );
}

if (ACLController::checkAccess('Campaigns', 'import', true)) {
    $module_menu[] = array(
        "index.php?module=Import&action=Step1&import_module=Campaigns&return_module=Campaigns&return_action=index",
        "Importar Campañas",
        "Import",
        'Campaigns'
    );
}
