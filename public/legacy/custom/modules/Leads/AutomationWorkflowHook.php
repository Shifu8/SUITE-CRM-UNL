<?php
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

class AutomationWorkflowHook
{
    public function processLeadWorkflow(&$bean, $event, $arguments)
    {
        // Auto-assign high score leads to Director de Maestria if score >= 50 and status is Interesado
        if (isset($bean->score_interes_c) && intval($bean->score_interes_c) >= 50 && $bean->status === 'Interesado') {
            // Find Director de Maestria (gsuing)
            $res = $bean->db->query("SELECT id FROM users WHERE user_name='gsuing' AND deleted=0");
            if ($row = $bean->db->fetchByAssoc($res)) {
                $bean->assigned_user_id = $row['id'];
            }
        }
    }
}