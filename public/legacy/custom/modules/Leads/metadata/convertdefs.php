<?php
/**
 * Convert Lead metadata custom para SuiteCRM Campus UNL
 * Incluye etiquetas en español y selección de Director / Usuario Asignado
 */
if (!file_exists('modules/Leads/metadata/convertdefs.php')) {
    return;
}

require 'modules/Leads/metadata/convertdefs.php';

// Configurar panel de Contactos para Convert Lead
$viewdefs['Contacts']['ConvertLead']['select'] = 'assigned_user_name';
$viewdefs['Contacts']['ConvertLead']['panels']['LNK_NEW_CONTACT'] = array(
    array(
        array(
            'name' => 'first_name',
            'customCode' => '{html_options name="Contactssalutation" options=$fields.salutation.options selected=$fields.salutation.value}&nbsp;<input name="Contactsfirst_name" size="25" maxlength="25" type="text" value="{$fields.first_name.value}">',
        ),
        'last_name',
    ),
    array(
        array('name' => 'maestria_interesada_c', 'label' => 'Maestría Interesada'),
        array('name' => 'estado_aspirante_c', 'label' => 'Estado del Aspirante'),
    ),
    array(
        array('name' => 'department', 'label' => 'Departamento / Maestría'),
        array('name' => 'phone_mobile', 'label' => 'Teléfono Móvil'),
    ),
    array(
        array('name' => 'email1', 'label' => 'Correo Electrónico'),
        array('name' => 'assigned_user_name', 'label' => 'Asignado a'),
    ),
    array(
        array('name' => 'campaign_name', 'label' => 'Campaña'),
        array('name' => 'cedula_c', 'label' => 'Cédula / Identificación'),
    ),
    array(
        array('name' => 'ciclo_convocatoria_c', 'label' => 'Ciclo / Convocatoria'),
        '',
    ),
    array(
        array('name' => 'description', 'label' => 'Descripción'),
    ),
);
