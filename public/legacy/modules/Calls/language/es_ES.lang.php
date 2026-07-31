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
    'LBL_BLANK' => ' ',
    'LBL_MODULE_NAME' => 'Llamadas',
    'LBL_MODULE_TITLE' => 'Llamadas: Inicio',
    'LBL_SEARCH_FORM_TITLE' => 'Búsqueda de Llamadas',
    'LBL_LIST_FORM_TITLE' => 'Lista de Llamadas',
    'LBL_NEW_FORM_TITLE' => 'Crear Cita',
    'LBL_LIST_CLOSE' => 'Close',
    'LBL_LIST_SUBJECT' => 'Subject',
    'LBL_LIST_CONTACT' => 'Contact',
    'LBL_LIST_RELATED_TO' => 'Related to',
    'LBL_LIST_RELATED_TO_ID' => 'Relacionado con ID',
    'LBL_LIST_DATE' => 'Fecha de Inicio',
    'LBL_LIST_DIRECTION' => 'Direction',
    'LBL_SUBJECT' => 'Subject:',
    'LBL_REMINDER' => 'Aviso',
    'LBL_CONTACT_NAME' => 'Contacto:',
    'LBL_DESCRIPTION' => 'Descripción:',
    'LBL_STATUS' => 'Status:',
    'LBL_DIRECTION' => 'Dirección:',
    'LBL_DATE' => 'Start Date:',
    'LBL_DURATION' => 'Duration:',
    'LBL_DURATION_HOURS' => 'Horas de Duración:',
    'LBL_DURATION_MINUTES' => 'Duración (Minutos):',
    'LBL_HOURS_MINUTES' => '(hours/minutes)',
    'LBL_DATE_TIME' => 'Fecha y hora de inicio:',
    'LBL_TIME' => 'Start Time:',
    'LBL_HOURS_ABBREV' => 'h',
    'LBL_MINSS_ABBREV' => 'm',
    'LNK_NEW_CALL' => 'Log Call',
    'LNK_NEW_MEETING' => 'Schedule Meeting',
    'LNK_CALL_LIST' => 'View Calls',
    'LNK_IMPORT_CALLS' => 'Import Calls',
    'ERR_DELETE_RECORD' => 'A record number must be specified to delete the account.',
    'LBL_INVITEE' => 'Invitees',
    'LBL_RELATED_TO' => 'Relacionado con',
    'LNK_NEW_APPOINTMENT' => 'Create Appointment',
    'LBL_SCHEDULING_FORM_TITLE' => 'Planificación',
    'LBL_ADD_INVITEE' => 'Añadir asistentes',
    'LBL_NAME' => 'Nombre',
    'LBL_FIRST_NAME' => 'Nombre',
    'LBL_LAST_NAME' => 'Last Name',
    'LBL_EMAIL' => 'Email',
    'LBL_PHONE' => 'Phone',
    'LBL_REMINDER_POPUP' => 'Ventana emergente',
    'LBL_REMINDER_EMAIL_ALL_INVITEES' => 'Enviar correo electrónico a todos los asistentes',
    'LBL_EMAIL_REMINDER' => 'Recordatorio por correo electrónico',
    'LBL_EMAIL_REMINDER_TIME' => 'Tiempo de recordatorio por correo electrónico',
    'LBL_SEND_BUTTON_TITLE' => 'Save & Send Invites',
    'LBL_SEND_BUTTON_LABEL' => 'Save & Send Invites',
    'LBL_DATE_END' => 'End Date',
    'LBL_REMINDER_TIME' => 'Hora Aviso',
    'LBL_EMAIL_REMINDER_SENT' => 'Recordatorio por correo electrónico enviado',
    'LBL_SEARCH_BUTTON' => 'Búsqueda',
    'LBL_ADD_BUTTON' => 'Añadir',
    'LBL_DEFAULT_SUBPANEL_TITLE' => 'Llamadas',
    'LNK_SELECT_ACCOUNT' => 'Select Account',
    'LNK_NEW_ACCOUNT' => 'New Account',
    'LNK_NEW_OPPORTUNITY' => 'Nueva Oportunidad',
    'LBL_LEADS_SUBPANEL_TITLE' => 'Leads',
    'LBL_CONTACTS_SUBPANEL_TITLE' => 'Contactos',
    'LBL_USERS_SUBPANEL_TITLE' => 'Usuarios',
    'LBL_OUTLOOK_ID' => 'ID Outlook',
    'LBL_MEMBER_OF' => 'Member Of',
    'LBL_HISTORY_SUBPANEL_TITLE' => 'Notes',
    'LBL_LIST_ASSIGNED_TO_NAME' => 'Asignado a',
    'LBL_LIST_MY_CALLS' => 'Mis Llamadas',
    'LBL_ASSIGNED_TO_NAME' => 'Asignado a',
    'LBL_ASSIGNED_TO_ID' => 'Assigned User',
    'NOTICE_DURATION_TIME' => 'Duration time must be greater than 0',
    'LBL_CALL_INFORMATION' => 'OVERVIEW', //No need to be translated in all caps. Translation used just in menu action items when using the SuiteP template
    'LBL_REMOVE' => 'Quitar',
    'LBL_ACCEPT_STATUS' => 'Accept Status',
    'LBL_ACCEPT_LINK' => 'Aceptar Link',

    // create invitee functionality
    'LBL_CREATE_INVITEE' => 'Crear una invitación',
    'LBL_CREATE_CONTACT' => 'As Contact',
    'LBL_CREATE_LEAD' => 'Nuevo Cliente Potencial',
    'LBL_CREATE_AND_ADD' => 'Create & Add',
    'LBL_CANCEL_CREATE_INVITEE' => 'Cancel',
    'LBL_EMPTY_SEARCH_RESULT' => 'Sorry, no results were found. Please create an invitee below.',
    'LBL_NO_ACCESS' => 'You have no access to create $module',

    'LBL_REPEAT_TYPE' => 'Repetición',
    'LBL_REPEAT_INTERVAL' => 'Intervalo de repetición',
    'LBL_REPEAT_DOW' => 'Repita el Dow',
    'LBL_REPEAT_UNTIL' => 'Repeat Until',
    'LBL_REPEAT_COUNT' => 'Número de repeticiones',
    'LBL_REPEAT_PARENT_ID' => 'Repita el ID principal',
    'LBL_RECURRING_SOURCE' => 'Fuente periódica',

    'LBL_SYNCED_RECURRING_MSG' => 'Esta convocatoria se originó en otro sistema y se sincronizan con el SuiteCRM. Para realizar cambios, vaya a la llamada original en el otro sistema. Los cambios realizados en el otro sistema se puede sincronizar con este registro.',

    // for reminders
    'LBL_REMINDERS' => 'Recordatorios',
    'LBL_REMINDERS_ACTIONS' => 'Acciones:',
    'LBL_REMINDERS_POPUP' => 'Popup',
    'LBL_REMINDERS_EMAIL' => 'Enviar e-mail a asistentes',
    'LBL_REMINDERS_WHEN' => 'Cuando:',
    'LBL_REMINDERS_REMOVE_REMINDER' => 'Eliminar recordatorio',
    'LBL_REMINDERS_ADD_ALL_INVITEES' => 'Añadir a todos los invitados',
    'LBL_REMINDERS_ADD_REMINDER' => 'Añadir recordatorio',

    'LBL_RESCHEDULE' => 'Reschedule',
    'LBL_RESCHEDULE_COUNT' => 'Call Attempts',
    'LBL_RESCHEDULE_DATE' => 'Date',
    'LBL_RESCHEDULE_REASON' => 'Razón',
    'LBL_RESCHEDULE_ERROR1' => 'Please select a valid date',
    'LBL_RESCHEDULE_ERROR2' => 'Please select a reason',
    'LBL_RESCHEDULE_PANEL' => 'Reschedule',
    'LBL_RESCHEDULE_HISTORY' => 'Historial de Intentos de Llamada',
    'LBL_CANCEL' => 'Cancel',
    'LBL_SAVE' => 'Save',

    'LBL_CALLS_RESCHEDULE' => 'Reprogramación de llamadas',
    'LBL_LIST_STATUS'=>'Estado',
    'LBL_LIST_DATE_MODIFIED'=>'Última Modificación',
    'LBL_LIST_DUE_DATE'=>'Due Date',
    'LBL_RESCHEDULED_BY'=>'by',
);
