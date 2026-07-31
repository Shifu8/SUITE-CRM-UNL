<?php
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

$hook_version = 1;
$hook_array = Array();

$hook_array['before_save'] = Array();
$hook_array['before_save'][] = Array(
    1,
    'Verificar Cédula e Historial de Aspirante',
    'custom/modules/Leads/CheckCedulaHook.php',
    'CheckCedulaHook',
    'checkCedulaAndHistory'
);