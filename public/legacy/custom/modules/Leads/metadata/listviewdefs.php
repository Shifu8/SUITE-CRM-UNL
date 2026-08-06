<?php
/**
 * Vista de Lista personalizada para LEADS
 * 
 * Flujo: Asesores y todos los roles ven "Estado del Aspirante" y "Maestría de Interés"
 */
$listViewDefs['Leads'] = array(
    'NAME' => array(
        'width'   => '18%',
        'label'   => 'LBL_NAME',
        'link'    => true,
        'default' => true,
    ),
    'STATUS' => array(
        'width'   => '12%',
        'label'   => 'LBL_STATUS',
        'default' => true,
    ),
    'MAESTRIA_INTERESADA_C' => array(
        'width'   => '25%',
        'label'   => 'LBL_MAESTRIA_INTERESADA',
        'default' => true,
    ),
    'EMAIL1' => array(
        'width'   => '18%',
        'label'   => 'LBL_EMAIL_ADDRESS',
        'default' => true,
    ),
    'ASSIGNED_USER_NAME' => array(
        'width'   => '12%',
        'label'   => 'LBL_ASSIGNED_TO',
        'default' => true,
    ),
    'DATE_ENTERED' => array(
        'width'     => '15%',
        'label'     => 'LBL_DATE_ENTERED',
        'default'   => true,
        'sortable'  => true,
    ),
);
