<?php
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

/**
 * Auto-asignar Director de Maestría según la maestría del contacto (Aspirante).
 * 
 * Mapeo específico:
 * - Big Data / Data Science -> Genoveva Suing (gsuing-director_maestria)
 * - Ingeniería de Software -> Roberth Figueroa (rfigueroa-director_maestria)
 * - Cualquier otra maestría -> Director de Maestría correspondiente
 */
class AutoAsignarDirectorHook
{
    public function autoAsignar($bean, $event, $arguments)
    {
        global $db;

        // 1. Inicializar estado_aspirante_c en "Nuevo" si está vacío
        if (empty($bean->estado_aspirante_c)) {
            $bean->estado_aspirante_c = 'Nuevo';
        }

        // 2. Sincronizar maestria_interesada_c y department
        $maestria = '';
        if (!empty($bean->maestria_interesada_c)) {
            $maestria = trim($bean->maestria_interesada_c);
        } elseif (!empty($bean->department)) {
            $maestria = trim($bean->department);
            $bean->maestria_interesada_c = $maestria;
        }

        if (!empty($maestria) && empty($bean->department)) {
            $bean->department = $maestria;
        }

        if (empty($maestria)) {
            return;
        }

        // 3. Buscar el Director de Maestría correspondiente
        $director_id = null;

        // Caso A: Big Data & Data Science -> Genoveva Suing
        if (stripos($maestria, 'Big Data') !== false || stripos($maestria, 'Data Science') !== false || stripos($maestria, 'Datos') !== false) {
            $q = "SELECT id FROM users WHERE (user_name LIKE 'gsuing%' OR (first_name LIKE '%Genoveva%' AND last_name LIKE '%Suing%')) AND status = 'Active' AND deleted = 0 LIMIT 1";
            $res = $db->query($q);
            if ($row = $db->fetchByAssoc($res)) {
                $director_id = $row['id'];
            }
        }

        // Caso B: Ingeniería de Software -> Roberth Figueroa
        if (!$director_id && (stripos($maestria, 'Software') !== false || stripos($maestria, 'Sistemas') !== false)) {
            $q = "SELECT id FROM users WHERE (user_name LIKE 'rfigueroa%' OR (first_name LIKE '%Roberth%' AND last_name LIKE '%Figueroa%')) AND status = 'Active' AND deleted = 0 LIMIT 1";
            $res = $db->query($q);
            if ($row = $db->fetchByAssoc($res)) {
                $director_id = $row['id'];
            }
        }

        // Caso C: Búsqueda dinámica por departamento / título del Director de Maestría
        if (!$director_id) {
            $words = explode(' ', str_replace(['Maestría', 'en', 'de', 'la', '&'], '', $maestria));
            foreach ($words as $word) {
                $word = trim($word);
                if (strlen($word) < 4) continue;
                $w_q = $db->quote($word);
                $q = "
                    SELECT u.id
                    FROM users u
                    JOIN acl_roles_users ru ON ru.user_id = u.id AND ru.deleted = 0
                    JOIN acl_roles r ON r.id = ru.role_id AND r.deleted = 0
                    WHERE r.name = 'Director de Maestría'
                      AND u.status = 'Active'
                      AND u.deleted = 0
                      AND (u.department LIKE '%$w_q%' OR u.title LIKE '%$w_q%')
                    LIMIT 1
                ";
                $res = $db->query($q);
                if ($row = $db->fetchByAssoc($res)) {
                    $director_id = $row['id'];
                    break;
                }
            }
        }

        // Caso D: Fallback al primer Director de Maestría activo disponible
        if (!$director_id) {
            $q_fallback = "
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
            $res_fallback = $db->query($q_fallback);
            if ($row = $db->fetchByAssoc($res_fallback)) {
                $director_id = $row['id'];
            }
        }

        // 4. Asignar la ID del Director al campo assigned_user_id
        if ($director_id) {
            $bean->assigned_user_id = $director_id;
        }
    }
}