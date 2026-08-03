<?php
/**
 * SEED DATA - Crea contactos realistas para rfigueroa y gsuing
 * además de actividades (llamadas, reuniones, tareas) y dashboards
 */
if (!defined('sugarEntry')) { define('sugarEntry', true); }
chdir(__DIR__ . '/../public/legacy');
require_once('include/entryPoint.php');
global $db;

// IDs clave
$rfigueroa_id = '3fdf1beb-c004-475e-95c8-3b940581c8d7'; // Director Software
$gsuing_id    = 'cc80d85d-d9d1-4e19-b12b-dee1d732062c'; // Director Big Data
$cmendoza_id  = 'ce1c286d-132a-444e-a5ba-b64bb8c2b8bd'; // Asesor
$arivas_id    = '511759fd-8967-41d9-adfe-721e8cfdc9a0'; // Asesor
$admin_id     = '1';
$email_ref    = 'brandon.medina@unl.edu.ec';

$date = date('Y-m-d H:i:s');
$created = [];

// ============================================================
// FUNCIÓN: Crear contacto
// ============================================================
function crearContacto($db, $data) {
    global $date, $email_ref;
    $id = create_guid();
    $fn = $db->quote($data['first_name']);
    $ln = $db->quote($data['last_name']);
    $phone = $db->quote($data['phone'] ?? '');
    $title = $db->quote($data['title'] ?? 'Aspirante a Posgrado');
    $dept  = $db->quote($data['department'] ?? '');
    $desc  = $db->quote($data['description'] ?? '');
    $assigned = $db->quote($data['assigned_user_id']);
    $created_by = $db->quote($data['created_by'] ?? '1');
    $status = $db->quote($data['lead_source'] ?? 'Web Site');

    $db->query("INSERT INTO contacts 
        (id, first_name, last_name, phone_mobile, phone_work, title, department, description,
         assigned_user_id, created_by, modified_user_id, date_entered, date_modified, deleted,
         lead_source, do_not_call, email_opt_out)
        VALUES 
        ('$id', '$fn', '$ln', '$phone', '$phone', '$title', '$dept', '$desc',
         '$assigned', '$created_by', '$created_by', '$date', '$date', 0,
         '$status', 0, 0)");

    // Email address
    $email = $data['email'] ?? $email_ref;
    $email_q = $db->quote($email);
    $email_id = create_guid();
    $db->query("INSERT INTO email_addresses (id, email_address, email_address_caps, date_created, date_modified, deleted)
        VALUES ('$email_id', '$email_q', '" . $db->quote(strtoupper($email)) . "', '$date', '$date', 0)
        ON DUPLICATE KEY UPDATE id=id");
    // Recuperar el email_id real
    $r = $db->query("SELECT id FROM email_addresses WHERE email_address_caps='" . $db->quote(strtoupper($email)) . "' AND deleted=0 LIMIT 1");
    $er = $db->fetchByAssoc($r);
    $real_email_id = $er ? $er['id'] : $email_id;

    $db->query("INSERT IGNORE INTO email_addr_bean_rel 
        (id, email_address_id, bean_id, bean_module, primary_address, reply_to_address, date_created, date_modified, deleted)
        VALUES ('" . create_guid() . "', '$real_email_id', '$id', 'Contacts', 1, 0, '$date', '$date', 0)");

    // Custom fields (maestria)
    $maestria = $db->quote($data['maestria'] ?? '');
    $existing = $db->query("SELECT id_c FROM contacts_cstm WHERE id_c='$id'");
    if (!$db->fetchByAssoc($existing)) {
        $db->query("INSERT INTO contacts_cstm (id_c, maestria_interesada_c) VALUES ('$id', '$maestria')");
    } else {
        $db->query("UPDATE contacts_cstm SET maestria_interesada_c='$maestria' WHERE id_c='$id'");
    }

    return $id;
}

// ============================================================
// FUNCIÓN: Crear llamada
// ============================================================
function crearLlamada($db, $contact_id, $user_id, $titulo, $descripcion, $status = 'Held', $duracion = 30) {
    global $date;
    $id = create_guid();
    $t = $db->quote($titulo);
    $d = $db->quote($descripcion);
    $uid = $db->quote($user_id);
    $cid = $db->quote($contact_id);
    $st  = $db->quote($status);
    $date_call = date('Y-m-d H:i:s', strtotime("-" . rand(1,60) . " days"));
    
    $db->query("INSERT INTO calls (id, name, description, status, direction, duration_hours, duration_minutes,
        date_start, date_end, assigned_user_id, created_by, modified_user_id, date_entered, date_modified, deleted)
        VALUES ('$id', '$t', '$d', '$st', 'Outbound', 0, $duracion,
        '$date_call', '$date_call', '$uid', '$uid', '$uid', '$date', '$date', 0)");
    
    // Relacionar con contacto
    $rel_id = create_guid();
    $db->query("INSERT INTO calls_contacts (id, call_id, contact_id, required, accept_status, date_modified, deleted)
        VALUES ('$rel_id', '$id', '$cid', 1, 'accept', '$date', 0)");
    
    // Relacionar con usuario
    $rel_id2 = create_guid();
    $db->query("INSERT INTO calls_users (id, call_id, user_id, required, accept_status, date_modified, deleted)
        VALUES ('$rel_id2', '$id', '$uid', 1, 'accept', '$date', 0)");
    
    return $id;
}

// ============================================================
// FUNCIÓN: Crear reunión
// ============================================================
function crearReunion($db, $contact_id, $user_id, $titulo, $descripcion, $status = 'Held') {
    global $date;
    $id = create_guid();
    $t  = $db->quote($titulo);
    $d  = $db->quote($descripcion);
    $uid = $db->quote($user_id);
    $cid = $db->quote($contact_id);
    $st  = $db->quote($status);
    $date_meet = date('Y-m-d H:i:s', strtotime("-" . rand(1,30) . " days"));
    
    $db->query("INSERT INTO meetings (id, name, description, status, duration_hours, duration_minutes,
        date_start, date_end, assigned_user_id, created_by, modified_user_id, date_entered, date_modified, deleted)
        VALUES ('$id', '$t', '$d', '$st', 1, 0,
        '$date_meet', '$date_meet', '$uid', '$uid', '$uid', '$date', '$date', 0)");
    
    $rel_id = create_guid();
    $db->query("INSERT INTO meetings_contacts (id, meeting_id, contact_id, required, accept_status, date_modified, deleted)
        VALUES ('$rel_id', '$id', '$cid', 1, 'accept', '$date', 0)");
    
    $rel_id2 = create_guid();
    $db->query("INSERT INTO meetings_users (id, meeting_id, user_id, required, accept_status, date_modified, deleted)
        VALUES ('$rel_id2', '$id', '$uid', 1, 'accept', '$date', 0)");
    
    return $id;
}

// ============================================================
// FUNCIÓN: Crear tarea
// ============================================================
function crearTarea($db, $contact_id, $user_id, $titulo, $nota, $status = 'Completed') {
    global $date;
    $id  = create_guid();
    $t   = $db->quote($titulo);
    $n   = $db->quote($nota);
    $uid = $db->quote($user_id);
    $cid = $db->quote($contact_id);
    $st  = $db->quote($status);
    $due = date('Y-m-d', strtotime("+" . rand(1,14) . " days"));
    
    $db->query("INSERT INTO tasks (id, name, notes, status, date_due,
        parent_type, parent_id, contact_id, assigned_user_id, created_by, modified_user_id, 
        date_entered, date_modified, deleted)
        VALUES ('$id', '$t', '$n', '$st', '$due',
        'Contacts', '$cid', '$cid', '$uid', '$uid', '$uid',
        '$date', '$date', 0)");
    
    return $id;
}

// ============================================================
// FUNCIÓN: Dashboard por usuario
// ============================================================
function setDashboard($db, $user_id, $dashlets, $page_title) {
    global $date;
    $serialized = base64_encode(serialize([
        'dashlets' => $dashlets,
        'pages' => [[
            'columns' => [
                ['width' => '60%', 'dashlets' => array_keys(array_filter($dashlets, fn($d) => ($d['forceColumn'] ?? 0) == 0))],
                ['width' => '40%', 'dashlets' => array_keys(array_filter($dashlets, fn($d) => ($d['forceColumn'] ?? 0) == 1))],
            ],
            'numColumns' => 2,
            'pageTitleLabel' => $page_title,
        ]]
    ]));
    
    $uid = $db->quote($user_id);
    $db->query("DELETE FROM user_preferences WHERE assigned_user_id='$uid' AND category='Home'");
    $pref_id = create_guid();
    $db->query("INSERT INTO user_preferences (id, assigned_user_id, category, contents, date_entered, date_modified, deleted)
        VALUES ('$pref_id', '$uid', 'Home', '$serialized', '$date', '$date', 0)");
    
    echo "  ✓ Dashboard actualizado para: $user_id\n";
}

echo "=== CREANDO DATOS DE CONTACTOS ===\n\n";

// ============================================================
// CONTACTOS PARA RFIGUEROA (Ingeniería de Software)
// 12 aspirantes realistas
// ============================================================
echo "[rfigueroa] Maestría en Ingeniería de Software\n";

$contactos_software = [
    ['first_name'=>'Andrés', 'last_name'=>'Vásquez Paredes', 'phone'=>'0991234501', 'title'=>'Desarrollador Backend', 'department'=>'TI', 'description'=>'Ingeniero con 5 años de experiencia en Java. Muy interesado en arquitectura de microservicios.', 'maestria'=>'Maestría en Ingeniería de Software', 'email'=>'a.vasquez.' . rand(100,999) . '@gmail.com'],
    ['first_name'=>'Karla', 'last_name'=>'Romero Suárez', 'phone'=>'0981234502', 'title'=>'QA Engineer', 'department'=>'Calidad', 'description'=>'Especialista en testing automatizado. Busca actualizar conocimientos en DevOps y CI/CD.', 'maestria'=>'Maestría en Ingeniería de Software', 'email'=>'k.romero.' . rand(100,999) . '@outlook.com'],
    ['first_name'=>'Diego', 'last_name'=>'Ochoa Celi', 'phone'=>'0971234503', 'title'=>'Full Stack Developer', 'department'=>'Desarrollo', 'description'=>'Trabaja en startup tecnológica. Interés en arquitecturas cloud-native y patrones de diseño.', 'maestria'=>'Maestría en Ingeniería de Software', 'email'=>$email_ref],
    ['first_name'=>'Patricia', 'last_name'=>'Salinas Mora', 'phone'=>'0961234504', 'title'=>'Líder Técnico', 'department'=>'Ingeniería', 'description'=>'Lidera equipo de 8 developers. Quiere profundizar en metodologías ágiles y gestión de proyectos tecnológicos.', 'maestria'=>'Maestría en Ingeniería de Software', 'email'=>'p.salinas.' . rand(100,999) . '@hotmail.com'],
    ['first_name'=>'Javier', 'last_name'=>'Toapanta Loja', 'phone'=>'0951234505', 'title'=>'Arquitecto de Software', 'department'=>'Arquitectura', 'description'=>'10 años de experiencia. Enfocado en modernización de sistemas legados.', 'maestria'=>'Maestría en Ingeniería de Software', 'email'=>'j.toapanta.' . rand(100,999) . '@gmail.com'],
    ['first_name'=>'Mónica', 'last_name'=>'Espinosa Quito', 'phone'=>'0941234506', 'title'=>'DevOps Engineer', 'department'=>'Infraestructura', 'description'=>'Certificada en AWS. Busca maestría para avanzar al rol de CTO.', 'maestria'=>'Maestría en Ingeniería de Software', 'email'=>'m.espinosa.' . rand(100,999) . '@gmail.com'],
    ['first_name'=>'Rafael', 'last_name'=>'Cabrera Tandazo', 'phone'=>'0931234507', 'title'=>'Ingeniero de Sistemas', 'department'=>'TI', 'description'=>'Trabaja en empresa pública. Financiamiento por beca institucional confirmado.', 'maestria'=>'Maestría en Ingeniería de Software', 'email'=>$email_ref],
    ['first_name'=>'Verónica', 'last_name'=>'Guamán Ayala', 'phone'=>'0921234508', 'title'=>'Backend Developer', 'department'=>'Desarrollo', 'description'=>'Especialista en Python/Django. Interés en IA aplicada al desarrollo de software.', 'maestria'=>'Maestría en Ingeniería de Software', 'email'=>'v.guaman.' . rand(100,999) . '@yahoo.com'],
    ['first_name'=>'Cristian', 'last_name'=>'Jumbo Maldonado', 'phone'=>'0911234509', 'title'=>'Mobile Developer', 'department'=>'Apps', 'description'=>'Desarrolla apps Flutter. Quiere maestría para escalar a arquitecto senior.', 'maestria'=>'Maestría en Ingeniería de Software', 'email'=>'c.jumbo.' . rand(100,999) . '@gmail.com'],
    ['first_name'=>'Natalia', 'last_name'=>'Ríos Carrión', 'phone'=>'0901234510', 'title'=>'Product Manager Técnico', 'department'=>'Producto', 'description'=>'Transición de desarrollo a gestión. Maestría complementará su perfil técnico-gerencial.', 'maestria'=>'Maestría en Ingeniería de Software', 'email'=>'n.rios.' . rand(100,999) . '@gmail.com'],
    ['first_name'=>'Eduardo', 'last_name'=>'Fierro Ponce', 'phone'=>'0891234511', 'title'=>'Scrum Master', 'department'=>'Agilidad', 'description'=>'Certificado PSM II. Busca profundizar en ingeniería de software como respaldo técnico.', 'maestria'=>'Maestría en Ingeniería de Software', 'email'=>$email_ref],
    ['first_name'=>'Lorena', 'last_name'=>'Aguilar Benítez', 'phone'=>'0881234512', 'title'=>'Desarrolladora Frontend', 'department'=>'UX/Frontend', 'description'=>'Especialista en React/Angular. Interés en combinar desarrollo con experiencia de usuario avanzada.', 'maestria'=>'Maestría en Ingeniería de Software', 'email'=>'l.aguilar.' . rand(100,999) . '@gmail.com'],
];

$contact_ids_soft = [];
foreach ($contactos_software as $c) {
    $c['assigned_user_id'] = $rfigueroa_id;
    $c['lead_source'] = 'Web Site';
    $cid = crearContacto($db, $c);
    $contact_ids_soft[] = $cid;
    echo "  ✓ {$c['first_name']} {$c['last_name']}\n";
}

// ============================================================
// CONTACTOS PARA GSUING (Big Data & Data Science)
// 11 aspirantes realistas
// ============================================================
echo "\n[gsuing] Maestría en Big Data & Data Science\n";

$contactos_bigdata = [
    ['first_name'=>'Fernando', 'last_name'=>'Castillo Vivanco', 'phone'=>'0991344601', 'title'=>'Data Analyst', 'department'=>'Analytics', 'description'=>'3 años en análisis de datos con Python y R. Quiere pasar a Data Science avanzado.', 'maestria'=>'Maestría en Big Data & Data Science', 'email'=>$email_ref],
    ['first_name'=>'Alejandra', 'last_name'=>'Moncayo Peña', 'phone'=>'0981344602', 'title'=>'Business Intelligence', 'department'=>'BI', 'description'=>'Experta en Power BI y SQL Server. Interés en machine learning aplicado a negocios.', 'maestria'=>'Maestría en Big Data & Data Science', 'email'=>'a.moncayo.' . rand(100,999) . '@gmail.com'],
    ['first_name'=>'Roberto', 'last_name'=>'Pineda Samaniego', 'phone'=>'0971344603', 'title'=>'Estadístico', 'department'=>'Investigación', 'description'=>'Estadístico de universidad pública. Busca aplicar big data a investigación socioeconómica.', 'maestria'=>'Maestría en Big Data & Data Science', 'email'=>'r.pineda.' . rand(100,999) . '@hotmail.com'],
    ['first_name'=>'Daniela', 'last_name'=>'Herrera Calva', 'phone'=>'0961344604', 'title'=>'Data Engineer', 'department'=>'Ingeniería de Datos', 'description'=>'Trabaja con Spark y Hadoop. Financiamiento garantizado por empresa tecnológica internacional.', 'maestria'=>'Maestría en Big Data & Data Science', 'email'=>'d.herrera.' . rand(100,999) . '@gmail.com'],
    ['first_name'=>'Marcelo', 'last_name'=>'Abad Ojeda', 'phone'=>'0951344605', 'title'=>'ML Engineer', 'department'=>'IA', 'description'=>'Desarrolla modelos predictivos en producción. Busca profundizar en NLP y computer vision.', 'maestria'=>'Maestría en Big Data & Data Science', 'email'=>$email_ref],
    ['first_name'=>'Gabriela', 'last_name'=>'Zurita Noblecilla', 'phone'=>'0941344606', 'title'=>'Coordinadora de Proyectos', 'department'=>'PMO', 'description'=>'Gestiona proyectos de transformación digital. Maestría para liderar estrategia de datos.', 'maestria'=>'Maestría en Big Data & Data Science', 'email'=>'g.zurita.' . rand(100,999) . '@outlook.com'],
    ['first_name'=>'Pablo', 'last_name'=>'Morocho Sánchez', 'phone'=>'0931344607', 'title'=>'Analista de Riesgo', 'department'=>'Finanzas', 'description'=>'Sector financiero. Aplicará big data a modelos de riesgo crediticio.', 'maestria'=>'Maestría en Big Data & Data Science', 'email'=>'p.morocho.' . rand(100,999) . '@gmail.com'],
    ['first_name'=>'Silvia', 'last_name'=>'Palma Chuquirima', 'phone'=>'0921344608', 'title'=>'Investigadora', 'department'=>'Academia', 'description'=>'Docente universitaria. Necesita maestría para formación en investigación cuantitativa avanzada.', 'maestria'=>'Maestría en Big Data & Data Science', 'email'=>'s.palma.' . rand(100,999) . '@yahoo.com'],
    ['first_name'=>'Iván', 'last_name'=>'Valladares Granda', 'phone'=>'0911344609', 'title'=>'Gerente de TI', 'department'=>'Tecnología', 'description'=>'12 años de experiencia. Busca maestría para estrategia de datos empresarial.', 'maestria'=>'Maestría en Big Data & Data Science', 'email'=>$email_ref],
    ['first_name'=>'Sofía', 'last_name'=>'Briceño Medina', 'phone'=>'0901344610', 'title'=>'Data Scientist Junior', 'department'=>'Ciencia de Datos', 'description'=>'Recién graduada con distinciones. Alto potencial. Beca SENESCYT confirmada.', 'maestria'=>'Maestría en Big Data & Data Science', 'email'=>'s.briceno.' . rand(100,999) . '@gmail.com'],
    ['first_name'=>'Héctor', 'last_name'=>'Armijos Jaramillo', 'phone'=>'0891344611', 'title'=>'Arquitecto de Datos', 'department'=>'Datos', 'description'=>'Diseña pipelines de datos en AWS y Azure. Quiere especialización en analytics avanzado.', 'maestria'=>'Maestría en Big Data & Data Science', 'email'=>'h.armijos.' . rand(100,999) . '@gmail.com'],
];

$contact_ids_data = [];
foreach ($contactos_bigdata as $c) {
    $c['assigned_user_id'] = $gsuing_id;
    $c['lead_source'] = 'Web Site';
    $cid = crearContacto($db, $c);
    $contact_ids_data[] = $cid;
    echo "  ✓ {$c['first_name']} {$c['last_name']}\n";
}

// ============================================================
// ACTIVIDADES PARA RFIGUEROA
// ============================================================
echo "\n[rfigueroa] Creando actividades...\n";

$soft_topics = [
    ['Entrevista de admisión inicial', 'Se revisó el perfil profesional del aspirante. Cumple con los requisitos de experiencia mínima requerida.'],
    ['Llamada de seguimiento - documentos', 'El aspirante confirmó tener todos los documentos listos. Pendiente apostilla de título.'],
    ['Reunión informativa del programa', 'Se explicó la malla curricular, modalidad híbrida y fechas de inicio del cohorte.'],
    ['Llamada - confirmación de matrícula', 'El aspirante confirmó su decisión de inscribirse. Se envió formulario de preinscripción.'],
    ['Seguimiento financiero - beca', 'Se orientó sobre las becas disponibles SENESCYT y descuentos institucionales.'],
];

foreach (array_slice($contact_ids_soft, 0, 8) as $i => $cid) {
    $topic = $soft_topics[$i % count($soft_topics)];
    crearLlamada($db, $cid, $rfigueroa_id, $topic[0], $topic[1], rand(0,1) ? 'Held' : 'Planned');
    if ($i < 4) {
        crearReunion($db, $cid, $rfigueroa_id, 
            'Reunión de presentación - Ing. Software',
            'Presentación detallada del programa y resolución de dudas del aspirante.',
            'Held');
    }
    if ($i < 5) {
        crearTarea($db, $cid, $rfigueroa_id,
            'Revisar documentos de admisión',
            'Verificar título universitario, cédula, carta de motivación y hoja de vida actualizada.',
            $i < 3 ? 'Completed' : 'In Progress');
    }
    echo "  ✓ Actividades para contacto " . ($i+1) . "/8\n";
}

// ============================================================
// ACTIVIDADES PARA GSUING
// ============================================================
echo "\n[gsuing] Creando actividades...\n";

$data_topics = [
    ['Entrevista perfil Data Science', 'Se evaluaron conocimientos en estadística y programación. Aspirante con perfil muy sólido.'],
    ['Llamada orientación - Big Data', 'Se explicaron las diferencias entre el programa de Big Data y el de IA. El aspirante eligió Big Data.'],
    ['Reunión con sponsor empresarial', 'La empresa del aspirante financiará el 70% del costo de la maestría.'],
    ['Llamada - resultados prueba de admisión', 'El aspirante aprobó la prueba de conocimientos con 87/100. Procede a siguiente etapa.'],
    ['Seguimiento post-entrevista', 'El aspirante solicitó tiempo adicional para decidir. Se programó llamada de cierre en 1 semana.'],
];

foreach (array_slice($contact_ids_data, 0, 8) as $i => $cid) {
    $topic = $data_topics[$i % count($data_topics)];
    crearLlamada($db, $cid, $gsuing_id, $topic[0], $topic[1], rand(0,1) ? 'Held' : 'Planned');
    if ($i < 4) {
        crearReunion($db, $cid, $gsuing_id,
            'Presentación Maestría Big Data',
            'Sesión de presentación del programa: Big Data, Machine Learning, y herramientas principales.',
            'Held');
    }
    if ($i < 5) {
        crearTarea($db, $cid, $gsuing_id,
            'Validar requisitos de admisión',
            'Confirmar título de ingeniería o ciencias, experiencia mínima 2 años, y carta de motivación.',
            $i < 3 ? 'Completed' : 'In Progress');
    }
    echo "  ✓ Actividades para contacto " . ($i+1) . "/8\n";
}

// ============================================================
// ACTIVIDADES PARA ASESORES (sobre leads)
// ============================================================
echo "\n[asesores] Creando actividades de seguimiento en leads...\n";

$seguimiento_temas = [
    ['Primera llamada de contacto', 'Lead captado por campaña digital. Se presentó el programa y se resolvieron dudas iniciales.'],
    ['Segundo seguimiento - interés confirmado', 'El aspirante confirmó interés. Se envió brochure y plan de estudios por email.'],
    ['Tercer seguimiento - listo para convertir', 'El aspirante está decidido. Se solicitaron documentos y se agendó entrevista con director.'],
];

$leads_mendoza = $db->query("SELECT id FROM leads WHERE assigned_user_id='$cmendoza_id' AND deleted=0 LIMIT 6");
$i = 0;
while ($lrow = $db->fetchByAssoc($leads_mendoza)) {
    $lid = $lrow['id'];
    $topic = $seguimiento_temas[$i % 3];
    
    // Crear nota de seguimiento en el lead
    $note_id = create_guid();
    $note_t = $db->quote($topic[0]);
    $note_d = $db->quote($topic[1]);
    $db->query("INSERT INTO notes (id, name, description, parent_type, parent_id, contact_id,
        assigned_user_id, created_by, modified_user_id, date_entered, date_modified, deleted)
        VALUES ('$note_id', '$note_t', '$note_d', 'Leads', '$lid', '',
        '$cmendoza_id', '$cmendoza_id', '$cmendoza_id', NOW(), NOW(), 0)");
    $i++;
}
echo "  ✓ Notas de seguimiento para leads de cmendoza\n";

$leads_arivas = $db->query("SELECT id FROM leads WHERE assigned_user_id='$arivas_id' AND deleted=0 LIMIT 6");
$i = 0;
while ($lrow = $db->fetchByAssoc($leads_arivas)) {
    $lid = $lrow['id'];
    $topic = $seguimiento_temas[$i % 3];
    $note_id = create_guid();
    $note_t = $db->quote($topic[0]);
    $note_d = $db->quote($topic[1]);
    $db->query("INSERT INTO notes (id, name, description, parent_type, parent_id, contact_id,
        assigned_user_id, created_by, modified_user_id, date_entered, date_modified, deleted)
        VALUES ('$note_id', '$note_t', '$note_d', 'Leads', '$lid', '',
        '$arivas_id', '$arivas_id', '$arivas_id', NOW(), NOW(), 0)");
    $i++;
}
echo "  ✓ Notas de seguimiento para leads de arivas\n";

// ============================================================
// CONFIGURAR DASHBOARDS
// ============================================================
echo "\n=== CONFIGURANDO DASHBOARDS ===\n";

// RFIGUEROA - Director Software
setDashboard($db, $rfigueroa_id, [
    'dash_mis_contactos' => [
        'className'    => 'MyContactsDashlet',
        'module'       => 'Contacts',
        'forceColumn'  => 0,
        'fileLocation' => 'modules/Contacts/Dashlets/MyContactsDashlet/MyContactsDashlet.php',
        'options'      => ['title' => 'Mis Aspirantes - Ingeniería de Software'],
    ],
    'dash_reuniones' => [
        'className'    => 'MyMeetingsDashlet',
        'module'       => 'Meetings',
        'forceColumn'  => 0,
        'fileLocation' => 'modules/Meetings/Dashlets/MyMeetingsDashlet/MyMeetingsDashlet.php',
        'options'      => ['title' => 'Próximas Entrevistas y Reuniones'],
    ],
    'dash_llamadas' => [
        'className'    => 'MyCallsDashlet',
        'module'       => 'Calls',
        'forceColumn'  => 1,
        'fileLocation' => 'modules/Calls/Dashlets/MyCallsDashlet/MyCallsDashlet.php',
        'options'      => ['title' => 'Mis Llamadas de Seguimiento'],
    ],
    'dash_tareas' => [
        'className'    => 'MyTasksDashlet',
        'module'       => 'Tasks',
        'forceColumn'  => 1,
        'fileLocation' => 'modules/Tasks/Dashlets/MyTasksDashlet/MyTasksDashlet.php',
        'options'      => ['title' => 'Tareas Pendientes de Admisión'],
    ],
    'dash_feed' => [
        'className'    => 'SugarFeedDashlet',
        'module'       => 'SugarFeed',
        'forceColumn'  => 1,
        'fileLocation' => 'modules/SugarFeed/Dashlets/SugarFeedDashlet/SugarFeedDashlet.php',
    ],
], 'Panel Director - Maestría en Ingeniería de Software');

// GSUING - Director Big Data
setDashboard($db, $gsuing_id, [
    'dash_mis_contactos' => [
        'className'    => 'MyContactsDashlet',
        'module'       => 'Contacts',
        'forceColumn'  => 0,
        'fileLocation' => 'modules/Contacts/Dashlets/MyContactsDashlet/MyContactsDashlet.php',
        'options'      => ['title' => 'Mis Aspirantes - Big Data & Data Science'],
    ],
    'dash_reuniones' => [
        'className'    => 'MyMeetingsDashlet',
        'module'       => 'Meetings',
        'forceColumn'  => 0,
        'fileLocation' => 'modules/Meetings/Dashlets/MyMeetingsDashlet/MyMeetingsDashlet.php',
        'options'      => ['title' => 'Próximas Entrevistas y Reuniones'],
    ],
    'dash_llamadas' => [
        'className'    => 'MyCallsDashlet',
        'module'       => 'Calls',
        'forceColumn'  => 1,
        'fileLocation' => 'modules/Calls/Dashlets/MyCallsDashlet/MyCallsDashlet.php',
        'options'      => ['title' => 'Mis Llamadas de Seguimiento'],
    ],
    'dash_tareas' => [
        'className'    => 'MyTasksDashlet',
        'module'       => 'Tasks',
        'forceColumn'  => 1,
        'fileLocation' => 'modules/Tasks/Dashlets/MyTasksDashlet/MyTasksDashlet.php',
        'options'      => ['title' => 'Tareas Pendientes de Admisión'],
    ],
    'dash_feed' => [
        'className'    => 'SugarFeedDashlet',
        'module'       => 'SugarFeed',
        'forceColumn'  => 1,
        'fileLocation' => 'modules/SugarFeed/Dashlets/SugarFeedDashlet/SugarFeedDashlet.php',
    ],
], 'Panel Director - Maestría en Big Data & Data Science');

// CMENDOZA - Asesor
setDashboard($db, $cmendoza_id, [
    'dash_mis_leads' => [
        'className'    => 'MyLeadsDashlet',
        'module'       => 'Leads',
        'forceColumn'  => 0,
        'fileLocation' => 'modules/Leads/Dashlets/MyLeadsDashlet/MyLeadsDashlet.php',
        'options'      => ['title' => 'Mis Aspirantes (Leads)'],
    ],
    'dash_actividad' => [
        'className'    => 'MyCallsDashlet',
        'module'       => 'Calls',
        'forceColumn'  => 0,
        'fileLocation' => 'modules/Calls/Dashlets/MyCallsDashlet/MyCallsDashlet.php',
        'options'      => ['title' => 'Mis Llamadas de Seguimiento'],
    ],
    'dash_tareas' => [
        'className'    => 'MyTasksDashlet',
        'module'       => 'Tasks',
        'forceColumn'  => 1,
        'fileLocation' => 'modules/Tasks/Dashlets/MyTasksDashlet/MyTasksDashlet.php',
        'options'      => ['title' => 'Mis Tareas Pendientes'],
    ],
    'dash_reuniones' => [
        'className'    => 'MyMeetingsDashlet',
        'module'       => 'Meetings',
        'forceColumn'  => 1,
        'fileLocation' => 'modules/Meetings/Dashlets/MyMeetingsDashlet/MyMeetingsDashlet.php',
        'options'      => ['title' => 'Mis Reuniones'],
    ],
    'dash_feed' => [
        'className'    => 'SugarFeedDashlet',
        'module'       => 'SugarFeed',
        'forceColumn'  => 1,
        'fileLocation' => 'modules/SugarFeed/Dashlets/SugarFeedDashlet/SugarFeedDashlet.php',
    ],
], 'Panel Asesor - Gestión de Aspirantes a Posgrado');

// ARIVAS - Asesor
setDashboard($db, $arivas_id, [
    'dash_mis_leads' => [
        'className'    => 'MyLeadsDashlet',
        'module'       => 'Leads',
        'forceColumn'  => 0,
        'fileLocation' => 'modules/Leads/Dashlets/MyLeadsDashlet/MyLeadsDashlet.php',
        'options'      => ['title' => 'Mis Aspirantes (Leads)'],
    ],
    'dash_actividad' => [
        'className'    => 'MyCallsDashlet',
        'module'       => 'Calls',
        'forceColumn'  => 0,
        'fileLocation' => 'modules/Calls/Dashlets/MyCallsDashlet/MyCallsDashlet.php',
        'options'      => ['title' => 'Mis Llamadas de Seguimiento'],
    ],
    'dash_tareas' => [
        'className'    => 'MyTasksDashlet',
        'module'       => 'Tasks',
        'forceColumn'  => 1,
        'fileLocation' => 'modules/Tasks/Dashlets/MyTasksDashlet/MyTasksDashlet.php',
        'options'      => ['title' => 'Mis Tareas Pendientes'],
    ],
    'dash_reuniones' => [
        'className'    => 'MyMeetingsDashlet',
        'module'       => 'Meetings',
        'forceColumn'  => 1,
        'fileLocation' => 'modules/Meetings/Dashlets/MyMeetingsDashlet/MyMeetingsDashlet.php',
        'options'      => ['title' => 'Mis Reuniones'],
    ],
    'dash_feed' => [
        'className'    => 'SugarFeedDashlet',
        'module'       => 'SugarFeed',
        'forceColumn'  => 1,
        'fileLocation' => 'modules/SugarFeed/Dashlets/SugarFeedDashlet/SugarFeedDashlet.php',
    ],
], 'Panel Asesor - Gestión de Aspirantes a Posgrado');

// SCARDENAS / DBENITEZ - Dirección
foreach ([$db->quote('3db2dd8f-2063-4692-86b8-1bc5ea6328d6'), $db->quote('b2bc213a-4c7e-44b2-a2a0-fcc4758fc343')] as $uid) {
    $uid_clean = str_replace("'", '', $uid);
    setDashboard($db, $uid_clean, [
        'dash_leads' => [
            'className'    => 'MyLeadsDashlet',
            'module'       => 'Leads',
            'forceColumn'  => 0,
            'fileLocation' => 'modules/Leads/Dashlets/MyLeadsDashlet/MyLeadsDashlet.php',
            'options'      => ['title' => 'Leads en Proceso - Supervisión'],
        ],
        'dash_contactos' => [
            'className'    => 'MyContactsDashlet',
            'module'       => 'Contacts',
            'forceColumn'  => 0,
            'fileLocation' => 'modules/Contacts/Dashlets/MyContactsDashlet/MyContactsDashlet.php',
            'options'      => ['title' => 'Aspirantes Interesados (Contactos)'],
        ],
        'dash_llamadas' => [
            'className'    => 'MyCallsDashlet',
            'module'       => 'Calls',
            'forceColumn'  => 1,
            'fileLocation' => 'modules/Calls/Dashlets/MyCallsDashlet/MyCallsDashlet.php',
            'options'      => ['title' => 'Actividad Reciente'],
        ],
        'dash_feed' => [
            'className'    => 'SugarFeedDashlet',
            'module'       => 'SugarFeed',
            'forceColumn'  => 1,
            'fileLocation' => 'modules/SugarFeed/Dashlets/SugarFeedDashlet/SugarFeedDashlet.php',
        ],
    ], 'Panel Dirección - Supervisión General Posgrado');
}

// MARKETING (ctorres, vmorales)
foreach (['92ebafa7-d89b-496a-9064-d9c708078142', 'd96577e4-e087-426a-8ca3-81402c8c20fc'] as $uid) {
    setDashboard($db, $uid, [
        'dash_campanas' => [
            'className'    => 'TopCampaignsDashlet',
            'module'       => 'Campaigns',
            'forceColumn'  => 0,
            'fileLocation' => 'modules/Campaigns/Dashlets/TopCampaignsDashlet/TopCampaignsDashlet.php',
            'options'      => ['title' => 'Campañas Activas'],
        ],
        'dash_roi' => [
            'className'    => 'CampaignROIChartDashlet',
            'module'       => 'Charts',
            'forceColumn'  => 0,
            'fileLocation' => 'modules/Charts/Dashlets/CampaignROIChartDashlet/CampaignROIChartDashlet.php',
            'options'      => ['title' => 'ROI de Campañas'],
        ],
        'dash_leads' => [
            'className'    => 'MyLeadsDashlet',
            'module'       => 'Leads',
            'forceColumn'  => 1,
            'fileLocation' => 'modules/Leads/Dashlets/MyLeadsDashlet/MyLeadsDashlet.php',
            'options'      => ['title' => 'Últimos Prospectos Captados'],
        ],
        'dash_feed' => [
            'className'    => 'SugarFeedDashlet',
            'module'       => 'SugarFeed',
            'forceColumn'  => 1,
            'fileLocation' => 'modules/SugarFeed/Dashlets/SugarFeedDashlet/SugarFeedDashlet.php',
        ],
    ], 'Panel Marketing - Campañas y Captación');
}

// ============================================================
// RESUMEN FINAL
// ============================================================
echo "\n=======================================================\n";
echo "  RESUMEN DE DATOS CREADOS\n";
echo "=======================================================\n";

$r = $db->query("SELECT COUNT(*) as cnt FROM contacts WHERE deleted=0");
$row = $db->fetchByAssoc($r);
echo "  📋 Total contactos: {$row['cnt']}\n";

$r2 = $db->query("SELECT u.user_name, COUNT(c.id) as cnt FROM contacts c JOIN users u ON c.assigned_user_id=u.id WHERE c.deleted=0 GROUP BY u.user_name ORDER BY cnt DESC");
while ($row = $db->fetchByAssoc($r2)) {
    echo "     {$row['user_name']}: {$row['cnt']} contactos\n";
}

$r3 = $db->query("SELECT COUNT(*) as cnt FROM calls WHERE deleted=0");
$row3 = $db->fetchByAssoc($r3);
echo "  📞 Total llamadas: {$row3['cnt']}\n";

$r4 = $db->query("SELECT COUNT(*) as cnt FROM meetings WHERE deleted=0");
$row4 = $db->fetchByAssoc($r4);
echo "  🗓️  Total reuniones: {$row4['cnt']}\n";

$r5 = $db->query("SELECT COUNT(*) as cnt FROM tasks WHERE deleted=0");
$row5 = $db->fetchByAssoc($r5);
echo "  ✅ Total tareas: {$row5['cnt']}\n";

echo "\n  Dashboards actualizados para:\n";
echo "  ✓ rfigueroa - Ing. Software (Mis Contactos)\n";
echo "  ✓ gsuing - Big Data (Mis Contactos)\n";
echo "  ✓ cmendoza - Asesor (Mis Leads)\n";
echo "  ✓ arivas - Asesor (Mis Leads)\n";
echo "  ✓ scardenas/dbenitez - Dirección (Leads + Contactos)\n";
echo "  ✓ ctorres/vmorales - Marketing (Campañas)\n";

echo "\n🎉 Todo listo. Ingresa al CRM con cualquier usuario y verás sus datos.\n";
echo "   URL: http://localhost:8000\n";
echo "   Password: crm123\n\n";
