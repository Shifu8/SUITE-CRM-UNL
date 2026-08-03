<?php
/**
 * Auto-asignar Director de Maestría según la maestría del contacto
 */
class AutoAsignarDirectorHook
{
    /**
     * Mapa: maestría → user_id del director
     */
    private static $directores = [
        'Maestría en Ingeniería de Software'  => '3fdf1beb-c004-475e-95c8-3b940581c8d7', // rfigueroa
        'Maestría en Big Data & Data Science' => 'cc80d85d-d9d1-4e19-b12b-dee1d732062c', // gsuing
    ];

    /**
     * Hook before_save - asigna director según maestría
     */
    public function autoAsignar($bean, $event, $arguments)
    {
        $maestria = isset($bean->maestria_interesada_c) ? trim($bean->maestria_interesada_c) : '';

        if (empty($maestria)) {
            return;
        }

        if (isset(self::$directores[$maestria])) {
            $director_id = self::$directores[$maestria];
            // Solo asignar si el contacto no tiene ya un director asignado correctamente
            // o si la maestría cambió
            if (empty($bean->assigned_user_id) || 
                (isset($bean->fetched_row['maestria_interesada_c']) && 
                 $bean->fetched_row['maestria_interesada_c'] !== $maestria)) {
                $bean->assigned_user_id = $director_id;
            }
        }
    }
}