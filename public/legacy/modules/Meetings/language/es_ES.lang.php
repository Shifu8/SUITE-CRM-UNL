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
    'LBL_ACCEPT_THIS' => 'Accept?',
    'LBL_ADD_BUTTON' => 'Añadir',
    'LBL_ADD_INVITEE' => 'Add Invitees',
    'LBL_CONTACT_NAME' => 'Contact:',
    'LBL_CONTACTS_SUBPANEL_TITLE' => 'Contactos',
    'LBL_CREATED_BY' => 'Created by',
    'LBL_DATE_END' => 'End Date',
    'LBL_DATE_TIME' => 'Fecha y hora de inicio:',
    'LBL_DATE' => 'Start Date:',
    'LBL_DEFAULT_SUBPANEL_TITLE' => 'Meetings',
    'LBL_DESCRIPTION' => 'Descripción:',
    'LBL_DIRECTION' => 'Direction:',
    'LBL_DURATION_HOURS' => 'Horas de Duración:',
    'LBL_DURATION_MINUTES' => 'Minutos de Duración:',
    'LBL_DURATION' => 'Duration:',
    'LBL_EMAIL' => 'Email',
    'LBL_FIRST_NAME' => 'Nombre',
    'LBL_HISTORY_SUBPANEL_TITLE' => 'Notes',
    'LBL_HOURS_ABBREV' => 'h',
    'LBL_HOURS_MINS' => '(hours/minutes)',
    'LBL_INVITEE' => 'Invitees',
    'LBL_LAST_NAME' => 'Last Name',
    'LBL_ASSIGNED_TO_NAME' => 'Asignado a:',
    'LBL_LIST_ASSIGNED_TO_NAME' => 'Assigned User',
    'LBL_LIST_CLOSE' => 'Close',
    'LBL_LIST_CONTACT' => 'Contact',
    'LBL_LIST_DATE_MODIFIED' => 'Última Modificación',
    'LBL_LIST_DATE' => 'Fecha de Inicio',
    'LBL_LIST_DIRECTION' => 'Direction',
    'LBL_LIST_DUE_DATE' => 'Due Date',
    'LBL_LIST_FORM_TITLE' => 'Lista de Reuniones',
    'LBL_LIST_MY_MEETINGS' => 'Mis Reuniones',
    'LBL_LIST_RELATED_TO' => 'Related to',
    'LBL_LIST_STATUS' => 'Estado',
    'LBL_LIST_SUBJECT' => 'Subject',
    'LBL_LEADS_SUBPANEL_TITLE' => 'Leads',
    'LBL_LOCATION' => 'Ubicación:',
    'LBL_MINSS_ABBREV' => 'm',
    'LBL_MODIFIED_BY' => 'Modified by',
    'LBL_MODULE_NAME' => 'Meetings',
    'LBL_MODULE_TITLE' => 'Reuniones: Inicio',
    'LBL_NAME' => 'Nombre',
    'LBL_NEW_FORM_TITLE' => 'Create Appointment',
    'LBL_OUTLOOK_ID' => 'Outlook ID',
    'LBL_SEQUENCE' => 'Secuencia de actualización de la reunión',
    'LBL_PHONE' => 'Phone Office:',
    'LBL_REMINDER_TIME' => 'Reminder Time',
    'LBL_EMAIL_REMINDER_SENT' => 'Email reminder sent',
    'LBL_REMINDER' => 'Aviso:',
    'LBL_REMINDER_POPUP' => 'Popup',
    'LBL_REMINDER_EMAIL_ALL_INVITEES' => 'Email all invitees',
    'LBL_EMAIL_REMINDER' => 'Email Reminder',
    'LBL_EMAIL_REMINDER_TIME' => 'Email Reminder Time',
    'LBL_REMOVE' => 'Quitar',
    'LBL_SCHEDULING_FORM_TITLE' => 'Scheduling',
    'LBL_SEARCH_BUTTON' => 'Búsqueda',
    'LBL_SEARCH_FORM_TITLE' => 'Búsqueda de Reuniones',
    'LBL_SEND_BUTTON_LABEL' => 'Save & Send Invites',
    'LBL_SEND_BUTTON_TITLE' => 'Save & Send Invites',
    'LBL_STATUS' => 'Status:',
    'LBL_TYPE' => 'Tipo de reunión',
    'LBL_PASSWORD' => 'Contraseña de la reunión',
    'LBL_URL' => 'Iniciar/Unirse a la reunión',
    'LBL_HOST_URL' => 'Host URL',
    'LBL_DISPLAYED_URL' => 'Ver URL',
    'LBL_CREATOR' => 'Creador de reuniones',
    'LBL_EXTERNALID' => 'ID App Externa',
    'LBL_SUBJECT' => 'Subject:',
    'LBL_TIME' => 'Start Time:',
    'LBL_USERS_SUBPANEL_TITLE' => 'Usuarios',
    'LBL_CALENDAR_ACCOUNTS' => 'Calendar Accounts',
    'LBL_PARENT_TYPE' => 'Parent Type',
    'LBL_PARENT_ID' => 'Parent ID',
    'LNK_MEETING_LIST' => 'View Meetings',
    'LNK_NEW_APPOINTMENT' => 'Create Appointment',
    'LNK_NEW_MEETING' => 'Schedule Meeting',
    'LNK_IMPORT_MEETINGS' => 'Import Meetings',

    'LBL_CREATED_USER' => 'Created User',
    'LBL_MODIFIED_USER' => 'Modified User',
    'NOTICE_DURATION_TIME' => 'Duration time must be greater than 0',
    'LBL_MEETING_INFORMATION' => 'OVERVIEW', //No need to be translated in all caps. Translation used just in menu action items when using the SuiteP template
    'LBL_LIST_JOIN_MEETING' => 'Unirser a la reunión',
    'LBL_ACCEPT_STATUS' => 'Accept Status',
    'LBL_ACCEPT_LINK' => 'Accept Link',
    // You are not invited to the meeting messages
    'LBL_EXTNOT_MAIN' => 'No es capaz de unirse a esta reunión, porque usted no es un asistente.',
    'LBL_EXTNOT_RECORD_LINK' => 'Ver reunión',

    //cannot start messages
    'LBL_EXTNOSTART_MAIN' => 'No se puede iniciar esta reunión, ya que no es un administrador o el dueño de la reunión.',

    // create invitee functionallity
    'LBL_CREATE_INVITEE' => 'Create an invitee',
    'LBL_CREATE_CONTACT' => 'As Contact',  // Create invitee functionallity
    'LBL_CREATE_LEAD' => 'As Lead',  // Create invitee functionallity
    'LBL_CREATE_AND_ADD' => 'Create & Add',  // Create invitee functionallity
    'LBL_CANCEL_CREATE_INVITEE' => 'Cancel',
    'LBL_EMPTY_SEARCH_RESULT' => 'Sorry, no results were found. Please create an invitee below.',
    'LBL_NO_ACCESS' => 'You have no access to create $module',  // Create invitee functionallity

    'LBL_REPEAT_TYPE' => 'Repeat Type',
    'LBL_REPEAT_INTERVAL' => 'Repeat Interval',
    'LBL_REPEAT_DOW' => 'Repeat Dow',
    'LBL_REPEAT_UNTIL' => 'Repeat Until',
    'LBL_REPEAT_COUNT' => 'Repeat Count',
    'LBL_REPEAT_PARENT_ID' => 'Repeat Parent ID',
    'LBL_RECURRING_SOURCE' => 'Recurring Source',

    'LBL_SYNCED_RECURRING_MSG' => 'Esta convocatoria se originó en otro sistema y se sincronizan con el SuiteCRM. Para realizar cambios, vaya a la reunión original en el otro sistema. Los cambios realizados en el otro sistema se puede sincronizar con este registro.',
    'LBL_RELATED_TO' => 'Relacionado con:',

    // for reminders
    'LBL_REMINDERS' => 'Reminders',
    'LBL_REMINDERS_ACTIONS' => 'Actions:',
    'LBL_REMINDERS_POPUP' => 'Popup',
    'LBL_REMINDERS_EMAIL' => 'Email invitees',
    'LBL_REMINDERS_WHEN' => 'When:',
    'LBL_REMINDERS_REMOVE_REMINDER' => 'Remove reminder',
    'LBL_REMINDERS_ADD_ALL_INVITEES' => 'Add All Invitees',
    'LBL_REMINDERS_ADD_REMINDER' => 'Add reminder',

    // for google sync
    'LBL_GSYNC_ID' => 'ID de evento de Google',
    'LBL_GSYNC_LASTSYNC' => 'Última marca de tiempo de Google Sync',
);
