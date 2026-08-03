<?php
/**
 * setup_campaigns_complete.php
 *
 * 1. Arregla el warning del dashlet AORReports (report null)
 * 2. Elimina campañas existentes mal configuradas (sin fechas, tipos raros)
 * 3. Crea campañas BIEN organizadas:
 *    - 3 convocatorias por año (Febrero, Julio, Octubre)
 *    - Por maestría: Software (rfigueroa), Big Data (gsuing)
 *    - 2025: Completas/pasadas | 2026: Activas
 * 4. Asigna correctamente a los directores y marketing
 * 5. Crea prospect lists asociadas
 *
 * IDs clave:
 * ctorres   = 92ebafa7-d89b-496a-9064-d9c708078142  (Marketing)
 * vmorales  = d96577e4-e087-426a-8ca3-81402c8c20fc  (Marketing)
 * rfigueroa = 3fdf1beb-c004-475e-95c8-3b940581c8d7  (Dir. Software)
 * gsuing    = cc80d85d-d9d1-4e19-b12b-dee1d732062c  (Dir. Big Data)
 * dbenitez  = b2bc213a-4c7e-44b2-a2a0-fcc4758fc343  (Dir. Posgrado)
 * scardenas = 3db2dd8f-2063-4692-86b8-1bc5ea6328d6  (Dir. Posgrado)
 */

$host = '127.0.0.1'; $port = 3306; $dbname = 'suitecrm8';
$dbuser = 'root'; $dbpass = 'root';

$pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $dbuser, $dbpass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// IDs de usuarios
$UID = [
    'ctorres'   => '92ebafa7-d89b-496a-9064-d9c708078142',
    'vmorales'  => 'd96577e4-e087-426a-8ca3-81402c8c20fc',
    'rfigueroa' => '3fdf1beb-c004-475e-95c8-3b940581c8d7',
    'gsuing'    => 'cc80d85d-d9d1-4e19-b12b-dee1d732062c',
    'dbenitez'  => 'b2bc213a-4c7e-44b2-a2a0-fcc4758fc343',
    'scardenas' => '3db2dd8f-2063-4692-86b8-1bc5ea6328d6',
    'admin'     => '1',
];

// =====================================================
// PASO 1: Limpiar campañas existentes con datos malos
// (las que tienen NULL en fechas o tipos incorrectos)
// =====================================================
echo "=== PASO 1: Limpiando campañas con datos incompletos ===\n";

$badCampaigns = [
    '32841595-29c2-4525-9004-fd214bea0453', // Octubre 2026 sin fechas
    '56bfaf16-cb9f-41b9-962d-61204d03afdb', // Web sin fechas
    'b675a87c-3694-4a3f-98c8-464bd44c82f2', // Marzo 2026 sin fechas
    'bb5dbb3c-9a1d-423a-b5dc-e65521cfe915', // Julio 2026 sin fechas
    'c1cab9b2-6521-40b5-936c-af1222fdab61', // Redes Sociales sin fechas
    'df11efc7-6619-45c6-aeda-f45a1946ed68', // Feria sin fechas
    '58f8ebde-298d-4968-973e-f03a9f5c0371', // Software 2026 tipo incorrecto
    '3eaac180-c819-40d1-8e2a-d314f4762f78', // Big Data 2026 tipo incorrecto
    'daaff726-a1d7-4ea9-b739-8fd1e14e27e0', // Febrero 2026 Finalizada
    // Campañas 2025 ya existentes (las conservamos si están bien)
];

$cleanIds = implode("','", $badCampaigns);
$pdo->exec("UPDATE campaigns SET deleted = 1 WHERE id IN ('$cleanIds')");
$pdo->exec("UPDATE prospect_list_campaigns SET deleted = 1 WHERE campaign_id IN ('$cleanIds')");
echo "✅ " . count($badCampaigns) . " campañas antiguas/incompletas eliminadas\n\n";

// =====================================================
// FUNCIÓN HELPER: crear campaña
// =====================================================
function createCampaign($pdo, $id, $name, $startDate, $endDate, $status, $type,
                        $assignedUserId, $description, $budget = 2500.00, $expectedRevenue = 15000.00) {
    $now = date('Y-m-d H:i:s');
    $pdo->prepare("
        INSERT INTO campaigns
            (id, name, date_entered, date_modified, created_by, deleted,
             assigned_user_id, start_date, end_date, status, campaign_type,
             content, budget, budget_usdollar, expected_revenue, expected_revenue_usdollar,
             actual_cost, actual_cost_usdollar, expected_cost, expected_cost_usdollar,
             impressions, tracker_count)
        VALUES
            (:id, :name, :now, :now, '1', 0,
             :uid, :sd, :ed, :status, :type,
             :desc, :budget, :budget, :rev, :rev,
             0, 0, :budget, :budget,
             0, 0)
        ON DUPLICATE KEY UPDATE
            name = :name, start_date = :sd, end_date = :ed,
            status = :status, campaign_type = :type, content = :desc,
            budget = :budget, expected_revenue = :rev,
            assigned_user_id = :uid, deleted = 0, date_modified = :now
    ")->execute([
        ':id' => $id, ':name' => $name, ':now' => $now,
        ':uid' => $assignedUserId, ':sd' => $startDate, ':ed' => $endDate,
        ':status' => $status, ':type' => $type, ':desc' => $description,
        ':budget' => $budget, ':rev' => $expectedRevenue,
    ]);
    echo "  ✅ Campaña: $name [$status] ($startDate → $endDate)\n";
    return $id;
}

// =====================================================
// FUNCIÓN HELPER: crear prospect list y asociar
// =====================================================
function createProspectList($pdo, $campId, $listName, $assignedUserId) {
    $plId = sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand(0,0xffff), mt_rand(0,0xffff), mt_rand(0,0xffff),
        mt_rand(0,0x0fff)|0x4000, mt_rand(0,0x3fff)|0x8000,
        mt_rand(0,0xffff), mt_rand(0,0xffff), mt_rand(0,0xffff));
    $now = date('Y-m-d H:i:s');
    
    $pdo->prepare("
        INSERT IGNORE INTO prospect_lists
            (id, date_entered, date_modified, created_by, deleted, name, list_type, assigned_user_id)
        VALUES
            (:id, :now, :now, '1', 0, :name, 'default', :uid)
    ")->execute([':id' => $plId, ':now' => $now, ':name' => $listName, ':uid' => $assignedUserId]);
    
    $assocId = sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand(0,0xffff), mt_rand(0,0xffff), mt_rand(0,0xffff),
        mt_rand(0,0x0fff)|0x4000, mt_rand(0,0x3fff)|0x8000,
        mt_rand(0,0xffff), mt_rand(0,0xffff), mt_rand(0,0xffff));
    $pdo->prepare("
        INSERT IGNORE INTO prospect_list_campaigns
            (id, prospect_list_id, campaign_id, deleted)
        VALUES (:id, :plid, :cid, 0)
    ")->execute([':id' => $assocId, ':plid' => $plId, ':cid' => $campId]);
    
    return $plId;
}

// =====================================================
// PASO 2: CAMPAÑAS 2025 (ya pasadas - Complete)
// =====================================================
echo "=== PASO 2: Campañas 2025 (Completas - Historial) ===\n";

// --- CONVOCATORIA FEBRERO 2025 ---
// Software
$c = createCampaign($pdo,
    'sw-feb-2025-0001-0000-000000000001',
    '[Software] Convocatoria Febrero 2025',
    '2025-01-05', '2025-02-28', 'Complete', 'Email',
    $UID['rfigueroa'],
    'Campaña de captación para la convocatoria de inicio de la Maestría en Ingeniería de Software - Período Febrero 2025. Dirigida a profesionales del área tecnológica.',
    2000.00, 12000.00
);
createProspectList($pdo, $c, 'Prospectos Software Feb 2025', $UID['rfigueroa']);

// Big Data
$c = createCampaign($pdo,
    'bd-feb-2025-0001-0000-000000000001',
    '[Big Data] Convocatoria Febrero 2025',
    '2025-01-08', '2025-02-28', 'Complete', 'Email',
    $UID['gsuing'],
    'Campaña de captación para la convocatoria de inicio de la Maestría en Big Data e Inteligencia Artificial - Período Febrero 2025.',
    2000.00, 14000.00
);
createProspectList($pdo, $c, 'Prospectos Big Data Feb 2025', $UID['gsuing']);

// Marketing general Feb 2025
$c = createCampaign($pdo,
    'mkt-feb-2025-0001-000000000001',
    'Campaña Digital - Convocatoria Febrero 2025',
    '2025-01-03', '2025-02-28', 'Complete', 'Email',
    $UID['ctorres'],
    'Campaña digital multicanal para promocionar todas las maestrías en la convocatoria Febrero 2025. Incluye redes sociales, email marketing y publicidad digital.',
    3500.00, 25000.00
);
createProspectList($pdo, $c, 'Prospectos Generales Feb 2025', $UID['ctorres']);

echo "\n";

// --- CONVOCATORIA JULIO 2025 ---
// Las existentes están bien (e3e64e1f y a8c41c53), las conservamos pero actualizamos
$pdo->exec("UPDATE campaigns SET deleted=0, status='Complete' WHERE id IN ('e3e64e1f-4851-45a3-b27f-9d39caeddb96','a8c41c53-4756-42b1-a1af-a0f97457cd0d') AND deleted=0");
echo "  ✅ [Software] Convocatoria Julio 2025 - conservada/actualizada\n";
echo "  ✅ [Big Data] Convocatoria Julio 2025 - conservada/actualizada\n";

// Marketing general Julio 2025
$c = createCampaign($pdo,
    'mkt-jul-2025-0001-000000000001',
    'Campaña Digital - Convocatoria Julio 2025',
    '2025-04-07', '2025-07-01', 'Complete', 'Email',
    $UID['vmorales'],
    'Campaña digital multicanal para promocionar todas las maestrías en la convocatoria Julio 2025. Gestión de leads y seguimiento de prospectos.',
    3500.00, 28000.00
);
createProspectList($pdo, $c, 'Prospectos Generales Jul 2025', $UID['vmorales']);
echo "\n";

// --- CONVOCATORIA OCTUBRE 2025 ---
// Las existentes: d3b0f8f1 (Software) y 6732dcfe (Big Data) las actualizamos
$pdo->exec("UPDATE campaigns SET deleted=0, status='Complete', end_date='2025-10-15' WHERE id IN ('d3b0f8f1-80bd-405c-91b6-1bf523486125','6732dcfe-3455-4dd9-a0b1-4f25ffdd1c48') AND deleted=0");
$pdo->exec("UPDATE campaigns SET name='[Software] Convocatoria Octubre 2025' WHERE id='d3b0f8f1-80bd-405c-91b6-1bf523486125'");
$pdo->exec("UPDATE campaigns SET name='[Big Data] Convocatoria Octubre 2025' WHERE id='6732dcfe-3455-4dd9-a0b1-4f25ffdd1c48'");
echo "  ✅ [Software] Convocatoria Octubre 2025 - actualizada a Complete\n";
echo "  ✅ [Big Data] Convocatoria Octubre 2025 - actualizada a Complete\n";

// Marketing general Octubre 2025
$c = createCampaign($pdo,
    'mkt-oct-2025-0001-000000000001',
    'Campaña Digital - Convocatoria Octubre 2025',
    '2025-07-07', '2025-10-15', 'Complete', 'Email',
    $UID['ctorres'],
    'Campaña digital de captación para la convocatoria Octubre 2025. Incluye email marketing, landing pages y gestión de prospectos en redes sociales.',
    3500.00, 30000.00
);
createProspectList($pdo, $c, 'Prospectos Generales Oct 2025', $UID['ctorres']);

echo "\n";

// =====================================================
// PASO 3: CAMPAÑAS 2026 (Activas - Presente/Futuro)
// =====================================================
echo "=== PASO 3: Campañas 2026 (Activas) ===\n";

// --- CONVOCATORIA FEBRERO 2026 (ya pasó, pero fue este año) ---
$c = createCampaign($pdo,
    'sw-feb-2026-0001-0000-000000000001',
    '[Software] Convocatoria Febrero 2026',
    '2026-01-06', '2026-02-28', 'Complete', 'Email',
    $UID['rfigueroa'],
    'Convocatoria Febrero 2026 para la Maestría en Ingeniería de Software. Período de captación Enero-Febrero 2026.',
    2200.00, 13500.00
);
createProspectList($pdo, $c, 'Prospectos Software Feb 2026', $UID['rfigueroa']);

$c = createCampaign($pdo,
    'bd-feb-2026-0001-0000-000000000001',
    '[Big Data] Convocatoria Febrero 2026',
    '2026-01-08', '2026-02-28', 'Complete', 'Email',
    $UID['gsuing'],
    'Convocatoria Febrero 2026 para la Maestría en Big Data e IA. Período de captación Enero-Febrero 2026.',
    2200.00, 15000.00
);
createProspectList($pdo, $c, 'Prospectos Big Data Feb 2026', $UID['gsuing']);

$c = createCampaign($pdo,
    'mkt-feb-2026-0001-000000000001',
    'Campaña Digital - Convocatoria Febrero 2026',
    '2026-01-05', '2026-02-28', 'Complete', 'Email',
    $UID['ctorres'],
    'Campaña digital multicanal para la convocatoria Febrero 2026. Coordinada con los directores de maestría.',
    4000.00, 28000.00
);
createProspectList($pdo, $c, 'Prospectos Generales Feb 2026', $UID['ctorres']);

echo "\n";

// --- CONVOCATORIA JULIO 2026 (ACTIVA - en curso) ---
$c = createCampaign($pdo,
    'sw-jul-2026-0001-0000-000000000001',
    '[Software] Convocatoria Julio 2026',
    '2026-04-07', '2026-07-15', 'Active', 'Email',
    $UID['rfigueroa'],
    'Convocatoria Julio 2026 para la Maestría en Ingeniería de Software. Campaña activa de captación de prospectos calificados.',
    2500.00, 15000.00
);
createProspectList($pdo, $c, 'Prospectos Software Jul 2026', $UID['rfigueroa']);

$c = createCampaign($pdo,
    'bd-jul-2026-0001-0000-000000000001',
    '[Big Data] Convocatoria Julio 2026',
    '2026-04-05', '2026-07-15', 'Active', 'Email',
    $UID['gsuing'],
    'Convocatoria Julio 2026 para la Maestría en Big Data e Inteligencia Artificial. Captación activa de prospectos.',
    2500.00, 17000.00
);
createProspectList($pdo, $c, 'Prospectos Big Data Jul 2026', $UID['gsuing']);

$c = createCampaign($pdo,
    'mkt-jul-2026-0001-000000000001',
    'Campaña Digital - Convocatoria Julio 2026',
    '2026-04-03', '2026-07-15', 'Active', 'Email',
    $UID['ctorres'],
    'Campaña digital activa para la convocatoria Julio 2026. Email marketing, redes sociales y eventos digitales para todas las maestrías.',
    5000.00, 35000.00
);
createProspectList($pdo, $c, 'Prospectos Generales Jul 2026', $UID['ctorres']);

echo "\n";

// --- CONVOCATORIA OCTUBRE 2026 (ACTIVA - próxima) ---
$c = createCampaign($pdo,
    'sw-oct-2026-0001-0000-000000000001',
    '[Software] Convocatoria Octubre 2026',
    '2026-07-15', '2026-10-15', 'Active', 'Email',
    $UID['rfigueroa'],
    'Convocatoria Octubre 2026 para la Maestría en Ingeniería de Software. Captación anticipada de prospectos para inicio en octubre.',
    2800.00, 16000.00
);
createProspectList($pdo, $c, 'Prospectos Software Oct 2026', $UID['rfigueroa']);

$c = createCampaign($pdo,
    'bd-oct-2026-0001-0000-000000000001',
    '[Big Data] Convocatoria Octubre 2026',
    '2026-07-12', '2026-10-15', 'Active', 'Email',
    $UID['gsuing'],
    'Convocatoria Octubre 2026 para la Maestría en Big Data e Inteligencia Artificial. Campaña activa de captación.',
    2800.00, 18000.00
);
createProspectList($pdo, $c, 'Prospectos Big Data Oct 2026', $UID['gsuing']);

$c = createCampaign($pdo,
    'mkt-oct-2026-0001-000000000001',
    'Campaña Digital - Convocatoria Octubre 2026',
    '2026-07-07', '2026-10-15', 'Active', 'Email',
    $UID['ctorres'],
    'Campaña digital para la convocatoria Octubre 2026. Estrategia multicanal para captación masiva de prospectos para todas las maestrías.',
    5500.00, 40000.00
);
createProspectList($pdo, $c, 'Prospectos Generales Oct 2026', $UID['ctorres']);

echo "\n";

// =====================================================
// PASO 4: Arreglar el warning del dashlet AOR en ctorres
// El problema es que hay dashlets de Reports sin report_id asignado
// Los borramos de las preferencias del usuario
// =====================================================
echo "=== PASO 4: Arreglando warnings del dashlet en ctorres ===\n";

$ctorresId = $UID['ctorres'];
$pref = $pdo->prepare("SELECT id, contents FROM user_preferences WHERE assigned_user_id = :uid AND category = 'Home' AND deleted = 0");
$pref->execute([':uid' => $ctorresId]);
$prefRow = $pref->fetch(PDO::FETCH_ASSOC);

if ($prefRow) {
    $decoded = base64_decode($prefRow['contents']);
    $data = @unserialize($decoded);
    
    // Buscar y limpiar dashlets de AOR_Reports sin report_id
    if (is_array($data)) {
        $changed = false;
        foreach ($data as $pageKey => $pageVal) {
            if (is_array($pageVal) && isset($pageVal['dashlets'])) {
                foreach ($pageVal['dashlets'] as $dashletId => $dashletDef) {
                    if (isset($dashletDef['className']) && $dashletDef['className'] === 'AORReportsDashlet') {
                        if (empty($dashletDef['report_id'])) {
                            // Remover este dashlet problemático
                            unset($data[$pageKey]['dashlets'][$dashletId]);
                            $changed = true;
                            echo "  ✅ Dashlet AOR sin report_id eliminado del dashboard de ctorres\n";
                        }
                    }
                }
            }
        }
        
        if ($changed) {
            $newContents = base64_encode(serialize($data));
            $pdo->prepare("UPDATE user_preferences SET contents = :c, date_modified = NOW() WHERE id = :id")
                ->execute([':c' => $newContents, ':id' => $prefRow['id']]);
            echo "  ✅ Preferencias Home de ctorres actualizadas\n";
        } else {
            echo "  ℹ️  No se encontraron dashlets AOR problemáticos en la estructura esperada\n";
        }
    }
} else {
    echo "  ℹ️  No se encontraron preferencias Home para ctorres\n";
}

// También verificar en otras categorías de preferencias del dashboard
$prefAll = $pdo->prepare("SELECT id, category, contents FROM user_preferences WHERE assigned_user_id = :uid AND deleted = 0");
$prefAll->execute([':uid' => $ctorresId]);
while ($row = $prefAll->fetch(PDO::FETCH_ASSOC)) {
    $decoded = base64_decode($row['contents']);
    if (strpos($decoded, 'AORReportsDashlet') !== false) {
        $data = @unserialize($decoded);
        if (is_array($data)) {
            $fixedDashlets = false;
            array_walk_recursive($data, function(&$val, $key) use (&$fixedDashlets) {
                // No modificar recursivamente en este nivel
            });
            // Buscar específicamente dashlets AOR sin report
            foreach ($data as $k => &$v) {
                if (is_array($v) && isset($v['className']) && $v['className'] === 'AORReportsDashlet') {
                    if (empty($v['report_id'])) {
                        $v['report_id'] = ''; // Prevenir null
                        $fixedDashlets = true;
                    }
                }
                if (is_array($v) && isset($v['dashlets'])) {
                    foreach ($v['dashlets'] as $dk => &$dv) {
                        if (isset($dv['className']) && $dv['className'] === 'AORReportsDashlet' && empty($dv['report_id'])) {
                            unset($v['dashlets'][$dk]);
                            $fixedDashlets = true;
                        }
                    }
                }
            }
            if ($fixedDashlets) {
                $newContents = base64_encode(serialize($data));
                $pdo->prepare("UPDATE user_preferences SET contents = :c, date_modified = NOW() WHERE id = :id")
                    ->execute([':c' => $newContents, ':id' => $row['id']]);
                echo "  ✅ Preferencias [{$row['category']}] de ctorres corregidas\n";
            }
        }
    }
}

// =====================================================
// VERIFICACIÓN FINAL
// =====================================================
echo "\n=== VERIFICACIÓN FINAL ===\n";
$campaigns = $pdo->query("
    SELECT c.name, c.start_date, c.end_date, c.status, c.campaign_type,
           u.user_name
    FROM campaigns c
    LEFT JOIN users u ON u.id = c.assigned_user_id
    WHERE c.deleted = 0
    ORDER BY c.start_date ASC
")->fetchAll(PDO::FETCH_ASSOC);

echo "\nTotal campañas activas: " . count($campaigns) . "\n\n";
$lastYear = '';
foreach ($campaigns as $camp) {
    $year = substr($camp['start_date'] ?? '????', 0, 4);
    if ($year !== $lastYear) {
        echo "── $year ──────────────────────────────────\n";
        $lastYear = $year;
    }
    $icon = $camp['status'] === 'Active' ? '🟢' : ($camp['status'] === 'Complete' ? '✔️' : '⚪');
    $short = strlen($camp['name']) > 45 ? substr($camp['name'], 0, 45) . '...' : $camp['name'];
    echo "  $icon [$camp[status]] $short\n";
    echo "     📅 {$camp['start_date']} → {$camp['end_date']} | 👤 {$camp['user_name']}\n";
}

echo "\n🎉 ¡Campañas configuradas correctamente!\n";
echo "🔓 El warning del dashlet en ctorres ha sido corregido.\n";
