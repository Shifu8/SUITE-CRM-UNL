<?php
if (!defined('sugarEntry')) {
    define('sugarEntry', true);
}

chdir(__DIR__ . '/../public/legacy');
require_once('include/entryPoint.php');

global $db;

echo "===================================================\n";
echo "STARTING SUITECRM MULTI-ROLE AUTOMATION EXECUTION\n";
echo "===================================================\n\n";

// --- PROMPT 1: ADMINISTRADOR DEL SISTEMA (Rol: bmedina) ---
echo "[PROMPT 1] Admin bmedina: Parameterization & Workflow Setup...\n";

// 1. Rebuild extensions & cache
require_once('ModuleInstall/ModuleInstaller.php');
$mi = new ModuleInstaller();
$mi->silent = true;
$mi->rebuild_extensions();
$mi->rebuild_languages();
$mi->rebuild_all();

echo "-> Extension rebuild completed.\n";

// 2. Automated Lead Assignment & Notification Hook Setup
// Create or verify custom logic hook in Leads for workflow automation
$hookFile = 'custom/modules/Leads/AutomationWorkflowHook.php';
$hookCode = <<<PHP
<?php
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

class AutomationWorkflowHook
{
    public function processLeadWorkflow(&\$bean, \$event, \$arguments)
    {
        // Auto-assign high score leads to Director de Maestria if score >= 50 and status is Interesado
        if (isset(\$bean->score_interes_c) && intval(\$bean->score_interes_c) >= 50 && \$bean->status === 'Interesado') {
            // Find Director de Maestria (gsuing)
            \$res = \$bean->db->query("SELECT id FROM users WHERE user_name='gsuing' AND deleted=0");
            if (\$row = \$bean->db->fetchByAssoc(\$res)) {
                \$bean->assigned_user_id = \$row['id'];
            }
        }
    }
}
PHP;
file_put_contents($hookFile, $hookCode);

// Register hook in logic_hooks.php
$hooksDefFile = 'custom/modules/Leads/logic_hooks.php';
$hooksContent = <<<PHP
<?php
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

\$hook_version = 1;
\$hook_array = Array();

\$hook_array['before_save'] = Array();
\$hook_array['before_save'][] = Array(
    1,
    'Verificar Cedula e Historial de Aspirante',
    'custom/modules/Leads/CheckCedulaHook.php',
    'CheckCedulaHook',
    'checkCedulaAndHistory'
);
\$hook_array['before_save'][] = Array(
    2,
    'Automation Workflow Lead Assignment',
    'custom/modules/Leads/AutomationWorkflowHook.php',
    'AutomationWorkflowHook',
    'processLeadWorkflow'
);
PHP;
file_put_contents($hooksDefFile, $hooksContent);
echo "-> Lead automation workflow hooks configured.\n";

// 3. Data Migration: Seed contacts, campaigns, applicants
echo "-> Executing Data Migration (Contacts, Campaigns, Applicants)...\n";

// Get user IDs
$bmedinaId = $db->getOne("SELECT id FROM users WHERE user_name='bmedina' AND deleted=0");
$ctorresId = $db->getOne("SELECT id FROM users WHERE user_name='ctorres' AND deleted=0");
$cmendozaId = $db->getOne("SELECT id FROM users WHERE user_name='cmendoza' AND deleted=0");
$gsuingId = $db->getOne("SELECT id FROM users WHERE user_name='gsuing' AND deleted=0");

echo "-> Loaded User IDs:\n";
echo "   bmedina:  $bmedinaId\n";
echo "   ctorres:  $ctorresId\n";
echo "   cmendoza: $cmendozaId\n";
echo "   gsuing:   $gsuingId\n";

// Seed Contact
$contactBean = BeanFactory::newBean('Contacts');
$contactBean->first_name = "Mateo";
$contactBean->last_name = "Guerrero";
$contactBean->assigned_user_id = $cmendozaId;
$contactBean->lead_source = "Web Site";
$contactId = $contactBean->save();
echo "-> Migrated Contact: Mateo Guerrero (ID: $contactId)\n";

echo "[PROMPT 1 COMPLETED SUCCESSFULLY]\n\n";

// --- PROMPT 2: MARKETING DE POSGRADO (Rol: ctorres) ---
echo "[PROMPT 2] Marketing ctorres: Creating Capture Campaigns...\n";

$campaignsData = [
    [
        'name' => 'Campana Captacion Posgrados - Marzo 2026',
        'type' => 'Direct Mail',
        'status' => 'Active',
        'period' => 'Marzo 2026',
        'channels' => 'web, redes sociales, ferias de eventos'
    ],
    [
        'name' => 'Campana Captacion Posgrados - Julio 2026',
        'type' => 'Direct Mail',
        'status' => 'Active',
        'period' => 'Julio 2026',
        'channels' => 'web, redes sociales, ferias de eventos'
    ],
    [
        'name' => 'Campana Captacion Posgrados - Octubre 2026',
        'type' => 'Direct Mail',
        'status' => 'Active',
        'period' => 'Octubre 2026',
        'channels' => 'web, redes sociales, ferias de eventos'
    ]
];

$campaignIds = [];
foreach ($campaignsData as $c) {
    $campBean = BeanFactory::newBean('Campaigns');
    $campBean->name = $c['name'];
    $campBean->campaign_type = $c['type'];
    $campBean->status = $c['status'];
    $campBean->assigned_user_id = $ctorresId;
    $campBean->content = "Canales de captacion configurados: " . $c['channels'];
    $cId = $campBean->save();
    $campaignIds[$c['period']] = $cId;
    echo "-> Created Campaign: {$c['name']} (ID: $cId)\n";
}

echo "[PROMPT 2 COMPLETED SUCCESSFULLY]\n\n";

// --- PROMPT 3: ASESOR DE ADMISIONES (Rol: cmendoza) ---
echo "[PROMPT 3] Admissions Adviser cmendoza: Lead Pipeline Management...\n";

// 1. Create Lead Record with Custom Fields
$leadBean = BeanFactory::newBean('Leads');
$leadBean->first_name = "Juan";
$leadBean->last_name = "Perez";
$leadBean->assigned_user_id = $cmendozaId;
$leadBean->status = "Registrado";
$leadBean->cedula_c = "1104567890";
$leadBean->maestria_interesada_c = "Maestria en Big Data";
$leadBean->ciudad_procedencia_c = "Loja";
$leadBean->canal_procedencia_c = "web";
$leadBean->ciclo_convocatoria_c = "2026-T1";
$leadBean->score_interes_c = "25";
$leadId = $leadBean->save();
echo "-> Created Lead: Juan Perez (ID: $leadId, Status: Registrado, Score: 25)\n";

// 2. 1st Contact: Log Call/Note -> Status to Contactado
$note1 = BeanFactory::newBean('Notes');
$note1->name = "Primer contacto con aspirante";
$note1->description = "Contacto inicial realizado via telefonica para solicitar datos de postulacion y ofrecer informacion del programa.";
$note1->parent_type = "Leads";
$note1->parent_id = $leadId;
$note1->assigned_user_id = $cmendozaId;
$note1Id = $note1->save();
echo "-> Logged 1st Contact Note (ID: $note1Id)\n";

$leadBean = BeanFactory::getBean('Leads', $leadId);
$leadBean->status = "Contactado";
$leadBean->save();
echo "-> Updated Lead Status to: Contactado\n";

// 3. 2nd Follow-up: Update Score -> 50, Document in Notes
$note2 = BeanFactory::newBean('Notes');
$note2->name = "Segundo seguimiento";
$note2->description = "Aspirante muestra interes relevante en la Maestria en Big Data. Revisa plan de estudios y modalidad.";
$note2->parent_type = "Leads";
$note2->parent_id = $leadId;
$note2->assigned_user_id = $cmendozaId;
$note2Id = $note2->save();
echo "-> Logged 2nd Follow-up Note (ID: $note2Id)\n";

$leadBean = BeanFactory::getBean('Leads', $leadId);
$leadBean->score_interes_c = "50";
$leadBean->save();
echo "-> Updated Lead Score de interes to: 50\n";

// 4. 3rd Follow-up (Score >= 50): Status -> Interesado, Assign to Director de Maestria (gsuing)
$note3 = BeanFactory::newBean('Notes');
$note3->name = "Tercer seguimiento y derivacion a Director";
$note3->description = "Score del aspirante alcanza 50. Se deriva expediente al Director de Maestria para revision y entrevista.";
$note3->parent_type = "Leads";
$note3->parent_id = $leadId;
$note3->assigned_user_id = $cmendozaId;
$note3Id = $note3->save();
echo "-> Logged 3rd Follow-up Note (ID: $note3Id)\n";

$leadBean = BeanFactory::getBean('Leads', $leadId);
$leadBean->status = "Interesado";
$leadBean->assigned_user_id = $gsuingId; // Derivacion a Director de Maestria
$leadBean->save();
echo "-> Updated Lead Status to: Interesado, Assigned to: gsuing (Genoveva Suing)\n";

// 5. Closing Stage: Document Contact for Documentation -> Status to Inscrito y/o Matriculado
$note4 = BeanFactory::newBean('Notes');
$note4->name = "Envio de documentacion para matricula";
$note4->description = "Se solicita envio de requisitos de admision, cedula y titulo registrado para formalizar inscripcion.";
$note4->parent_type = "Leads";
$note4->parent_id = $leadId;
$note4->assigned_user_id = $cmendozaId;
$note4Id = $note4->save();
echo "-> Logged Closing Contact Note (ID: $note4Id)\n";

$leadBean = BeanFactory::getBean('Leads', $leadId);
$leadBean->status = "Inscrito y/o Matriculado";
$leadBean->save();
echo "-> Updated Lead Status manually to: Inscrito y/o Matriculado\n";

echo "[PROMPT 3 COMPLETED SUCCESSFULLY]\n\n";

// --- PROMPT 4: DIRECTOR DE MAESTRIA (Rol: gsuing) ---
echo "[PROMPT 4] Master Director gsuing: Review & Evaluation...\n";

// 1. Filter / Fetch Leads Assigned to gsuing
$leadBean = BeanFactory::getBean('Leads', $leadId);
echo "-> Reviewing Assigned Lead: {$leadBean->first_name} {$leadBean->last_name} (ID: {$leadBean->id})\n";

// 2. Document Academic & Financial Info in Notes Subpanel
$noteDirector = BeanFactory::newBean('Notes');
$noteDirector->name = "Revision academica y financiera por Director";
$noteDirector->description = "Perfil academico validado y documento financiero verificado. Aspirante cumple requisitos de admision para posgrado.";
$noteDirector->parent_type = "Leads";
$noteDirector->parent_id = $leadId;
$noteDirector->assigned_user_id = $gsuingId;
$noteDirectorId = $noteDirector->save();
echo "-> Logged Director Academic/Financial Review Note (ID: $noteDirectorId)\n";

// 3. Record Follow-up Comments & Update Status to En seguimiento
$leadBean->status = "En seguimiento";
$leadBean->save();
echo "-> Updated Lead Status to: En seguimiento\n";

echo "[PROMPT 4 COMPLETED SUCCESSFULLY]\n\n";

echo "===================================================\n";
echo "ALL 4 PROMPTS EXECUTED SUCCESSFULLY WITHOUT TILDES!\n";
echo "===================================================\n";
