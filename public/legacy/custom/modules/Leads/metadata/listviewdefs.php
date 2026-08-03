<?php
/**
 * Vista de Lista personalizada para LEADS
 * 
 * Cambia la columna "Nombre de Cuenta" (account_name) por "Nombre de Maestría" (maestria_interesada_c)
 * 
 * Flujo: Asesor de Admisiones ve sus leads con la maestría de interés del aspirante
 */
$listViewDefs['Leads'] = array(
    'NAME' => array(
        'width'   => '15%',
        'label'   => 'LBL_NAME',
        'link'    => true,
        'default' => true,
    ),
    'STATUS' => array(
        'width'   => '10%',
        'label'   => 'LBL_LEAD_STATUS',
        'default' => true,
    ),
    // COLUMNA PRINCIPAL CAMBIADA: maestría de interés en lugar de nombre de cuenta
    'MAESTRIA_INTERESADA_C' => array(
        'width'   => '20%',
        'label'   => 'LBL_MAESTRIA_INTERESADA',
        'default' => true,
    ),
    'OFFICE_PHONE' => array(
        'width'   => '10%',
        'label'   => 'LBL_OFFICE_PHONE',
        'default' => true,
    ),
    'EMAIL1' => array(
        'width'   => '15%',
        'label'   => 'LBL_EMAIL_ADDRESS',
        'default' => true,
    ),
    'ASSIGNED_USER_NAME' => array(
        'width'   => '10%',
        'label'   => 'LBL_ASSIGNED_TO',
        'default' => true,
    ),
    'DATE_ENTERED' => array(
        'width'     => '10%',
        'label'     => 'LBL_DATE_ENTERED',
        'default'   => true,
        'sortable'  => true,
    ),
    'CONVERTED' => array(
        'width'   => '5%',
        'label'   => 'LBL_CONVERTED',
        'default' => false,
    ),
    'LEAD_SOURCE' => array(
        'width'   => '10%',
        'label'   => 'LBL_LEAD_SOURCE',
        'default' => false,
    ),
    'CANAL_PROCEDENCIA_C' => array(
        'width'   => '10%',
        'label'   => 'LBL_CANAL_PROCEDENCIA',
        'default' => false,
    ),
    'CEDULA_C' => array(
        'width'   => '10%',
        'label'   => 'LBL_CEDULA',
        'default' => false,
    ),
    'SCORE_INTERES_C' => array(
        'width'   => '7%',
        'label'   => 'LBL_SCORE_INTERES',
        'default' => false,
    ),
);
