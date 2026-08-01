<?php
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

$hook_version = 1;
$hook_array = Array();

$hook_array['before_save'] = Array();
$hook_array['before_save'][] = Array(
    1,
    'Verificar Cedula e Historial de Aspirante',
    'custom/modules/Leads/CheckCedulaHook.php',
    'CheckCedulaHook',
    'checkCedulaAndHistory'
);
$hook_array['before_save'][] = Array(
    2,
    'Automation Workflow Lead Assignment',
    'custom/modules/Leads/AutomationWorkflowHook.php',
    'AutomationWorkflowHook',
    'processLeadWorkflow'
);