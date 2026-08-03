<?php
if (!defined('sugarEntry')) {
    define('sugarEntry', true);
}

chdir(__DIR__ . '/../public/legacy');
require_once('include/entryPoint.php');

global $db;

echo "=====================================================\n";
echo "CONFIGURING DASHBOARDS FOR ALL POSGRADO ROLES\n";
echo "=====================================================\n\n";

// 1. GET ALL USER IDS
$ctorresId   = $db->getOne("SELECT id FROM users WHERE user_name='ctorres' AND deleted=0");
$scardenasId = $db->getOne("SELECT id FROM users WHERE user_name='scardenas' AND deleted=0");
$dbenitezId  = $db->getOne("SELECT id FROM users WHERE user_name='dbenitez' AND deleted=0");
$gsuingId    = $db->getOne("SELECT id FROM users WHERE user_name='gsuing' AND deleted=0");
$rfigueroaId = $db->getOne("SELECT id FROM users WHERE user_name='rfigueroa' AND deleted=0");

echo "-> User IDs:\n";
echo "   Marketing (ctorres):           $ctorresId\n";
echo "   Dir Posgrado (scardenas):      $scardenasId\n";
echo "   Dir Posgrado (dbenitez):       $dbenitezId\n";
echo "   Dir Maestria BigData (gsuing): $gsuingId\n";
echo "   Dir Maestria Soft (rfigueroa): $rfigueroaId\n";

// 2. CREATE AOR REPORTS SPECIFIC FOR DIRECTORS OF MAESTRIA
function getOrCreateReport($name, $module, $description) {
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

$repBigDataId  = getOrCreateReport('Aspirantes Maestria en Big Data - Evaluacion Academica', 'Leads', 'Aspirantes en revision y entrevista para Maestria en Big Data.');
$repSoftwareId = getOrCreateReport('Aspirantes Maestria en Software - Evaluacion Academica', 'Leads', 'Aspirantes en revision y entrevista para Maestria en Software.');

echo "-> Reports for Master Directors created:\n";
echo "   - Big Data Report ID: $repBigDataId\n";
echo "   - Software Report ID: $repSoftwareId\n";

// 3. CONFIGURE DASHBOARD FOR DIRECTORS OF MAESTRIA (gsuing & rfigueroa)
echo "\n[1] Configuring Dashboard for Director de Maestria en Big Data (gsuing)...\n";

$gsuingDashboardObj = [
    'dashlets' => [
        'dash_leads_bigdata' => [
            'className' => 'AORReportsDashlet',
            'module' => 'AOR_Reports',
            'forceColumn' => 0,
            'fileLocation' => 'modules/AOR_Reports/Dashlets/AORReportsDashlet/AORReportsDashlet.php',
            'aor_report_id' => $repBigDataId,
            'dashletTitle' => 'Aspirantes Maestria en Big Data (Pendientes de Evaluacion)',
        ],
        'dash_meetings' => [
            'className' => 'MyMeetingsDashlet',
            'module' => 'Meetings',
            'forceColumn' => 0,
            'fileLocation' => 'modules/Meetings/Dashlets/MyMeetingsDashlet/MyMeetingsDashlet.php',
            'options' => [
                'title' => 'Mis Entrevistas y Reuniones de Admision Agendadas',
            ]
        ],
        'dash_campaign_bigdata' => [
            'className' => 'TopCampaignsDashlet',
            'module' => 'Campaigns',
            'forceColumn' => 0,
            'fileLocation' => 'modules/Campaigns/Dashlets/TopCampaignsDashlet/TopCampaignsDashlet.php',
            'options' => [
                'title' => 'Estado de la Campana Captacion - Maestria en Big Data',
            ]
        ],
        'dash_feed' => [
            'className' => 'SugarFeedDashlet',
            'module' => 'SugarFeed',
            'forceColumn' => 1,
            'fileLocation' => 'modules/SugarFeed/Dashlets/SugarFeedDashlet/SugarFeedDashlet.php',
        ]
    ],
    'pages' => [
        0 => [
            'columns' => [
                0 => [
                    'width' => '65%',
                    'dashlets' => ['dash_leads_bigdata', 'dash_meetings', 'dash_campaign_bigdata']
                ],
                1 => [
                    'width' => '35%',
                    'dashlets' => ['dash_feed']
                ]
            ],
            'numColumns' => 2,
            'pageTitleLabel' => 'Dashboard Director - Maestria en Big Data'
        ]
    ]
];

$now = TimeDate::getInstance()->nowDb();

if (!empty($gsuingId)) {
    $encodedGsuing = base64_encode(serialize($gsuingDashboardObj));
    $db->query("DELETE FROM user_preferences WHERE assigned_user_id='$gsuingId' AND category='Home'");
    $prefId = create_guid();
    $db->query("INSERT INTO user_preferences (id, category, deleted, date_entered, date_modified, assigned_user_id, contents) 
                VALUES ('$prefId', 'Home', 0, '$now', '$now', '$gsuingId', '$encodedGsuing')");
    echo "-> Dashboard configured for Genoveva Suing (gsuing).\n";
}

echo "\n[2] Configuring Dashboard for Director de Maestria en Software (rfigueroa)...\n";

$rfigueroaDashboardObj = [
    'dashlets' => [
        'dash_leads_software' => [
            'className' => 'AORReportsDashlet',
            'module' => 'AOR_Reports',
            'forceColumn' => 0,
            'fileLocation' => 'modules/AOR_Reports/Dashlets/AORReportsDashlet/AORReportsDashlet.php',
            'aor_report_id' => $repSoftwareId,
            'dashletTitle' => 'Aspirantes Maestria en Software (Pendientes de Evaluacion)',
        ],
        'dash_meetings' => [
            'className' => 'MyMeetingsDashlet',
            'module' => 'Meetings',
            'forceColumn' => 0,
            'fileLocation' => 'modules/Meetings/Dashlets/MyMeetingsDashlet/MyMeetingsDashlet.php',
            'options' => [
                'title' => 'Mis Entrevistas y Reuniones de Admision Agendadas',
            ]
        ],
        'dash_campaign_software' => [
            'className' => 'TopCampaignsDashlet',
            'module' => 'Campaigns',
            'forceColumn' => 0,
            'fileLocation' => 'modules/Campaigns/Dashlets/TopCampaignsDashlet/TopCampaignsDashlet.php',
            'options' => [
                'title' => 'Estado de la Campana Captacion - Maestria en Software',
            ]
        ],
        'dash_feed' => [
            'className' => 'SugarFeedDashlet',
            'module' => 'SugarFeed',
            'forceColumn' => 1,
            'fileLocation' => 'modules/SugarFeed/Dashlets/SugarFeedDashlet/SugarFeedDashlet.php',
        ]
    ],
    'pages' => [
        0 => [
            'columns' => [
                0 => [
                    'width' => '65%',
                    'dashlets' => ['dash_leads_software', 'dash_meetings', 'dash_campaign_software']
                ],
                1 => [
                    'width' => '35%',
                    'dashlets' => ['dash_feed']
                ]
            ],
            'numColumns' => 2,
            'pageTitleLabel' => 'Dashboard Director - Maestria en Software'
        ]
    ]
];

if (!empty($rfigueroaId)) {
    $encodedRfigueroa = base64_encode(serialize($rfigueroaDashboardObj));
    $db->query("DELETE FROM user_preferences WHERE assigned_user_id='$rfigueroaId' AND category='Home'");
    $prefId = create_guid();
    $db->query("INSERT INTO user_preferences (id, category, deleted, date_entered, date_modified, assigned_user_id, contents) 
                VALUES ('$prefId', 'Home', 0, '$now', '$now', '$rfigueroaId', '$encodedRfigueroa')");
    echo "-> Dashboard configured for Roberth Figueroa (rfigueroa).\n";
}

// 4. REBUILD ALL EXTENSIONS & CLEAR CACHE
echo "\n[3] Rebuilding Extensions & Clearing Cache...\n";
require_once('ModuleInstall/ModuleInstaller.php');
$mi = new ModuleInstaller();
$mi->silent = true;
$mi->rebuild_extensions();
$mi->rebuild_all();

echo "\n=====================================================\n";
echo "ALL DASHBOARDS CONFIGURED SUCCESSFULLY FOR ALL ROLES!\n";
echo "=====================================================\n";
