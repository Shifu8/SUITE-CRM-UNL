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
    'LBL_MODULE_NAME' => 'Tasks',
    'LBL_MODULE_TITLE' => 'Tareas: Inicio',
    'LBL_SEARCH_FORM_TITLE' => 'Búsqueda de Tareas',
    'LBL_LIST_FORM_TITLE' => 'Lista de Tareas',
    'LBL_NEW_FORM_TITLE' => 'Nueva Tarea',
    'LBL_LIST_CLOSE' => 'Close',
    'LBL_LIST_SUBJECT' => 'Subject',
    'LBL_LIST_CONTACT' => 'Contact',
    'LBL_LIST_PRIORITY' => 'Priority',
    'LBL_LIST_RELATED_TO' => 'Related to',
    'LBL_LIST_DUE_DATE' => 'Due Date',
    'LBL_LIST_DUE_TIME' => 'Hora Vencimiento',
    'LBL_SUBJECT' => 'Subject:',
    'LBL_STATUS' => 'Status:',
    'LBL_DUE_DATE' => 'Due Date:',
    'LBL_DUE_TIME' => 'Due Time:',
    'LBL_PRIORITY' => 'Priority:',
    'LBL_DUE_DATE_AND_TIME' => 'Fecha y hora de vencimiento:',
    'LBL_START_DATE_AND_TIME' => 'Fecha y hora de inicio:',
    'LBL_START_DATE' => 'Start Date:',
    'LBL_LIST_START_DATE' => 'Fecha de Inicio',
    'LBL_START_TIME' => 'Start Time:',
    'DATE_FORMAT' => '(yyyy-mm-dd)',
    'LBL_DAYS_UNTIL_DUE_TASK' => 'Esta Tarea debe Realizarse en',
    'LBL_DAYS_OVERDUE' => 'Días de Atraso de la Tarea ',
    'LBL_TASK_COMPLETED' => 'Esta Tarea ha sido Completada',
    'LBL_NONE' => 'None',
    'LBL_CONTACT' => 'Contact:',
    'LBL_EMAIL_ADDRESS' => 'Email Address:',
    'LBL_PHONE' => 'Phone:',
    'LBL_EMAIL' => 'Email Address:',
    'LBL_DESCRIPTION' => 'Descripción:',
    'LBL_NAME' => 'Nombre:',
    'LBL_CONTACT_NAME' => 'Contacto',
    'LBL_LIST_STATUS' => 'Estado',
    'LBL_DATE_DUE_FLAG' => 'Sin fecha de vencimiento',
    'LBL_DATE_START_FLAG' => 'Sin fecha de inicio',
    'LBL_LIST_MY_TASKS' => 'Mis Tareas Abiertas',
    'LNK_NEW_TASK' => 'Create Task',
    'LNK_TASK_LIST' => 'View Tasks',
    'LNK_IMPORT_TASKS' => 'Import Tasks',
    'LBL_LIST_ASSIGNED_TO_NAME' => 'Assigned User',
    'LBL_ASSIGNED_TO_NAME' => 'Asignado a:',
    'LBL_LIST_DATE_MODIFIED' => 'Última Modificación',
    'LBL_CONTACT_ID' => 'Contact ID:',
    'LBL_PARENT_ID' => 'Parent ID:',
    'LBL_CONTACT_PHONE' => 'Teléfono de Contacto:',
    'LBL_PARENT_TYPE' => 'Tipo de Padre:',
    'LBL_TASK_INFORMATION' => 'Visión General', //No need to be translated in all caps. Translation used just in menu action items when using the SuiteP template
    'LBL_EDITLAYOUT' => 'Edit Layout' /*for 508 compliance fix*/,
    'LBL_HISTORY_SUBPANEL_TITLE' => 'Notes',
    //For export labels
    'LBL_DATE_DUE' => 'Date Due',
    'LBL_RELATED_TO' => 'Related to:',
);
