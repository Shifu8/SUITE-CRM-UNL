<?php
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

class AutomationWorkflowHook
{
    /**
     * Hook before_save en Leads
     * 1. Auto-asociar Lead nuevo a la campaña activa (Agosto 2026) si no tiene campaña.
     * 2. No utilizar usuarios quemados.
     */
    public function processLeadWorkflow(&$bean, $event, $arguments)
    {
        // Auto-asociar campaña activa si campaign_id está vacío
        if (empty($bean->campaign_id)) {
            $res = $bean->db->query("SELECT id, name FROM campaigns WHERE status='Active' AND deleted=0 ORDER BY date_entered DESC LIMIT 1");
            if ($row = $bean->db->fetchByAssoc($res)) {
                $bean->campaign_id = $row['id'];
                $bean->campaign_name = $row['name'];
            }
        }
    }
}