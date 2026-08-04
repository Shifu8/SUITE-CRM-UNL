<?php
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

/**
 * Auto-asignar Director de Maestría según la maestría del contacto.
 * Todo obtenido dinámicamente desde la base de datos sin IDs ni usuarios quemados.
 */
class AutoAsignarDirectorHook
{
    public function autoAsignar($bean, $event, $arguments)
    {
        // 1. Inicializar estado_aspirante_c en "Nuevo" si no está seteado
        if (empty($bean->estado_aspirante_c)) {
            $bean->estado_aspirante_c = 'Nuevo';
        }

        // 2. Obtener la maestría del contacto
        $maestria = '';
        if (!empty($bean->maestria_interesada_c)) {
            $maestria = trim($bean->maestria_interesada_c);
        } elseif (!empty($bean->department)) {
            $maestria = trim($bean->department);
            $bean->maestria_interesada_c = $maestria;
        }

        if (empty($maestria)) {
            return;
        }

        // 3. Buscar dinámicamente en la base de datos el usuario activo con rol "Director de Maestría"
        // que corresponda a esa maestría (por coincidencias en departamento o título)
        global $db;

        // Extraer palabras clave de la maestría (ej: "Software", "Big Data", etc.)
        $keywords = [];
        if (stripos($maestria, 'Software') !== false) {
            $keywords[] = 'Software';
        }
        if (stripos($maestria, 'Big Data') !== false || stripos($maestria, 'Data Science') !== false) {
            $keywords[] = 'Big Data';
        }
        if (stripos($maestria, 'Inteligencia Artificial') !== false) {
            $keywords[] = 'Inteligencia Artificial';
        }

        $director_id = null;

        if (!empty($keywords)) {
            foreach ($keywords as $kw) {
                $kw_q = $db->quote($kw);
                $query = "
                    SELECT u.id
                    FROM users u
                    JOIN acl_roles_users ru ON ru.user_id = u.id AND ru.deleted = 0
                    JOIN acl_roles r ON r.id = ru.role_id AND r.deleted = 0
                    WHERE r.name = 'Director de Maestría'
                      AND u.status = 'Active'
                      AND u.deleted = 0
                      AND (u.department LIKE '%$kw_q%' OR u.title LIKE '%$kw_q%')
                    LIMIT 1
                ";
                $res = $db->query($query);
                if ($row = $db->fetchByAssoc($res)) {
                    $director_id = $row['id'];
                    break;
                }
            }
        }

        // Si no hubo coincidencia por palabra clave, asignar el primer Director de Maestría activo disponible
        if (!$director_id) {
            $query_fallback = "
                SELECT u.id
                FROM users u
                JOIN acl_roles_users ru ON ru.user_id = u.id AND ru.deleted = 0
                JOIN acl_roles r ON r.id = ru.role_id AND r.deleted = 0
                WHERE r.name = 'Director de Maestría'
                  AND u.status = 'Active'
                  AND u.deleted = 0
                ORDER BY u.date_entered ASC
                LIMIT 1
            ";
            $res_fallback = $db->query($query_fallback);
            if ($row = $db->fetchByAssoc($res_fallback)) {
                $director_id = $row['id'];
            }
        }

        // Asignar el contacto al Director de Maestría
        if ($director_id) {
            // Asignar si es un registro nuevo (sin id o sin assigned_user_id previo)
            // o si es la primera conversión desde Lead
            if (empty($bean->assigned_user_id) || empty($bean->fetched_row['id']) || 
                (isset($bean->fetched_row['maestria_interesada_c']) && $bean->fetched_row['maestria_interesada_c'] !== $maestria)) {
                $bean->assigned_user_id = $director_id;
            }
        }
    }
}