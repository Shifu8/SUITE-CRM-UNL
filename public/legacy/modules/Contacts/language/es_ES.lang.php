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
    'ERR_DELETE_RECORD' => 'Especifique el número de registro para eliminar el contacto.',
    'LBL_ACCOUNT_ID' => 'ID de Cuenta:',
    'LBL_ACCOUNT_NAME' => 'Account Name:',
    'LBL_CAMPAIGN' => 'Campaign:',
    'LBL_ACTIVITIES_SUBPANEL_TITLE' => 'Activities',
    'LBL_ADDRESS_INFORMATION' => 'Información de Dirección',
    'LBL_ALT_ADDRESS_CITY' => 'Ciudad de dirección alternativa:',
    'LBL_ALT_ADDRESS_COUNTRY' => 'País de dirección alternativa:',
    'LBL_ALT_ADDRESS_POSTALCODE' => 'CP de dirección alternativa:',
    'LBL_ALT_ADDRESS_STATE' => 'Estado/Provincia de dirección alternativa:',
    'LBL_ALT_ADDRESS_STREET_2' => 'Alternate Address Street 2:',
    'LBL_ALT_ADDRESS_STREET_3' => 'Alternate Address Street 3:',
    'LBL_ALT_ADDRESS_STREET' => 'Calle de dirección alternativa:',
    'LBL_ALTERNATE_ADDRESS' => 'Other Address:',
    'LBL_ALT_ADDRESS' => 'Other Address:',
    'LBL_ANY_ADDRESS' => 'Any Address:',
    'LBL_ANY_EMAIL' => 'Cualquier Correo:',
    'LBL_ANY_PHONE' => 'Any Phone:',
    'LBL_ASSIGNED_TO_NAME' => 'Asignado a:',
    'LBL_ASSIGNED_TO_ID' => 'Assigned User',
    'LBL_ASSISTANT_PHONE' => 'Tel. asistente:',
    'LBL_ASSISTANT' => 'Asistente:',
    'LBL_BIRTHDATE' => 'Fecha de nacimiento:',
    'LBL_CITY' => 'City:',
    'LBL_CAMPAIGN_ID' => 'Campaign ID',
    'LBL_CONTACT_INFORMATION' => 'OVERVIEW', //No need to be translated in all caps. Translation used just in menu action items when using the SuiteP template
    'LBL_CONTACT_NAME' => 'Contact Name:',
    'LBL_CONTACT_OPP_FORM_TITLE' => 'Oportunidad-Contacto:',
    'LBL_CONTACT_ROLE' => 'Rol:',
    'LBL_CONTACT' => 'Contact:',
    'LBL_COUNTRY' => 'Country:',
    'LBL_CREATED_ACCOUNT' => 'Creada una nueva cuenta',
    'LBL_CREATED_CALL' => 'Nueva llamada creada',
    'LBL_CREATED_CONTACT' => 'Nuevo contacto creado',
    'LBL_CREATED_MEETING' => 'Nueva reunión creada',
    'LBL_CREATED_OPPORTUNITY' => 'Nueva oportunidad creada',
    'LBL_DATE_MODIFIED' => 'Fecha de Modificación:',
    'LBL_DEFAULT_SUBPANEL_TITLE' => 'Contactos',
    'LBL_DEPARTMENT' => 'Departamento:',
    'LBL_DESCRIPTION' => 'Descripción:',
    'LBL_DIRECT_REPORTS_SUBPANEL_TITLE' => 'Direct Reports',
    'LBL_DO_NOT_CALL' => 'No llamar:',
    'LBL_DUPLICATE' => 'Posible contacto duplicado',
    'LBL_EMAIL_ADDRESS' => 'Email Address:',
    'LBL_EMAIL_OPT_OUT' => 'Email Opt Out:',
    'LBL_EXISTING_ACCOUNT' => 'Usada cuenta existente',
    'LBL_EXISTING_CONTACT' => 'Usado contacto existente',
    'LBL_EXISTING_OPPORTUNITY' => 'Usada oportunidad existente',
    'LBL_FAX_PHONE' => 'Fax:',
    'LBL_FIRST_NAME' => 'Nombre:',
    'LBL_HISTORY_SUBPANEL_TITLE' => 'Historial',
    'LBL_HOME_PHONE' => 'Tel. casa:',
    'LBL_ID' => 'ID:',
    'LBL_IMPORT_VCARD' => 'Import vCard',
    'LBL_VCARD' => 'vCard',
    'LBL_IMPORT_VCARDTEXT' => 'Crea automáticamente un nuevo contacto a partir de una vCard.',
    'LBL_INVALID_EMAIL' => 'Invalid Email:',
    'LBL_INVITEE' => 'Direct Reports',
    'LBL_LAST_NAME' => 'Apellidos:',
    'LBL_LEAD_SOURCE' => 'Primer medio de contacto:',
    'LBL_LIST_ACCEPT_STATUS' => 'Accept Status',
    'LBL_LIST_ACCOUNT_NAME' => 'Nombre de Cuenta',
    'LBL_LIST_CONTACT_NAME' => 'Contact Name',
    'LBL_LIST_CONTACT_ROLE' => 'Role',
    'LBL_LIST_EMAIL_ADDRESS' => 'Email',
    'LBL_LIST_FIRST_NAME' => 'Nombre',
    'LBL_LIST_FORM_TITLE' => 'Contact List',
    'LBL_LIST_LAST_NAME' => 'Last Name',
    'LBL_LIST_NAME' => 'Nombre',
    'LBL_LIST_PHONE' => 'Office Phone',
    'LBL_LIST_TITLE' => 'Cargo',
    'LBL_MOBILE_PHONE' => 'Móvil:',
    'LBL_MODIFIED' => 'Modificado por:',
    'LBL_MODULE_NAME' => 'Contactos',
    'LBL_MODULE_TITLE' => 'Contactos: Inicio',
    'LBL_NAME' => 'Nombre:',
    'LBL_NEW_FORM_TITLE' => 'Nuevo Contacto',
    'LBL_NOTE_SUBJECT' => 'Asunto de Nota',
    'LBL_OFFICE_PHONE' => 'Office Phone:',
    'LBL_OPP_NAME' => 'Nombre de la oportunidad:',
    'LBL_OPPORTUNITY_ROLE_ID' => 'ID de Rol en Oportunidad',
    'LBL_OPPORTUNITY_ROLE' => 'Rol en Oportunidad',
    'LBL_OTHER_EMAIL_ADDRESS' => 'Other Email:',
    'LBL_OTHER_PHONE' => 'Other Phone:',
    'LBL_PHONE' => 'Phone:',
    'LBL_PORTAL_APP' => 'Aplicación de Portal',
    'LBL_PORTAL_INFORMATION' => 'Información de Portal',
    'LBL_PORTAL_NAME' => 'Nombre del Portal:',
    'LBL_STREET' => 'Street',
    'LBL_POSTAL_CODE' => 'Postal Code:',
    'LBL_PRIMARY_ADDRESS_CITY' => 'Primary Address City:',
    'LBL_PRIMARY_ADDRESS_COUNTRY' => 'Primary Address Country:',
    'LBL_PRIMARY_ADDRESS_POSTALCODE' => 'Primary Address Postal Code:',
    'LBL_PRIMARY_ADDRESS_STATE' => 'Primary Address State:',
    'LBL_PRIMARY_ADDRESS_STREET_2' => 'Primary Address Street 2:',
    'LBL_PRIMARY_ADDRESS_STREET_3' => 'Primary Address Street 3:',
    'LBL_PRIMARY_ADDRESS_STREET' => 'Primary Address Street:',
    'LBL_PRIMARY_ADDRESS' => 'Primary Address:',
    'LBL_PRODUCTS_TITLE' => 'Products',
    'LBL_REPORTS_TO_ID' => 'Informa a ID:',
    'LBL_REPORTS_TO' => 'Informa a:',
    'LBL_RESOURCE_NAME' => 'Nombre de Recurso',
    'LBL_SALUTATION' => 'Saludo',
    'LBL_SAVE_CONTACT' => 'Guardar Contacto',
    'LBL_SEARCH_FORM_TITLE' => 'Búsqueda de Contactos',
    'LBL_SELECT_CHECKED_BUTTON_LABEL' => 'Seleccionar Contactos Marcados',
    'LBL_SELECT_CHECKED_BUTTON_TITLE' => 'Select Checked Contacts',
    'LBL_STATE' => 'Estado/Región:',
    'LBL_SYNC_CONTACT' => 'Sincronizar con Outlook&reg;',
    'LBL_PROSPECT_LIST' => 'Prospect List',
    'LBL_TITLE' => 'Puesto de trabajo:',
    'LNK_CONTACT_LIST' => 'Ver Contactos',
    'LNK_IMPORT_VCARD' => 'Nuevo Contacto desde vCard',
    'LNK_NEW_ACCOUNT' => 'Crear una cuenta',
    'LNK_NEW_APPOINTMENT' => 'Create Appointment',
    'LNK_NEW_CALL' => 'Log Call',
    'LNK_NEW_CASE' => 'Create Case',
    'LNK_NEW_CONTACT' => 'Create Contact',
    'LNK_NEW_EMAIL' => 'Archive Email',
    'LNK_NEW_MEETING' => 'Schedule Meeting',
    'LNK_NEW_NOTE' => 'Create Note',
    'LNK_NEW_OPPORTUNITY' => 'Create Opportunity',
    'LNK_NEW_TASK' => 'Create Task',
    'LNK_SELECT_ACCOUNT' => "Select Account",
    'NTC_DELETE_CONFIRMATION' => 'Are you sure you want to delete this record?',
    'NTC_SNOOZE_CONFIRMATION' => '¿Está seguro que quiere posponerlo?',
    'NTC_OPPORTUNITY_REQUIRES_ACCOUNT' => 'La creación de una oportunidad requiere una cuenta.\n Por favor, cree una nueva cuenta o seleccione una existente.',
    'NTC_REMOVE_CONFIRMATION' => '¿Está seguro que desea eliminar este contacto del caso?',

    'LBL_LEADS_SUBPANEL_TITLE' => 'Leads',
    'LBL_OPPORTUNITIES_SUBPANEL_TITLE' => 'Opportunities',
    'LBL_DOCUMENTS_SUBPANEL_TITLE' => 'Documents',
    'LBL_COPY_ADDRESS_CHECKED_PRIMARY' => 'Copiar dirección principal',
    'LBL_COPY_ADDRESS_CHECKED_ALT' => 'Copiar otra dirección',

    'LBL_CASES_SUBPANEL_TITLE' => 'Casos',
    'LBL_BUGS_SUBPANEL_TITLE' => 'Bugs',
    'LBL_PROJECTS_SUBPANEL_TITLE' => 'Projects',
    'LBL_PROJECTS_RESOURCES' => 'Proyectos de recursos',
    'LBL_CAMPAIGNS' => 'Campaigns',
    'LBL_CAMPAIGN_LIST_SUBPANEL_TITLE' => 'Campaigns',
    'LBL_LIST_CITY' => 'City',
    'LBL_LIST_STATE' => 'Estado',
    'LBL_HOMEPAGE_TITLE' => 'Mis Contactos',
    'LBL_OPPORTUNITIES' => 'Opportunities',

    'LBL_CONTACTS_SUBPANEL_TITLE' => 'Contactos',
    'LBL_PROJECT_SUBPANEL_TITLE' => 'Projects',
    'LNK_IMPORT_CONTACTS' => 'Importar Contactos',

    // SNIP
    'LBL_USER_SYNC' => 'Sincronización de usuario',

    'LBL_FP_EVENTS_CONTACTS_FROM_FP_EVENTS_TITLE' => 'Events',

    'LBL_AOP_CASE_UPDATES' => 'Actualizaciones del caso',
    'LBL_CREATE_PORTAL_USER' => 'Crear Usuario del Portal',
    'LBL_ENABLE_PORTAL_USER' => 'Habilitar Usuario del Portal',
    'LBL_DISABLE_PORTAL_USER' => 'Deshabilitar el Usuario del Portal',
    'LBL_CREATE_PORTAL_USER_FAILED' => 'Error al crear el usuario del portal',
    'LBL_ENABLE_PORTAL_USER_FAILED' => 'Error al habilitar el usuario del portal',
    'LBL_DISABLE_PORTAL_USER_FAILED' => 'Error al deshabilitar el usuario del portal',
    'LBL_CREATE_PORTAL_USER_SUCCESS' => 'Usuario del portal creado',
    'LBL_ENABLE_PORTAL_USER_SUCCESS' => 'Usuario del portal habilitado',
    'LBL_DISABLE_PORTAL_USER_SUCCESS' => 'Usuario del portal deshabilitado',
    'LBL_FAILED_TO_CONNECT_JOOMLA' => 'Failed to create portal user, not able to connect to Joomla',
    'LBL_ERROR_CONTACT_ID_OR_EMAIL_EMPTY' => 'Contact ID or Email is empty',
    'LBL_NO_JOOMLA_URL' => 'No se especificó URL del portal',
    'LBL_PORTAL_USER_TYPE' => 'Tipo de usuario del portal',
    'LBL_PORTAL_ACCOUNT_DISABLED' => 'Cuenta deshabilitada',
    'LBL_JOOMLA_ACCOUNT_ID' => 'ID de cuenta de Joomla',
    'LBL_AOP_DISABLED' => 'AOP is disabled, please enable via settings',

    'LBL_AOS_CONTRACTS' => 'Contracts',
    'LBL_AOS_INVOICES' => 'Invoices',
    'LBL_AOS_QUOTES' => 'Presupuestos',
    'LBL_PROJECT_CONTACTS_1_FROM_PROJECT_TITLE' => 'Contactos del projecto a partir del nombre del projecto',
    'LBL_LAST_MEETING' => 'Su última interacción fue una junta en:',
    'LBL_LAST_CALL' => 'Su última interacción fue una llamada en:',
    'LBL_LAST_EMAIL' => 'Su última interacción fue un correo en:',
    'LBL_NO_INTERACTION' => 'Aún tiene que interactuar con este contacto.',

    'LBL_LIST_INVITE_STATUS' => 'Estado de Invitación',
);
