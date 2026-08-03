<?php
/**
 * SEED DATA v2 - Usando BeanFactory correctamente
 * Crea contactos, actividades y configura dashboards
 */
if (!defined('sugarEntry')) { define('sugarEntry', true); }
chdir(__DIR__ . '/../public/legacy');
require_once('include/entryPoint.php');
global $db;

// Simular sesión admin
$GLOBALS['current_user'] = BeanFactory::newBean('Users');
$GLOBALS['current_user']->retrieve('1');
$GLOBALS['current_user']->is_admin = 1;

$rfigueroa_id = '3fdf1beb-c004-475e-95c8-3b940581c8d7';
$gsuing_id    = 'cc80d85d-d9d1-4e19-b12b-dee1d732062c';
$cmendoza_id  = 'ce1c286d-132a-444e-a5ba-b64bb8c2b8bd';
$arivas_id    = '511759fd-8967-41d9-adfe-721e8cfdc9a0';
$email_ref    = 'brandon.medina@unl.edu.ec';

// Eliminar contactos viejos de test si existen
$db->query("UPDATE contacts SET deleted=1 WHERE first_name IN ('Test','BeanFactory') AND deleted=0");

// ============================================================
// FUNCIÓN: Crear contacto via BeanFactory (correcto)
// ============================================================
function crearContacto($data) {
    global $db, $email_ref;
    
    $c = BeanFactory::newBean('Contacts');
    $c->first_name         = $data['first_name'];
    $c->last_name          = $data['last_name'];
    $c->phone_mobile       = $data['phone'] ?? '';
    $c->phone_work         = $data['phone'] ?? '';
    $c->title              = $data['title'] ?? 'Aspirante a Posgrado';
    $c->department         = $data['department'] ?? '';
    $c->description        = $data['description'] ?? '';
    $c->assigned_user_id   = $data['assigned_user_id'];
    $c->created_by         = '1';
    $c->modified_user_id   = '1';
    $c->lead_source        = $data['lead_source'] ?? 'Web Site';
    $c->email1             = $data['email'] ?? $email_ref;
    
    // Campo custom de maestría
    $c->maestria_interesada_c = $data['maestria'] ?? '';
    
    $saved_id = $c->save(false); // false = no notificación
    
    if ($saved_id) {
        // Actualizar contacts_cstm si el campo custom no se guardó automáticamente
        $maestria_q = $db->quote($data['maestria'] ?? '');
        $r = $db->query("SELECT id_c FROM contacts_cstm WHERE id_c='$saved_id'");
        if ($db->fetchByAssoc($r)) {
            $db->query("UPDATE contacts_cstm SET maestria_interesada_c='$maestria_q' WHERE id_c='$saved_id'");
        } else {
            $db->query("INSERT INTO contacts_cstm (id_c, maestria_interesada_c) VALUES ('$saved_id', '$maestria_q')");
        }
    }
    
    return $saved_id;
}

// ============================================================
// FUNCIÓN: Crear llamada via BeanFactory
// ============================================================
function crearLlamada($contact_id, $user_id, $titulo, $descripcion, $status = 'Held') {
    global $db;
    $call = BeanFactory::newBean('Calls');
    $call->name              = $titulo;
    $call->description       = $descripcion;
    $call->status            = $status;
    $call->direction         = 'Outbound';
    $call->duration_hours    = 0;
    $call->duration_minutes  = 30;
    $call->assigned_user_id  = $user_id;
    $call->created_by        = '1';
    $offset_days = rand(1, 60);
    $call->date_start        = date('Y-m-d H:i:s', strtotime("-{$offset_days} days"));
    
    $call_id = $call->save(false);
    
    if ($call_id) {
        // Relacionar con contacto
        $rel_id = create_guid();
        $date = date('Y-m-d H:i:s');
        $db->query("INSERT IGNORE INTO calls_contacts (id, call_id, contact_id, required, accept_status, date_modified, deleted)
            VALUES ('$rel_id', '$call_id', '$contact_id', 1, 'accept', '$date', 0)");
        
        // Relacionar con usuario
        $rel_id2 = create_guid();
        $db->query("INSERT IGNORE INTO calls_users (id, call_id, user_id, required, accept_status, date_modified, deleted)
            VALUES ('$rel_id2', '$call_id', '$user_id', 1, 'accept', '$date', 0)");
    }
    
    return $call_id;
}

// ============================================================
// FUNCIÓN: Crear reunión via BeanFactory
// ============================================================
function crearReunion($contact_id, $user_id, $titulo, $descripcion, $status = 'Held') {
    global $db;
    $m = BeanFactory::newBean('Meetings');
    $m->name             = $titulo;
    $m->description      = $descripcion;
    $m->status           = $status;
    $m->duration_hours   = 1;
    $m->duration_minutes = 0;
    $m->assigned_user_id = $user_id;
    $m->created_by       = '1';
    $offset_days = rand(1, 30);
    $m->date_start       = date('Y-m-d H:i:s', strtotime("-{$offset_days} days"));
    
    $meet_id = $m->save(false);
    
    if ($meet_id) {
        $date = date('Y-m-d H:i:s');
        $rel_id = create_guid();
        $db->query("INSERT IGNORE INTO meetings_contacts (id, meeting_id, contact_id, required, accept_status, date_modified, deleted)
            VALUES ('$rel_id', '$meet_id', '$contact_id', 1, 'accept', '$date', 0)");
        $rel_id2 = create_guid();
        $db->query("INSERT IGNORE INTO meetings_users (id, meeting_id, user_id, required, accept_status, date_modified, deleted)
            VALUES ('$rel_id2', '$meet_id', '$user_id', 1, 'accept', '$date', 0)");
    }
    
    return $meet_id;
}

// ============================================================
// FUNCIÓN: Crear tarea via BeanFactory
// ============================================================
function crearTarea($contact_id, $user_id, $titulo, $nota, $status = 'Completed') {
    $t = BeanFactory::newBean('Tasks');
    $t->name             = $titulo;
    $t->notes            = $nota;
    $t->status           = $status;
    $t->assigned_user_id = $user_id;
    $t->created_by       = '1';
    $t->parent_type      = 'Contacts';
    $t->parent_id        = $contact_id;
    $t->contact_id       = $contact_id;
    $t->date_due         = date('Y-m-d', strtotime('+' . rand(1, 14) . ' days'));
    
    return $t->save(false);
}

// ============================================================
// DATOS DE CONTACTOS
// ============================================================
echo "=== CREANDO CONTACTOS ===\n\n";

// SOFTWARE (rfigueroa)
$contactos_software = [
    ['first_name'=>'Andrés',   'last_name'=>'Vásquez Paredes',   'phone'=>'0991234501', 'title'=>'Desarrollador Backend',    'department'=>'TI',            'description'=>'Ingeniero con 5 años en Java. Interesado en microservicios y arquitectura cloud.',    'maestria'=>'Maestría en Ingeniería de Software', 'email'=>'a.vasquez@techcorp.ec'],
    ['first_name'=>'Karla',    'last_name'=>'Romero Suárez',     'phone'=>'0981234502', 'title'=>'QA Engineer',               'department'=>'Calidad',       'description'=>'Especialista en testing automatizado. Busca profundizar en DevOps y CI/CD.',          'maestria'=>'Maestría en Ingeniería de Software', 'email'=>'k.romero@empresa.com'],
    ['first_name'=>'Diego',    'last_name'=>'Ochoa Celi',        'phone'=>'0971234503', 'title'=>'Full Stack Developer',      'department'=>'Desarrollo',    'description'=>'Trabaja en startup. Interés en arquitecturas cloud-native y patrones de diseño.',     'maestria'=>'Maestría en Ingeniería de Software', 'email'=>$email_ref],
    ['first_name'=>'Patricia', 'last_name'=>'Salinas Mora',      'phone'=>'0961234504', 'title'=>'Líder Técnico',             'department'=>'Ingeniería',    'description'=>'Lidera equipo de 8 devs. Quiere profundizar en metodologías ágiles y gestión tech.', 'maestria'=>'Maestría en Ingeniería de Software', 'email'=>'p.salinas@consulting.ec'],
    ['first_name'=>'Javier',   'last_name'=>'Toapanta Loja',     'phone'=>'0951234505', 'title'=>'Arquitecto de Software',   'department'=>'Arquitectura',  'description'=>'10 años de experiencia. Enfocado en modernización de sistemas legados.',              'maestria'=>'Maestría en Ingeniería de Software', 'email'=>'j.toapanta@arqsoft.ec'],
    ['first_name'=>'Mónica',   'last_name'=>'Espinosa Quito',    'phone'=>'0941234506', 'title'=>'DevOps Engineer',           'department'=>'Infraestructura','description'=>'Certificada en AWS. Busca maestría para avanzar al rol de CTO.',                    'maestria'=>'Maestría en Ingeniería de Software', 'email'=>'m.espinosa@devops.ec'],
    ['first_name'=>'Rafael',   'last_name'=>'Cabrera Tandazo',   'phone'=>'0931234507', 'title'=>'Ingeniero de Sistemas',    'department'=>'TI',            'description'=>'Trabaja en empresa pública. Beca institucional confirmada. Muy motivado.',            'maestria'=>'Maestría en Ingeniería de Software', 'email'=>$email_ref],
    ['first_name'=>'Verónica', 'last_name'=>'Guamán Ayala',      'phone'=>'0921234508', 'title'=>'Backend Developer',        'department'=>'Desarrollo',    'description'=>'Especialista Python/Django. Interés en IA aplicada al desarrollo.',                  'maestria'=>'Maestría en Ingeniería de Software', 'email'=>'v.guaman@python.ec'],
    ['first_name'=>'Cristian', 'last_name'=>'Jumbo Maldonado',   'phone'=>'0911234509', 'title'=>'Mobile Developer',         'department'=>'Apps',          'description'=>'Desarrolla en Flutter. Quiere escalar a arquitecto senior.',                         'maestria'=>'Maestría en Ingeniería de Software', 'email'=>'c.jumbo@mobile.ec'],
    ['first_name'=>'Natalia',  'last_name'=>'Ríos Carrión',      'phone'=>'0901234510', 'title'=>'Product Manager Técnico',  'department'=>'Producto',      'description'=>'Transición de dev a gestión. Maestría complementará su perfil técnico-gerencial.',  'maestria'=>'Maestría en Ingeniería de Software', 'email'=>'n.rios@product.ec'],
    ['first_name'=>'Eduardo',  'last_name'=>'Fierro Ponce',      'phone'=>'0891234511', 'title'=>'Scrum Master',             'department'=>'Agilidad',      'description'=>'Certificado PSM II. Busca respaldo técnico en ingeniería de software.',              'maestria'=>'Maestría en Ingeniería de Software', 'email'=>$email_ref],
    ['first_name'=>'Lorena',   'last_name'=>'Aguilar Benítez',   'phone'=>'0881234512', 'title'=>'Frontend Developer',       'department'=>'UX/Frontend',   'description'=>'Especialista en React/Angular. Quiere combinar dev con UX avanzado.',               'maestria'=>'Maestría en Ingeniería de Software', 'email'=>'l.aguilar@frontend.ec'],
];

// BIG DATA (gsuing)
$contactos_bigdata = [
    ['first_name'=>'Fernando', 'last_name'=>'Castillo Vivanco', 'phone'=>'0991344601', 'title'=>'Data Analyst',              'department'=>'Analytics',        'description'=>'3 años en análisis con Python y R. Quiere pasar a Data Science avanzado.',            'maestria'=>'Maestría en Big Data & Data Science', 'email'=>$email_ref],
    ['first_name'=>'Alejandra','last_name'=>'Moncayo Peña',     'phone'=>'0981344602', 'title'=>'Business Intelligence',     'department'=>'BI',               'description'=>'Experta en Power BI y SQL Server. Interés en ML aplicado a negocios.',                'maestria'=>'Maestría en Big Data & Data Science', 'email'=>'a.moncayo@bi.ec'],
    ['first_name'=>'Roberto',  'last_name'=>'Pineda Samaniego', 'phone'=>'0971344603', 'title'=>'Estadístico',               'department'=>'Investigación',    'description'=>'Estadístico universitario. Busca aplicar big data a investigación socioeconómica.',    'maestria'=>'Maestría en Big Data & Data Science', 'email'=>'r.pineda@estadistica.ec'],
    ['first_name'=>'Daniela',  'last_name'=>'Herrera Calva',    'phone'=>'0961344604', 'title'=>'Data Engineer',             'department'=>'Ing. de Datos',    'description'=>'Trabaja con Spark y Hadoop. Financiamiento garantizado por empresa tech.',             'maestria'=>'Maestría en Big Data & Data Science', 'email'=>'d.herrera@dataeng.ec'],
    ['first_name'=>'Marcelo',  'last_name'=>'Abad Ojeda',       'phone'=>'0951344605', 'title'=>'ML Engineer',               'department'=>'IA',               'description'=>'Desarrolla modelos predictivos en producción. Busca profundizar en NLP.',              'maestria'=>'Maestría en Big Data & Data Science', 'email'=>$email_ref],
    ['first_name'=>'Gabriela', 'last_name'=>'Zurita Noblecilla','phone'=>'0941344606', 'title'=>'Coord. de Proyectos',       'department'=>'PMO',              'description'=>'Gestiona proyectos de transformación digital. Maestría para liderar estrategia datos.', 'maestria'=>'Maestría en Big Data & Data Science', 'email'=>'g.zurita@pmo.ec'],
    ['first_name'=>'Pablo',    'last_name'=>'Morocho Sánchez',  'phone'=>'0931344607', 'title'=>'Analista de Riesgo',        'department'=>'Finanzas',         'description'=>'Sector financiero. Aplicará big data a modelos de riesgo crediticio.',                 'maestria'=>'Maestría en Big Data & Data Science', 'email'=>'p.morocho@finanzas.ec'],
    ['first_name'=>'Silvia',   'last_name'=>'Palma Chuquirima', 'phone'=>'0921344608', 'title'=>'Investigadora',             'department'=>'Academia',         'description'=>'Docente universitaria. Necesita maestría para investigación cuantitativa avanzada.',    'maestria'=>'Maestría en Big Data & Data Science', 'email'=>'s.palma@academia.ec'],
    ['first_name'=>'Iván',     'last_name'=>'Valladares Granda','phone'=>'0911344609', 'title'=>'Gerente de TI',             'department'=>'Tecnología',       'description'=>'12 años de experiencia. Busca maestría para estrategia de datos empresarial.',         'maestria'=>'Maestría en Big Data & Data Science', 'email'=>$email_ref],
    ['first_name'=>'Sofía',    'last_name'=>'Briceño Medina',   'phone'=>'0901344610', 'title'=>'Data Scientist Junior',     'department'=>'Ciencia de Datos', 'description'=>'Recién graduada con distinciones. Alto potencial. Beca SENESCYT confirmada.',          'maestria'=>'Maestría en Big Data & Data Science', 'email'=>'s.briceno@datascience.ec'],
    ['first_name'=>'Héctor',   'last_name'=>'Armijos Jaramillo','phone'=>'0891344611', 'title'=>'Arquitecto de Datos',       'department'=>'Datos',            'description'=>'Diseña pipelines en AWS y Azure. Quiere especialización en analytics avanzado.',       'maestria'=>'Maestría en Big Data & Data Science', 'email'=>'h.armijos@dataarch.ec'],
];

echo "[rfigueroa] Maestría en Ingeniería de Software:\n";
$ids_soft = [];
foreach ($contactos_software as $c) {
    $c['assigned_user_id'] = $rfigueroa_id;
    $id = crearContacto($c);
    if ($id) {
        $ids_soft[] = $id;
        echo "  ✓ {$c['first_name']} {$c['last_name']} ($id)\n";
    } else {
        echo "  ❌ FALLO: {$c['first_name']} {$c['last_name']}\n";
    }
}

echo "\n[gsuing] Maestría en Big Data & Data Science:\n";
$ids_data = [];
foreach ($contactos_bigdata as $c) {
    $c['assigned_user_id'] = $gsuing_id;
    $id = crearContacto($c);
    if ($id) {
        $ids_data[] = $id;
        echo "  ✓ {$c['first_name']} {$c['last_name']} ($id)\n";
    } else {
        echo "  ❌ FALLO: {$c['first_name']} {$c['last_name']}\n";
    }
}

// ============================================================
// ACTIVIDADES
// ============================================================
echo "\n=== CREANDO ACTIVIDADES ===\n";

$temas_soft = [
    ['Entrevista de admisión - perfil técnico', 'Se revisó el perfil profesional. Cumple con requisitos mínimos de experiencia.'],
    ['Seguimiento documentación', 'Confirmó documentos listos. Pendiente apostilla de título de grado.'],
    ['Presentación del programa', 'Explicación de malla curricular, modalidad híbrida y fechas del cohorte 2026.'],
    ['Confirmación de matrícula', 'Aspirante confirmó decisión. Se envió formulario de preinscripción oficial.'],
    ['Orientación becas y financiamiento', 'Se informó sobre becas SENESCYT y descuentos por pronto pago.'],
];
$temas_data = [
    ['Evaluación perfil Data Science', 'Perfil evaluado: estadística sólida y Python intermedio. Apto para el programa.'],
    ['Llamada orientación - diferencias Big Data vs IA', 'El aspirante eligió Big Data tras comparar los dos programas.'],
    ['Reunión con sponsor empresarial', 'Empresa del aspirante financiará el 70% del costo de la maestría.'],
    ['Resultados prueba de conocimientos', 'Aspirante aprobó con 87/100. Procede a entrevista personal.'],
    ['Seguimiento post-entrevista', 'Aspirante solicitó 1 semana para decidir. Se programó llamada de cierre.'],
];

echo "\n[rfigueroa] Actividades:\n";
foreach (array_slice($ids_soft, 0, min(8, count($ids_soft))) as $i => $cid) {
    $tema = $temas_soft[$i % count($temas_soft)];
    $lid = crearLlamada($cid, $rfigueroa_id, $tema[0], $tema[1], $i < 6 ? 'Held' : 'Planned');
    if ($i < 5) {
        crearReunion($cid, $rfigueroa_id, 'Entrevista Personal - Ing. Software', 'Presentación del programa y evaluación del perfil del aspirante.', $i < 4 ? 'Held' : 'Planned');
    }
    if ($i < 6) {
        crearTarea($cid, $rfigueroa_id, 'Revisar expediente de admisión', 'Verificar: título, cédula, carta de motivación, hoja de vida.', $i < 4 ? 'Completed' : 'In Progress');
    }
    echo "  ✓ Contacto " . ($i+1) . ": llamada + reunión + tarea\n";
}

echo "\n[gsuing] Actividades:\n";
foreach (array_slice($ids_data, 0, min(8, count($ids_data))) as $i => $cid) {
    $tema = $temas_data[$i % count($temas_data)];
    $lid = crearLlamada($cid, $gsuing_id, $tema[0], $tema[1], $i < 6 ? 'Held' : 'Planned');
    if ($i < 5) {
        crearReunion($cid, $gsuing_id, 'Entrevista Personal - Big Data', 'Evaluación del aspirante y presentación detallada del programa Big Data.', $i < 4 ? 'Held' : 'Planned');
    }
    if ($i < 6) {
        crearTarea($cid, $gsuing_id, 'Validar requisitos de admisión', 'Confirmar: título de ingeniería, 2 años exp, carta de motivación y referencia.', $i < 4 ? 'Completed' : 'In Progress');
    }
    echo "  ✓ Contacto " . ($i+1) . ": llamada + reunión + tarea\n";
}

// Notas de seguimiento en leads de asesores
echo "\n[asesores] Notas de seguimiento en leads:\n";
$temas_seguimiento = [
    ['1er contacto - presentación del programa', 'Lead captado por campaña digital. Se presentó el programa, requisitos y costos.'],
    ['2do seguimiento - interés confirmado', 'El aspirante confirmó interés. Se envió brochure detallado y plan de estudios.'],
    ['3er seguimiento - listo para entrevista', 'Aspirante muy interesado. Se solicitaron documentos y se agendó entrevista con director.'],
];

$leads_cmendoza = $db->query("SELECT id FROM leads WHERE assigned_user_id='$cmendoza_id' AND deleted=0 LIMIT 8");
$i = 0;
while ($lrow = $db->fetchByAssoc($leads_cmendoza)) {
    $lid = $lrow['id'];
    $tema = $temas_seguimiento[$i % 3];
    
    $note = BeanFactory::newBean('Notes');
    $note->name            = $tema[0];
    $note->description     = $tema[1];
    $note->parent_type     = 'Leads';
    $note->parent_id       = $lid;
    $note->assigned_user_id = $cmendoza_id;
    $note->created_by      = '1';
    $note->save(false);
    $i++;
}
echo "  ✓ {$i} notas para leads de cmendoza\n";

$leads_arivas = $db->query("SELECT id FROM leads WHERE assigned_user_id='$arivas_id' AND deleted=0 LIMIT 8");
$i = 0;
while ($lrow = $db->fetchByAssoc($leads_arivas)) {
    $lid = $lrow['id'];
    $tema = $temas_seguimiento[$i % 3];
    
    $note = BeanFactory::newBean('Notes');
    $note->name            = $tema[0];
    $note->description     = $tema[1];
    $note->parent_type     = 'Leads';
    $note->parent_id       = $lid;
    $note->assigned_user_id = $arivas_id;
    $note->created_by      = '1';
    $note->save(false);
    $i++;
}
echo "  ✓ {$i} notas para leads de arivas\n";

// ============================================================
// DASHBOARDS
// ============================================================
echo "\n=== CONFIGURANDO DASHBOARDS ===\n";

function setDashboard($db, $user_id, $dashlets_col0, $dashlets_col1, $page_title) {
    global $date;
    $date = date('Y-m-d H:i:s');
    
    $all_dashlets = array_merge($dashlets_col0, $dashlets_col1);
    $col0_keys = array_keys($dashlets_col0);
    $col1_keys = array_keys($dashlets_col1);
    
    $home = [
        'dashlets' => $all_dashlets,
        'pages' => [[
            'columns' => [
                ['width' => '60%', 'dashlets' => $col0_keys],
                ['width' => '40%', 'dashlets' => $col1_keys],
            ],
            'numColumns'   => 2,
            'pageTitleLabel' => $page_title,
        ]]
    ];
    
    $serialized = base64_encode(serialize($home));
    $uid = $db->quote($user_id);
    $db->query("DELETE FROM user_preferences WHERE assigned_user_id='$uid' AND category='Home'");
    $pid = create_guid();
    $db->query("INSERT INTO user_preferences (id, assigned_user_id, category, contents, date_entered, date_modified, deleted)
        VALUES ('$pid', '$uid', 'Home', '$serialized', NOW(), NOW(), 0)");
    echo "  ✓ Dashboard: $user_id\n";
}

$d_contacts = ['dash_contactos' => ['className'=>'MyContactsDashlet','module'=>'Contacts','forceColumn'=>0,'fileLocation'=>'modules/Contacts/Dashlets/MyContactsDashlet/MyContactsDashlet.php','options'=>['title'=>'Mis Aspirantes']]];
$d_meetings = ['dash_reuniones' => ['className'=>'MyMeetingsDashlet','module'=>'Meetings','forceColumn'=>0,'fileLocation'=>'modules/Meetings/Dashlets/MyMeetingsDashlet/MyMeetingsDashlet.php','options'=>['title'=>'Próximas Entrevistas']]];
$d_calls    = ['dash_llamadas'  => ['className'=>'MyCallsDashlet','module'=>'Calls','forceColumn'=>1,'fileLocation'=>'modules/Calls/Dashlets/MyCallsDashlet/MyCallsDashlet.php','options'=>['title'=>'Mis Llamadas']]];
$d_tasks    = ['dash_tareas'    => ['className'=>'MyTasksDashlet','module'=>'Tasks','forceColumn'=>1,'fileLocation'=>'modules/Tasks/Dashlets/MyTasksDashlet/MyTasksDashlet.php','options'=>['title'=>'Tareas Pendientes']]];
$d_feed     = ['dash_feed'      => ['className'=>'SugarFeedDashlet','module'=>'SugarFeed','forceColumn'=>1,'fileLocation'=>'modules/SugarFeed/Dashlets/SugarFeedDashlet/SugarFeedDashlet.php']];
$d_leads    = ['dash_leads'     => ['className'=>'MyLeadsDashlet','module'=>'Leads','forceColumn'=>0,'fileLocation'=>'modules/Leads/Dashlets/MyLeadsDashlet/MyLeadsDashlet.php','options'=>['title'=>'Mis Aspirantes (Leads)']]];
$d_camps    = ['dash_campanas'  => ['className'=>'TopCampaignsDashlet','module'=>'Campaigns','forceColumn'=>0,'fileLocation'=>'modules/Campaigns/Dashlets/TopCampaignsDashlet/TopCampaignsDashlet.php','options'=>['title'=>'Campañas Activas']]];
$d_roi      = ['dash_roi'       => ['className'=>'CampaignROIChartDashlet','module'=>'Charts','forceColumn'=>0,'fileLocation'=>'modules/Charts/Dashlets/CampaignROIChartDashlet/CampaignROIChartDashlet.php','options'=>['title'=>'ROI de Campañas']]];

// rfigueroa - Director Software
setDashboard($db, $rfigueroa_id,
    array_merge($d_contacts, $d_meetings),
    array_merge($d_calls, $d_tasks, $d_feed),
    'Panel Director - Maestría en Ingeniería de Software'
);

// gsuing - Director Big Data
setDashboard($db, $gsuing_id,
    array_merge($d_contacts, $d_meetings),
    array_merge($d_calls, $d_tasks, $d_feed),
    'Panel Director - Maestría en Big Data & Data Science'
);

// cmendoza - Asesor
setDashboard($db, $cmendoza_id,
    array_merge($d_leads, $d_meetings),
    array_merge($d_calls, $d_tasks, $d_feed),
    'Panel Asesor - Gestión de Aspirantes'
);

// arivas - Asesor
setDashboard($db, $arivas_id,
    array_merge($d_leads, $d_meetings),
    array_merge($d_calls, $d_tasks, $d_feed),
    'Panel Asesor - Gestión de Aspirantes'
);

// scardenas - Dirección
setDashboard($db, '3db2dd8f-2063-4692-86b8-1bc5ea6328d6',
    array_merge($d_leads, $d_contacts),
    array_merge($d_calls, $d_feed),
    'Panel Dirección - Supervisión Posgrado'
);

// dbenitez - Dirección
setDashboard($db, 'b2bc213a-4c7e-44b2-a2a0-fcc4758fc343',
    array_merge($d_leads, $d_contacts),
    array_merge($d_calls, $d_feed),
    'Panel Dirección - Supervisión Posgrado'
);

// ctorres - Marketing
setDashboard($db, '92ebafa7-d89b-496a-9064-d9c708078142',
    array_merge($d_camps, $d_roi),
    array_merge(['dash_leads2'=>['className'=>'MyLeadsDashlet','module'=>'Leads','forceColumn'=>1,'fileLocation'=>'modules/Leads/Dashlets/MyLeadsDashlet/MyLeadsDashlet.php','options'=>['title'=>'Prospectos Captados']]], $d_feed),
    'Panel Marketing - Campañas y Captación'
);

// vmorales - Marketing
setDashboard($db, 'd96577e4-e087-426a-8ca3-81402c8c20fc',
    array_merge($d_camps, $d_roi),
    array_merge(['dash_leads3'=>['className'=>'MyLeadsDashlet','module'=>'Leads','forceColumn'=>1,'fileLocation'=>'modules/Leads/Dashlets/MyLeadsDashlet/MyLeadsDashlet.php','options'=>['title'=>'Prospectos Captados']]], $d_feed),
    'Panel Marketing - Campañas y Captación'
);

// ============================================================
// RESUMEN FINAL
// ============================================================
echo "\n\n=======================================================\n";
echo "  RESUMEN FINAL\n";
echo "=======================================================\n";

$r = $db->query("SELECT u.user_name, COUNT(c.id) as cnt FROM contacts c JOIN users u ON c.assigned_user_id=u.id WHERE c.deleted=0 GROUP BY u.user_name ORDER BY cnt DESC");
echo "\n📋 Contactos por usuario:\n";
$total_c = 0;
while ($row = $db->fetchByAssoc($r)) {
    echo "  {$row['user_name']}: {$row['cnt']}\n";
    $total_c += $row['cnt'];
}
echo "  TOTAL: $total_c contactos\n";

$r2 = $db->query("SELECT COUNT(*) as cnt FROM leads WHERE deleted=0");
echo "\n📊 Leads: " . $db->fetchByAssoc($r2)['cnt'] . "\n";

$r3 = $db->query("SELECT COUNT(*) as cnt FROM calls WHERE deleted=0");
echo "📞 Llamadas: " . $db->fetchByAssoc($r3)['cnt'] . "\n";

$r4 = $db->query("SELECT COUNT(*) as cnt FROM meetings WHERE deleted=0");
echo "🗓️  Reuniones: " . $db->fetchByAssoc($r4)['cnt'] . "\n";

$r5 = $db->query("SELECT COUNT(*) as cnt FROM tasks WHERE deleted=0");
echo "✅ Tareas: " . $db->fetchByAssoc($r5)['cnt'] . "\n";

echo "\n🎉 ¡Listo! Entra al CRM con cada usuario:\n";
echo "   rfigueroa / crm123 → verá 12 aspirantes de Software\n";
echo "   gsuing / crm123    → verá 11 aspirantes de Big Data\n";
echo "   cmendoza / crm123  → verá sus 12 leads\n";
echo "   arivas / crm123    → verá sus 13 leads\n";
echo "   URL: http://localhost:8000\n\n";
