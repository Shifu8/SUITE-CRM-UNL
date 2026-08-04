<?php
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
