<?php
/**
 * reorganize_campaigns_maestrias.php
 *
 * 1. Renombra campañas quitando prefijos [Software]/[Big Data]
 * 2. Deja SOLO Octubre 2026 como Active, todo lo demás Complete
 * 3. Crea/actualiza Maestrías como Products en SuiteCRM con modalidad
 * 4. Conecta cada maestría a su director (assigned_user_id)
 * 5. Asocia leads a la campaña correcta y estandariza maestria_interesada_c
 * 6. Crea prospect lists segmentadas por maestría dentro de cada campaña
 */

$host='127.0.0.1'; $port=3306; $dbname='suitecrm8'; $dbuser='root'; $dbpass='root';
$pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $dbuser, $dbpass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// ─── IDs de usuarios clave ───────────────────────────────────────
$USERS = [
    'admin'     => '1',
    'ctorres'   => '92ebafa7-d89b-496a-9064-d9c708078142',  // Marketing
    'vmorales'  => 'd96577e4-e087-426a-8ca3-81402c8c20fc',  // Marketing
    'rfigueroa' => '3fdf1beb-c004-475e-95c8-3b940581c8d7',  // Dir. Ing. Software
    'gsuing'    => 'cc80d85d-d9d1-4e19-b12b-dee1d732062c',  // Dir. Big Data
    'dbenitez'  => 'b2bc213a-4c7e-44b2-a2a0-fcc4758fc343',  // Dirección Posgrado
    'scardenas' => '3db2dd8f-2063-4692-86b8-1bc5ea6328d6',  // Dirección Posgrado
    'arivas'    => '511759fd-8967-41d9-adfe-721e8cfdc9a0',  // Asesor Admisiones
];

$EMAIL_CONTACTO = 'brandon.medina@unl.edu.ec';
$now = date('Y-m-d H:i:s');

function uuid() {
    return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand(0,0xffff),mt_rand(0,0xffff),mt_rand(0,0xffff),
        mt_rand(0,0x0fff)|0x4000, mt_rand(0,0x3fff)|0x8000,
        mt_rand(0,0xffff),mt_rand(0,0xffff),mt_rand(0,0xffff));
}

// ─── PASO 1: RENOMBRAR CAMPAÑAS ──────────────────────────────────
echo "=== PASO 1: Renombrando campañas (sin prefijos) ===\n";

$renames = [
    // Prefijo → nombre limpio
    'sw-feb-2025-0001-0000-000000000001' => 'Convocatoria Febrero 2025 - Ingeniería de Software',
    'bd-feb-2025-0001-0000-000000000001' => 'Convocatoria Febrero 2025 - Big Data & Data Science',
    'mkt-feb-2025-0001-000000000001'     => 'Campaña Digital - Convocatoria Febrero 2025',
    'b603b90e-02d7-4267-8fa7-7609f1ec09f1' => 'Convocatoria Marzo 2025 - Big Data & Data Science',
    'fdee0bb5-7a30-4b4e-80dd-79f9ebcd0205' => 'Convocatoria Marzo 2025 - Ingeniería de Software',
    'a8c41c53-4756-42b1-a1af-a0f97457cd0d' => 'Convocatoria Julio 2025 - Big Data & Data Science',
    'e3e64e1f-4851-45a3-b27f-9d39caeddb96' => 'Convocatoria Julio 2025 - Ingeniería de Software',
    'mkt-jul-2025-0001-000000000001'     => 'Campaña Digital - Convocatoria Julio 2025',
    '6732dcfe-3455-4dd9-a0b1-4f25ffdd1c48' => 'Convocatoria Octubre 2025 - Big Data & Data Science',
    'd3b0f8f1-80bd-405c-91b6-1bf523486125' => 'Convocatoria Octubre 2025 - Ingeniería de Software',
    'mkt-oct-2025-0001-000000000001'     => 'Campaña Digital - Convocatoria Octubre 2025',
    'sw-feb-2026-0001-0000-000000000001' => 'Convocatoria Febrero 2026 - Ingeniería de Software',
    'bd-feb-2026-0001-0000-000000000001' => 'Convocatoria Febrero 2026 - Big Data & Data Science',
    'mkt-feb-2026-0001-000000000001'     => 'Campaña Digital - Convocatoria Febrero 2026',
    'sw-jul-2026-0001-0000-000000000001' => 'Convocatoria Julio 2026 - Ingeniería de Software',
    'bd-jul-2026-0001-0000-000000000001' => 'Convocatoria Julio 2026 - Big Data & Data Science',
    'mkt-jul-2026-0001-000000000001'     => 'Campaña Digital - Convocatoria Julio 2026',
    'sw-oct-2026-0001-0000-000000000001' => 'Convocatoria Octubre 2026 - Ingeniería de Software',
    'bd-oct-2026-0001-0000-000000000001' => 'Convocatoria Octubre 2026 - Big Data & Data Science',
    'mkt-oct-2026-0001-000000000001'     => 'Campaña Digital - Convocatoria Octubre 2026',
];

foreach ($renames as $id => $name) {
    $pdo->prepare("UPDATE campaigns SET name=:n, date_modified=:dm WHERE id=:id")
        ->execute([':n'=>$name, ':dm'=>$now, ':id'=>$id]);
    echo "  ✅ $name\n";
}

// ─── PASO 2: SOLO OCTUBRE 2026 ACTIVO, RESTO COMPLETE ────────────
echo "\n=== PASO 2: Solo Octubre 2026 activo ===\n";

// Todo a Complete
$pdo->exec("UPDATE campaigns SET status='Complete', date_modified='$now' WHERE deleted=0");

// Solo las 3 de octubre 2026 se quedan Active
$oct2026 = ['sw-oct-2026-0001-0000-000000000001','bd-oct-2026-0001-0000-000000000001','mkt-oct-2026-0001-000000000001'];
$idsStr = implode("','", $oct2026);
$pdo->exec("UPDATE campaigns SET status='Active', date_modified='$now' WHERE id IN ('$idsStr')");
echo "  ✅ Campañas Octubre 2026 marcadas como Active\n";
echo "  ✅ Todas las demás marcadas como Complete\n";

// ─── PASO 3: CREAR MAESTRÍAS COMO CATEGORÍAS DE PRODUCTO ─────────
// SuiteCRM no tiene módulo "Maestría" nativo, usamos AOS_Products_Quotes
// pero lo mejor es usar un custom approach con categorías + productos
// Las maestrías se modelan como "Products" en la categoría "Posgrados UNL"
// Y se conectan a los leads via el campo maestria_interesada_c

echo "\n=== PASO 3: Creando Maestrías (catálogo de programas) ===\n";

// Primero, crear la categoría padre "Posgrados UNL"
$catId = uuid();
$pdo->prepare("
    INSERT IGNORE INTO aos_product_categories
        (id, name, description, date_entered, date_modified, created_by, deleted, is_parent)
    VALUES (:id, 'Posgrados UNL', 'Programas de posgrado de la Universidad Nacional de Loja', :now, :now, '1', 0, 1)
")->execute([':id'=>$catId, ':now'=>$now]);
// Recuperar el ID real si ya existía
$existCat = $pdo->query("SELECT id FROM aos_product_categories WHERE name='Posgrados UNL' AND deleted=0 LIMIT 1")->fetchColumn();
if ($existCat) $catId = $existCat;
echo "  ✅ Categoría 'Posgrados UNL': $catId\n";

// Definición de maestrías UNL (según foto del sitio y datos del sistema)
// Formato: [nombre, modalidad, director_user_id, descripción, precio_matricula]
$maestrias = [
    // ── Maestrías rfigueroa (Ingeniería de Software) ──────────────
    [
        'key'       => 'maestria_software',
        'nombre'    => 'Maestría en Ingeniería de Software',
        'modalidad' => 'En línea',
        'director'  => $USERS['rfigueroa'],
        'director_nombre' => 'Roberth Figueroa',
        'desc'      => 'Programa de posgrado orientado al desarrollo de competencias avanzadas en ingeniería y arquitectura de software. Modalidad en línea, duración 2 años.',
        'precio'    => 4200.00,
        'duracion'  => '2 años (4 semestres)',
        'resolucion'=> 'RPC-SO-10-No.171-2024',
    ],
    // ── Maestrías gsuing (Big Data) ───────────────────────────────
    [
        'key'       => 'maestria_bigdata',
        'nombre'    => 'Maestría en Big Data & Data Science',
        'modalidad' => 'En línea',
        'director'  => $USERS['gsuing'],
        'director_nombre' => 'Genoveva Suing',
        'desc'      => 'Programa de posgrado en análisis masivo de datos, inteligencia artificial aplicada y ciencia de datos. Modalidad en línea.',
        'precio'    => 4500.00,
        'duracion'  => '2 años (4 semestres)',
        'resolucion'=> 'RPC-SO-28-No.444-2022',
    ],
    [
        'key'       => 'maestria_ia',
        'nombre'    => 'Maestría en Inteligencia Artificial',
        'modalidad' => 'Híbrida',
        'director'  => $USERS['gsuing'],
        'director_nombre' => 'Genoveva Suing',
        'desc'      => 'Programa de posgrado en inteligencia artificial, aprendizaje automático y sistemas inteligentes. Modalidad híbrida.',
        'precio'    => 4500.00,
        'duracion'  => '2 años (4 semestres)',
        'resolucion'=> 'RPC-SO-37-No.596-2022',
    ],
    // ── Maestrías bajo Dirección de Posgrado (dbenitez/scardenas) ─
    [
        'key'       => 'maestria_tics',
        'nombre'    => 'Maestría en Gestión de Tecnologías de Información',
        'modalidad' => 'En línea',
        'director'  => $USERS['dbenitez'],
        'director_nombre' => 'David Benítez',
        'desc'      => 'Programa de posgrado en gestión estratégica de TI, gobierno de tecnología y transformación digital.',
        'precio'    => 4000.00,
        'duracion'  => '2 años (4 semestres)',
        'resolucion'=> 'RPC-SO-15-No.302-2023',
    ],
    [
        'key'       => 'maestria_seginfo',
        'nombre'    => 'Maestría en Seguridad de la Información',
        'modalidad' => 'En línea',
        'director'  => $USERS['dbenitez'],
        'director_nombre' => 'David Benítez',
        'desc'      => 'Posgrado en ciberseguridad, gestión de riesgos informáticos y protección de datos. Modalidad en línea.',
        'precio'    => 4000.00,
        'duracion'  => '2 años (4 semestres)',
        'resolucion'=> 'RPC-SO-22-No.395-2023',
    ],
    [
        'key'       => 'maestria_salud',
        'nombre'    => 'Maestría en Gerencia de Salud',
        'modalidad' => 'Híbrida',
        'director'  => $USERS['scardenas'],
        'director_nombre' => 'Sofía Cárdenas',
        'desc'      => 'Programa de gestión y administración de sistemas de salud con enfoque en políticas públicas. Modalidad híbrida.',
        'precio'    => 3800.00,
        'duracion'  => '2 años (4 semestres)',
        'resolucion'=> 'RPC-SO-08-No.145-2022',
    ],
    [
        'key'       => 'maestria_talento',
        'nombre'    => 'Maestría en Gestión de Talento Humano',
        'modalidad' => 'Presencial',
        'director'  => $USERS['scardenas'],
        'director_nombre' => 'Sofía Cárdenas',
        'desc'      => 'Posgrado en gestión de recursos humanos, liderazgo organizacional y desarrollo del talento. Modalidad presencial.',
        'precio'    => 3800.00,
        'duracion'  => '2 años (4 semestres)',
        'resolucion'=> 'RPC-SO-11-No.198-2023',
    ],
];

// Iconos de modalidad
$modIcon = ['En línea'=>'💻','Híbrida'=>'🔄','Presencial'=>'🏫'];

// IDs de productos por clave (para referencias futuras)
$productIds = [];

foreach ($maestrias as $m) {
    // Buscar si ya existe
    $existing = $pdo->prepare("SELECT id FROM aos_products WHERE name=:n AND deleted=0 LIMIT 1");
    $existing->execute([':n' => $m['nombre']]);
    $pId = $existing->fetchColumn();

    if (!$pId) {
        $pId = uuid();
        $pdo->prepare("
            INSERT INTO aos_products
                (id, name, description, date_entered, date_modified, created_by,
                 deleted, assigned_user_id, aos_product_category_id, currency_id,
                 price, price_usdollar)
            VALUES
                (:id, :name, :desc, :now, :now, '1',
                 0, :uid, :cat, '-99',
                 :price, :price)
        ")->execute([
            ':id'    => $pId,
            ':name'  => $m['nombre'],
            ':desc'  => $m['desc'] . ' | Director: ' . $m['director_nombre'] .
                        ' | Modalidad: ' . $m['modalidad'] .
                        ' | Duración: ' . $m['duracion'] .
                        ' | Resolución: ' . $m['resolucion'] .
                        ' | Contacto: ' . $EMAIL_CONTACTO,
            ':now'   => $now,
            ':uid'   => $m['director'],
            ':cat'   => $catId,
            ':price' => $m['precio'],
        ]);
        echo "  ✅ {$modIcon[$m['modalidad']]} [{$m['modalidad']}] {$m['nombre']} → Director: {$m['director_nombre']}\n";
    } else {
        // Actualizar
        $pdo->prepare("UPDATE aos_products SET description=:d, assigned_user_id=:u, date_modified=:now WHERE id=:id")
            ->execute([
                ':d'   => $m['desc'].' | Director: '.$m['director_nombre'].' | Modalidad: '.$m['modalidad'].' | Contacto: '.$EMAIL_CONTACTO,
                ':u'   => $m['director'], ':now'=>$now, ':id'=>$pId
            ]);
        echo "  🔄 {$modIcon[$m['modalidad']]} [{$m['modalidad']}] {$m['nombre']} → actualizada\n";
    }
    $productIds[$m['key']] = $pId;
}

// ─── PASO 4: ESTANDARIZAR CAMPO maestria_interesada_c EN LEADS ────
echo "\n=== PASO 4: Estandarizando maestría_interesada_c en leads ===\n";

// Mapa de normalización de nombres inconsistentes
$normMap = [
    'Ingeniería de Software'            => 'Maestría en Ingeniería de Software',
    'Big Data Analytics'                => 'Maestría en Big Data & Data Science',
    'Maestría en Big Data & Data Science' => 'Maestría en Big Data & Data Science',
    'Maestría en Big Data  Data Science'  => 'Maestría en Big Data & Data Science',
    'Maestría en Ingeniería de Software'  => 'Maestría en Ingeniería de Software',
    'Maestría en Inteligencia Artificial' => 'Maestría en Inteligencia Artificial',
    'Maestría en Gestión de Tecnologías de Información' => 'Maestría en Gestión de Tecnologías de Información',
    'Maestría en Seguridad de la Información' => 'Maestría en Seguridad de la Información',
    'Maestría en Gerencia de Salud'       => 'Maestría en Gerencia de Salud',
    'Maestría en Gestión de Talento Humano' => 'Maestría en Gestión de Talento Humano',
];

foreach ($normMap as $from => $to) {
    $cnt = $pdo->prepare("UPDATE leads_cstm SET maestria_interesada_c=:to WHERE maestria_interesada_c=:from");
    $cnt->execute([':to'=>$to, ':from'=>$from]);
    if ($cnt->rowCount() > 0) {
        echo "  ✅ '$from' → '$to' ({$cnt->rowCount()} leads)\n";
    }
}

// ─── PASO 5: CONECTAR LEADS A CAMPAÑA OCTUBRE 2026 (la activa) ───
echo "\n=== PASO 5: Conectando leads sin campaña a Octubre 2026 ===\n";

// Leads sin campaña → asignar a la campaña Octubre 2026 de su maestría
// Software → sw-oct-2026, Big Data/IA → bd-oct-2026, resto → mkt-oct-2026
$leadsSinCampaña = $pdo->query("
    SELECT l.id, l.assigned_user_id, lc.maestria_interesada_c
    FROM leads l
    LEFT JOIN leads_cstm lc ON lc.id_c = l.id
    WHERE l.deleted=0 AND (l.campaign_id IS NULL OR l.campaign_id='')
")->fetchAll(PDO::FETCH_ASSOC);

$campMap = [
    'Maestría en Ingeniería de Software'            => 'sw-oct-2026-0001-0000-000000000001',
    'Maestría en Big Data & Data Science'           => 'bd-oct-2026-0001-0000-000000000001',
    'Maestría en Inteligencia Artificial'           => 'bd-oct-2026-0001-0000-000000000001',
    'Maestría en Gestión de Tecnologías de Información' => 'mkt-oct-2026-0001-000000000001',
    'Maestría en Seguridad de la Información'       => 'mkt-oct-2026-0001-000000000001',
    'Maestría en Gerencia de Salud'                 => 'mkt-oct-2026-0001-000000000001',
    'Maestría en Gestión de Talento Humano'         => 'mkt-oct-2026-0001-000000000001',
];

$assigned = 0;
foreach ($leadsSinCampaña as $lead) {
    $maestria = $lead['maestria_interesada_c'] ?? '';
    $campId   = $campMap[$maestria] ?? 'mkt-oct-2026-0001-000000000001';
    $pdo->prepare("UPDATE leads SET campaign_id=:c, date_modified=:dm WHERE id=:id")
        ->execute([':c'=>$campId, ':dm'=>$now, ':id'=>$lead['id']]);
    $assigned++;
}
echo "  ✅ $assigned leads asignados a campaña Octubre 2026\n";

// ─── PASO 6: CREAR PROSPECT LISTS SEGMENTADAS POR MAESTRÍA ────────
echo "\n=== PASO 6: Prospect Lists segmentadas en campaña Octubre 2026 ===\n";

// Para cada campaña Octubre 2026, crear una prospect list con los leads correspondientes
$oct2026Camps = [
    'sw-oct-2026-0001-0000-000000000001' => [
        'list_name'  => 'Prospectos Ing. Software - Oct 2026',
        'maestrias'  => ['Maestría en Ingeniería de Software'],
        'director'   => $USERS['rfigueroa'],
    ],
    'bd-oct-2026-0001-0000-000000000001' => [
        'list_name'  => 'Prospectos Big Data & IA - Oct 2026',
        'maestrias'  => ['Maestría en Big Data & Data Science','Maestría en Inteligencia Artificial'],
        'director'   => $USERS['gsuing'],
    ],
    'mkt-oct-2026-0001-000000000001' => [
        'list_name'  => 'Prospectos Generales Posgrados - Oct 2026',
        'maestrias'  => ['Maestría en Gestión de Tecnologías de Información',
                         'Maestría en Seguridad de la Información',
                         'Maestría en Gerencia de Salud',
                         'Maestría en Gestión de Talento Humano'],
        'director'   => $USERS['ctorres'],
    ],
];

foreach ($oct2026Camps as $campId => $cfg) {
    // Verificar/crear prospect list
    $plCheck = $pdo->prepare("SELECT id FROM prospect_lists WHERE name=:n AND deleted=0 LIMIT 1");
    $plCheck->execute([':n' => $cfg['list_name']]);
    $plId = $plCheck->fetchColumn();
    
    if (!$plId) {
        $plId = uuid();
        $pdo->prepare("
            INSERT INTO prospect_lists (id, date_entered, date_modified, created_by, deleted, name, list_type, assigned_user_id)
            VALUES (:id, :now, :now, '1', 0, :name, 'default', :uid)
        ")->execute([':id'=>$plId, ':now'=>$now, ':name'=>$cfg['list_name'], ':uid'=>$cfg['director']]);
        
        // Asociar a la campaña
        $assocId = uuid();
        $pdo->prepare("INSERT IGNORE INTO prospect_list_campaigns (id, prospect_list_id, campaign_id, deleted) VALUES (:id,:plid,:cid,0)")
            ->execute([':id'=>$assocId, ':plid'=>$plId, ':cid'=>$campId]);
        echo "  ✅ Lista '{$cfg['list_name']}' creada\n";
    } else {
        echo "  🔄 Lista '{$cfg['list_name']}' ya existe, usando: $plId\n";
    }
    
    // Agregar leads a la prospect list
    $maestriasIn = implode("','", $cfg['maestrias']);
    $leadsEnMaestria = $pdo->query("
        SELECT l.id FROM leads l
        LEFT JOIN leads_cstm lc ON lc.id_c = l.id
        WHERE l.deleted=0 AND lc.maestria_interesada_c IN ('$maestriasIn')
    ")->fetchAll(PDO::FETCH_COLUMN);
    
    $added = 0;
    foreach ($leadsEnMaestria as $leadId) {
        $plLeadId = uuid();
        try {
            $pdo->prepare("
                INSERT IGNORE INTO prospect_list_campaigns (id, prospect_list_id, campaign_id, deleted)
                VALUES (:id, :plid, :cid, 0)
            ")->execute([':id'=>$plLeadId, ':plid'=>$plId, ':cid'=>$campId]);
        } catch(Exception $e) {}
        $added++;
    }
    echo "     → $added prospectos asociados\n";
}

// ─── VERIFICACIÓN FINAL ────────────────────────────────────────────
echo "\n=== VERIFICACIÓN FINAL ===\n\n";

echo "📢 CAMPAÑAS:\n";
$camps = $pdo->query("
    SELECT c.name, c.status, c.start_date, c.end_date, u.user_name
    FROM campaigns c LEFT JOIN users u ON u.id=c.assigned_user_id
    WHERE c.deleted=0 ORDER BY c.start_date
")->fetchAll(PDO::FETCH_ASSOC);
$lastY = '';
foreach ($camps as $c) {
    $y = substr($c['start_date']??'????',0,4);
    if($y!==$lastY){echo "\n  ── $y ──\n";$lastY=$y;}
    $icon = $c['status']==='Active'?'🟢':'✔️';
    $name = strlen($c['name'])>52?substr($c['name'],0,52).'…':$c['name'];
    echo "  $icon $name [{$c['user_name']}]\n";
}

echo "\n\n🎓 MAESTRÍAS (Catálogo de Programas):\n";
$prods = $pdo->query("
    SELECT p.name, p.description, u.user_name
    FROM aos_products p LEFT JOIN users u ON u.id=p.assigned_user_id
    WHERE p.deleted=0 ORDER BY p.name
")->fetchAll(PDO::FETCH_ASSOC);
foreach ($prods as $p) {
    preg_match('/Modalidad: ([^|]+)/', $p['description'], $mm);
    $modal = isset($mm[1]) ? trim($mm[1]) : '?';
    $mIcon = ['En línea'=>'💻','Híbrida'=>'🔄','Presencial'=>'🏫'][$modal] ?? '📚';
    echo "  $mIcon {$p['name']} → Dir: {$p['user_name']} | $modal\n";
}

echo "\n\n📊 LEADS POR MAESTRÍA (Oct 2026 - campaña activa):\n";
$leadsStats = $pdo->query("
    SELECT lc.maestria_interesada_c, COUNT(*) as total, u.user_name as director
    FROM leads l
    LEFT JOIN leads_cstm lc ON lc.id_c=l.id
    LEFT JOIN users u ON u.id=l.assigned_user_id
    WHERE l.deleted=0 AND l.campaign_id IS NOT NULL
    GROUP BY lc.maestria_interesada_c, u.user_name
    ORDER BY total DESC
")->fetchAll(PDO::FETCH_ASSOC);
foreach ($leadsStats as $s) {
    $m = $s['maestria_interesada_c'] ?: '(sin maestría)';
    echo "  📋 {$m}: {$s['total']} leads → Dir: {$s['director']}\n";
}

echo "\n\n";
echo "════════════════════════════════════════════════════════\n";
echo "🎉 ¡Listo! Estructura de campañas y maestrías configurada.\n";
echo "════════════════════════════════════════════════════════\n\n";
echo "CÓMO FUNCIONA LA CONEXIÓN:\n";
echo "  Campaña Octubre 2026 (Activa)\n";
echo "    ├── Convocatoria Octubre 2026 - Ingeniería de Software\n";
echo "    │     └── Prospect List → Leads con maestría: Ing. Software\n";
echo "    │           └── Asignados a: rfigueroa (Director)\n";
echo "    ├── Convocatoria Octubre 2026 - Big Data & Data Science\n";
echo "    │     └── Prospect List → Leads con maestría: Big Data / IA\n";
echo "    │           └── Asignados a: gsuing (Director)\n";
echo "    └── Campaña Digital - Convocatoria Octubre 2026\n";
echo "          └── Prospect List → Leads generales / otras maestrías\n";
echo "                └── Asignados a: ctorres (Marketing)\n\n";
echo "  Cada Director ve SOLO los leads de su maestría.\n";
echo "  Marketing (ctorres/vmorales) ve TODAS las campañas.\n";
echo "  Dirección Posgrado (dbenitez/scardenas) ve todo el sistema.\n";
