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
    'ERR_DELETE_RECORD' => 'Debe especificar un registro para borrarlo de la cuenta.',
    'LBL_ACCOUNT_NAME' => 'Nombre de Compañía:',
    'LBL_ACCOUNT' => 'Compañía:',
    'LBL_ACTIVITIES_SUBPANEL_TITLE' => 'Actividades',
    'LBL_ADDRESS_INFORMATION' => 'Información de Dirección',
    'LBL_ANNUAL_REVENUE' => 'Ingreso Anual:',
    'LBL_ANY_ADDRESS' => 'Cualquier Dirección:',
    'LBL_ANY_EMAIL' => 'Cualquier Correo:',
    'LBL_EMAIL_NON_PRIMARY' => 'Correos Electrónicos No Principales',
    'LBL_ANY_PHONE' => 'Cualquier Teléfono:',
    'LBL_ASSIGNED_TO_NAME' => 'Usuario:',
    'LBL_RATING' => 'Clasificación',
    'LBL_ASSIGNED_TO' => 'Asignado a:',
    'LBL_ASSIGNED_USER' => 'Asignado a:',
    'LBL_ASSIGNED_TO_ID' => 'Asignado a:',
    'LBL_BILLING_ADDRESS_CITY' => 'Ciudad de Facturación:',
    'LBL_BILLING_ADDRESS_COUNTRY' => 'País de Facturación:',
    'LBL_BILLING_ADDRESS_POSTALCODE' => 'Código Postal de Facturación:',
    'LBL_BILLING_ADDRESS_STATE' => 'Estado de Facturación:',
    'LBL_BILLING_ADDRESS_STREET_2' => 'Calle de Facturación 2',
    'LBL_BILLING_ADDRESS_STREET_3' => 'Calle de Facturación 3',
    'LBL_BILLING_ADDRESS_STREET_4' => 'Calle de Facturación 4',
    'LBL_BILLING_ADDRESS_STREET' => 'Calle de Facturación:',
    'LBL_BILLING_ADDRESS' => 'Dirección de Facturación:',
    'LBL_ACCOUNT_INFORMATION' => 'Información de la Compañía',
    'LBL_CITY' => 'Ciudad:',
    'LBL_CONTACTS_SUBPANEL_TITLE' => 'Contactos',
    'LBL_COUNTRY' => 'País:',
    'LBL_DATE_ENTERED' => 'Fecha de Creación:',
    'LBL_DATE_MODIFIED' => 'Fecha de Modificación:',
    'LBL_DEFAULT_SUBPANEL_TITLE' => 'Cuentas',
    'LBL_DESCRIPTION_INFORMATION' => 'Información adicional',
    'LBL_DESCRIPTION' => 'Descripción:',
    'LBL_DUPLICATE' => 'Posible cuenta duplicada',
    'LBL_EMAIL' => 'Correo electrónico:',
    'LBL_EMPLOYEES' => 'Empleados:',
    'LBL_FAX' => 'Fax:',
    'LBL_INDUSTRY' => 'Industria:',
    'LBL_LIST_ACCOUNT_NAME' => 'Nombre de Cuenta',
    'LBL_LIST_CITY' => 'Ciudad',
    'LBL_LIST_EMAIL_ADDRESS' => 'Dirección de Email',
    'LBL_LIST_PHONE' => 'Teléfono',
    'LBL_LIST_STATE' => 'Estado',
    'LBL_MEMBER_OF' => 'Miembro de:',
    'LBL_MEMBER_ORG_SUBPANEL_TITLE' => 'Miembro de Organizaciones',
    'LBL_NAME' => 'Nombre:',
    'LBL_OTHER_EMAIL_ADDRESS' => 'Otro Email:',
    'LBL_OTHER_PHONE' => 'Otro Teléfono:',
    'LBL_OWNERSHIP' => 'Propiedad:',
    'LBL_PARENT_ACCOUNT_ID' => 'ID de cuenta Matriz',
    'LBL_PHONE_ALT' => 'Teléfono Alternativo:',
    'LBL_PHONE_FAX' => 'Teléfono de Fax:',
    'LBL_PHONE_OFFICE' => 'Teléfono oficina:',
    'LBL_PHONE' => 'Teléfono:',
    'LBL_EMAIL_ADDRESS' => 'Email Address',
    'LBL_EMAIL_ADDRESSES' => 'Direcciones de Email',
    'LBL_POSTAL_CODE' => 'Código Postal:',
    'LBL_SAVE_ACCOUNT' => 'Guardar Cuenta',
    'LBL_SHIPPING_ADDRESS_CITY' => 'Ciudad de Envío:',
    'LBL_SHIPPING_ADDRESS_COUNTRY' => 'País de Envío:',
    'LBL_SHIPPING_ADDRESS_POSTALCODE' => 'Código Postal de Envío:',
    'LBL_SHIPPING_ADDRESS_STATE' => 'Estado de Envío:',
    'LBL_SHIPPING_ADDRESS_STREET_2' => 'Calle de Envío 2',
    'LBL_SHIPPING_ADDRESS_STREET_3' => 'Calle de Envío 3',
    'LBL_SHIPPING_ADDRESS_STREET_4' => 'Calle de Envío 4',
    'LBL_SHIPPING_ADDRESS_STREET' => 'Calle de Envío:',
    'LBL_SHIPPING_ADDRESS' => 'Calle de Envío:',

    'LBL_STATE' => 'Estado:',
    'LBL_TICKER_SYMBOL' => 'Símbolo Ticker:',
    'LBL_TYPE' => 'Tipo:',
    'LBL_WEBSITE' => 'Sitio Web:',

    'LNK_ACCOUNT_LIST' => 'Cuentas',
    'LNK_NEW_ACCOUNT' => 'Crear una cuenta',

    'MSG_DUPLICATE' => 'El registro para la cuenta que va a crear podría ser un duplicado de otro registro de cuenta existente. Los registros de cuenta con nombres similares se listan a continuación.<br>Haga clic en Guardar para continuar con la creación de esta cuenta, o en Cancelar para volver al módulo sin crear la cuenta.',
    'MSG_SHOW_DUPLICATES' => 'El registro para la cuenta que va a crear podría ser un duplicado de otro registro de cuenta existente. Los registros de cuenta con nombres similares se listan a continuación.<br>Haga clic en Guardar para continuar con la creación de esta cuenta, o en Cancelar para volver al módulo sin crear la cuenta.',

    'NTC_DELETE_CONFIRMATION' => '¿Está seguro de que desea eliminar este registro?',

    'LBL_EDIT_BUTTON' => 'Editar',
    'LBL_REMOVE' => 'Quitar',

);
