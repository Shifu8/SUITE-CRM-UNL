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


    'LBL_RE' => 'RE:',

    'ERR_BAD_LOGIN_PASSWORD' => 'Usuario o contraseña incorrecta',
    'ERR_INI_ZLIB' => 'No pudo deshabilitarse la compresión Zlib temporalmente.  Puede que "Comprobar Configuración" falle.',
    'ERR_NO_IMAP' => 'No se han encontrado las librerías de IMAP.  Por favor, resuelva esto antes de continuar con la configuración de correo entrante',
    'ERR_NO_OPTS_SAVED' => 'No se han guardado valores óptimos con su cuenta de correo entrante.  Por favor, revise la configuración',
    'ERR_TEST_MAILBOX' => 'Por favor, compruebe su configuración e inténtelo de nuevo.',
    'ERR_INVALID_PORT' => 'Puerto inválido',

    'LBL_ASSIGN_TO_USER' => 'Asignar a Usuario',
    'LBL_AUTOREPLY' => 'Plantilla de Respuesta Automática',
    'LBL_AUTOREPLY_HELP' => 'Seleccione una respuesta automática para notificar a los remitentes de correo que su respuesta ha sido recibida.',
    'LBL_BASIC' => 'Información de la Cuenta de Correo',
    'LBL_CASE_MACRO' => 'Case Macro',
    'LBL_CASE_MACRO_DESC' => 'Set the macro which will be parsed and used to link imported email to a Case.',
    'LBL_CASE_MACRO_DESC2' => 'Set this to any value, but preserve the <b>"%1"</b>.',
    'LBL_CLOSE_POPUP' => 'Cerrar Ventana',
    'LBL_CREATE_TEMPLATE' => 'Nuevo',
    'LBL_DELETE_SEEN' => 'Eliminar Emails Leídos Tras Importación',
    'LBL_EDIT_TEMPLATE' => 'Editar',
    'LBL_EMAIL_OPTIONS' => 'Opciones de Gestión de Correo',
    'LBL_EMAIL_BOUNCE_OPTIONS' => 'Opciones de Gestión de Rebotes',
    'LBL_FILTER_DOMAIN_DESC' => 'Especificar un dominio al cual no se enviarán respuestas automáticas.',
    'LBL_ASSIGN_TO_GROUP_FOLDER_DESC' => 'Seleccione esta opción para se creen automáticamente registros de correo en SuiteCRM para todos los correos entrantes.',
    'LBL_FILTER_DOMAIN' => 'No enviar Respuestas Automáticas a este Dominio',
    'LBL_FIND_SSL_WARN' => '<br>La comprobación de SSL puede durar bastante tiempo.  Por favor, tenga paciencia.<br>',
    'LBL_FROM_ADDR' => 'Dirección del Remitente',
    'LBL_FROM_ADDR_DESC' => 'La dirección de correo electrónico indicada aquí podría no aparecer en el campo &quot;De&quot; del correo electrónico enviado debido a las restricciones impuestas por el proveedor de servicios de correo electrónico. En estas circunstancias, se utilizará la dirección de correo electrónico definida en el servidor de correo saliente.', // as long as XTemplate doesn't support output escaping, transform quotes to html-entities right here (bug #48913)
    'LBL_FROM_NAME' => 'Nombre del remitente',
    'LBL_GROUP_QUEUE' => 'Asignar a Grupo',
    'LBL_HOME' => 'Inicio',
    'LBL_LIST_MAILBOX_TYPE' => 'Utilización de la Cuenta de Correo',
    'LBL_LIST_NAME' => 'Nombre:',
    'LBL_LIST_GLOBAL_PERSONAL' => 'Type',
    'LBL_LIST_SERVER_URL' => 'Servidor de Correo',
    'LBL_SERVER_ADDRESS' => 'Dirección del servidor',
    'LBL_LIST_STATUS' => 'Estado',
    'LBL_LOGIN' => 'User Name',
    'LBL_USERNAME' => 'User Name',
    'LBL_MAILBOX_DEFAULT' => 'INBOX',
    'LBL_MAILBOX_SSL' => 'Use SSL',
    'LBL_MAILBOX_TYPE' => 'Acciones Posibles',
    'LBL_DISTRIBUTION_METHOD' => 'Método de Distribución',
    'LBL_CREATE_CASE_REPLY_TEMPLATE' => 'Nueva Plantilla de Respuesta Automática para Caso',
    'LBL_CREATE_CASE_REPLY_TEMPLATE_HELP' => 'Seleccione una respuesta automática para notificar a los remitentes de correo que se ha creado un nuevo caso. El correo contiene el número de caso en la línea de Asunto acorde con la configuración de la Macro de Caso.  Esta respuesta sólo se enviará cuando se reciba el primer correo de un remitente.',
    'LBL_MAILBOX' => 'Carpetas Monitorizadas',
    'LBL_TRASH_FOLDER' => 'Papelera',
    'LBL_SENT_FOLDER' => 'Elementos Enviados',
    'LBL_SELECT' => 'Select',
    'LBL_MARK_READ_NO' => 'Email marcado como borrado tras importación',
    'LBL_MARK_READ_YES' => 'Email dejado en el servidor tras importación',
    'LBL_MARK_READ' => 'Dejar mensajes en el servidor',
    'LBL_MAX_AUTO_REPLIES' => 'Número de respuestas automáticas',
    'LBL_MAX_AUTO_REPLIES_DESC' => 'Establece el máximo número de respuestas automáticas a enviar a una única dirección de correo durante un período de 24 horas.',
    'LBL_PERSONAL_MODULE_NAME' => 'Cuenta de Correo Personal',
    'LBL_CREATE_CASE' => 'Crear Caso desde Correo',
    'LBL_CREATE_CASE_HELP' => 'Seleccione esta opción para crear automáticamente registros de casos en SuiteCRM a partir de correos entrantes.',
    'LBL_MODULE_NAME' => 'Cuentas de Email Entrante',
    'LBL_BOUNCE_MODULE_NAME' => 'Bandeja de Gestión de Correo Rebotado',
    'LBL_MODULE_TITLE' => 'Cuentas de Email Entrante',
    'LBL_NAME' => 'Nombre',
    'LBL_NONE' => 'None',
    'LBL_ONLY_SINCE_NO' => 'No. Comprobar contra todos los correos en el servidor de correo.',
    'LBL_ONLY_SINCE_YES' => 'Sí.',
    'LBL_PASSWORD' => 'Password',
    'LBL_EMAIL_PASSWORD' => 'Password',
    'LBL_POP3_SUCCESS' => 'Su prueba de conexión de POP3 tuvo éxito.',
    'LBL_POPUP_TITLE' => 'Test Settings',
    'LBL_SELECT_SUBSCRIBED_FOLDERS' => 'Seleccionar Carpetas Suscritas',
    'LBL_SELECT_TRASH_FOLDERS' => 'Seleccionar Papelera',
    'LBL_SELECT_SENT_FOLDERS' => 'Seleccionar Carpeta de Elementos Enviados',
    'LBL_DELETED_FOLDERS_LIST' => 'Las siguientes carpetas %s o no existen o han sido eliminadas del servidor',
    'LBL_PORT' => 'Mail Server Port',
    'LBL_REPLY_TO_NAME' => 'Nombre de "Responder A"',
    'LBL_REPLY_TO_ADDR' => 'Dirección de "Responder A"',
    'LBL_SAME_AS_ABOVE' => 'Usando el mismo Nombre/Dirección',
    'LBL_SERVER_OPTIONS' => 'Configuración Avanzada',
    'LBL_SERVER_TYPE' => 'Mail Server Protocol',
    'LBL_SERVER_PORT' => 'Mail Server Port',
    'LBL_SERVER_URL' => 'Mail Server Address',
    'LBL_SSL_DESC' => 'If your mail server supports secure socket connections, enabling this will force SSL connections when importing email.',
    'LBL_ASSIGN_TO_TEAM_DESC' => 'El equipo seleccionado tiene acceso a la cuenta de correo.',
    'LBL_SSL' => 'Use SSL',
    'LBL_STATUS' => 'Estado',
    'LBL_EMAIL_BODY_FILTERING' => 'Tipo de filtro de cuerpo de correo',
    'LBL_SYSTEM_DEFAULT' => 'System Default',
    'LBL_TEST_BUTTON_TITLE' => 'Test',
    'LBL_TEST_SETTINGS' => 'Test Settings',
    'LBL_TEST_CONNECTION_SETTINGS' => 'Probar configuración de conexión',
    'LBL_TEST_SUCCESSFUL' => 'Conexión completada con éxito.',
    'LBL_TEST_WAIT_MESSAGE' => 'One moment please...',
    'LBL_WARN_IMAP_TITLE' => 'Correo Entrante Deshabilitado',
    'LBL_WARN_IMAP' => 'Avisos:',
    'LBL_WARN_NO_IMAP' => 'El Correo Entrante <b>no puede</b> funcionar sin las librerías de C del cliente de IMAP habilitadas/compiladas en el módulo de PHP.  Por favor, contacte con su administrador para resolver este problema.',

    'LNK_LIST_CREATE_NEW_PERSONAL' => 'Nueva cuenta personal',
    'LNK_LIST_CREATE_NEW_GROUP' => 'Nueva cuenta de grupo',
    'LNK_LIST_CREATE_NEW_CASES_TYPE' => 'Nuevo tipo de caso',
    'LNK_LIST_CREATE_NEW_BOUNCE' => 'Nueva cuenta de gestión de rebotes',
    'LNK_LIST_MAILBOXES' => 'Cuentas de Email Entrante',
    'LNK_LIST_OUTBOUND_EMAILS' => 'Outbound Email Accounts',
    'LNK_LIST_SCHEDULER' => 'Schedulers',
    'LNK_SEED_QUEUES' => 'Crear Cabeza de Serie para Colas de Equipos',
    'LBL_GROUPFOLDER_ID' => 'Id de Carpeta de Grupo',

    'LBL_ALLOW_OUTBOUND_GROUP_USAGE' => 'Permitir que los usuarios envíen correo usando el Nombre y la Dirección del campo "De" como dirección de respuesta',
    'LBL_ALLOW_OUTBOUND_GROUP_USAGE_DESC' => 'Cuando se selecciona esta opción, el Nombre y Dirección del remitente asociados a la cuenta de correo de este grupo aparecerán como una opción para el campo "De" al escribir un correo para los usuarios que tengan acceso a la cuenta de correo del grupo.',
    'LBL_STATUS_ACTIVE' => 'Active',
    'LBL_STATUS_INACTIVE' => 'Inactive',
    'LBL_IS_PERSONAL' => 'Personal',
    'LBL_IS_GROUP' => 'group',
    'LBL_ENABLE_AUTO_IMPORT' => 'Importar Correos Automáticamente',
    'LBL_WARNING_CHANGING_AUTO_IMPORT' => 'Aviso: Está modificando su configuración de importación automática lo cual puede provocar pérdida de datos.',
    'LBL_WARNING_CHANGING_AUTO_IMPORT_WITH_CREATE_CASE' => 'Aviso: La importación automática debe estar habilitada para la creación automática de casos.',
    'LBL_LIST_TITLE_MY_DRAFTS' => 'Borradores',
    'LBL_LIST_TITLE_MY_INBOX' => 'Bandeja de entrada',
    'LBL_LIST_TITLE_MY_SENT' => 'Sent Email',
    'LBL_LIST_TITLE_MY_ARCHIVES' => 'Archived Emails',
    'LNK_MY_DRAFTS' => 'Borradores',
    'LNK_MY_INBOX' => 'Email',
    'LNK_VIEW_MY_INBOX' => 'Ver Email',
    'LNK_QUICK_REPLY' => 'Reply',
    'LNK_SENT_EMAIL_LIST' => 'Sent Emails',
    'LBL_EDIT_LAYOUT' => 'Edit Layout' /*for 508 compliance fix*/,
    'LBL_TYPE_DIFFERENT' => 'External OAuth Connection type must be the SAME as the Inbound Email Account type',

    'LBL_MODIFIED_BY' => 'Modificado Por',
    'LBL_SERVICE' => 'Service',
    'LBL_STORED_OPTIONS' => 'Opciones Almacenadas',
    'LBL_GROUP_ID' => 'Grupo ID',

    'LBL_OUTBOUND_CONFIGURATION' => 'Configuración saliente',
    'LBL_CONNECTION_CONFIGURATION' => 'Configuración del servidor',
    'LBL_AUTO_REPLY_CONFIGURATION' => 'Configuración de respuesta automática',
    'LBL_CASE_CONFIGURATION' => 'Configuración del caso',
    'LBL_GROUP_CONFIGURATION' => 'Configuración del grupo',

    'LBL_SECURITYGROUPS_SUBPANEL_TITLE' => 'Grupos de Seguridad',


    'LBL_OUTBOUND_EMAIL_ACCOUNT' => 'Cuenta de correo saliente',
    'LBL_OUTBOUND_EMAIL_ACCOUNT_ID' => 'ID de cuenta de correo saliente',
    'LBL_OUTBOUND_EMAIL_ACCOUNT_NAME' => 'Cuenta de correo saliente',

    'LBL_AUTOREPLY_EMAIL_TEMPLATE' => 'Plantilla de respuesta automática',
    'LBL_AUTOREPLY_EMAIL_TEMPLATE_ID' => 'Id de plantilla de respuesta automática',
    'LBL_AUTOREPLY_EMAIL_TEMPLATE_NAME' => 'Plantilla de respuesta automática',

    'LBL_CASE_EMAIL_TEMPLATE' => 'Plantilla de Email de Caso',
    'LBL_CASE_EMAIL_TEMPLATE_ID' => 'ID de plantilla de Email de Caso',
    'LBL_CASE_EMAIL_TEMPLATE_NAME' => 'Plantilla de Email de Caso',

    'LBL_PROTOCOL' => 'Protocolo',
    'LBL_CONNECTION_STRING' => 'Cadena de conexión',
    'LBL_DISTRIB_METHOD' => 'Distribution Method',
    'LBL_DISTRIB_OPTIONS' => 'Opciones de distribución',

    'LBL_DISTRIBUTION_USER' => 'Usuario de Distribución',
    'LBL_DISTRIBUTION_USER_ID' => 'Id de Usuario de Distribución',
    'LBL_DISTRIBUTION_USER_NAME' => 'Usuario de Distribución',

    'LBL_EXTERNAL_OAUTH_CONNECTION' => 'Conexión OAuth externa',
    'LBL_EXTERNAL_OAUTH_CONNECTION_ID' => 'Id de conexión OAuth Externo',
    'LBL_EXTERNAL_OAUTH_CONNECTION_NAME' => 'Conexión OAuth externa',
    'LNK_EXTERNAL_OAUTH_CONNECTIONS' => 'Conexiones externas mediante OAuth',

    'LBL_TYPE' => 'Type',
    'LBL_AUTH_TYPE' => 'Tipo de autenticación',
    'LBL_IS_DEFAULT' => 'Por Defecto',
    'LBL_SIGNATURE' => 'Firma',

    'LBL_OWNER_NAME' => 'Owner',

    'LBL_SET_AS_DEFAULT_BUTTON' => 'Establecer por defecto',

    'LBL_MOVE_MESSAGES_TO_TRASH_AFTER_IMPORT' => '¿Mover mensajes a la papelera después de importar?',
    'LBL_LAST_IMPORT_RUN_DATETIME' => 'Last Import Run Date/Time',
    'LBL_MAILBOX_LAST_IMPORTED_DAYS' => 'Last Imported Date Per Mailbox',
    'LBL_EMAIL_IMPORT_PER_RUN_THRESHOLD' => 'Emails to Import Per Run',
    'LBL_EMAIL_IMPORT_TIMEFRAME_START' => 'Import Timeframe Start',
    'LBL_EMAIL_IMPORT_UNREAD_ONLY' => 'Import Unread Emails Only'
);
