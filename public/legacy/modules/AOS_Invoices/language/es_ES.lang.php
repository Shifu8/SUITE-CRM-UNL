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
    'LBL_NAME' => 'Titulo',
    'LBL_CREATED_USER' => 'Creado por el Usuario',
    'LBL_MODIFIED_USER' => 'Modificado por el Usuario',
    'ERR_DELETE_RECORD' => 'A record number must be specified to delete the account.',
    'LBL_ACCOUNT_NAME' => 'Titulo',
    'LBL_ACCOUNT' => 'Compañía:',
    'LBL_ACTIVITIES_SUBPANEL_TITLE' => 'Activities',
    'LBL_ADDRESS_INFORMATION' => 'Información de Dirección',
    'LBL_ANNUAL_REVENUE' => 'Annual Revenue:',
    'LBL_ANY_ADDRESS' => 'Any Address:',
    'LBL_ANY_EMAIL' => 'Cualquier Correo:',
    'LBL_ANY_PHONE' => 'Any Phone:',
    'LBL_RATING' => 'Rating',
    'LBL_ASSIGNED_USER' => 'Usuario',
    'LBL_BILLING_ADDRESS_CITY' => 'Ciudad de Facturación:',
    'LBL_BILLING_ADDRESS_COUNTRY' => 'País de Facturación:',
    'LBL_BILLING_ADDRESS_POSTALCODE' => 'CP de Dirección de Facturación:',
    'LBL_BILLING_ADDRESS_STATE' => 'Estado/Provincia de Dirección de Facturación:',
    'LBL_BILLING_ADDRESS_STREET_2' => 'Calle de Dirección de Facturación 2',
    'LBL_BILLING_ADDRESS_STREET_3' => 'Calle de Dirección de Facturación 3',
    'LBL_BILLING_ADDRESS_STREET_4' => 'Calle de Dirección de Facturación 4',
    'LBL_BILLING_ADDRESS_STREET' => 'Billing Street:',
    'LBL_BILLING_ADDRESS' => 'Billing Address:',
    'LBL_ACCOUNT_INFORMATION' => 'Visión Global',
    'LBL_CITY' => 'City:',
    'LBL_CONTACTS_SUBPANEL_TITLE' => 'Contactos',
    'LBL_COUNTRY' => 'Country:',
    'LBL_DEFAULT_SUBPANEL_TITLE' => 'Cuentas',
    'LBL_DUPLICATE' => 'Possible Duplicate Account',
    'LBL_EMAIL' => 'Correo:',
    'LBL_EMPLOYEES' => 'Employees:',
    'LBL_FAX' => 'Fax:',
    'LBL_INDUSTRY' => 'Industry:',
    'LBL_LIST_ACCOUNT_NAME' => 'Nombre de Cuenta',
    'LBL_LIST_CITY' => 'City',
    'LBL_LIST_EMAIL_ADDRESS' => 'Email Address',
    'LBL_LIST_PHONE' => 'Phone',
    'LBL_LIST_STATE' => 'Estado',
    'LBL_MEMBER_OF' => 'Member of:',
    'LBL_MEMBER_ORG_SUBPANEL_TITLE' => 'Member Organizations',
    'LBL_OTHER_EMAIL_ADDRESS' => 'Other Email:',
    'LBL_OTHER_PHONE' => 'Other Phone:',
    'LBL_OWNERSHIP' => 'Ownership:',
    'LBL_PARENT_ACCOUNT_ID' => 'Parent Account ID',
    'LBL_PHONE_ALT' => 'Alternate Phone:',
    'LBL_PHONE_FAX' => 'Phone Fax:',
    'LBL_PHONE_OFFICE' => 'Phone Office:',
    'LBL_PHONE' => 'Phone:',
    'LBL_POSTAL_CODE' => 'Postal Code:',
    'LBL_SAVE_ACCOUNT' => 'Save Account',
    'LBL_SHIPPING_ADDRESS_CITY' => 'Shipping City:',
    'LBL_SHIPPING_ADDRESS_COUNTRY' => 'Shipping Country:',
    'LBL_SHIPPING_ADDRESS_POSTALCODE' => 'Shipping Postal Code:',
    'LBL_SHIPPING_ADDRESS_STATE' => 'Shipping State:',
    'LBL_SHIPPING_ADDRESS_STREET_2' => 'Shipping Street 2',
    'LBL_SHIPPING_ADDRESS_STREET_3' => 'Shipping Street 3',
    'LBL_SHIPPING_ADDRESS_STREET_4' => 'Shipping Street 4',
    'LBL_SHIPPING_ADDRESS_STREET' => 'Shipping Street:',
    'LBL_SHIPPING_ADDRESS' => 'Shipping Address:',
    'LBL_STATE' => 'Estado o región:',
    'LBL_TICKER_SYMBOL' => 'Ticker Symbol:',
    'LBL_TYPE' => 'Type:',
    'LBL_WEBSITE' => 'Website:',
    'LNK_ACCOUNT_LIST' => 'Cuentas',
    'LNK_NEW_ACCOUNT' => 'Crear una cuenta',
    'MSG_DUPLICATE' => 'Crear esta cuenta puede potencialmente crear un duplicado. Usted puede seleccionar una cuenta de la lista de abajo o puede dar click en Guardar para continuar creando una nueva cuenta con la información previamente ingresada.',
    'MSG_SHOW_DUPLICATES' => 'Crear esta cuenta puede potencialmente crear un duplicado. Usted puede dar click en Guardar para continuar creando una nueva cuenta con la información previamente ingresada o usted puede dar click en Cancelar.',
    'NTC_DELETE_CONFIRMATION' => 'Are you sure you want to delete this record?',
    'LBL_LIST_FORM_TITLE' => 'Lista de Facturas',
    'LBL_MODULE_NAME' => 'Invoices',
    'LBL_MODULE_TITLE' => 'Facturas',
    'LBL_HOMEPAGE_TITLE' => 'Mis Facturas',
    'LNK_NEW_RECORD' => 'Crear Factura',
    'LNK_LIST' => 'Facturas',
    'LBL_SEARCH_FORM_TITLE' => ' Buscar Facturas',
    'LBL_HISTORY_SUBPANEL_TITLE' => 'View History',
    'LBL_NEW_FORM_TITLE' => 'Nueva Factura',
    'LBL_TERMS_C' => 'Terminos',
    'LBL_APPROVAL_ISSUE' => 'Incidencias de Aprobación',
    'LBL_APPROVAL_STATUS' => 'Estado de Aprobación',
    'LBL_BILLING_ACCOUNT' => 'Account',
    'LBL_BILLING_CONTACT' => 'Contact',
    'LBL_EXPIRATION' => 'Válida Hasta',
    'LBL_INVOICE_NUMBER' => 'Número de Factura',
    'LBL_OPPORTUNITY' => 'Nombre de la oportunidad',
    'LBL_TEMPLATE_DDOWN_C' => 'Formatos de Facturas',
    'LBL_STAGE' => 'Etapa de Cotiazación',
    'LBL_TERM' => 'Términos de Pago',
    'LBL_SUBTOTAL_AMOUNT' => 'Subtotal',
    'LBL_DISCOUNT_AMOUNT' => 'Discount',
    'LBL_TAX_AMOUNT' => 'Tax',
    'LBL_SHIPPING_AMOUNT' => 'Shipping',
    'LBL_TOTAL_AMT' => 'Total',
    'VALUE' => 'Titulo',
    'LBL_EMAIL_ADDRESSES' => 'Direcciones de Email',
    'LBL_LINE_ITEMS' => 'Items de Línea',
    'LBL_GRAND_TOTAL' => 'Grand Total',
    'LBL_QUOTE_NUMBER' => 'Número de Cotización',
    'LBL_QUOTE_DATE' => 'Fecha de Cotización',
    'LBL_INVOICE_DATE' => 'Fecha de Facturación',
    'LBL_DUE_DATE' => 'Fecha de Vencimiento',
    'LBL_STATUS' => 'Estado',
    'LBL_INVOICE_STATUS' => 'Estado de la Factura',
    'LBL_PRODUCT_QUANITY' => 'Quantity',
    'LBL_PRODUCT_NAME' => 'Product',
    'LBL_PART_NUMBER' => 'Part Number',
    'LBL_PRODUCT_NOTE' => 'Note',
    'LBL_PRODUCT_DESCRIPTION' => 'Descripción',
    'LBL_LIST_PRICE' => 'List',
    'LBL_DISCOUNT_AMT' => 'Discount',
    'LBL_UNIT_PRICE' => 'Sale Price',
    'LBL_TOTAL_PRICE' => 'Total',
    'LBL_VAT' => 'Tax', //VAT
    'LBL_VAT_AMT' => 'Tax Amount', //VAT
    'LBL_ADD_PRODUCT_LINE' => 'Add Product Line',
    'LBL_SERVICE_NAME' => 'Service',
    'LBL_SERVICE_LIST_PRICE' => 'List',
    'LBL_SERVICE_PRICE' => 'Sale Price',
    'LBL_SERVICE_DISCOUNT' => 'Discount',
    'LBL_ADD_SERVICE_LINE' => 'Add Service Line ',
    'LBL_REMOVE_PRODUCT_LINE' => 'Quitar',
    'LBL_PRINT_AS_PDF' => 'Print as PDF',
    'LBL_EMAIL_INVOICE' => 'Enviar Factura por Email',
    'LBL_LIST_NUM' => 'No.',
    'LBL_PDF_NAME' => 'Invoice',
    'LBL_EMAIL_NAME' => 'Factura para',
    'LBL_NO_TEMPLATE' => 'ERROR\nPor favor seleccione un formato editando la Factura y seleccionando un formato de Factura\nSi usted no ha creado un formato de Factura, vaya al módulo de Formatos PDF y cree uno',
    'LBL_SUBTOTAL_TAX_AMOUNT' => 'Subtotal + Impuestos',//pre shipping
    'LBL_EMAIL_PDF' => 'Email PDF',
    'LBL_ADD_GROUP' => 'Add Group',
    'LBL_DELETE_GROUP' => 'Delete Group',
    'LBL_GROUP_NAME' => 'Group Name',
    'LBL_GROUP_TOTAL' => 'Group Total',
    'LBL_SHIPPING_TAX' => 'Shipping Tax',
    'LBL_SHIPPING_TAX_AMT' => 'Shipping Tax',
    'LBL_IMPORT_LINE_ITEMS' => 'Importar Items de Línea',
    'LBL_SUBTOTAL_AMOUNT_USDOLLAR' => 'Subtotal (Default Currency)',
    'LBL_DISCOUNT_AMOUNT_USDOLLAR' => 'Discount (Default Currency)',
    'LBL_TAX_AMOUNT_USDOLLAR' => 'Tax (Default Currency)',
    'LBL_SHIPPING_AMOUNT_USDOLLAR' => 'Shipping (Default Currency)',
    'LBL_TOTAL_AMT_USDOLLAR' => 'Total (Default Currency)',
    'LBL_SHIPPING_TAX_AMT_USDOLLAR' => 'Shipping Tax (Default Currency)',
    'LBL_GRAND_TOTAL_USDOLLAR' => 'Grand Total (Default Currency)',
    'LBL_INVOICE_TO' => 'Factura a',
    'LBL_AOS_LINE_ITEM_GROUPS' => 'Line Item Groups',
    'LBL_AOS_PRODUCT_QUOTES' => 'Cotizaciones de Productos',
    'LBL_AOS_QUOTES_AOS_INVOICES' => 'Cotizaciones: Facturas',
);
