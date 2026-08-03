<?php
/**
 * Vista de Lista personalizada para CONTACTS
 * 
 * Para el Director de Maestría: muestra sus aspirantes (contactos)
 * con columna de Estado del Aspirante y Maestría de interés.
 * 
 * Flujo: Lead convertido por Asesor → Contacto asignado al Director de Maestría
 */
$listViewDefs['Contacts'] = array(
    'NAME' => array(
        'width'   => '15%',
        'label'   => 'LBL_NAME',
        'link'    => true,
        'default' => true,
    ),
    // COLUMNA DE ESTADO - El Director ve en qué etapa está cada aspirante
    'ESTADO_ASPIRANTE_C' => array(
        'width'   => '12%',
        'label'   => 'LBL_ESTADO_ASPIRANTE',
        'default' => true,
    ),
    // Maestría de interés - campo personalizado
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
        'width'    => '8%',
        'label'    => 'LBL_DATE_ENTERED',
        'default'  => true,
        'sortable' => true,
    ),
    'ACCOUNT_NAME' => array(
        'width'   => '10%',
        'label'   => 'LBL_ACCOUNT_NAME',
        'default' => false,
    ),
    'CEDULA_C' => array(
        'width'   => '10%',
        'label'   => 'LBL_CEDULA',
        'default' => false,
    ),
    'CICLO_CONVOCATORIA_C' => array(
        'width'   => '8%',
        'label'   => 'LBL_CICLO_CONVOCATORIA',
        'default' => false,
    ),
    'LEAD_SOURCE' => array(
        'width'   => '10%',
        'label'   => 'LBL_LEAD_SOURCE',
        'default' => false,
    ),
);
