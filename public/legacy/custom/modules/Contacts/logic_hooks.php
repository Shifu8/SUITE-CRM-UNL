<?php
$hook_version = 1;
$hook_array = array();
// Hook para auto-asignar director de maestría
$hook_array['before_save'][] = array(
    1,
    'Auto-asignar Director de Maestría',
    'custom/modules/Contacts/AutoAsignarDirectorHook.php',
    'AutoAsignarDirectorHook',
    'autoAsignar'
);