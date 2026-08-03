<?php
if (!defined('sugarEntry')) {
    define('sugarEntry', true);
}

chdir(__DIR__ . '/../public/legacy');
require_once('include/entryPoint.php');

global $db;

echo "=====================================================\n";
echo "CONFIGURING MARKETING & DIRECTOR DASHBOARDS IN SUITECRM\n";
echo "=====================================================\n\n";

// 1. UPDATE SYSTEM MODULE TABS ORDER IN CONFIG & TAB CONTROLLER
echo "[1] Updating System Module Tabs Order...\n";

// Set max tabs to 12 in config_override.php
$configOverridePath = 'config_override.php';
$overrideContent = file_get_contents($configOverridePath);
if (strpos($overrideContent, "default_max_tabs") === false) {
    $overrideContent .= "\n\$sugar_config['default_max_tabs'] = 12;\n";
    file_put_contents($configOverridePath, $overrideContent);
}

// Set system tabs with Campaigns prominently placed
require_once('modules/MySettings/TabController.php');
$tabController = new TabController();
$newTabs = array(
    'Home' => 'Home',
    'Campaigns' => 'Campaigns',
    'Leads' => 'Leads',
    'Accounts' => 'Accounts',
    'Contacts' => 'Contacts',
    'Opportunities' => 'Opportunities',
    'AOR_Reports' => 'AOR_Reports',
    'Calendar' => 'Calendar',
    'Documents' => 'Documents',
    'Emails' => 'Emails',
    'ProspectLists' => 'ProspectLists',
    'Prospects' => 'Prospects'
);
$tabController->set_system_tabs($newTabs);
echo "-> Navigation bar updated: 'Campaigns' is now tab #2 right after 'Home'.\n";

// 2. GET USER IDS
$ctorresId  = $db->getOne("SELECT id FROM users WHERE user_name='ctorres' AND deleted=0");
$scardenasId = $db->getOne("SELECT id FROM users WHERE user_name='scardenas' AND deleted=0");
$dbenitezId  = $db->getOne("SELECT id FROM users WHERE user_name='dbenitez' AND deleted=0");
$gsuingId    = $db->getOne("SELECT id FROM users WHERE user_name='gsuing' AND deleted=0");

echo "-> User IDs:\n";
echo "   ctorres (Marketing): $ctorresId\n";
echo "   scardenas (Dir Posgrado): $scardenasId\n";
echo "   dbenitez (Dir Posgrado): $dbenitezId\n";

// 3. CREATE / SEED CAMPAIGNS WITH ACTIVE / INACTIVE STATUSES & DATES
echo "\n[2] Seeding / Updating Campaigns Data...\n";

$campaignsToCreate = [
    [
        'name' => 'Campana Captacion Posgrados - Big Data 2026',
        'type' => 'Web',
        'status' => 'Active',
        'start' => '2026-06-01',
        'end' => '2026-10-31',
        'budget' => 5000,
        'expected_cost' => 4800,
        'actual_cost' => 3200,
        'expected_revenue' => 45000,
        'content' => 'Campana activa de captacion para Maestria en Big Data via Landing Page Web y Google Ads.'
    ],
    [
        'name' => 'Campana Captacion Posgrados - Software 2026',
        'type' => 'Redes Sociales',
        'status' => 'Active',
        'start' => '2026-07-01',
        'end' => '2026-11-30',
        'budget' => 6000,
        'expected_cost' => 5500,
        'actual_cost' => 2900,
        'expected_revenue' => 50000,
        'content' => 'Campana activa en Meta (Facebook/Instagram Ads) para la Maestria en Software.'
    ],
    [
        'name' => 'Campana Captacion Posgrados - Febrero 2026 (Finalizada)',
        'type' => 'Direct Mail',
        'status' => 'Inactive',
        'start' => '2026-01-01',
        'end' => '2026-03-31',
        'budget' => 3000,
        'expected_cost' => 3000,
        'actual_cost' => 2950,
        'expected_revenue' => 25000,
        'content' => 'Campana finalizada de inicio de ano 2026. Tiempo de ejecucion expirado.'
    ]
];

$createdCampaignIds = [];

foreach ($campaignsToCreate as $c) {
    // Check if campaign exists
    $existingId = $db->getOne("SELECT id FROM campaigns WHERE name='" . $db->quote($c['name']) . "' AND deleted=0");
    if (!empty($existingId)) {
        $cBean = BeanFactory::getBean('Campaigns', $existingId);
    } else {
        $cBean = BeanFactory::newBean('Campaigns');
    }
    
    $cBean->name = $c['name'];
    $cBean->campaign_type = $c['type'];
    $cBean->status = $c['status'];
    $cBean->start_date = $c['start'];
    $cBean->end_date = $c['end'];
    $cBean->budget = $c['budget'];
    $cBean->expected_cost = $c['expected_cost'];
    $cBean->actual_cost = $c['actual_cost'];
    $cBean->expected_revenue = $c['expected_revenue'];
    $cBean->content = $c['content'];
    $cBean->assigned_user_id = $ctorresId;
    $savedId = $cBean->save();
    $createdCampaignIds[$c['name']] = $savedId;
    echo "-> Saved Campaign: '{$c['name']}' (ID: $savedId | Status: {$c['status']} | End Date: {$c['end']})\n";
}

// 4. LINK LEADS TO CAMPAIGNS FOR REAL METRICS
echo "\n[3] Linking Leads to Campaigns...\n";
$bigDataCampId = $createdCampaignIds['Campana Captacion Posgrados - Big Data 2026'];
$softwareCampId = $createdCampaignIds['Campana Captacion Posgrados - Software 2026'];

$db->query("UPDATE leads SET campaign_id='$bigDataCampId' WHERE maestria_interesada_c LIKE '%Big Data%' OR maestria_interesada_c IS NULL");
$db->query("UPDATE leads SET campaign_id='$softwareCampId' WHERE maestria_interesada_c LIKE '%Software%'");
echo "-> Updated Leads with campaign associations.\n";

// 5. CREATE AOR REPORTS FOR DASHLETS
echo "\n[4] Creating Custom AOR Reports for Dashlets...\n";

// Helper function to create AOR Report
function createOrUpdateReport($name, $module, $description) {
    global $db;
    $repId = $db->getOne("SELECT id FROM aor_reports WHERE name='" . $db->quote($name) . "' AND deleted=0");
    if (!empty($repId)) {
        $rep = BeanFactory::getBean('AOR_Reports', $repId);
    } else {
        $rep = BeanFactory::newBean('AOR_Reports');
    }
    $rep->name = $name;
    $rep->module = $module;
    $rep->description = $description;
    return $rep->save();
}

$rep1Id = createOrUpdateReport('Mis Campanas Activas', 'Campaigns', 'Reporte de campanas en estado Activa/En proceso con sus fechas y tipo.');
$rep2Id = createOrUpdateReport('Campanas Finalizadas / Inactivas', 'Campaigns', 'Reporte de campanas que caducaron o estan inactivas.');
$rep3Id = createOrUpdateReport('Rendimiento de Campanas (Leads Capturados)', 'Leads', 'Resumen de prospectos generados por campana activa.');
$repExecutiveId = createOrUpdateReport('Informe Ejecutivo Posgrado - Conversion y ROI de Campanas', 'Campaigns', 'Vista ejecutiva para Director de Posgrado con prospectos, matriculas e ingresos.');

echo "-> Reports created/verified:\n";
echo "   - Mis Campanas Activas (ID: $rep1Id)\n";
echo "   - Campanas Finalizadas (ID: $rep2Id)\n";
echo "   - Rendimiento de Campanas (ID: $rep3Id)\n";
echo "   - Informe Ejecutivo Posgrado (ID: $repExecutiveId)\n";

// 6. BUILD DASHBOARD PREFERENCES FOR CTORRES (MARKETING)
echo "\n[5] Configuring Dashboard for Camila Torres (ctorres)...\n";

$marketingDashlets = [
    'top_campaigns_active' => [
        'className' => 'TopCampaignsDashlet',
        'module' => 'Campaigns',
        'forceColumn' => 0,
        'fileLocation' => 'modules/Campaigns/Dashlets/TopCampaignsDashlet/TopCampaignsDashlet.php',
        'options' => [
            'title' => 'Mis Campanas Activas (Ingresos Generados)',
        ]
    ],
    'campaign_roi_chart' => [
        'className' => 'CampaignROIChartDashlet',
        'module' => 'Charts',
        'forceColumn' => 0,
        'fileLocation' => 'modules/Charts/Dashlets/CampaignROIChartDashlet/CampaignROIChartDashlet.php',
        'options' => [
            'title' => 'Rendimiento y ROI de Campanas (Grafico)',
        ]
    ],
    'rep1_dashlet' => [
        'className' => 'AORReportsDashlet',
        'module' => 'AOR_Reports',
        'forceColumn' => 0,
        'fileLocation' => 'modules/AOR_Reports/Dashlets/AORReportsDashlet/AORReportsDashlet.php',
        'aor_report_id' => $rep1Id,
        'dashletTitle' => 'Mis Campanas Activas - Listado Completo',
    ],
    'rep2_dashlet' => [
        'className' => 'AORReportsDashlet',
        'module' => 'AOR_Reports',
        'forceColumn' => 0,
        'fileLocation' => 'modules/AOR_Reports/Dashlets/AORReportsDashlet/AORReportsDashlet.php',
        'aor_report_id' => $rep2Id,
        'dashletTitle' => 'Campanas Finalizadas / Inactivas (Historial)',
    ],
    'my_leads_dashlet' => [
        'className' => 'MyLeadsDashlet',
        'module' => 'Leads',
        'forceColumn' => 1,
        'fileLocation' => 'modules/Leads/Dashlets/MyLeadsDashlet/MyLeadsDashlet.php',
        'options' => [
            'title' => 'Mis Ultimos Prospectos Capturados',
        ]
    ],
    'activity_stream' => [
        'className' => 'SugarFeedDashlet',
        'module' => 'SugarFeed',
        'forceColumn' => 1,
        'fileLocation' => 'modules/SugarFeed/Dashlets/SugarFeedDashlet/SugarFeedDashlet.php',
    ]
];

$ctorresDashboardObj = [
    'dashlets' => [
        'dash_active_camp' => $marketingDashlets['top_campaigns_active'],
        'dash_roi_chart'   => $marketingDashlets['campaign_roi_chart'],
        'dash_rep1'        => $marketingDashlets['rep1_dashlet'],
        'dash_rep2'        => $marketingDashlets['rep2_dashlet'],
        'dash_leads'       => $marketingDashlets['my_leads_dashlet'],
        'dash_feed'        => $marketingDashlets['activity_stream'],
    ],
    'pages' => [
        0 => [
            'columns' => [
                0 => [
                    'width' => '60%',
                    'dashlets' => ['dash_active_camp', 'dash_roi_chart', 'dash_rep1', 'dash_rep2']
                ],
                1 => [
                    'width' => '40%',
                    'dashlets' => ['dash_leads', 'dash_feed']
                ]
            ],
            'numColumns' => 2,
            'pageTitleLabel' => 'Dashboard de Marketing - Campanas'
        ]
    ]
];

$encodedCtorres = base64_encode(serialize($ctorresDashboardObj));

// Save in user_preferences for ctorres
$db->query("DELETE FROM user_preferences WHERE assigned_user_id='$ctorresId' AND category='Home'");
$prefId = create_guid();
$now = TimeDate::getInstance()->nowDb();
$db->query("INSERT INTO user_preferences (id, category, deleted, date_entered, date_modified, assigned_user_id, contents) 
            VALUES ('$prefId', 'Home', 0, '$now', '$now', '$ctorresId', '$encodedCtorres')");

echo "-> Home Dashboard preferences saved for ctorres (Camila Torres).\n";

// 7. BUILD DASHBOARD PREFERENCES FOR DIRECTOR DE POSGRADO (SCARDENAS & DBENITEZ)
echo "\n[6] Configuring Executive Dashboard for Director de Posgrado...\n";

$executiveDashlets = [
    'executive_roi_chart' => [
        'className' => 'CampaignROIChartDashlet',
        'module' => 'Charts',
        'forceColumn' => 0,
        'fileLocation' => 'modules/Charts/Dashlets/CampaignROIChartDashlet/CampaignROIChartDashlet.php',
        'options' => [
            'title' => 'Retorno de Inversion (ROI) por Campana de Posgrado',
        ]
    ],
    'top_campaigns_exec' => [
        'className' => 'TopCampaignsDashlet',
        'module' => 'Campaigns',
        'forceColumn' => 0,
        'fileLocation' => 'modules/Campaigns/Dashlets/TopCampaignsDashlet/TopCampaignsDashlet.php',
        'options' => [
            'title' => 'Campanas con Mayor Rendimiento e Ingresos',
        ]
    ],
    'executive_report' => [
        'className' => 'AORReportsDashlet',
        'module' => 'AOR_Reports',
        'forceColumn' => 0,
        'fileLocation' => 'modules/AOR_Reports/Dashlets/AORReportsDashlet/AORReportsDashlet.php',
        'aor_report_id' => $repExecutiveId,
        'dashletTitle' => 'Informe Ejecutivo - Conversion y ROI por Maestria',
    ]
];

$directorDashboardObj = [
    'dashlets' => [
        'exec_chart'  => $executiveDashlets['executive_roi_chart'],
        'exec_top'    => $executiveDashlets['top_campaigns_exec'],
        'exec_rep'    => $executiveDashlets['executive_report']
    ],
    'pages' => [
        0 => [
            'columns' => [
                0 => [
                    'width' => '60%',
                    'dashlets' => ['exec_chart', 'exec_rep']
                ],
                1 => [
                    'width' => '40%',
                    'dashlets' => ['exec_top']
                ]
            ],
            'numColumns' => 2,
            'pageTitleLabel' => 'Dashboard Ejecutivo - Posgrados'
        ]
    ]
];

$encodedDirector = base64_encode(serialize($directorDashboardObj));

foreach ([$scardenasId, $dbenitezId] as $dUserId) {
    if (!empty($dUserId)) {
        $db->query("DELETE FROM user_preferences WHERE assigned_user_id='$dUserId' AND category='Home'");
        $prefId = create_guid();
        $db->query("INSERT INTO user_preferences (id, category, deleted, date_entered, date_modified, assigned_user_id, contents) 
                    VALUES ('$prefId', 'Home', 0, '$now', '$now', '$dUserId', '$encodedDirector')");
        echo "-> Executive Dashboard saved for user ID: $dUserId\n";
    }
}

// 8. CLEAR SUITECRM CACHE & REBUILD EXTENSIONS
echo "\n[7] Rebuilding Extensions & Clearing Cache...\n";
require_once('ModuleInstall/ModuleInstaller.php');
$mi = new ModuleInstaller();
$mi->silent = true;
$mi->rebuild_extensions();
$mi->rebuild_all();

echo "\n=====================================================\n";
echo "MARKETING & DIRECTOR DASHBOARDS CONFIGURED SUCCESSFULLY!\n";
echo "=====================================================\n";
