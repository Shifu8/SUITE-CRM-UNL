<?php
/**
 *
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.
 *
 * SuiteCRM is an extension to SugarCRM Community Edition developed by SalesAgility Ltd.
 * Copyright (C) 2011 - 2019 SalesAgility Ltd.
 *
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU Affero General Public License for more
 * details.
 *
 * You should have received a copy of the GNU Affero General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 *
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 *
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 *
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo and "Supercharged by SuiteCRM" logo. If the display of the logos is not
 * reasonably feasible for technical reasons, the Appropriate Legal Notices must
 * display the words "Powered by SugarCRM" and "Supercharged by SuiteCRM".
 */

if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}

$mod_strings = array(
    'LBL_EDIT_LAYOUT' => 'Edit Layout',
    'LBL_EDIT_FIELDS' => 'Editar Campos Personalizados',
    'LBL_SELECT_FILE' => 'Select File',
    'LBL_MODULE_TITLE' => 'Studio',
    'LBL_TOOLBOX' => 'Toolbox',
    'LBL_SUITE_FIELDS_STAGE' => 'Campos SuiteCRM (haga clic en los elementos para agregarlos al área de diseño)',
    'LBL_VIEW_SUITE_FIELDS' => 'Ver Campos SuiteCRM',
    'LBL_FAILED_TO_SAVE' => 'Failed To Save',
    'LBL_CONFIRM_UNSAVE' => 'Los cambios no se han guardado y se perderán. ¿Está seguro de que desea continuar?',
    'LBL_PUBLISHING' => 'Publicando...',
    'LBL_PUBLISHED' => 'Publicado',
    'LBL_FAILED_PUBLISHED' => 'Failed to Publish',
    'LBL_DROP_HERE' => '[Drop Here]',

//CUSTOM FIELDS
    'LBL_NAME' => 'Nombre',
    'LBL_LABEL' => 'Label',
    'LBL_MASS_UPDATE' => 'Mass Update',
    'LBL_DEFAULT_VALUE' => 'Default Value',
    'LBL_REQUIRED' => 'Required',
    'LBL_DATA_TYPE' => 'Type',


    'LBL_HISTORY' => 'Historial',

//WIZARDS

//STUDIO WIZARD
    'LBL_SW_WELCOME' => '<h2>¡Bienvenido al Estudio!</h2><br> ¿Qué desea hacer hoy?<br><b> Por favor, seleccione una de las siguientes opciones.</b>',
    'LBL_SW_EDIT_MODULE' => 'Editar un Módulo',
    'LBL_SW_EDIT_DROPDOWNS' => 'Editar Listas Desplegables',
    'LBL_SW_EDIT_TABS' => 'Configurar Pestañas',
    'LBL_SW_RENAME_TABS' => 'Renombrar Pestañas',
    'LBL_SW_EDIT_GROUPTABS' => 'Configurar Grupos de Pestañas',
    'LBL_SW_EDIT_PORTAL' => 'Editar Portal',
    'LBL_SW_REPAIR_CUSTOMFIELDS' => 'Reparar Campos Personalizados',
    'LBL_SW_MIGRATE_CUSTOMFIELDS' => 'Migrate Custom Fields',

// JS LABELS
    'LBL_REBUILD_JAVASCRIPT_LANG_DESC_SHORT' => 'Rebuilds javascript versions of language files',
    'LBL_REBUILD_JAVASCRIPT_LANG_DESC' => 'Removing javascript versions of language files, will rebuild when needed.',


//Manager Backups History
    'LBL_MB_DELETE' => 'Delete',

//EDIT DROP DOWNS
    'LBL_ED_CREATE_DROPDOWN' => 'Crea una Lista Desplegable',
    'LBL_DROPDOWN_NAME' => 'Nombre de Lista Desplegable:',
    'LBL_DROPDOWN_LANGUAGE' => 'Idioma de Lista Desplegable:',
    'LBL_TABGROUP_LANGUAGE' => 'Idioma:',

//END WIZARDS

//DROP DOWN EDITOR
    'LBL_DD_DISPALYVALUE' => 'Valor de Visualización',
    'LBL_DD_DATABASEVALUE' => 'Valor de Base de datos',
    'LBL_DD_ALL' => 'All',

//BUTTONS
    'LBL_BTN_SAVE' => 'Save',
    'LBL_BTN_CANCEL' => 'Cancel',
    'LBL_BTN_SAVEPUBLISH' => 'Save & Deploy',
    'LBL_BTN_HISTORY' => 'Historial',
    'LBL_BTN_ADDROWS' => 'Add Rows',
    'LBL_BTN_UNDO' => 'Undo',
    'LBL_BTN_REDO' => 'Redo',
    'LBL_BTN_ADDCUSTOMFIELD' => 'Add Custom Field',
    'LBL_BTN_TABINDEX' => 'Editar Orden de Pestañas',

//TABS
    'LBL_MODULES' => 'Modules',
    'LBL_MODULE_NAME' => 'Administration',
    'LBL_CONFIGURE_GROUP_TABS' => 'Configurar filtros de menú de módulos',
    'LBL_GROUP_TAB_WELCOME' => 'Los siguientes grupos se mostrarán en la barra de navegación a los usuarios que elijan ver Módulos Agrupados. Arrastre y suele módulos a y desde los Grupos para configurar qué módulos aparecen bajo los grupos. Nota: Los grupos vacíos no serán mostrados en la barra de navegación.',
    'LBL_RENAME_TAB_WELCOME' => 'Haga clic en el Valor de Visualización de cualquier pestaña de la siguiente tabla para renombrar la pestaña.',
    'LBL_DELETE_MODULE' => 'Quitar&nbsp;módulo<br />del&nbsp;filtro',
    'LBL_TAB_GROUP_LANGUAGE_HELP' => 'Seleccione uno de los idiomas disponibles, edite las etiquetas del Grupo y haga clic en Guardar y Desplegar para aplicar las etiquetas en el idioma deseado.',
    'LBL_ADD_GROUP' => 'Agregar filtro',
    'LBL_NEW_GROUP' => 'Nuevo Grupo',
    'LBL_RENAME_TABS' => 'Rename Modules',

//ERRORS
    'ERROR_INVALID_KEY_VALUE' => "Error: Invalid Key Value: [']",

//SUGAR PORTAL
    'LBL_SAVE' => 'Save' /*for 508 compliance fix*/,
    'LBL_UNDO' => 'Undo' /*for 508 compliance fix*/,
    'LBL_REDO' => 'Redo' /*for 508 compliance fix*/,
    'LBL_INLINE' => 'En línea' /*for 508 compliance fix*/,
    'LBL_DELETE' => 'Delete' /*for 508 compliance fix*/,
    'LBL_ADD_FIELD' => 'Add Field' /*for 508 compliance fix*/,
    'LBL_MAXIMIZE' => 'Maximizar' /*for 508 compliance fix*/,
    'LBL_MINIMIZE' => 'Minimizar' /*for 508 compliance fix*/,
    'LBL_PUBLISH' => 'Publish' /*for 508 compliance fix*/,
    'LBL_ADDROWS' => 'Add Rows' /*for 508 compliance fix*/,
    'LBL_ADDFIELD' => 'Add Field' /*for 508 compliance fix*/,
    'LBL_EDIT' => 'Editar' /*for 508 compliance fix*/,

    'LBL_LANGUAGE_TOOLTIP' => 'Seleccione el idioma que desea editar.',
    'LBL_SINGULAR' => 'Etiqueta en Singular',
    'LBL_PLURAL' => 'Etiqueta en Plural',
    'LBL_RENAME_MOD_SAVE_HELP' => 'Pulse en Guardar para aplicar los cambios.'

);
