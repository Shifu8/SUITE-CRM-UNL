<?php
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

class CheckCedulaHook
{
    /**
     * Hook before_save to validate cedula and log existing lead history
     */
    public function checkCedulaAndHistory(&$bean, $event, $arguments)
    {
        if (empty($bean->cedula_c) && !empty($_POST['cedula_c'])) {
            $bean->cedula_c = $_POST['cedula_c'];
        }

        if (!empty($bean->cedula_c)) {
            $cedula = $bean->db->quote($bean->cedula_c);
            $query = "SELECT l.id, l.first_name, l.last_name, l.status 
                      FROM leads l 
                      JOIN leads_cstm c ON l.id = c.id_c 
                      WHERE c.cedula_c = '$cedula' AND l.deleted = 0 AND l.id != '{$bean->id}'";
            $result = $bean->db->query($query);
            if ($row = $bean->db->fetchByAssoc($result)) {
                $GLOBALS['log']->info("LogicHook CheckCedula: Cédula {$bean->cedula_c} ya existe en el lead {$row['id']} ({$row['first_name']} {$row['last_name']})");
            }
        }
    }
}
