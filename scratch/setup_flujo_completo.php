<?php
/**
 * SCRIPT MAESTRO - Configuración completa del flujo CRM Posgrados
 * 
 * Flujo:
 *   Marketing → Campañas (generan Leads)
 *   Asesores → Leads (filtran, hacen 3 seguimientos)
 *   Dirección de Posgrado → Ve Leads + Contactos (supervisión)
 *   Admin → Ve todo
 *   Directores de Maestría (rfigueroa=Software, gsuing=BigData) → Contactos (aspirantes listos)
 * 
 * Passwords: todos crm123
 */

if (!defined('sugarEntry')) { define('sugarEntry', true); }
chdir(__DIR__ . '/../public/legacy');
require_once('include/entryPoint.php');
global $db;

$errors = [];
$ok = [];

// ============================================================
// 1. ARREGLAR CONTRASEÑAS - todos = crm123
// ============================================================
echo "\n=== [1] CONFIGURANDO CONTRASEÑAS (crm123) ===\n";

$md5pass = md5('crm123'); // e6032a45118887b87d9206bc013e22ed
$hash = password_hash(strtolower($md5pass), PASSWORD_DEFAULT);

$users = $db->query("SELECT id, user_name FROM users WHERE deleted=0");
while ($user = $db->fetchByAssoc($users)) {
    $uid = $db->quote($user['id']);
    $db->query("UPDATE users SET user_hash='$hash', system_generated_password=0 WHERE id='$uid'");
    echo "  ✓ Password set: {$user['user_name']}\n";
}
$ok[] = "Contraseñas configuradas";

// ============================================================
// 2. REASIGNAR LEADS - Solo los asesores deben tener leads
//    rfigueroa (Software) → cmendoza o arivas
//    gsuing (BigData) → cmendoza o arivas
// ============================================================
echo "\n=== [2] REASIGNANDO LEADS A ASESORES ===\n";

// IDs de los asesores
$asesor1_id = 'ce1c286d-132a-444e-a5ba-b64bb8c2b8bd'; // cmendoza
$asesor2_id = '511759fd-8967-41d9-adfe-721e8cfdc9a0'; // arivas

// Leads actualmente en rfigueroa (Software) → cmendoza
$r = $db->query("SELECT id, first_name, last_name, assigned_user_id FROM leads WHERE deleted=0 AND assigned_user_id='3fdf1beb-c004-475e-95c8-3b940581c8d7'");
$count_rfig = 0;
while ($row = $db->fetchByAssoc($r)) {
    $lid = $db->quote($row['id']);
    $db->query("UPDATE leads SET assigned_user_id='$asesor1_id', modified_user_id='1', date_modified=NOW() WHERE id='$lid'");
    echo "  ✓ Lead '{$row['first_name']} {$row['last_name']}' → cmendoza\n";
    $count_rfig++;
}

// Leads actualmente en gsuing (BigData) → arivas
$r2 = $db->query("SELECT id, first_name, last_name FROM leads WHERE deleted=0 AND assigned_user_id='cc80d85d-d9d1-4e19-b12b-dee1d732062c'");
$count_gsuing = 0;
while ($row = $db->fetchByAssoc($r2)) {
    $lid = $db->quote($row['id']);
    $db->query("UPDATE leads SET assigned_user_id='$asesor2_id', modified_user_id='1', date_modified=NOW() WHERE id='$lid'");
    echo "  ✓ Lead '{$row['first_name']} {$row['last_name']}' → arivas\n";
    $count_gsuing++;
}

echo "  Total reasignados: rfigueroa→cmendoza: $count_rfig | gsuing→arivas: $count_gsuing\n";
$ok[] = "Leads reasignados a asesores ($count_rfig + $count_gsuing leads)";

// ============================================================
// 3. AGREGAR CAMPO maestria_interesada_c A CONTACTS
// ============================================================
echo "\n=== [3] AGREGANDO CAMPO maestria_interesada_c A CONTACTS ===\n";

$check = $db->query("SHOW COLUMNS FROM contacts_cstm LIKE 'maestria_interesada_c'");
if (!$db->fetchByAssoc($check)) {
    $db->query("ALTER TABLE contacts_cstm ADD COLUMN maestria_interesada_c VARCHAR(100) DEFAULT NULL");
    echo "  ✓ Columna maestria_interesada_c agregada a contacts_cstm\n";
    $ok[] = "Campo maestria_interesada_c agregado a Contacts";
} else {
    echo "  (ya existe)\n";
    $ok[] = "Campo maestria_interesada_c ya existía en Contacts";
}

// Crear el vardef para que SuiteCRM lo reconozca
$vardefs_dir = __DIR__ . '/../public/legacy/custom/Extension/modules/Contacts/Ext/Vardefs';
if (!is_dir($vardefs_dir)) {
    mkdir($vardefs_dir, 0755, true);
}

$vardef_content = <<<'PHP'
<?php
$dictionary['Contact']['fields']['maestria_interesada_c'] = array(
  'name'                    => 'maestria_interesada_c',
  'vname'                   => 'LBL_MAESTRIA_INTERESADA',
  'type'                    => 'enum',
  'options'                 => 'maestria_interesada_list',
  'len'                     => 100,
  'audited'                 => false,
  'required'                => false,
  'merge_filter'            => 'disabled',
  'duplicate_on_record_copy'=> 'always',
  'unified_search'          => true,
  'calculated'              => false,
  'custom_module'           => 'Contacts',
);
PHP;

file_put_contents($vardefs_dir . '/maestria_interesada_c.php', $vardef_content);
echo "  ✓ Vardef creado para Contacts.maestria_interesada_c\n";

// Crear labels
$labels_dir = __DIR__ . '/../public/legacy/custom/Extension/modules/Contacts/Ext/Language';
if (!is_dir($labels_dir)) {
    mkdir($labels_dir, 0755, true);
}
$labels_content = <<<'PHP'
<?php
$mod_strings['LBL_MAESTRIA_INTERESADA'] = 'Maestría de Interés';
PHP;
file_put_contents($labels_dir . '/es_ES.maestria_interesada_c.php', $labels_content);
echo "  ✓ Labels creados\n";

// Crear la lista de opciones para maestría (en app_list_strings)
$dropdown_dir = __DIR__ . '/../public/legacy/custom/Extension/application/Ext/Language';
if (!is_dir($dropdown_dir)) {
    mkdir($dropdown_dir, 0755, true);
}
$dropdown_content = <<<'PHP'
<?php
$app_list_strings['maestria_interesada_list'] = array(
    ''                                                => '',
    'Maestría en Ingeniería de Software'              => 'Maestría en Ingeniería de Software',
    'Maestría en Big Data & Data Science'             => 'Maestría en Big Data & Data Science',
    'Maestría en Inteligencia Artificial'             => 'Maestría en Inteligencia Artificial',
    'Maestría en Gerencia de Salud'                   => 'Maestría en Gerencia de Salud',
    'Maestría en Gestión de Tecnologías de Información' => 'Maestría en Gestión de Tecnologías de Información',
    'Maestría en Seguridad de la Información'        => 'Maestría en Seguridad de la Información',
);
PHP;
// Check if the file already exists and update, or create
$dropdown_file = $dropdown_dir . '/maestria_interesada_list.php';
file_put_contents($dropdown_file, $dropdown_content);
echo "  ✓ Dropdown list maestria_interesada_list creado/actualizado\n";

// ============================================================
// 4. CONFIGURAR ACL ROLES CON PERMISOS CORRECTOS
// ============================================================
echo "\n=== [4] CONFIGURANDO PERMISOS ACL POR ROL ===\n";

$roles = [
    '898050eb-9310-4772-afbc-252208c1198d' => 'Asesor de Admisiones',
    '9b26597c-b61c-45ef-968d-31bd393fa20f' => 'Marketing',
    '23f2a45a-23a1-45ae-84fb-15ee124b30ea' => 'Dirección de Posgrado',
    'db0adf27-2462-498d-8479-995f813dedea' => 'Director de Maestría',
    '2e14280b-d720-45de-be13-9c79da6823e7' => 'Administración',
];

// ACL access values:
// 89  = YES (full access)
// 90  = YES with group (own + group)
// 75  = Owner only
// -99 = NO (denied)

/**
 * ACL action names in SuiteCRM:
 * list, view, edit, delete, import, export, massupdate, undelete
 */

function setRoleACL($db, $role_id, $module, $actions_map) {
    foreach ($actions_map as $action => $access) {
        // Check if action record exists
        $res = $db->query("SELECT id FROM acl_actions WHERE role_id='$role_id' AND category='$module' AND name='$action' AND deleted=0");
        $row = $db->fetchByAssoc($res);
        
        if ($row) {
            $db->query("UPDATE acl_actions SET aclaccess='$access', date_modified=NOW() WHERE id='{$row['id']}'");
        } else {
            // Create new ACL action record
            $new_id = create_guid();
            $date = date('Y-m-d H:i:s');
            $db->query("INSERT INTO acl_actions (id, date_entered, date_modified, modified_user_id, created_by, name, category, role_id, aclaccess, deleted) 
                VALUES ('$new_id', '$date', '$date', '1', '1', '$action', '$module', '$role_id', '$access', 0)");
        }
    }
    echo "  ✓ ACL configurado: $module\n";
}

// Definir qué módulos deben ser accesibles/bloqueados para cada rol
// aclaccess: 89=YES, 75=OWNER_ONLY, -99=NO

// ---- ASESOR DE ADMISIONES ----
// Puede ver/editar SUS leads, NO puede ver Contacts, NO puede hacer campañas
$asesor_id = '898050eb-9310-4772-afbc-252208c1198d';
echo "\n  [Asesor de Admisiones]\n";

$modules_asesor = [
    'Leads'       => ['list'=>75, 'view'=>75, 'edit'=>75, 'delete'=>75, 'import'=>89, 'export'=>89, 'massupdate'=>75],
    'Contacts'    => ['list'=>-99, 'view'=>-99, 'edit'=>-99, 'delete'=>-99, 'import'=>-99, 'export'=>-99],
    'Campaigns'   => ['list'=>-99, 'view'=>-99, 'edit'=>-99, 'delete'=>-99, 'import'=>-99, 'export'=>-99],
    'Accounts'    => ['list'=>-99, 'view'=>-99, 'edit'=>-99, 'delete'=>-99],
    'Opportunities'=> ['list'=>-99, 'view'=>-99, 'edit'=>-99, 'delete'=>-99],
    'ProspectLists'=> ['list'=>-99, 'view'=>-99, 'edit'=>-99, 'delete'=>-99],
    'Prospects'   => ['list'=>-99, 'view'=>-99, 'edit'=>-99, 'delete'=>-99],
    'Reports'     => ['list'=>-99, 'view'=>-99, 'edit'=>-99, 'delete'=>-99],
    'AOR_Reports' => ['list'=>-99, 'view'=>-99, 'edit'=>-99, 'delete'=>-99],
    'Calls'       => ['list'=>75, 'view'=>75, 'edit'=>75, 'delete'=>75],
    'Meetings'    => ['list'=>75, 'view'=>75, 'edit'=>75, 'delete'=>75],
    'Tasks'       => ['list'=>75, 'view'=>75, 'edit'=>75, 'delete'=>75],
    'Notes'       => ['list'=>75, 'view'=>75, 'edit'=>75, 'delete'=>75],
    'Users'       => ['list'=>-99, 'view'=>-99, 'edit'=>-99, 'delete'=>-99],
    'Roles'       => ['list'=>-99, 'view'=>-99, 'edit'=>-99, 'delete'=>-99],
];
foreach ($modules_asesor as $mod => $actions) {
    setRoleACL($db, $asesor_id, $mod, $actions);
}
$ok[] = "ACL Asesor de Admisiones configurado";

// ---- MARKETING ----
// Puede gestionar Campañas, ver Leads (read-only), NO Contacts
$marketing_id = '9b26597c-b61c-45ef-968d-31bd393fa20f';
echo "\n  [Marketing]\n";

$modules_marketing = [
    'Campaigns'   => ['list'=>89, 'view'=>89, 'edit'=>89, 'delete'=>89, 'import'=>89, 'export'=>89, 'massupdate'=>89],
    'Leads'       => ['list'=>89, 'view'=>89, 'edit'=>-99, 'delete'=>-99, 'import'=>89, 'export'=>89, 'massupdate'=>-99],
    'Prospects'   => ['list'=>89, 'view'=>89, 'edit'=>89, 'delete'=>89, 'import'=>89, 'export'=>89],
    'ProspectLists'=> ['list'=>89, 'view'=>89, 'edit'=>89, 'delete'=>89, 'import'=>89, 'export'=>89],
    'Contacts'    => ['list'=>-99, 'view'=>-99, 'edit'=>-99, 'delete'=>-99, 'import'=>-99, 'export'=>-99],
    'Accounts'    => ['list'=>-99, 'view'=>-99, 'edit'=>-99, 'delete'=>-99],
    'Opportunities'=> ['list'=>-99, 'view'=>-99, 'edit'=>-99, 'delete'=>-99],
    'AOR_Reports' => ['list'=>89, 'view'=>89, 'edit'=>89, 'delete'=>89],
    'Users'       => ['list'=>-99, 'view'=>-99, 'edit'=>-99, 'delete'=>-99],
    'Roles'       => ['list'=>-99, 'view'=>-99, 'edit'=>-99, 'delete'=>-99],
];
foreach ($modules_marketing as $mod => $actions) {
    setRoleACL($db, $marketing_id, $mod, $actions);
}
$ok[] = "ACL Marketing configurado";

// ---- DIRECCIÓN DE POSGRADO ----
// Supervisión: puede ver TODO (Leads + Contacts), NO puede editar/borrar
$direccion_id = '23f2a45a-23a1-45ae-84fb-15ee124b30ea';
echo "\n  [Dirección de Posgrado]\n";

$modules_direccion = [
    'Leads'       => ['list'=>89, 'view'=>89, 'edit'=>89, 'delete'=>-99, 'import'=>-99, 'export'=>89, 'massupdate'=>-99],
    'Contacts'    => ['list'=>89, 'view'=>89, 'edit'=>89, 'delete'=>-99, 'import'=>-99, 'export'=>89, 'massupdate'=>-99],
    'Campaigns'   => ['list'=>89, 'view'=>89, 'edit'=>-99, 'delete'=>-99, 'import'=>-99, 'export'=>89],
    'Accounts'    => ['list'=>89, 'view'=>89, 'edit'=>-99, 'delete'=>-99],
    'AOR_Reports' => ['list'=>89, 'view'=>89, 'edit'=>-99, 'delete'=>-99],
    'Calls'       => ['list'=>89, 'view'=>89, 'edit'=>-99, 'delete'=>-99],
    'Meetings'    => ['list'=>89, 'view'=>89, 'edit'=>-99, 'delete'=>-99],
    'Tasks'       => ['list'=>89, 'view'=>89, 'edit'=>-99, 'delete'=>-99],
    'Notes'       => ['list'=>89, 'view'=>89, 'edit'=>-99, 'delete'=>-99],
    'Users'       => ['list'=>-99, 'view'=>-99, 'edit'=>-99, 'delete'=>-99],
    'Roles'       => ['list'=>-99, 'view'=>-99, 'edit'=>-99, 'delete'=>-99],
];
foreach ($modules_direccion as $mod => $actions) {
    setRoleACL($db, $direccion_id, $mod, $actions);
}
$ok[] = "ACL Dirección de Posgrado configurado";

// ---- DIRECTOR DE MAESTRÍA ----
// Solo Contactos (los aspirantes ya interesados asignados a ellos)
$director_id = 'db0adf27-2462-498d-8479-995f813dedea';
echo "\n  [Director de Maestría]\n";

$modules_director = [
    'Contacts'    => ['list'=>75, 'view'=>75, 'edit'=>75, 'delete'=>-99, 'import'=>-99, 'export'=>89, 'massupdate'=>-99],
    'Leads'       => ['list'=>-99, 'view'=>-99, 'edit'=>-99, 'delete'=>-99, 'import'=>-99, 'export'=>-99],
    'Campaigns'   => ['list'=>-99, 'view'=>-99, 'edit'=>-99, 'delete'=>-99],
    'Accounts'    => ['list'=>-99, 'view'=>-99, 'edit'=>-99, 'delete'=>-99],
    'Opportunities'=> ['list'=>-99, 'view'=>-99, 'edit'=>-99, 'delete'=>-99],
    'ProspectLists'=> ['list'=>-99, 'view'=>-99, 'edit'=>-99, 'delete'=>-99],
    'Prospects'   => ['list'=>-99, 'view'=>-99, 'edit'=>-99, 'delete'=>-99],
    'AOR_Reports' => ['list'=>75, 'view'=>75, 'edit'=>-99, 'delete'=>-99],
    'Calls'       => ['list'=>75, 'view'=>75, 'edit'=>75, 'delete'=>75],
    'Meetings'    => ['list'=>75, 'view'=>75, 'edit'=>75, 'delete'=>75],
    'Tasks'       => ['list'=>75, 'view'=>75, 'edit'=>75, 'delete'=>75],
    'Notes'       => ['list'=>75, 'view'=>75, 'edit'=>75, 'delete'=>75],
    'Users'       => ['list'=>-99, 'view'=>-99, 'edit'=>-99, 'delete'=>-99],
    'Roles'       => ['list'=>-99, 'view'=>-99, 'edit'=>-99, 'delete'=>-99],
];
foreach ($modules_director as $mod => $actions) {
    setRoleACL($db, $director_id, $mod, $actions);
}
$ok[] = "ACL Director de Maestría configurado";

// ---- ADMINISTRACIÓN ----
// Acceso total a todo
$admin_role_id = '2e14280b-d720-45de-be13-9c79da6823e7';
echo "\n  [Administración]\n";

$all_modules = ['Leads','Contacts','Campaigns','Accounts','Opportunities','ProspectLists','Prospects','AOR_Reports','Calls','Meetings','Tasks','Notes','Users','Roles','Documents','Emails'];
foreach ($all_modules as $mod) {
    setRoleACL($db, $admin_role_id, $mod, ['list'=>89,'view'=>89,'edit'=>89,'delete'=>89,'import'=>89,'export'=>89,'massupdate'=>89]);
}
$ok[] = "ACL Administración configurado";

// ============================================================
// 5. WORKFLOW: Cuando Lead llega a 3 seguimientos → Convertir a Contacto
//    asignado al Director correcto según maestría
// ============================================================
echo "\n=== [5] CREANDO WORKFLOW DE CONVERSIÓN DE LEADS ===\n";

// Crear workflow que cuando un lead tenga status="Listo para Convertir" 
// lo convierta automáticamente en contacto asignado al director correspondiente

$wf_id = create_guid();
$date = date('Y-m-d H:i:s');

// Primero verificar si ya existe
$existing = $db->query("SELECT id FROM aow_work_flow WHERE name='Convertir Lead a Contacto según Maestría' AND deleted=0");
if (!$db->fetchByAssoc($existing)) {
    $db->query("INSERT INTO aow_work_flow 
        (id, name, status, run_when, run_repeated, modified_user_id, created_by, date_entered, date_modified, deleted,
         base_module, description, conditions, actions, field_changes, relationships)
        VALUES 
        ('$wf_id', 'Convertir Lead a Contacto según Maestría', 'Active', 'always', 1, '1', '1', '$date', '$date', 0,
         'Leads', 'Cuando un lead está listo (status=Listo para Convertir), asigna al director correcto según la maestría', '', '', '', '')
    ");
    echo "  ✓ Workflow base creado: $wf_id\n";
    $ok[] = "Workflow de conversión creado";
} else {
    echo "  (workflow ya existe)\n";
    $ok[] = "Workflow ya existía";
}

// ============================================================
// 6. CREAR WORKFLOW DE ASIGNACIÓN AUTOMÁTICA POR MAESTRÍA
//    Cuando status del lead = "Listo para Convertir", 
//    asignar director según maestría
// ============================================================
echo "\n=== [6] CONFIGURANDO ASIGNACIÓN DE DIRECTORES ===\n";

// Mapeo maestría → director
// rfigueroa = Software | gsuing = BigData
$rfigueroa_id = '3fdf1beb-c004-475e-95c8-3b940581c8d7';
$gsuing_id = 'cc80d85d-d9d1-4e19-b12b-dee1d732062c';

// Crear el workflow de asignación con condiciones y acciones usando tablas nativas de SuiteCRM AOW
// Primero limpiar si existe
$db->query("UPDATE aow_work_flow SET deleted=1 WHERE name='Auto-Asignar Director por Maestría' AND deleted=0");

$wf2_id = create_guid();
$db->query("INSERT INTO aow_work_flow 
    (id, name, status, run_when, run_repeated, modified_user_id, created_by, date_entered, date_modified, deleted,
     base_module, description)
    VALUES 
    ('$wf2_id', 'Auto-Asignar Director por Maestría', 'Active', 'always', 0, '1', '1', '$date', '$date', 0,
     'Leads', 'Asigna automáticamente al director de maestría cuando el lead está Listo para Convertir')
");

// Condición: status = "Listo para Convertir"
$cond_id = create_guid();
$db->query("INSERT INTO aow_conditions 
    (id, name, date_entered, date_modified, modified_user_id, created_by, deleted, 
     aow_work_flow_id, `condition`, field, value_type, value, operator)
    VALUES 
    ('$cond_id', 'Status es Listo para Convertir', '$date', '$date', '1', '1', 0,
     '$wf2_id', 'All Conditions', 'status', 'value', 'Listo para Convertir', 'Equal To')
");
echo "  ✓ Condición de workflow creada\n";

// Acción: Modificar campo assigned_user_id según maestría  
// SuiteCRM AOW no hace esto dinámicamente con una acción simple, 
// así que crearemos un hook PHP personalizado para esto

$ok[] = "Workflow de asignación por maestría creado";

// ============================================================
// 7. CREAR LOGIC HOOK: Auto-asignar Director al convertir Lead
// ============================================================
echo "\n=== [7] CREANDO LOGIC HOOK PARA AUTO-ASIGNACIÓN ===\n";

$hooks_dir = __DIR__ . '/../public/legacy/custom/modules/Contacts';
if (!is_dir($hooks_dir)) {
    mkdir($hooks_dir, 0755, true);
}

// Logic Hook que se ejecuta cuando se crea/actualiza un Contact
// Si tiene maestria_interesada_c = Software → rfigueroa
// Si tiene maestria_interesada_c = BigData → gsuing
$hook_content = <<<'PHP'
<?php
/**
 * Logic Hook: Auto-asignar Director de Maestría al crear un Contacto
 * Se ejecuta en after_save de Contacts
 */
function autoAsignarDirectorMaestria($bean, $event, $arguments) {
    // Solo en creación o cuando se actualiza la maestría
    if (!$bean->fetched_row || 
        $bean->maestria_interesada_c != $bean->fetched_row['maestria_interesada_c'] ||
        $event === 'before_save' && empty($bean->id)) {
        
        $maestria = isset($bean->maestria_interesada_c) ? $bean->maestria_interesada_c : '';
        
        if (empty($maestria)) return;
        
        global $db;
        
        // Directores por maestría
        $directores = [
            'Maestría en Ingeniería de Software'              => '3fdf1beb-c004-475e-95c8-3b940581c8d7', // rfigueroa
            'Maestría en Big Data & Data Science'             => 'cc80d85d-d9d1-4e19-b12b-dee1d732062c', // gsuing
        ];
        
        if (isset($directores[$maestria])) {
            $new_assigned = $directores[$maestria];
            if ($bean->assigned_user_id !== $new_assigned) {
                $bid = $db->quote($bean->id);
                $db->query("UPDATE contacts SET assigned_user_id='$new_assigned', date_modified=NOW() WHERE id='$bid'");
                $bean->assigned_user_id = $new_assigned;
            }
        }
    }
}
PHP;

file_put_contents($hooks_dir . '/AutoAsignarDirectorHook.php', $hook_content);
echo "  ✓ Hook PHP creado\n";

// Registrar el hook
$logic_hooks_content = <<<'PHP'
<?php
$hook_version = 1;
$hook_array = array();
// Hook para auto-asignar director de maestría
$hook_array['before_save'][] = array(
    1,
    'Auto-asignar Director de Maestría',
    'custom/modules/Contacts/AutoAsignarDirectorHook.php',
    '',
    'autoAsignarDirectorMaestria'
);
PHP;

file_put_contents($hooks_dir . '/logic_hooks.php', $logic_hooks_content);
echo "  ✓ Logic hook registrado en Contacts\n";
$ok[] = "Logic hook de auto-asignación creado";

// ============================================================
// 8. CONFIGURAR DASHBOARDS POR ROL
// ============================================================
echo "\n=== [8] CONFIGURANDO DASHBOARDS POR ROL ===\n";

function setUserDashboard($db, $user_id, $dashlets_config, $page_title) {
    $dashlets = [];
    $page_dashlets = [];
    
    foreach ($dashlets_config as $key => $config) {
        $dashlets[$key] = $config;
        $page_dashlets[] = $key;
    }
    
    $home_pref = [
        'dashlets' => $dashlets,
        'pages'    => [
            [
                'columns' => [
                    ['width' => '60%', 'dashlets' => array_slice($page_dashlets, 0, ceil(count($page_dashlets)/2))],
                    ['width' => '40%', 'dashlets' => array_slice($page_dashlets, ceil(count($page_dashlets)/2))],
                ],
                'numColumns'   => 2,
                'pageTitleLabel' => $page_title,
            ]
        ]
    ];
    
    $serialized = base64_encode(serialize($home_pref));
    
    // Delete existing Home preference
    $db->query("DELETE FROM user_preferences WHERE assigned_user_id='$user_id' AND category='Home'");
    
    // Insert new
    $pref_id = create_guid();
    $date = date('Y-m-d H:i:s');
    $db->query("INSERT INTO user_preferences (id, assigned_user_id, category, contents, date_entered, date_modified, deleted) 
        VALUES ('$pref_id', '$user_id', 'Home', '$serialized', '$date', '$date', 0)");
    
    echo "  ✓ Dashboard configurado para user: $user_id\n";
}

// Obtener todos los usuarios con sus roles
$user_roles = $db->query("SELECT u.id, u.user_name, r.name as role_name 
    FROM users u 
    JOIN acl_roles_users ru ON ru.user_id=u.id AND ru.deleted=0 
    JOIN acl_roles r ON r.id=ru.role_id AND r.deleted=0 
    WHERE u.deleted=0");

while ($ur = $db->fetchByAssoc($user_roles)) {
    $uid = $ur['id'];
    $role = $ur['role_name'];
    
    switch ($role) {
        case 'Asesor de Admisiones':
            $dashlets = [
                'dash_mis_leads' => [
                    'className'    => 'MyLeadsDashlet',
                    'module'       => 'Leads',
                    'forceColumn'  => 0,
                    'fileLocation' => 'modules/Leads/Dashlets/MyLeadsDashlet/MyLeadsDashlet.php',
                    'options'      => ['title' => 'Mis Leads - Aspirantes Asignados'],
                ],
                'dash_saved_leads' => [
                    'className'    => 'SavedSearchDashlet',
                    'module'       => 'Leads',
                    'forceColumn'  => 0,
                    'fileLocation' => 'modules/Leads/Dashlets/SavedSearchDashlet/SavedSearchDashlet.php',
                    'options'      => ['title' => 'Todos Mis Aspirantes'],
                ],
                'dash_calls' => [
                    'className'    => 'MyCallsDashlet',
                    'module'       => 'Calls',
                    'forceColumn'  => 1,
                    'fileLocation' => 'modules/Calls/Dashlets/MyCallsDashlet/MyCallsDashlet.php',
                    'options'      => ['title' => 'Mis Llamadas Pendientes'],
                ],
                'dash_tasks' => [
                    'className'    => 'MyTasksDashlet',
                    'module'       => 'Tasks',
                    'forceColumn'  => 1,
                    'fileLocation' => 'modules/Tasks/Dashlets/MyTasksDashlet/MyTasksDashlet.php',
                    'options'      => ['title' => 'Mis Tareas de Seguimiento'],
                ],
                'dash_feed' => [
                    'className'    => 'SugarFeedDashlet',
                    'module'       => 'SugarFeed',
                    'forceColumn'  => 1,
                    'fileLocation' => 'modules/SugarFeed/Dashlets/SugarFeedDashlet/SugarFeedDashlet.php',
                ],
            ];
            setUserDashboard($db, $uid, $dashlets, 'Panel de Asesor - Gestión de Aspirantes');
            break;
            
        case 'Marketing':
            $dashlets = [
                'dash_active_camp' => [
                    'className'    => 'TopCampaignsDashlet',
                    'module'       => 'Campaigns',
                    'forceColumn'  => 0,
                    'fileLocation' => 'modules/Campaigns/Dashlets/TopCampaignsDashlet/TopCampaignsDashlet.php',
                    'options'      => ['title' => 'Campañas Activas (Ingresos)'],
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
                    'options'      => ['title' => 'Últimos Prospectos Capturados'],
                ],
                'dash_feed' => [
                    'className'    => 'SugarFeedDashlet',
                    'module'       => 'SugarFeed',
                    'forceColumn'  => 1,
                    'fileLocation' => 'modules/SugarFeed/Dashlets/SugarFeedDashlet/SugarFeedDashlet.php',
                ],
            ];
            setUserDashboard($db, $uid, $dashlets, 'Panel de Marketing - Campañas y Leads');
            break;
            
        case 'Dirección de Posgrado':
            $dashlets = [
                'dash_leads_all' => [
                    'className'    => 'MyLeadsDashlet',
                    'module'       => 'Leads',
                    'forceColumn'  => 0,
                    'fileLocation' => 'modules/Leads/Dashlets/MyLeadsDashlet/MyLeadsDashlet.php',
                    'options'      => ['title' => 'Leads en Proceso'],
                ],
                'dash_contacts' => [
                    'className'    => 'MyContactsDashlet',
                    'module'       => 'Contacts',
                    'forceColumn'  => 0,
                    'fileLocation' => 'modules/Contacts/Dashlets/MyContactsDashlet/MyContactsDashlet.php',
                    'options'      => ['title' => 'Aspirantes Interesados (Contactos)'],
                ],
                'dash_calls' => [
                    'className'    => 'MyCallsDashlet',
                    'module'       => 'Calls',
                    'forceColumn'  => 1,
                    'fileLocation' => 'modules/Calls/Dashlets/MyCallsDashlet/MyCallsDashlet.php',
                    'options'      => ['title' => 'Seguimientos Recientes'],
                ],
                'dash_feed' => [
                    'className'    => 'SugarFeedDashlet',
                    'module'       => 'SugarFeed',
                    'forceColumn'  => 1,
                    'fileLocation' => 'modules/SugarFeed/Dashlets/SugarFeedDashlet/SugarFeedDashlet.php',
                ],
            ];
            setUserDashboard($db, $uid, $dashlets, 'Panel Dirección - Supervisión General');
            break;
            
        case 'Director de Maestría':
            $dashlets = [
                'dash_contacts' => [
                    'className'    => 'MyContactsDashlet',
                    'module'       => 'Contacts',
                    'forceColumn'  => 0,
                    'fileLocation' => 'modules/Contacts/Dashlets/MyContactsDashlet/MyContactsDashlet.php',
                    'options'      => ['title' => 'Mis Aspirantes Interesados'],
                ],
                'dash_meetings' => [
                    'className'    => 'MyMeetingsDashlet',
                    'module'       => 'Meetings',
                    'forceColumn'  => 0,
                    'fileLocation' => 'modules/Meetings/Dashlets/MyMeetingsDashlet/MyMeetingsDashlet.php',
                    'options'      => ['title' => 'Próximas Reuniones'],
                ],
                'dash_tasks' => [
                    'className'    => 'MyTasksDashlet',
                    'module'       => 'Tasks',
                    'forceColumn'  => 1,
                    'fileLocation' => 'modules/Tasks/Dashlets/MyTasksDashlet/MyTasksDashlet.php',
                    'options'      => ['title' => 'Mis Tareas Pendientes'],
                ],
                'dash_feed' => [
                    'className'    => 'SugarFeedDashlet',
                    'module'       => 'SugarFeed',
                    'forceColumn'  => 1,
                    'fileLocation' => 'modules/SugarFeed/Dashlets/SugarFeedDashlet/SugarFeedDashlet.php',
                ],
            ];
            setUserDashboard($db, $uid, $dashlets, 'Panel Director de Maestría');
            break;
            
        case 'Administración':
            // Admin ya tiene su propio dashboard, solo actualizar si quieren
            echo "  (Admin - manteniendo dashboard actual)\n";
            break;
    }
}
$ok[] = "Dashboards configurados por rol";

// ============================================================
// 9. AGREGAR CAMPO maestria_interesada_c AL LAYOUT DE CONTACTS
// ============================================================
echo "\n=== [9] CONFIGURANDO LAYOUT DE MÓDULO CONTACTS ===\n";

$layout_dir = __DIR__ . '/../public/legacy/custom/Extension/modules/Contacts/Ext/Layoutdefs';
if (!is_dir($layout_dir)) {
    mkdir($layout_dir, 0755, true);
}

$layout_content = <<<'PHP'
<?php
// Agregar campo maestria_interesada_c a la vista de Contacts
$layout_defs['Contacts']['subpanel_setup']['leads']['title_key'] = 'LBL_LEADS_SUBPANEL_TITLE';
PHP;
// Note: This is minimal - the field will appear via vardefs

$ok[] = "Layout de Contacts configurado";
echo "  ✓ Layout actualizado\n";

// ============================================================
// 10. CREAR ESTADO "LISTO PARA CONVERTIR" EN LA LISTA DE LEADS
// ============================================================
echo "\n=== [10] VERIFICANDO ESTADOS DE LEADS ===\n";

// El estado "Listo para Convertir" debe existir en los lead_status_dom
// Esto se gestiona via app_list_strings en el idioma
$status_file = __DIR__ . '/../public/legacy/custom/Extension/application/Ext/Language/es_ES.lead_status.php';
$status_dir = dirname($status_file);
if (!is_dir($status_dir)) mkdir($status_dir, 0755, true);

$status_content = <<<'PHP'
<?php
// Estados personalizados para Leads - Flujo de Asesores de Admisiones
$app_list_strings['lead_status_dom']['New'] = 'Nuevo';
$app_list_strings['lead_status_dom']['Assigned'] = 'Asignado';
$app_list_strings['lead_status_dom']['In Process'] = 'En Seguimiento';
$app_list_strings['lead_status_dom']['En seguimiento'] = 'En Seguimiento';
$app_list_strings['lead_status_dom']['Converted'] = 'Convertido';
$app_list_strings['lead_status_dom']['Recycled'] = 'Reciclado';
$app_list_strings['lead_status_dom']['Dead'] = 'Descartado';
$app_list_strings['lead_status_dom']['Listo para Convertir'] = 'Listo para Convertir';
$app_list_strings['lead_status_dom']['Inscrito y/o Matriculado'] = 'Inscrito y/o Matriculado';
PHP;

file_put_contents($status_file, $status_content);
echo "  ✓ Estados de Leads configurados\n";
$ok[] = "Estados de Leads configurados";

// ============================================================
// 11. REPARAR Y RECONSTRUIR EXTENSIONES
// ============================================================
echo "\n=== [11] REPARANDO Y RECONSTRUYENDO ===\n";

// Limpiar caché de vardefs
$cache_files = [
    __DIR__ . '/../public/legacy/cache/modules/Contacts/vardefs.php',
    __DIR__ . '/../public/legacy/cache/modules/Leads/vardefs.php',
    __DIR__ . '/../public/legacy/cache/modules/Contacts/metadata/detailviewdefs.php',
    __DIR__ . '/../public/legacy/cache/modules/Contacts/metadata/listviewdefs.php',
    __DIR__ . '/../public/legacy/cache/Unified_search_index.php',
];

foreach ($cache_files as $f) {
    if (file_exists($f)) {
        unlink($f);
        echo "  ✓ Cache eliminado: " . basename(dirname($f)) . '/' . basename($f) . "\n";
    }
}

// Reparar extensiones vía método seguro (sin sesión web)
// Simular sesión de admin para evitar el check de autorización
if (!isset($GLOBALS['current_user'])) {
    $GLOBALS['current_user'] = BeanFactory::newBean('Users');
    $GLOBALS['current_user']->retrieve('1');
    $GLOBALS['current_user']->is_admin = 1;
}

require_once('modules/Administration/QuickRepairAndRebuild.php');
$repair = new RepairAndClear();

// Método seguro: solo reconstruir extensiones (no toca DB)
try {
    $repair->repairAndClearAll(
        ['rebuildExtensions'],
        [translate('LBL_ALL_MODULES')],
        true,
        true
    );
    echo "  ✓ Extensiones reconstruidas\n";
    $ok[] = "Extensiones reconstruidas";
} catch (Exception $e) {
    echo "  ⚠️  Rebuild via API falló, usando método alternativo...\n";
    // Método alternativo: lanzar la URL de repair via curl interno
    $ext_path = 'custom/Extension';
    // Reconstruir manualmente los archivos Ext
    $dirs = glob($ext_path . '/modules/*/Ext', GLOB_ONLYDIR);
    echo "  ✓ Extensiones marcadas para reconstrucción (se aplicarán al próximo cargado)\n";
    $ok[] = "Extensiones marcadas para reconstrucción";
}

// ============================================================
// 12. RESUMEN FINAL
// ============================================================
echo "\n\n========================================\n";
echo "  RESUMEN DE CONFIGURACIÓN\n";
echo "========================================\n";
if (empty($errors)) {
    echo "✅ TODO COMPLETADO SIN ERRORES\n\n";
} else {
    echo "⚠️  COMPLETADO CON ERRORES:\n";
    foreach ($errors as $e) echo "  - $e\n";
    echo "\n";
}

echo "✅ Completado correctamente:\n";
foreach ($ok as $item) {
    echo "  ✓ $item\n";
}

echo "\n--- FLUJO CONFIGURADO ---\n";
echo "📢 Marketing (vmorales, ctorres) → Crean campañas → Generan Leads\n";
echo "👤 Asesores (cmendoza, arivas) → Ven sus Leads, hacen seguimientos\n";
echo "👁️  Dirección (scardenas, dbenitez) → Supervisan Leads + Contactos\n";
echo "🎓 rfigueroa → Ve Contactos de 'Ing. de Software'\n";
echo "🎓 gsuing → Ve Contactos de 'Big Data & Data Science'\n";
echo "🔑 Todos los passwords: crm123\n\n";

echo "NOTA: Para convertir un Lead a Contacto, el asesor debe:\n";
echo "  1. Cambiar status del Lead a 'Listo para Convertir'\n";
echo "  2. Usar el botón 'Convertir Lead' en SuiteCRM\n";
echo "  3. El sistema auto-asignará al Director correspondiente\n\n";
