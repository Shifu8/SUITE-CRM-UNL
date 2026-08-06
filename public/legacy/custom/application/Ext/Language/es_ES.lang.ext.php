<?php
// WARNING: The contents of this file are auto-generated


/**
 * Global application language strings for SuiteCRM Campus UNL
 */
$app_strings['LBL_ESTADO_ASPIRANTE'] = 'Estado del Aspirante';
$app_strings['LBL_MAESTRIA_INTERESADA'] = 'Maestría Interesada';
$app_strings['LBL_CEDULA'] = 'Cédula / Identificación';
$app_strings['LBL_CICLO_CONVOCATORIA'] = 'Ciclo / Convocatoria';
$app_strings['LBL_DEPARTMENT'] = 'Maestría / Departamento';
$app_strings['LBL_LIST_DEPARTMENT'] = 'Maestría';
$app_strings['LBL_LIST_STATE'] = 'Estado';
$app_strings['LBL_LIST_ASSIGNED_USER_NAME'] = 'Asignado a';
$app_strings['LBL_LIST_PRIMARY_ADDRESS_CITY'] = 'Ciudad';


/**
 * Cargar dinámicamente listas desplegables de Asesores, Directores y Usuarios desde la BD.
 */
if (defined('sugarEntry') && sugarEntry) {
    global $db;
    if (isset($db) && $db) {
        // List de Asesores
        $asesores = array('' => '');
        $res = $db->query("
            SELECT u.id, u.first_name, u.last_name, u.user_name
            FROM users u
            JOIN acl_roles_users ru ON ru.user_id = u.id AND ru.deleted = 0
            JOIN acl_roles r ON r.id = ru.role_id AND r.deleted = 0
            WHERE r.name = 'Asesor de Admisiones' AND u.status = 'Active' AND u.deleted = 0
            ORDER BY u.first_name, u.last_name
        ");
        while ($row = $db->fetchByAssoc($res)) {
            $name = trim($row['first_name'] . ' ' . $row['last_name']);
            if (empty($name)) $name = $row['user_name'];
            $asesores[$row['id']] = $name;
        }
        $app_list_strings['asesor_list'] = $asesores;
        $app_list_strings['asesores_list'] = $asesores;

        // Lista de Directores
        $directores = array('' => '');
        $res = $db->query("
            SELECT u.id, u.first_name, u.last_name, u.user_name
            FROM users u
            JOIN acl_roles_users ru ON ru.user_id = u.id AND ru.deleted = 0
            JOIN acl_roles r ON r.id = ru.role_id AND r.deleted = 0
            WHERE r.name = 'Director de Maestría' AND u.status = 'Active' AND u.deleted = 0
            ORDER BY u.first_name, u.last_name
        ");
        while ($row = $db->fetchByAssoc($res)) {
            $name = trim($row['first_name'] . ' ' . $row['last_name']);
            if (empty($name)) $name = $row['user_name'];
            $directores[$row['id']] = $name;
        }
        $app_list_strings['director_list'] = $directores;
        $app_list_strings['directores_list'] = $directores;

        // Lista de Todos los Usuarios Activos
        $usuarios = array('' => '');
        $res = $db->query("
            SELECT u.id, u.first_name, u.last_name, u.user_name
            FROM users u
            WHERE u.status = 'Active' AND u.deleted = 0
            ORDER BY u.first_name, u.last_name
        ");
        while ($row = $db->fetchByAssoc($res)) {
            $name = trim($row['first_name'] . ' ' . $row['last_name']);
            if (empty($name)) $name = $row['user_name'];
            $usuarios[$row['id']] = $name;
        }
        $app_list_strings['user_list'] = $usuarios;
        $app_list_strings['usuarios_list'] = $usuarios;
    }
}


$app_list_strings['lead_status_dom'] = array (
  'Registrado' => 'Registrado',
  'Contactado' => 'Contactado',
  'No_Interesado' => 'No Interesado',
  'Interesado' => 'Interesado',
  'En_seguimiento' => 'En seguimiento',
  'Inscrito' => 'Inscrito y/o Matriculado',
);

$app_list_strings['score_interes_list'] = array (
  '25%' => '25%',
  '50%' => '50%',
  '75%' => '75%',
  '100%' => '100%',
);

$app_list_strings['canal_procedencia_list'] = array (
  'Pagina Web Posgrados' => 'Pagina Web Posgrados',
  'Redes Sociales' => 'Redes Sociales',
  'Feria de Eventos' => 'Feria de Eventos',
);


$app_list_strings['lead_status_dom'] = array(
    'New' => 'Nuevo',
    'Assigned' => 'Asignado',
    'In Process' => 'En Seguimiento',
    'En seguimiento' => 'En Seguimiento',
    'Contacted' => 'Contactado',
    'Registered' => 'Registrado',
    'Converted' => 'Convertido',
    'Listo para Convertir' => 'Listo para Convertir',
    'Inscrito y/o Matriculado' => 'Inscrito y/o Matriculado',
    'Recycled' => 'Reciclado',
    'Dead' => 'Descartado',
);

// created: 2026-07-27 16:09:09
$app_list_strings['calendar_source_types']['caldav_basic'] = 'CalDAV';
$app_list_strings['calendar_source_types']['google'] = 'Google Calendar';

