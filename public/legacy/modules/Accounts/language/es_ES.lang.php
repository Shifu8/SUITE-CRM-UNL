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
    // DON'T CONVERT THESE THEY ARE MAPPINGS
    'db_name' => 'LBL_LIST_ACCOUNT_NAME',
    'db_website' => 'LBL_LIST_WEBSITE',
    'db_billing_address_city' => 'LBL_LIST_CITY',
    // END DON'T CONVERT
    'LBL_DOCUMENTS_SUBPANEL_TITLE' => 'Documents',
    // Dashlet Categories
    'LBL_CHARTS' => 'Gráficos',
    'LBL_DEFAULT' => 'Vistas',
    // END Dashlet Categories

    'ERR_DELETE_RECORD' => 'Debe especificar un número de registro para eliminar la cuenta.',
    'LBL_ACCOUNT_INFORMATION' => 'OVERVIEW', //No need to be translated in all caps. Translation used just in menu action items when using the SuiteP template
    'LBL_ACCOUNT_NAME' => 'Account Name:',
    'LBL_ACCOUNT' => 'Cuenta:',
    'LBL_ACTIVITIES_SUBPANEL_TITLE' => 'Activities',
    'LBL_ADDRESS_INFORMATION' => 'Información de Dirección',
    'LBL_ANNUAL_REVENUE' => 'Annual Revenue:',
    'LBL_ANY_ADDRESS' => 'Any Address:',
    'LBL_ANY_EMAIL' => 'Cualquier Correo:',
    'LBL_ANY_PHONE' => 'Any Phone:',
    'LBL_ASSIGNED_TO_NAME' => 'Asignado a:',
    'LBL_ASSIGNED_TO_ID' => 'Assigned User:',
    'LBL_BILLING_ADDRESS_CITY' => 'Ciudad de Facturación:',
    'LBL_BILLING_ADDRESS_COUNTRY' => 'País de Facturación:',
    'LBL_BILLING_ADDRESS_POSTALCODE' => 'CP de Dirección de Facturación:',
    'LBL_BILLING_ADDRESS_STATE' => 'Estado/Provincia de Dirección de Facturación:',
    'LBL_BILLING_ADDRESS_STREET_2' => 'Calle de Dirección de Facturación 2',
    'LBL_BILLING_ADDRESS_STREET_3' => 'Calle de Dirección de Facturación 3',
    'LBL_BILLING_ADDRESS_STREET_4' => 'Calle de Dirección de Facturación 4',
    'LBL_BILLING_ADDRESS_STREET' => 'Billing Street:',
    'LBL_BILLING_ADDRESS' => 'Billing Address:',
    'LBL_BUGS_SUBPANEL_TITLE' => 'Bugs',
    'LBL_CAMPAIGN_ID' => 'ID Campaña',
    'LBL_CASES_SUBPANEL_TITLE' => 'Casos',
    'LBL_CITY' => 'City:',
    'LBL_CONTACTS_SUBPANEL_TITLE' => 'Contactos',
    'LBL_COUNTRY' => 'Country:',
    'LBL_DATE_ENTERED' => 'Fecha de Creación:',
    'LBL_DATE_MODIFIED' => 'Fecha de Modificación:',
    'LBL_DEFAULT_SUBPANEL_TITLE' => 'Cuentas',
    'LBL_DESCRIPTION_INFORMATION' => 'Description Information',
    'LBL_DESCRIPTION' => 'Descripción:',
    'LBL_DUPLICATE' => 'Possible Duplicate Account',
    'LBL_EMAIL' => 'Email Address:',
    'LBL_EMAIL_OPT_OUT' => 'Rehusar Email:',
    'LBL_EMAIL_ADDRESSES' => 'Email Addresses',
    'LBL_EMPLOYEES' => 'Employees:',
    'LBL_FAX' => 'Fax:',
    'LBL_HISTORY_SUBPANEL_TITLE' => 'Historial',
    'LBL_HOMEPAGE_TITLE' => 'Mis Cuentas',
    'LBL_INDUSTRY' => 'Industry:',
    'LBL_INVALID_EMAIL' => 'Email no válido:',
    'LBL_INVITEE' => 'Contactos',
    'LBL_LEADS_SUBPANEL_TITLE' => 'Leads',
    'LBL_LIST_ACCOUNT_NAME' => 'Nombre',
    'LBL_LIST_CITY' => 'City',
    'LBL_LIST_CONTACT_NAME' => 'Contact Name',
    'LBL_LIST_EMAIL_ADDRESS' => 'Email Address',
    'LBL_LIST_FORM_TITLE' => 'Lista de Cuentas',
    'LBL_LIST_PHONE' => 'Phone',
    'LBL_LIST_STATE' => 'Estado',
    'LBL_MEMBER_OF' => 'Member of:',
    'LBL_MEMBER_ORG_SUBPANEL_TITLE' => 'Member Organizations',
    'LBL_MODULE_NAME' => 'Cuentas',
    'LBL_MODULE_TITLE' => 'Cuentas: Inicio',
    'LBL_MODULE_ID' => 'Cuentas',
    'LBL_NAME' => 'Nombre:',
    'LBL_NEW_FORM_TITLE' => 'Nueva Cuenta',
    'LBL_OPPORTUNITIES_SUBPANEL_TITLE' => 'Opportunities',
    'LBL_OTHER_EMAIL_ADDRESS' => 'Other Email:',
    'LBL_OTHER_PHONE' => 'Other Phone:',
    'LBL_OWNERSHIP' => 'Ownership:',
    'LBL_PARENT_ACCOUNT_ID' => 'Parent Account ID',
    'LBL_PHONE_ALT' => 'Alternate Phone:',
    'LBL_PHONE_FAX' => 'Phone Fax:',
    'LBL_PHONE_OFFICE' => 'Office Phone:',
    'LBL_PHONE' => 'Phone:',
    'LBL_POSTAL_CODE' => 'Postal Code:',
    'LBL_PRODUCTS_TITLE' => 'Products',
    'LBL_PROJECTS_SUBPANEL_TITLE' => 'Projects',
    'LBL_PUSH_CONTACTS_BUTTON_LABEL' => 'Copiar a Contactos',
    'LBL_PUSH_CONTACTS_BUTTON_TITLE' => 'Copiar...',
    'LBL_RATING' => 'Calificación:',
    'LBL_SAVE_ACCOUNT' => 'Save Account',
    'LBL_SEARCH_FORM_TITLE' => 'Búsqueda de Cuentas',
    'LBL_SHIPPING_ADDRESS_CITY' => 'Shipping City:',
    'LBL_SHIPPING_ADDRESS_COUNTRY' => 'Shipping Country:',
    'LBL_SHIPPING_ADDRESS_POSTALCODE' => 'Shipping Postal Code:',
    'LBL_SHIPPING_ADDRESS_STATE' => 'Shipping State:',
    'LBL_SHIPPING_ADDRESS_STREET_2' => 'Shipping Street 2',
    'LBL_SHIPPING_ADDRESS_STREET_3' => 'Shipping Street 3',
    'LBL_SHIPPING_ADDRESS_STREET_4' => 'Shipping Street 4',
    'LBL_SHIPPING_ADDRESS_STREET' => 'Shipping Street:',
    'LBL_SHIPPING_ADDRESS' => 'Shipping Address:',
    'LBL_SIC_CODE' => 'Código CNAE/SIC:',
    'LBL_STATE' => 'Estado/Región:',
    'LBL_TICKER_SYMBOL' => 'Ticker Symbol:',
    'LBL_TYPE' => 'Type:',
    'LBL_WEBSITE' => 'Website:',
    'LBL_CAMPAIGNS' => 'Campaigns',
    'LNK_ACCOUNT_LIST' => 'Ver Cuentas',
    'LNK_NEW_ACCOUNT' => 'Crear una cuenta',
    'LNK_IMPORT_ACCOUNTS' => 'Importar Cuentas',
    'MSG_DUPLICATE' => 'La creación de esta cuenta puede producir una cuenta duplicada. Puede elegir una cuenta existente de la lista inferior o hacer clic en Guardar para continuar la creación de una nueva cuenta con los datos introducidos previamente.',
    'MSG_SHOW_DUPLICATES' => 'El registro de cuenta que está a punto de crear podría ser un duplicado de una cuenta que ya existe. Las cuentas que contienen nombres similares se listan a continuación.<br>Haga clic en Crear Cuenta para seguir con la creación de esta nueva cuenta, o haga clic en Cancelar para volver al módulo sin crear la cuenta.',
    'LBL_ASSIGNED_USER_NAME' => 'Asignado a:',
    'LBL_PROSPECT_LIST' => 'Lista de Público Objetivo',
    'LBL_ACCOUNTS_SUBPANEL_TITLE' => 'Cuentas',
    'LBL_PROJECT_SUBPANEL_TITLE' => 'Projects',
    //For export labels
    'LBL_PARENT_ID' => 'Parent ID',
    // SNIP
    'LBL_PRODUCTS_SERVICES_PURCHASED_SUBPANEL_TITLE' => 'Productos y servicios adquiridos',

    'LBL_AOS_CONTRACTS' => 'Contracts',
    'LBL_AOS_INVOICES' => 'Invoices',
    'LBL_AOS_QUOTES' => 'Presupuestos',
    'LBL_LIST_WEBSITE' => 'Página web',
);
