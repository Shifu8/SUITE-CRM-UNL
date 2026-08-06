<?php
/**
 * Vista de Lista personalizada para CONTACTS (Aspirantes)
 * 
 * Columnas por defecto alineadas exactamente con el requerimiento:
 * Name | Status | Department (Maestría) | Email | Mobile | Primary Address City | User (Asignado a)
 */
$listViewDefs['Contacts'] = array(
    'NAME' => array(
        'width'   => '18%',
        'label'   => 'LBL_LIST_NAME',
        'link'    => true,
        'default' => true,
        'orderBy' => 'name',
    ),
    'ESTADO_ASPIRANTE_C' => array(
        'width'   => '12%',
        'label'   => 'LBL_ESTADO_ASPIRANTE',
        'default' => true,
    ),
    'DEPARTMENT' => array(
        'width'   => '20%',
        'label'   => 'LBL_DEPARTMENT',
        'default' => true,
    ),
    'EMAIL1' => array(
        'width'   => '15%',
        'label'   => 'LBL_LIST_EMAIL_ADDRESS',
        'sortable'=> false,
        'customCode' => '{$EMAIL1_LINK}',
        'default' => true,
    ),
    'PHONE_MOBILE' => array(
        'width'   => '10%',
        'label'   => 'LBL_MOBILE_PHONE',
        'default' => true,
    ),
    'PRIMARY_ADDRESS_CITY' => array(
        'width'   => '10%',
        'label'   => 'LBL_PRIMARY_ADDRESS_CITY',
        'default' => true,
    ),
    'ASSIGNED_USER_NAME' => array(
        'width'   => '12%',
        'label'   => 'LBL_LIST_ASSIGNED_USER',
        'module'  => 'Users',
        'id'      => 'ASSIGNED_USER_ID',
        'default' => true,
    ),
    'MAESTRIA_INTERESADA_C' => array(
        'width'   => '15%',
        'label'   => 'LBL_MAESTRIA_INTERESADA',
        'default' => false,
    ),
    'CEDULA_C' => array(
        'width'   => '10%',
        'label'   => 'LBL_CEDULA',
        'default' => false,
    ),
    'CICLO_CONVOCATORIA_C' => array(
        'width'   => '10%',
        'label'   => 'LBL_CICLO_CONVOCATORIA',
        'default' => false,
    ),
    'PHONE_WORK' => array(
        'width'   => '10%',
        'label'   => 'LBL_OFFICE_PHONE',
        'default' => false,
    ),
    'TITLE' => array(
        'width'   => '10%',
        'label'   => 'LBL_TITLE',
        'default' => false,
    ),
    'ACCOUNT_NAME' => array(
        'width'   => '15%',
        'label'   => 'LBL_LIST_ACCOUNT_NAME',
        'module'  => 'Accounts',
        'id'      => 'ACCOUNT_ID',
        'link'    => true,
        'default' => false,
    ),
    'LEAD_SOURCE' => array(
        'width'   => '10%',
        'label'   => 'LBL_LEAD_SOURCE',
        'default' => false,
    ),
    'DATE_ENTERED' => array(
        'width'   => '10%',
        'label'   => 'LBL_DATE_ENTERED',
        'default' => false,
    ),
    'CREATED_BY_NAME' => array(
        'width'   => '10%',
        'label'   => 'LBL_CREATED',
        'default' => false,
    ),
    'MODIFIED_BY_NAME' => array(
        'width'   => '10%',
        'label'   => 'LBL_MODIFIED',
        'default' => false,
    ),
);

$viewdefs['Contacts']['ListView']['columns'] = $listViewDefs['Contacts'];
