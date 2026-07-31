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
    'LBL_LIST_FORM_TITLE' => 'Lista de cuentas de correo electrónico saliente',
    'LBL_MODULE_NAME' => 'Outbound Email Accounts',
    'LBL_MODULE_TITLE' => 'Outbound Email Accounts',
    'LBL_HOMEPAGE_TITLE' => 'Mis cuentas de correo electrónico saliente',
    'LNK_NEW_RECORD' => 'Crear cuentas de correo electrónico saliente',

    'LNK_LIST_CREATE_NEW_PERSONAL' => 'Nueva cuenta personal',
    'LNK_LIST_CREATE_NEW_GROUP' => 'Nueva cuenta de grupo',
    'LNK_LIST_CREATE_SYSTEM_OVERRIDE_GROUP' => 'Nueva cuenta de correo electrónico saliente del sistema',

    'LNK_LIST' => 'Outbound Email Accounts',
    'LNK_LIST_INBOUND_EMAIL_ACCOUNTS' => 'Cuentas de Email Entrante',
    'LBL_SEARCH_FORM_TITLE' => 'Buscar cuentas de correo electrónico saliente',
    'LBL_HISTORY_SUBPANEL_TITLE' => 'View History',
    'LBL_ACTIVITIES_SUBPANEL_TITLE' => 'Activities',
    'LBL_NEW_FORM_TITLE' => 'Nueva cuenta de correo electrónico saliente',
    'LBL_USERNAME' => 'Username',
    'LBL_PASSWORD' => 'Password',
    'LBL_SMTP_SERVERNAME' => 'Servidor SMTP',
    'LBL_SMTP_AUTH' => 'Autentificación SMTP',
    'LBL_SMTP_PORT' => 'SMTP Port',
    'LBL_SMTP_PROTOCOL' => 'Protocolo SMTP',
    'LBL_EDITVIEW_PANEL1' => 'Configuración de cuenta',
    'LBL_OUTBOUND_CONFIGURATION' => 'Configuración saliente',
    'LBL_CONNECTION_CONFIGURATION' => 'Configuración del servidor',
    'LBL_CHANGE_PASSWORD' => 'Change password',
    'LBL_SEND_TEST_EMAIL' => 'Send Test Email',

    // for outbound email dialog
    'LBL_MISSING_DEFAULT_OUTBOUND_SMTP_SETTINGS' => 'The administrator has not yet configured the default outbound account. Unable to send test email.',
    'LBL_MAIL_SMTPAUTH_REQ' => 'Use SMTP Authentication?',
    'LBL_MAIL_SMTPPASS' => 'Password',
    'LBL_MAIL_SMTPPORT' => 'Port',
    'LBL_MAIL_SMTPSERVER' => 'Servidor',
    'LBL_MAIL_SMTPUSER' => 'Username',
    'LBL_MAIL_SMTP_SETTINGS' => 'SMTP Server Specification',
    'LBL_CHOOSE_EMAIL_PROVIDER' => 'Choose your Email provider:',
    'LBL_YAHOOMAIL_SMTPPASS' => 'Yahoo! Mail Password:',
    'LBL_YAHOOMAIL_SMTPUSER' => 'Yahoo! Mail ID:',
    'LBL_GMAIL_SMTPPASS' => 'Gmail Password:',
    'LBL_GMAIL_SMTPUSER' => 'Gmail Email Address:',
    'LBL_EXCHANGE_SMTPPASS' => 'Exchange Password:',
    'LBL_EXCHANGE_SMTPUSER' => 'Exchange Username:',
    'LBL_EXCHANGE_SMTPPORT' => 'Exchange Server Port:',
    'LBL_EXCHANGE_SMTPSERVER' => 'Exchange Server:',

    'LBL_TYPE' => 'Type',
    'LBL_MAIL_SENDTYPE' => 'Mode de envío de mail',
    'LBL_MAIL_SMTPSSL' => 'Mail SMTP/SSL',
    'LBL_SMTP_FROM_NAME' => 'Nombre del remitente',
    'LBL_SMTP_FROM_ADDR' => 'Dirección del Remitente',
    'LBL_REPLY_TO_NAME' => 'Nombre de "Responder a"',
    'LBL_REPLY_TO_ADDR' => 'Dirección de "Responder a"',

    'LBL_SECURITYGROUPS_SUBPANEL_TITLE' => 'Grupos de Seguridad',

    'LBL_OWNER' => 'Owner',
    'LBL_OWNER_NAME' => 'Owner',
    'LBL_IS_DEFAULT' => 'Por Defecto',
    'LBL_IS_PERSONAL' => 'Is Personal',
    'LBL_SET_AS_DEFAULT_BUTTON' => 'Establecer por defecto',

    'LBL_AUTH_TYPE' => 'Tipo de autenticación',

    'LBL_EXTERNAL_OAUTH_CONNECTION' => 'Conexión OAuth externa',
    'LBL_EXTERNAL_OAUTH_CONNECTION_ID' => 'Id de conexión OAuth Externo',
    'LBL_EXTERNAL_OAUTH_CONNECTION_NAME' => 'Conexión OAuth externa',
    'LNK_EXTERNAL_OAUTH_CONNECTIONS' => 'Conexiones externas mediante OAuth',

    'LBL_ERROR_OUTBOUND_EMAIL_SYSTEM_EXISTS' => 'System Outbound Email Account already exists. Please remove it before creating a new one.',
    'LBL_ERROR_OUTBOUND_EMAIL_SYSTEM_IS_NOT_GROUP' => 'When configuring the System Outbound account using OAuth, you must select a Group-Type External Oauth Connection',
    'LBL_ERROR_OUTBOUND_EMAIL_CONNECTION_TYPE_MISMATCH' => 'When configuring the Outbound account using OAuth, you must select a External Oauth Connection the same type as the Outbound Email Account (Group or Personal)',
);
