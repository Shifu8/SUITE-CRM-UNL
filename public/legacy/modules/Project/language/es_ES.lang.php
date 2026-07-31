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
    'LBL_MODULE_NAME' => 'Project',
    'LBL_MODULE_TITLE' => 'Proyectos: Inicio',
    'LBL_SEARCH_FORM_TITLE' => 'Búsqueda de Proyectos',
    'LBL_LIST_FORM_TITLE' => 'Lista de Proyectos',
    'LBL_HISTORY_TITLE' => 'Historial',
    'LBL_ID' => 'Identificación:',
    'LBL_DATE_ENTERED' => 'Fecha de Creación:',
    'LBL_DATE_MODIFIED' => 'Fecha de Modificación:',
    'LBL_ASSIGNED_USER_ID' => 'Assigned To:',
    'LBL_ASSIGNED_USER_NAME' => 'Project Manager:',
    'LBL_MODIFIED_USER_ID' => 'Id de usuario modificado:',
    'LBL_CREATED_BY' => 'Creado por:',
    'LBL_NAME' => 'Nombre:',
    'LBL_DESCRIPTION' => 'Descripción:',
    'LBL_DELETED' => 'Eliminado:',
    'LBL_DATE' => 'Date:',
    'LBL_DATE_START' => 'Start Date:',
    'LBL_DATE_END' => 'End Date:',
    'LBL_PRIORITY' => 'Priority:',
    'LBL_LIST_NAME' => 'Nombre',
    'LBL_LIST_TOTAL_ESTIMATED_EFFORT' => 'Trabajo Total Estimado (h)',
    'LBL_LIST_TOTAL_ACTUAL_EFFORT' => 'Trabajo Total Real (h)',
    'LBL_LIST_END_DATE' => 'End Date',
    'LBL_PROJECT_SUBPANEL_TITLE' => 'Projects',
    'LBL_PROJECT_TASK_SUBPANEL_TITLE' => 'Project Tasks',
    'LBL_OPPORTUNITY_SUBPANEL_TITLE' => 'Opportunities',
    'LBL_PROJECT_PREDECESSOR_NONE' => 'None',
    'LBL_ALL_PROJECTS' => 'Todos los proyectos',
    'LBL_ALL_USERS' => 'Todos los usuarios',
    'LBL_ALL_CONTACTS' => 'Todos los contactos',

    // quick create label
    'LBL_NEW_FORM_TITLE' => 'Nuevo Proyecto',
    'LNK_NEW_PROJECT' => 'Create Project',
    'LNK_PROJECT_LIST' => 'Ver Lista de Proyectos',
    'LNK_NEW_PROJECT_TASK' => 'Crear Tarea de Proyecto',
    'LNK_PROJECT_TASK_LIST' => 'Ver Tareas de Proyecto',
    'LBL_DEFAULT_SUBPANEL_TITLE' => 'Projects',
    'LBL_ACTIVITIES_SUBPANEL_TITLE' => 'Activities',
    'LBL_HISTORY_SUBPANEL_TITLE' => 'Historial',
    'LBL_CONTACTS_SUBPANEL_TITLE' => 'Contactos',
    'LBL_ACCOUNTS_SUBPANEL_TITLE' => 'Cuentas',
    'LBL_OPPORTUNITIES_SUBPANEL_TITLE' => 'Opportunities',
    'LBL_CASES_SUBPANEL_TITLE' => 'Casos',
    'LBL_BUGS_SUBPANEL_TITLE' => 'Bugs',
    'LBL_TASK_ID' => 'ID',
    'LBL_TASK_NAME' => 'Task Name',
    'LBL_DURATION' => 'Duración',
    'LBL_ACTUAL_DURATION' => 'Actual Duration',
    'LBL_START' => 'Start',
    'LBL_FINISH' => 'Finish',
    'LBL_PREDECESSORS' => 'Predecessors',
    'LBL_PERCENT_COMPLETE' => '% Complete',
    'LBL_MORE' => 'Más...',
    'LBL_OPPORTUNITIES' => 'Opportunities',
    'LBL_NEXT_WEEK' => 'Next',
    'LBL_PROJECT_INFORMATION' => 'Visión general del proyecto',
    'LBL_EDITLAYOUT' => 'Edit Layout' /*for 508 compliance fix*/,
    'LBL_PROJECT_TASKS_SUBPANEL_TITLE' => 'Project Tasks',
    'LBL_VIEW_GANTT_TITLE' => 'View Gantt',
    'LBL_VIEW_GANTT_DURATION' => 'Duración',
    'LBL_TASK_TITLE' => 'Edit Task',
    'LBL_DURATION_TITLE' => 'Edit Duration',
    'LBL_LAG' => 'Lag',
    'LBL_DAYS' => 'Days',
    'LBL_HOURS' => 'Hours',
    'LBL_MONTHS' => 'Months',
    'LBL_SUBTASK' => 'Task',
    'LBL_MILESTONE_FLAG' => 'Milestone',
    'LBL_ADD_NEW_TASK' => 'Add New Task',
    'LBL_DELETE_TASK' => 'Delete Task',
    'LBL_EDIT_TASK_PROPERTIES' => 'Edit task properties.',
    'LBL_PARENT_TASK_ID' => 'Id Tarea Padre:',
    'LBL_RESOURCE_CHART' => 'Calendario de recursos',
    'LBL_RELATIONSHIP_TYPE' => 'Relation Type',
    'LBL_ASSIGNED_TO' => 'Project Manager',
    'LBL_AM_PROJECTTEMPLATES_PROJECT_1_FROM_AM_PROJECTTEMPLATES_TITLE' => 'Plantilla de proyecto',
    'LBL_STATUS' => 'Status:',
    'LBL_LIST_ASSIGNED_USER_ID' => 'Project Manager',
    'LBL_TOOLTIP_PROJECT_NAME' => 'Project',
    'LBL_TOOLTIP_TASK_NAME' => 'Task Name',
    'LBL_TOOLTIP_TITLE' => 'Tareas en este día',
    'LBL_TOOLTIP_TASK_DURATION' => 'Duración',
    'LBL_RESOURCE_TYPE_TITLE_USER' => 'Recurso es un usuario',
    'LBL_RESOURCE_TYPE_TITLE_CONTACT' => 'Recurso es un contacto',
    'LBL_RESOURCE_CHART_PREVIOUS_MONTH' => 'Previous Month',
    'LBL_RESOURCE_CHART_NEXT_MONTH' => 'Next Month',
    'LBL_RESOURCE_CHART_WEEK' => 'Semana',
    'LBL_RESOURCE_CHART_DAY' => 'Día',
    'LBL_RESOURCE_CHART_WARNING' => 'Recursos no han sido asignados a un proyecto.',
    'LBL_PROJECT_DELETE_MSG' => '¿Está seguro que desea eliminar este proyecto y sus tareas relacionadas?',
    'LBL_LIST_MY_PROJECT' => 'Mis Proyectos',
    'LBL_LIST_ASSIGNED_USER' => 'Project Manager',
    'LBL_UNASSIGNED' => 'Unassigned',
    'LBL_PROJECT_USERS_1_FROM_USERS_TITLE' => 'Resources',

    'LBL_EMAIL' => 'Email',
    'LBL_PHONE' => 'Phone Office:',
    'LBL_ADD_BUTTON' => 'Añadir',
    'LBL_ADD_INVITEE' => 'Add Resource',
    'LBL_FIRST_NAME' => 'Nombre',
    'LBL_LAST_NAME' => 'Last Name',
    'LBL_SEARCH_BUTTON' => 'Búsqueda',
    'LBL_EMPTY_SEARCH_RESULT' => 'Sorry, no results were found. Please create an invitee below.',
    'LBL_CREATE_INVITEE' => 'Create a Resource',
    'LBL_CREATE_CONTACT' => 'As Contact',
    'LBL_CREATE_AND_ADD' => 'Create & Add',
    'LBL_CANCEL_CREATE_INVITEE' => 'Cancel',
    'LBL_NO_ACCESS' => 'You have no access to create $module',
    'LBL_SCHEDULING_FORM_TITLE' => 'Resource List',
    'LBL_REMOVE' => 'Quitar',
    'LBL_VIEW_DETAIL' => 'View Details',
    'LBL_OVERRIDE_BUSINESS_HOURS' => 'Consider Working days',

    'LBL_IMPORT_PROJECTS' => 'Importar Proyectos',

    'LBL_PROJECTS_SEARCH' => 'Buscar proyectos',
    'LBL_USERS_SEARCH' => 'Buscar usuarios',
    'LBL_CONTACTS_SEARCH' => 'Seleccionar contactos',
    'LBL_RESOURCE_CHART_SEARCH_BUTTON' => 'Búsqueda',

    'LBL_CHART_TYPE' => 'Type',
    'LBL_CHART_WEEKLY' => 'Weekly',
    'LBL_CHART_MONTHLY' => 'Monthly',
    'LBL_CHART_QUARTERLY' => 'Quarterly',

    'LBL_RESOURCE_CHART_MONTH' => 'Month',
    'LBL_RESOURCE_CHART_QUARTER' => 'Trimestre',

    'LBL_PROJECT_CONTACTS_1_FROM_CONTACTS_TITLE' => 'Contactos del proyecto a partir del nombre de contactos',
    'LBL_AM_PROJECTTEMPLATES_PROJECT_1_FROM_PROJECT_TITLE' => 'Plantilla de proyecto: Proyecto a partir del nombre del proyecto',
    'LBL_AOS_QUOTES_PROJECT' => 'Cotizaciones: Proyecto',
    'LBL_TASKS_NOT_FOUND' => 'There are no Tasks to build the Gantt Table',


    'LBL_ASCENDING' => 'Ascendente',
    'LBL_DESCENDING' => 'Descendente',
);
