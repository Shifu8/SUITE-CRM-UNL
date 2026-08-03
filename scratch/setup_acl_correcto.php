<?php
/**
 * SCRIPT CORRECTO - Configurar permisos ACL usando la API correcta de SuiteCRM
 * 
 * La estructura real es:
 *   - acl_actions: acciones globales del sistema (sin role_id)
 *   - acl_roles_actions: role_id + action_id + access_override
 * 
 * Para configurar permisos correctamente debemos usar ACLRole::setAction()
 * o manipular acl_roles_actions directamente
 */

if (!defined('sugarEntry')) { define('sugarEntry', true); }
chdir(__DIR__ . '/../public/legacy');
require_once('include/entryPoint.php');
global $db;

// Simular admin session
$GLOBALS['current_user'] = BeanFactory::newBean('Users');
$GLOBALS['current_user']->retrieve('1');
$GLOBALS['current_user']->is_admin = 1;

$errors = [];

// ACL Access Values usados por SuiteCRM:
// 0   = No Change (heredar default)
// 89  = YES (full access)
// 90  = ALL (todos en el grupo)  
// 75  = OWNER (solo los propios)
// -99 = NO (denied)

/**
 * Configurar permiso para un rol en un módulo/acción específica
 * 
 * @param object $db
 * @param string $role_id  UUID del rol
 * @param string $module   Nombre del módulo (ej: 'Leads')
 * @param string $action   Nombre de la acción (ej: 'list', 'edit', 'delete', 'view', 'import', 'export', 'massupdate')
 * @param int    $access   Valor de acceso (89=YES, 75=OWNER, -99=NO, 0=DEFAULT)
 */
function setACLPermission($db, $role_id, $module, $action, $access) {
    // Primero buscar el action_id en acl_actions para este módulo/acción
    $module_q = $db->quote($module);
    $action_q = $db->quote($action);
    
    $r = $db->query("SELECT id FROM acl_actions WHERE category='$module_q' AND name='$action_q' AND deleted=0");
    $row = $db->fetchByAssoc($r);
    
    if (!$row) {
        echo "    ⚠️  Acción no encontrada en sistema: $module.$action\n";
        return false;
    }
    
    $action_id = $row['id'];
    $role_q = $db->quote($role_id);
    $action_id_q = $db->quote($action_id);
    
    // Verificar si ya existe en acl_roles_actions
    $r2 = $db->query("SELECT id FROM acl_roles_actions WHERE role_id='$role_q' AND action_id='$action_id_q' AND deleted=0");
    $existing = $db->fetchByAssoc($r2);
    
    if ($existing) {
        // Actualizar
        $db->query("UPDATE acl_roles_actions SET access_override='$access', date_modified=NOW() WHERE id='{$existing['id']}'");
    } else {
        // Insertar nuevo
        $new_id = create_guid();
        $date = date('Y-m-d H:i:s');
        $db->query("INSERT INTO acl_roles_actions (id, role_id, action_id, access_override, date_modified, deleted) 
            VALUES ('$new_id', '$role_q', '$action_id_q', '$access', '$date', 0)");
    }
    
    return true;
}

/**
 * Configurar múltiples acciones para un módulo en un rol
 * 
 * @param object $db
 * @param string $role_id
 * @param string $module
 * @param array  $actions_map ['action' => access_value]
 */
function configureModuleACL($db, $role_id, $module, $actions_map) {
    $set = 0;
    $skip = 0;
    foreach ($actions_map as $action => $access) {
        $result = setACLPermission($db, $role_id, $module, $action, $access);
        if ($result) $set++;
        else $skip++;
    }
    echo "    → $module: $set permisos configurados" . ($skip > 0 ? ", $skip no encontrados" : "") . "\n";
}

// ============================================================
// CONFIGURAR CADA ROL
// ============================================================

// IDs de roles
$roles = [
    'asesor'    => '898050eb-9310-4772-afbc-252208c1198d', // Asesor de Admisiones
    'marketing' => '9b26597c-b61c-45ef-968d-31bd393fa20f', // Marketing
    'direccion' => '23f2a45a-23a1-45ae-84fb-15ee124b30ea', // Dirección de Posgrado
    'director'  => 'db0adf27-2462-498d-8479-995f813dedea', // Director de Maestría
    'admin_rol' => '2e14280b-d720-45de-be13-9c79da6823e7', // Administración
];

// Primero limpiamos todos los overrides existentes para estos roles para comenzar limpio
foreach ($roles as $key => $role_id) {
    $role_q = $db->quote($role_id);
    $db->query("UPDATE acl_roles_actions SET deleted=1, date_modified=NOW() WHERE role_id='$role_q'");
}
echo "✓ Permisos anteriores limpiados\n\n";

// ============================================================
// 1. ASESOR DE ADMISIONES
//    - Leads: solo sus propios (OWNER=75)
//    - Contacts: DENEGADO (-99)
//    - Campaigns: DENEGADO (-99)
//    - Todo lo demás: acceso básico de trabajo (calls, tasks, meetings, notes)
// ============================================================
echo "=== [ROL] ASESOR DE ADMISIONES ===\n";
$rid = $roles['asesor'];

configureModuleACL($db, $rid, 'Leads', [
    'access'      => 89,  // puede entrar al módulo
    'list'        => 75,  // solo sus leads
    'view'        => 75,  // solo sus leads
    'edit'        => 75,  // solo sus leads
    'delete'      => -99, // no puede borrar
    'import'      => 89,  // puede importar
    'export'      => 75,  // exportar sus leads
    'massupdate'  => -99, // no massupdate
]);

configureModuleACL($db, $rid, 'Contacts', [
    'access'      => -99, // SIN ACCESO
    'list'        => -99,
    'view'        => -99,
    'edit'        => -99,
    'delete'      => -99,
    'import'      => -99,
    'export'      => -99,
    'massupdate'  => -99,
]);

configureModuleACL($db, $rid, 'Campaigns', [
    'access'      => -99,
    'list'        => -99,
    'view'        => -99,
    'edit'        => -99,
    'delete'      => -99,
]);

configureModuleACL($db, $rid, 'Accounts', [
    'access'      => -99,
    'list'        => -99,
    'view'        => -99,
    'edit'        => -99,
    'delete'      => -99,
]);

configureModuleACL($db, $rid, 'Opportunities', [
    'access'      => -99,
    'list'        => -99,
    'view'        => -99,
    'edit'        => -99,
    'delete'      => -99,
]);

configureModuleACL($db, $rid, 'ProspectLists', [
    'access'      => -99,
    'list'        => -99,
    'view'        => -99,
    'edit'        => -99,
    'delete'      => -99,
]);

configureModuleACL($db, $rid, 'Prospects', [
    'access'      => -99,
    'list'        => -99,
    'view'        => -99,
    'edit'        => -99,
    'delete'      => -99,
]);

// Actividad de seguimiento: Calls, Tasks, Meetings, Notes
foreach (['Calls', 'Tasks', 'Meetings', 'Notes'] as $actmod) {
    configureModuleACL($db, $rid, $actmod, [
        'access'  => 89,
        'list'    => 75,
        'view'    => 75,
        'edit'    => 75,
        'delete'  => 75,
    ]);
}

// ============================================================
// 2. MARKETING
//    - Campaigns: COMPLETO (89)
//    - Leads: Ver todos, NO editar (read-only)
//    - ProspectLists/Prospects: COMPLETO
//    - Contacts: DENEGADO
// ============================================================
echo "\n=== [ROL] MARKETING ===\n";
$rid = $roles['marketing'];

configureModuleACL($db, $rid, 'Campaigns', [
    'access'      => 89,
    'list'        => 89,
    'view'        => 89,
    'edit'        => 89,
    'delete'      => 89,
    'import'      => 89,
    'export'      => 89,
    'massupdate'  => 89,
]);

configureModuleACL($db, $rid, 'Leads', [
    'access'      => 89,  // puede ver el módulo
    'list'        => 89,  // ve todos los leads (para métricas)
    'view'        => 89,  // ve el detalle
    'edit'        => -99, // NO puede editar leads
    'delete'      => -99, // NO puede borrar
    'import'      => 89,  // puede importar leads desde campaña
    'export'      => 89,
    'massupdate'  => -99,
]);

configureModuleACL($db, $rid, 'Prospects', [
    'access'      => 89,
    'list'        => 89,
    'view'        => 89,
    'edit'        => 89,
    'delete'      => 89,
    'import'      => 89,
    'export'      => 89,
]);

configureModuleACL($db, $rid, 'ProspectLists', [
    'access'      => 89,
    'list'        => 89,
    'view'        => 89,
    'edit'        => 89,
    'delete'      => 89,
    'import'      => 89,
    'export'      => 89,
]);

configureModuleACL($db, $rid, 'Contacts', [
    'access'      => -99,
    'list'        => -99,
    'view'        => -99,
    'edit'        => -99,
    'delete'      => -99,
]);

configureModuleACL($db, $rid, 'Accounts', [
    'access'      => -99,
    'list'        => -99,
    'view'        => -99,
    'edit'        => -99,
    'delete'      => -99,
]);

configureModuleACL($db, $rid, 'AOR_Reports', [
    'access'      => 89,
    'list'        => 89,
    'view'        => 89,
    'edit'        => 89,
    'delete'      => -99,
]);

// ============================================================
// 3. DIRECCIÓN DE POSGRADO
//    - Leads: Ver todos (supervisión, no borrar)
//    - Contacts: Ver todos (supervisión, no borrar)
//    - Campaigns: Ver (no editar)
//    - Todo en modo lectura
// ============================================================
echo "\n=== [ROL] DIRECCIÓN DE POSGRADO ===\n";
$rid = $roles['direccion'];

configureModuleACL($db, $rid, 'Leads', [
    'access'      => 89,
    'list'        => 89,  // ver todos
    'view'        => 89,  // ver detalle
    'edit'        => 89,  // puede editar para supervisión
    'delete'      => -99, // no borrar
    'import'      => -99,
    'export'      => 89,
    'massupdate'  => -99,
]);

configureModuleACL($db, $rid, 'Contacts', [
    'access'      => 89,
    'list'        => 89,  // ver todos los contactos
    'view'        => 89,
    'edit'        => 89,  // puede editar
    'delete'      => -99,
    'import'      => -99,
    'export'      => 89,
    'massupdate'  => -99,
]);

configureModuleACL($db, $rid, 'Campaigns', [
    'access'      => 89,
    'list'        => 89,
    'view'        => 89,
    'edit'        => -99,
    'delete'      => -99,
    'export'      => 89,
]);

configureModuleACL($db, $rid, 'Accounts', [
    'access'      => 89,
    'list'        => 89,
    'view'        => 89,
    'edit'        => -99,
    'delete'      => -99,
]);

configureModuleACL($db, $rid, 'AOR_Reports', [
    'access'      => 89,
    'list'        => 89,
    'view'        => 89,
    'edit'        => -99,
    'delete'      => -99,
]);

foreach (['Calls', 'Tasks', 'Meetings', 'Notes'] as $actmod) {
    configureModuleACL($db, $rid, $actmod, [
        'access'  => 89,
        'list'    => 89,
        'view'    => 89,
        'edit'    => -99,
        'delete'  => -99,
    ]);
}

// ============================================================
// 4. DIRECTOR DE MAESTRÍA
//    - Contacts: Solo los suyos (OWNER=75) - aspirantes ya interesados
//    - Leads: DENEGADO (no deben ver el proceso previo)
//    - Campaigns: DENEGADO
// ============================================================
echo "\n=== [ROL] DIRECTOR DE MAESTRÍA ===\n";
$rid = $roles['director'];

configureModuleACL($db, $rid, 'Contacts', [
    'access'      => 89,  // acceso al módulo
    'list'        => 75,  // solo sus contactos
    'view'        => 75,  // solo sus contactos
    'edit'        => 75,  // puede editar sus contactos
    'delete'      => -99, // no borrar
    'import'      => -99,
    'export'      => 75,
    'massupdate'  => -99,
]);

configureModuleACL($db, $rid, 'Leads', [
    'access'      => -99, // SIN ACCESO A LEADS
    'list'        => -99,
    'view'        => -99,
    'edit'        => -99,
    'delete'      => -99,
]);

configureModuleACL($db, $rid, 'Campaigns', [
    'access'      => -99,
    'list'        => -99,
    'view'        => -99,
    'edit'        => -99,
    'delete'      => -99,
]);

configureModuleACL($db, $rid, 'Accounts', [
    'access'      => -99,
    'list'        => -99,
    'view'        => -99,
    'edit'        => -99,
    'delete'      => -99,
]);

configureModuleACL($db, $rid, 'Opportunities', [
    'access'      => -99,
    'list'        => -99,
    'view'        => -99,
    'edit'        => -99,
    'delete'      => -99,
]);

configureModuleACL($db, $rid, 'ProspectLists', [
    'access'      => -99,
    'list'        => -99,
    'view'        => -99,
    'edit'        => -99,
    'delete'      => -99,
]);

configureModuleACL($db, $rid, 'Prospects', [
    'access'      => -99,
    'list'        => -99,
    'view'        => -99,
    'edit'        => -99,
    'delete'      => -99,
]);

// Actividad
foreach (['Calls', 'Tasks', 'Meetings', 'Notes'] as $actmod) {
    configureModuleACL($db, $rid, $actmod, [
        'access'  => 89,
        'list'    => 75,
        'view'    => 75,
        'edit'    => 75,
        'delete'  => 75,
    ]);
}

configureModuleACL($db, $rid, 'AOR_Reports', [
    'access'  => 89,
    'list'    => 75,
    'view'    => 75,
    'edit'    => -99,
    'delete'  => -99,
]);

// ============================================================
// 5. ADMINISTRACIÓN
//    Acceso completo a todo - Los admins ya tienen is_admin=1
//    así que los ACL de rol no los afectan, pero configuramos de todas formas
// ============================================================
echo "\n=== [ROL] ADMINISTRACIÓN ===\n";
$rid = $roles['admin_rol'];

$all_mods = ['Leads','Contacts','Campaigns','Accounts','Opportunities','ProspectLists','Prospects',
             'AOR_Reports','Calls','Meetings','Tasks','Notes','Documents','Emails'];

foreach ($all_mods as $mod) {
    configureModuleACL($db, $rid, $mod, [
        'access'      => 89,
        'list'        => 89,
        'view'        => 89,
        'edit'        => 89,
        'delete'      => 89,
        'import'      => 89,
        'export'      => 89,
        'massupdate'  => 89,
    ]);
}

// ============================================================
// VERIFICACIÓN FINAL
// ============================================================
echo "\n========================================\n";
echo "VERIFICANDO PERMISOS CONFIGURADOS\n";
echo "========================================\n";

$role_names = [
    '898050eb-9310-4772-afbc-252208c1198d' => 'Asesor de Admisiones',
    '9b26597c-b61c-45ef-968d-31bd393fa20f' => 'Marketing',
    '23f2a45a-23a1-45ae-84fb-15ee124b30ea' => 'Dirección de Posgrado',
    'db0adf27-2462-498d-8479-995f813dedea' => 'Director de Maestría',
    '2e14280b-d720-45de-be13-9c79da6823e7' => 'Administración',
];

$expected_checks = [
    '898050eb-9310-4772-afbc-252208c1198d' => [
        ['Leads','list',75], ['Contacts','access',-99], ['Campaigns','access',-99]
    ],
    '9b26597c-b61c-45ef-968d-31bd393fa20f' => [
        ['Campaigns','access',89], ['Leads','list',89], ['Leads','edit',-99], ['Contacts','access',-99]
    ],
    '23f2a45a-23a1-45ae-84fb-15ee124b30ea' => [
        ['Leads','list',89], ['Contacts','list',89], ['Leads','delete',-99]
    ],
    'db0adf27-2462-498d-8479-995f813dedea' => [
        ['Contacts','list',75], ['Leads','access',-99], ['Campaigns','access',-99]
    ],
    '2e14280b-d720-45de-be13-9c79da6823e7' => [
        ['Leads','list',89], ['Contacts','list',89], ['Campaigns','list',89]
    ],
];

$access_labels = [89=>'SI(89)', 90=>'TODOS(90)', 75=>'OWNER(75)', -99=>'NO(-99)', 0=>'DEFAULT(0)'];

foreach ($expected_checks as $role_id => $checks) {
    $role_name = $role_names[$role_id];
    echo "\n  [$role_name]\n";
    
    foreach ($checks as $chk) {
        list($module, $action, $expected) = $chk;
        
        // Query join: acl_roles_actions → acl_actions
        $r = $db->query("SELECT ra.access_override 
            FROM acl_roles_actions ra 
            JOIN acl_actions a ON ra.action_id=a.id
            WHERE ra.role_id='$role_id' AND a.category='$module' AND a.name='$action' AND ra.deleted=0 AND a.deleted=0");
        $row = $db->fetchByAssoc($r);
        
        $actual = $row ? (int)$row['access_override'] : 'NO ENCONTRADO';
        $match = $actual === $expected;
        
        $exp_str = $access_labels[$expected] ?? $expected;
        $act_str = isset($access_labels[$actual]) ? $access_labels[$actual] : $actual;
        
        echo "    " . ($match ? "✅" : "❌") . " $module.$action: esperado=$exp_str actual=$act_str\n";
    }
}

// Contar total de overrides por rol
echo "\n=== TOTAL OVERRIDES CONFIGURADOS ===\n";
foreach ($roles as $key => $role_id) {
    $r = $db->query("SELECT COUNT(*) as cnt FROM acl_roles_actions WHERE role_id='$role_id' AND deleted=0");
    $row = $db->fetchByAssoc($r);
    echo "  " . $role_names[$role_id] . ": {$row['cnt']} overrides\n";
}

echo "\n✅ ACL configurados correctamente via acl_roles_actions\n";
echo "\nIMPORTANTE: Haz un Quick Repair & Rebuild en Admin → Reparación\n";
echo "para que los cambios surtan efecto inmediato.\n\n";
