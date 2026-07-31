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
    'LBL_ASSIGNED_TO_ID' => 'Id de usuario asignado',
    'LBL_ASSIGNED_TO_NAME' => 'Asignado a',
    'LBL_ID' => 'ID',
    'LBL_DATE_ENTERED' => 'Fecha de Creación',
    'LBL_DATE_MODIFIED' => 'Fecha de Modificación',
    'LBL_MODIFIED' => 'Modificado Por',
    'LBL_MODIFIED_NAME' => 'Modified By Name',
    'LBL_CREATED' => 'Creado Por',
    'LBL_DESCRIPTION' => 'Descripción',
    'LBL_DELETED' => 'Eliminado',
    'LBL_NAME' => 'Nombre',
    'LBL_CREATED_USER' => 'Creado por el Usuario',
    'LBL_MODIFIED_USER' => 'Modificado por el Usuario',
    'LBL_LIST_NAME' => 'Nombre',
    'LBL_EDIT_BUTTON' => 'Editar',
    'LBL_REMOVE' => 'Quitar',
    'LBL_LIST_FORM_TITLE' => 'Event List',
    'LBL_MODULE_NAME' => 'Event',
    'LBL_MODULE_TITLE' => 'Event',
    'LBL_HOMEPAGE_TITLE' => 'My Event',
    'LNK_NEW_RECORD' => 'Create Event',
    'LNK_LIST' => 'View Events',
    'LBL_SEARCH_FORM_TITLE' => 'Search Event',
    'LBL_HISTORY_SUBPANEL_TITLE' => 'View History',
    'LBL_ACTIVITIES_SUBPANEL_TITLE' => 'Activities',
    'LBL_NEW_FORM_TITLE' => 'New Event',
    'LBL_LOCATION' => 'Location',
    'LBL_START_DATE' => 'start date',
    'LBL_END_DATE' => 'End Date/Time',
    'LBL_BUDGET' => 'Presupuesto',
    'LBL_DATE' => 'Fecha de Inicio',
    'LBL_DATE_END' => 'End Date',
    'LBL_DURATION' => 'Duración',
    'LBL_INVITE_TEMPLATES' => 'Plantilla de Email de Invitación',
    'LBL_INVITE_PDF' => 'Send Invites',
    'LBL_EDITVIEW_PANEL1' => 'Detalles del Evento',
    'LBL_DEFAULT_SUBPANEL_TITLE' => 'Delegates',
    'LBL_ACCEPT_REDIRECT' => 'Redirección URL de Aceptación',
    'LBL_DECLINE_REDIRECT' => 'Redirección URL de Rechazo',
    'LBL_SELECT_DELEGATES' => 'Seleccionar Delegados',
    'LBL_SELECT_DELEGATES_TITLE' => 'Seleccionar Delegados:-',
    'LBL_SELECT_DELEGATES_TARGET_LIST' => 'Target List',
    'LBL_SELECT_DELEGATES_TARGETS' => 'Público Objetivo',
    'LBL_SELECT_DELEGATES_CONTACTS' => 'Contactos',
    'LBL_SELECT_DELEGATES_LEADS' => 'Leads',
    'LBL_MANAGE_DELEGATES' => 'Manejar Delegados',
    'LBL_MANAGE_DELEGATES_TITLE' => 'Manejar Delegados:-',
    'LBL_MANAGE_ACCEPTANCES' => 'Manejar Aceptaciones',
    'LBL_MANAGE_ACCEPTANCES_TITLE' => 'Manejar Aceptaciones:-',
    'LBL_MANAGE_ACCEPTANCES_ACCEPTED' => 'Accepted',
    'LBL_MANAGE_ACCEPTANCES_DECLINED' => 'Rechazado',
    'LBL_MANAGE_POPUP_ERROR' => 'No se seleccionaron delegados.',
    'LBL_MANAGE_DELEGATES_INVITED' => 'Invited',
    'LBL_MANAGE_DELEGATES_NOT_INVITED' => 'Not Invited',
    'LBL_MANAGE_DELEGATES_ATTENDED' => 'Attended',
    'LBL_MANAGE_DELEGATES_NOT_ATTENDED' => 'Not Attended',
    'LBL_SUCCESS_MSG' => 'Todas las invitaciones fueron enviadas exitosamente.',
    'LBL_ERROR_MSG_1' => 'Todos los contactos relacionados ya fueron invitados.',
    'LBL_ERROR_MSG_2' => 'El envío de emails de invitación falló! Por favor verifique su configuración de email.',
    'LBL_ERROR_MSG_3' => 'Falló el envío de más de 10 emails. Por favor verifique que todos los contactos que está invitando tienen dirección de email correcta (vea el log de errores SuiteCRM)',
    'LBL_ERROR_MSG_4' => 'emails fallaron al intentar enviarlos. Por favor verifique que todos los contactos que está invitando tienen dirección de email correcta (vea el log de errores SuiteCRM)', // LBL_ERROR_MSG_4 Begins with a number (controller.php line 581) for example 10 emails have failed to send.
    'LBL_ERROR_MSG_5' => 'Plantilla de mensaje de correo electrónico incorrecta',
    'LBL_EMAIL_INVITE' => 'Enviar invitación por correo electrónico',

    'LBL_FP_EVENTS_CONTACTS_FROM_CONTACTS_TITLE' => 'Contactos',
    'LBL_FP_EVENT_LOCATIONS_FP_EVENTS_1_FROM_FP_EVENT_LOCATIONS_TITLE' => 'Locations',
    'LBL_FP_EVENTS_LEADS_1_FROM_LEADS_TITLE' => 'Leads',
    'LBL_FP_EVENTS_PROSPECTS_1_FROM_PROSPECTS_TITLE' => 'Público Objetivo',

    'LBL_HOURS_ABBREV' => 'h',
    'LBL_MINSS_ABBREV' => 'm',
    'LBL_FP_EVENTS_FP_EVENT_DELEGATES_1_FROM_FP_EVENT_DELEGATES_TITLE' => 'Delegates',

    // Attendance report
    'LBL_CONTACT_NAME' => 'Nombre',
    'LBL_ACCOUNT_NAME' => 'Company',
    'LBL_SIGNATURE' => 'Firma',
    // contacts/leads/targets subpanels
    'LBL_LIST_INVITE_STATUS_EVENT' => 'Invited',
    'LBL_LIST_ACCEPT_STATUS_EVENT' => 'Estado',

    'LBL_ACTIVITY_STATUS' => 'Estado de actividad',
    'LBL_FP_EVENT_LOCATIONS_FP_EVENTS_1_FROM_FP_EVENTS_TITLE' => 'Ubicaciones de eventos desde los títulos',
    // Email links
    'LBL_ACCEPT_LINK' => 'Accept',
    'LBL_DECLINE_LINK' => 'Decline',
    
);
