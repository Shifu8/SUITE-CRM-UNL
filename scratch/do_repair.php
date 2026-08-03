<?php
/**
 * Repair & Rebuild via HTTP request - Dispara el repair sin sesión web
 */
if (!defined('sugarEntry')) { define('sugarEntry', true); }
chdir(__DIR__ . '/../public/legacy');
require_once('include/entryPoint.php');

// Set admin user
$GLOBALS['current_user'] = BeanFactory::newBean('Users');
$GLOBALS['current_user']->retrieve('1');
$GLOBALS['current_user']->is_admin = 1;

echo "Iniciando Quick Repair & Rebuild...\n";

// Limpiar cache principal
$cache_dirs = [
    'cache/modules',
    'cache/include/language',
    'cache/Vardefs',
];

foreach ($cache_dirs as $dir) {
    if (is_dir($dir)) {
        // Solo limpiar archivos .php del cache
        $files = glob($dir . '/*.php');
        if ($files) {
            foreach ($files as $f) {
                unlink($f);
            }
        }
        echo "  ✓ Cache limpiado: $dir\n";
    }
}

// Limpiar archivos Ext compilados para que se regeneren
$ext_compiled = [
    'custom/modules/Contacts/Ext/Vardefs/vardefs.ext.php',
    'custom/modules/Leads/Ext/Vardefs/vardefs.ext.php',
    'custom/modules/Contacts/Ext/Language/language.ext.php',
    'custom/modules/Contacts/Ext/LogicHooks/logichooks.ext.php',
    'custom/application/Ext/Language/language.ext.php',
];

foreach ($ext_compiled as $f) {
    if (file_exists($f)) {
        unlink($f);
        echo "  ✓ Ext limpiado: " . basename($f) . "\n";
    }
}

// Ejecutar sugar_cache_clear
if (function_exists('sugar_cache_clear')) {
    sugar_cache_clear('ACLObject');
    sugar_cache_clear('ACLRole');
    echo "  ✓ ACL cache limpiado\n";
}

// Limpiar metadata cache de SuiteCRM 8
$suitecrm8_cache = __DIR__ . '/../../../../../../cache';
if (is_dir($suitecrm8_cache)) {
    echo "  ✓ SuiteCRM8 cache dir encontrado\n";
}

// Trigger repair via URL interna
$ch = curl_init();
if ($ch) {
    curl_setopt($ch, CURLOPT_URL, 'http://localhost:8000/index.php?module=Administration&action=DiagnosticRun&repair=1');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    @curl_exec($ch);
    curl_close($ch);
    echo "  ✓ Repair trigger enviado\n";
}

// Rebuild extensions manually using SuiteCRM's built-in mechanism
require_once('include/utils/sugar_file_utils.php');

// Execute repair through direct function call
if (file_exists('modules/Administration/QuickRepairAndRebuild.php')) {
    require_once('modules/Administration/QuickRepairAndRebuild.php');
    
    $repair = new RepairAndClear();
    
    // Bypass auth check
    $GLOBALS['current_user']->is_admin = 1;
    $_SESSION['authenticated_user_id'] = '1';
    $_SESSION['is_valid_session'] = true;
    
    ob_start();
    try {
        // Only rebuild extensions (not database - safer)
        $repair->repairAndClearAll(
            ['rebuildExtensions'],
            ['Contacts', 'Leads'],
            false,
            true
        );
        $output = ob_get_clean();
        echo "  ✓ Extensions rebuilt: " . strlen($output) . " bytes de output\n";
    } catch (Exception $e) {
        ob_end_clean();
        echo "  ⚠️  Exception: " . $e->getMessage() . "\n";
    }
}

echo "\n✅ Repair completado.\n";
echo "Los cambios de ACL se aplicarán cuando los usuarios vuelvan a iniciar sesión.\n";
