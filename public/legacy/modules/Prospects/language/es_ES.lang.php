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
    'LBL_MODULE_NAME' => 'Público Objetivo',
    'LBL_MODULE_ID' => 'Público Objetivo',
    'LBL_INVITEE' => 'Direct Reports',
    'LBL_MODULE_TITLE' => 'Público Objetivo: Inicio',
    'LBL_SEARCH_FORM_TITLE' => 'Búsqueda de Público Objetivo',
    'LBL_LIST_FORM_TITLE' => 'Target List',
    'LBL_NEW_FORM_TITLE' => 'Nuevo Público Objetivo',
    'LBL_LIST_NAME' => 'Nombre',
    'LBL_LIST_LAST_NAME' => 'Last Name',
    'LBL_LIST_TITLE' => 'Cargo',
    'LBL_LIST_EMAIL_ADDRESS' => 'Email',
    'LBL_LIST_PHONE' => 'Phone',
    'LBL_LIST_FIRST_NAME' => 'Nombre',
    'LBL_ASSIGNED_TO_NAME' => 'Asignado a',
    'LBL_ASSIGNED_TO_ID' => 'Assigned To:',
    'LBL_CAMPAIGN_ID' => 'Campaign ID',
    'LBL_EXISTING_ACCOUNT' => 'Used an existing account',
    'LBL_CREATED_ACCOUNT' => 'Creada una nueva cuenta',
    'LBL_CREATED_CALL' => 'Created a new call',
    'LBL_CREATED_MEETING' => 'Created a new meeting',
    'LBL_NAME' => 'Nombre:',
    'LBL_PROSPECT_INFORMATION' => 'OVERVIEW', //No need to be translated in all caps. Translation used just in menu action items when using the SuiteP template
    'LBL_MORE_INFORMATION' => 'More Information',
    'LBL_FIRST_NAME' => 'Nombre:',
    'LBL_OFFICE_PHONE' => 'Office Phone:',
    'LBL_ANY_PHONE' => 'Any Phone:',
    'LBL_PHONE' => 'Phone:',
    'LBL_LAST_NAME' => 'Last Name:',
    'LBL_MOBILE_PHONE' => 'Mobile:',
    'LBL_HOME_PHONE' => 'Home:',
    'LBL_OTHER_PHONE' => 'Other Phone:',
    'LBL_FAX_PHONE' => 'Fax:',
    'LBL_PRIMARY_ADDRESS_STREET' => 'Primary Address Street:',
    'LBL_PRIMARY_ADDRESS_CITY' => 'Primary Address City:',
    'LBL_PRIMARY_ADDRESS_COUNTRY' => 'Primary Address Country:',
    'LBL_PRIMARY_ADDRESS_STATE' => 'Primary Address State:',
    'LBL_PRIMARY_ADDRESS_POSTALCODE' => 'Primary Address Postal Code:',
    'LBL_ALT_ADDRESS_STREET' => 'Alternate Address Street:',
    'LBL_ALT_ADDRESS_CITY' => 'Alternate Address City:',
    'LBL_ALT_ADDRESS_COUNTRY' => 'Alternate Address Country:',
    'LBL_ALT_ADDRESS_STATE' => 'Alternate Address State:',
    'LBL_ALT_ADDRESS_POSTALCODE' => 'Alternate Address Postal Code:',
    'LBL_TITLE' => 'Puesto de trabajo:',
    'LBL_DEPARTMENT' => 'Department:',
    'LBL_BIRTHDATE' => 'Fecha de nacimiento:',
    'LBL_EMAIL_ADDRESS' => 'Email Address:',
    'LBL_OTHER_EMAIL_ADDRESS' => 'Other Email:',
    'LBL_ANY_EMAIL' => 'Cualquier Correo:',
    'LBL_ASSISTANT' => 'Assistant:',
    'LBL_ASSISTANT_PHONE' => 'Assistant Phone:',
    'LBL_DO_NOT_CALL' => 'Do Not Call:',
    'LBL_EMAIL_OPT_OUT' => 'Email Opt Out:',
    'LBL_PRIMARY_ADDRESS' => 'Primary Address:',
    'LBL_ALTERNATE_ADDRESS' => 'Other Address:',
    'LBL_ANY_ADDRESS' => 'Any Address:',
    'LBL_CITY' => 'City:',
    'LBL_STATE' => 'Estado/Región:',
    'LBL_POSTAL_CODE' => 'Postal Code:',
    'LBL_COUNTRY' => 'Country:',
    'LBL_ADDRESS_INFORMATION' => 'Información de Dirección',
    'LBL_DESCRIPTION' => 'Descripción:',
    'LBL_OPP_NAME' => 'Nombre de la oportunidad:',
    'LBL_IMPORT_VCARD' => 'Import vCard',
    'LBL_IMPORT_VCARDTEXT' => 'Crear un nuevo contacto automáticamente importando una vCard de su sistema de ficheros.',
    'LBL_DUPLICATE' => 'Posible Público Objetivo Duplicado',
    'MSG_SHOW_DUPLICATES' => 'El registro para el prospecto que va a crear podría ser un duplicado de otro registro de prospecto existente. Los registros de prospectos con nombres y/o direcciones de correo similares se listan a continuación.<br>Haga clic en Guardar para continuar con la creación de este prospecto, o en Cancelar para volver al módulo sin crear el prospecto.',
    'MSG_DUPLICATE' => 'El registro para el prospecto que va a crear podría ser un duplicado de otro registro de prospecto existente. Los registros de prospectos con nombres y/o direcciones de correo similares se listan a continuación.<br>Haga clic en Guardar para continuar con la creación de este prospecto, o en Cancelar para volver al módulo sin crear el prospecto.',
    'LNK_IMPORT_VCARD' => 'Create From vCard',
    'LNK_NEW_ACCOUNT' => 'Crear una cuenta',
    'LNK_NEW_OPPORTUNITY' => 'Create Opportunity',
    'LNK_NEW_CASE' => 'Create Case',
    'LNK_NEW_NOTE' => 'Create Note or Attachment',
    'LNK_NEW_CALL' => 'Log Call',
    'LNK_NEW_EMAIL' => 'Archive Email',
    'LNK_NEW_MEETING' => 'Schedule Meeting',
    'LNK_NEW_TASK' => 'Create Task',
    'LNK_NEW_APPOINTMENT' => 'Create Appointment',
    'LNK_IMPORT_PROSPECTS' => 'Importar Prospectos',
    'NTC_DELETE_CONFIRMATION' => 'Are you sure you want to delete this record?',
    'NTC_SNOOZE_CONFIRMATION' => '¿Está seguro que quiere posponerlo?',
    'NTC_REMOVE_CONFIRMATION' => 'Are you sure you want to remove this contact from the case?',
    'ERR_DELETE_RECORD' => 'A record number must be specified to delete the contact.',
    'LBL_SALUTATION' => 'Salutation',
    'LBL_CREATED_OPPORTUNITY' => 'Nueva oportunidad creada',
    'LNK_SELECT_ACCOUNT' => "Select Account",
    'LNK_NEW_PROSPECT' => 'Create Target',
    'LNK_PROSPECT_LIST' => 'View Targets',
    'LNK_NEW_CAMPAIGN' => 'Create Campaign',
    'LNK_CAMPAIGN_LIST' => 'Campaigns',
    'LNK_NEW_PROSPECT_LIST' => 'Create Target List',
    'LNK_PROSPECT_LIST_LIST' => 'Target Lists',
    'LBL_SELECT_CHECKED_BUTTON_LABEL' => 'Seleccione Público Objetivo Marcado',
    'LBL_SELECT_CHECKED_BUTTON_TITLE' => 'Select Checked Targets',
    'LBL_INVALID_EMAIL' => 'Invalid Email:',
    'LBL_DEFAULT_SUBPANEL_TITLE' => 'Público Objetivo',
    'LBL_PROSPECT_LIST' => 'Prospect List',
    'LBL_CONVERT_BUTTON_TITLE' => 'Convertir Público Objetivo',
    'LBL_CONVERT_BUTTON_LABEL' => 'Convert Target',
    'LNK_NEW_CONTACT' => 'New Contact',
    'LBL_CREATED_CONTACT' => "Created a new contact",
    'LBL_CAMPAIGNS' => 'Campaigns',
    'LBL_CAMPAIGN_LIST_SUBPANEL_TITLE' => 'Campaign Log',
    'LBL_TRACKER_KEY' => 'Tracker Key',
    'LBL_LEAD_ID' => 'Id Cliente Potencial',
    'LBL_CONVERTED_LEAD' => 'Cliente Potencial Convertido',
    'LBL_ACCOUNT_NAME' => 'Nombre de Cuenta',
    'LBL_EDIT_ACCOUNT_NAME' => 'Account Name:',
    'LBL_CREATED_USER' => 'Created User',
    'LBL_MODIFIED_USER' => 'Modified User',
    'LBL_HISTORY_SUBPANEL_TITLE' => 'Historial',
    //For export labels
    'LBL_FP_EVENTS_PROSPECTS_1_FROM_FP_EVENTS_TITLE' => 'Events',
);
