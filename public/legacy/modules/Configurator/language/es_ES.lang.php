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
    /*'ADMIN_EXPORT_ONLY'=>'Admin export only',*/
    'ADVANCED' => 'Advanced',
    'DEFAULT_CURRENCY_ISO4217' => 'Código de moneda ISO 4217',
    'DEFAULT_CURRENCY_NAME' => 'Nombre de Moneda',
    'DEFAULT_CURRENCY_SYMBOL' => 'Símbolo de moneda',
    'DEFAULT_DATE_FORMAT' => 'Formato de fecha predeterminado',
    'DEFAULT_DECIMAL_SEP' => 'Símbolo decimal',
    'DEFAULT_LANGUAGE' => 'Idioma predeterminado',
    'DEFAULT_SYSTEM_SETTINGS' => 'User Interface',
    'DEFAULT_THEME' => 'Default theme',
    'DEFAULT_TIME_FORMAT' => 'Formato de hora predeterminado',

    'DISPLAY_RESPONSE_TIME' => 'Mostrar los tiempos de respuesta del servidor',

    'IMAGES' => 'Logos',
    'LBL_ALLOW_USER_TABS' => 'Permitir a los usuarios ocultar pestañas',
    'LBL_CONFIGURE_SETTINGS_TITLE' => 'System Settings',
    'LBL_LOGVIEW' => 'Ver registro',
    'LBL_MAIL_SMTPAUTH_REQ' => 'Use SMTP Authentication?',
    'LBL_MAIL_SMTPPASS' => 'SMTP Password:',
    'LBL_MAIL_SMTPPORT' => 'SMTP Port:',
    'LBL_MAIL_SMTPSERVER' => 'SMTP Server:',
    'LBL_MAIL_SMTPUSER' => 'Nombre de Usuario SMTP:',
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
    'LBL_ALLOW_DEFAULT_SELECTION' => 'Allow users to use this account for outgoing email:',
    'LBL_ALLOW_DEFAULT_SELECTION_HELP' => 'When this option is selected, all users will be able to send emails using the same outgoing mail account used to send system notifications and alerts. If the option is not selected, users can still use the outgoing mail server after providing their own account information.',
    'LBL_MAILMERGE' => 'Mail Merge',
    'LBL_MIN_AUTO_REFRESH_INTERVAL' => 'Intervalo minimo de actualización del Dashlet',
    'LBL_MIN_AUTO_REFRESH_INTERVAL_HELP' => 'Este es el valor mínimo que uno puede elegir para la actualización automática de los dashlets. Ajustar a &#39;No&#39; desactiva que se actualicen automáticamente los dashlets.',
    'LBL_MODULE_FAVICON' => 'Mostrar el icono del módulo como un favicon',
    'LBL_MODULE_FAVICON_HELP' => 'Si está visitando un módulo con icono, utiliza el icono del módulo como favicon, en lugar del favicon del tema, en la pestaña del navegador.',
    'LBL_MODULE_NAME' => 'System Settings',
    'LBL_MODULE_ID' => 'Configurador',
    'LBL_MODULE_TITLE' => 'User Interface',
    'LBL_NOTIFY_FROMADDRESS' => 'Dirección del Remitente:',
    'LBL_NOTIFY_SUBJECT' => 'Email subject:',

    'LBL_PROXY_AUTH' => 'Authentication?',
    'LBL_PROXY_HOST' => 'Proxy Host',
    'LBL_PROXY_ON_DESC' => 'Configura la dirección del servidor proxy y la configuración de la autenticación',
    'LBL_PROXY_ON' => '¿Utilizar servidor proxy?',
    'LBL_PROXY_PASSWORD' => 'Password',
    'LBL_PROXY_PORT' => 'Port',
    'LBL_PROXY_TITLE' => 'Proxy Settings',
    'LBL_PROXY_USERNAME' => 'User Name',
    'LBL_RESTORE_BUTTON_LABEL' => 'Restore',
    'LBL_SYSTEM_SETTINGS' => 'System Settings',
    'LBL_USE_REAL_NAMES' => 'Show Nombre Completo',
    'LBL_USE_REAL_NAMES_DESC' => 'Mostrar el nombre completo de los usuarios en lugar de sus Nombres de Usuario en los campos de asignación.',
    'LBL_DISALBE_CONVERT_LEAD' => 'Desactivar la acción de convertir clientes potenciales para clientes potenciales convertidos.',
    'LBL_DISALBE_CONVERT_LEAD_DESC' => 'Si un cliente potencial se ha convertido ya, lo que permite esta opción, eliminar la acción principal de conversión.',
    'LBL_ENABLE_ACTION_MENU' => 'Mostrar acciones dentro de los menús',
    'LBL_ENABLE_ACTION_MENU_DESC' => 'Seleccione para mostrar la Vista de Detalle y el subpanel de acciones dentro de un menú desplegable. Si no se selecciona, las acciones se mostrarán como botones independientes.',
    'LBL_ENABLE_INLINE_EDITING_LIST' => 'Activar edición rápida en el listado',
    'LBL_ENABLE_INLINE_EDITING_LIST_DESC' => 'Elige para activar la edición rápida en los campos de la lista. Si no hay campos seleccionados, será desactivado en el listado.',
    'LBL_ENABLE_INLINE_EDITING_DETAIL' => 'Activar edición rápida en la vista detallada',
    'LBL_ENABLE_INLINE_EDITING_DETAIL_DESC' => 'Elige para activar la edición rápida en los campos de la vista detallada. Si no hay campos seleccionados, será desactivado en la vista detallada.',
    'LBL_HIDE_SUBPANELS' => 'Subpaneles colapsados',
    'LIST_ENTRIES_PER_LISTVIEW' => 'Elementos por página para listas',
    'LIST_ENTRIES_PER_SUBPANEL' => 'Elementos por página para subpaneles',
    'LOG_MEMORY_USAGE' => 'Registrar utilización de memoria',
    'LOG_SLOW_QUERIES' => 'Registrar consultas lentas',
    'CURRENT_LOGO' => 'Current Logo:',
    'CURRENT_LOGO_HELP' => 'Este logotipo se muestra en el centro de la pantalla de inicio de sesión de la aplicación SuiteCRM.',
    'NEW_LOGO' => 'Select Logo:',
    'NEW_LOGO_HELP' => 'The image file format can be either .png or .jpg. The maximum height is 170px, and the maximum width is 450px. Any image uploaded that is larger in any direction will be scaled to these max dimensions.',
    'NEW_LOGO_HELP_NO_SPACE' => 'The image file format can be either .png or .jpg. The maximum height is 170px, and the maximum width is 450px. Any image uploaded that is larger in any direction will be scaled to these max dimensions.',
    'SLOW_QUERY_TIME_MSEC' => 'Tiempo umbral para consultas lentas (ms)',
    'STACK_TRACE_ERRORS' => 'Mostrar traza de la pila de errores',
    'UPLOAD_MAX_SIZE' => 'Tamaño máximo para subida de archivos',
    'VERIFY_CLIENT_IP' => 'Validar dirección IP del usuario',
    'LOCK_HOMEPAGE' => 'No permitir el diseño personalizado de la Página de Inicio',
    'LOCK_SUBPANELS' => 'No permitir el diseño personalizado de subpaneles',
    'MAX_DASHLETS' => 'Máximo número de SuiteCRM Dashlets en la Página de Inicio',
    'SYSTEM_NAME' => 'Nombre del Sistema:',
    'SYSTEM_NAME_WIZARD' => 'Nombre:',
    'LBL_SNOOZE_TIMER' => 'Establecer Posponer Notificaciones',
    'SYSTEM_NAME_HELP' => 'This is the name that displays in the title bar of your browser.',
    'LBL_LDAP_TITLE' => 'Soporte de Autenticación LDAP',
    'LBL_LDAP_LEGACY_WARNING' => 'Advertencia LDAP',
    'LBL_LDAP_LEGACY_WARNING_MORE' => 'Esta configuración LDAP sólo se utilizará para autenticación de la API v4. Para configurar el inicio de sesión de SuiteCRM y utilizar LDAP, agregue las configuraciones necesarias al archivo .env.local. Consulte los documentos de configuración de LDAP para más información.',
    'LBL_LDAP_ENABLE' => 'Habilitar LDAP',
    'LBL_LDAP_SERVER_HOSTNAME' => 'Server:',
    'LBL_LDAP_SERVER_PORT' => 'Port Number:',
    'LBL_LDAP_ADMIN_USER' => 'User Name:',
    'LBL_LDAP_ADMIN_USER_DESC' => 'Usado para buscar el usuario de LDAP. Podría ser necesario escribir el nombre completo del dominio.',
    'LBL_LDAP_ADMIN_PASSWORD' => 'Password:',
    'LBL_LDAP_AUTHENTICATION' => 'Authentication:',
    'LBL_LDAP_AUTHENTICATION_DESC' => 'Conecta al servidor LDAP usando credenciales especificas de usuarios. Si no se proporcionan, la conexión sera anónima.',
    'LBL_LDAP_AUTO_CREATE_USERS' => 'Auto Create Users:',
    'LBL_LDAP_USER_DN' => 'User DN:',
    'LBL_LDAP_GROUP_DN' => 'Group DN:',
    'LBL_LDAP_GROUP_DN_DESC' => 'Example: <em>ou=groups,dc=example,dc=com</em>',
    'LBL_LDAP_USER_FILTER' => 'User Filter:',
    'LBL_LDAP_GROUP_MEMBERSHIP' => 'Group Membership:',
    'LBL_LDAP_GROUP_MEMBERSHIP_DESC' => 'Users must be a member of a specific group',
    'LBL_LDAP_GROUP_USER_ATTR' => 'User Attribute:',
    'LBL_LDAP_GROUP_USER_ATTR_DESC' => 'The unique identifier of the person that will be used to check if they are a member of the group Example: <em>uid</em>',
    'LBL_LDAP_GROUP_ATTR_DESC' => 'The attribute of the Group that will be used to filter against the User Attribute Example: <em>memberUid</em>',
    'LBL_LDAP_GROUP_ATTR' => 'Group Attribute:',
    'LBL_LDAP_USER_FILTER_DESC' => 'Cualquier parámetro de filtrado adicional a aplicar a la hora de autenticar usuarios. Por ejemplo:\nis_SuiteCRM_user=1 o (is_SuiteCRM_user=1)(is_sales=1)',
    'LBL_LDAP_LOGIN_ATTRIBUTE' => 'Login Attribute:',
    'LBL_LDAP_BIND_ATTRIBUTE' => 'Bind Attribute:',
    'LBL_LDAP_BIND_ATTRIBUTE_DESC' => 'Para ejemplos de uso de autentificación usando LDAP:[<b>AD:</b>&nbsp;userPrincipalName] [<b>openLDAP:</b>&nbsp;dn] [<b>Mac&nbsp;OS&nbsp;X:</b>&nbsp;uid] ',
    'LBL_LDAP_LOGIN_ATTRIBUTE_DESC' => 'Para ejemplos de busquedas de usuarios usando LDAP:[<b>AD:</b>&nbsp;userPrincipalName] [<b>openLDAP:</b>&nbsp;cn] [<b>Mac&nbsp;OS&nbsp;X:</b>&nbsp;dn] ',
    'LBL_LDAP_SERVER_HOSTNAME_DESC' => 'Ejemplo: ldap://ldap.example.com:389 o ldaps://ldap.example.com:636 para SSL',
    'LBL_LDAP_SERVER_PORT_DESC' => 'Ejemplo: 389 o 636 cuando se usa SSL',
    'LBL_LDAP_GROUP_NAME' => 'Nombre del Grupo:',
    'LBL_LDAP_GROUP_NAME_DESC' => 'Ejemplo: cn=SuiteCRM',
    'LBL_LDAP_USER_DN_DESC' => 'Ejemplo: ou=gente,dc=ejemplo,dc=com',
    'LBL_LDAP_AUTO_CREATE_USERS_DESC' => 'Si un usuario autenticado no existe, se creará uno en SuiteCRM.',
    'LBL_LDAP_ENC_KEY' => 'Encryption Key:',
    'DEVELOPER_MODE' => 'Modo Desarrollador',
    'LBL_SET_SUBPANEL_PAGINATION_TYPE' => 'Tipo de paginación del subpanel',
    'LBL_SET_LISTVIEW_PAGINATION_TYPE' => 'Tipo de Paginación de Subpanel Ver Listado',
    'LBL_LIST_ENTRIES_PER_MODAL' => 'Lista de registros en ventana emergente',
    'LBL_SET_RECORD_MODAL_PAGINATION_TYPE' => 'Tipo de paginación de lista de registros en ventana emergente',

    'SHOW_DOWNLOADS_TAB' => 'Visualizar la pestaña de descargas',
    'SHOW_DOWNLOADS_TAB_HELP' => 'Cuando es seleccionada, la pestaña de descarga aparecerá en la configuración de Usuario y proporcionará acceso a los usuarios a los plug-ins de SuiteCRM y otros archivos disponibles',
    'LBL_LDAP_ENC_KEY_DESC' => 'Para la autenticación SOAP al usar LDAP.',
    'LDAP_ENC_KEY_NO_FUNC_DESC' => 'La extensión php_mcrypt debe estar habilitada en su archivo php.ini.',
    'LDAP_ENC_KEY_NO_FUNC_OPENSSL_DESC' => 'La extensión openssl debe habilitarse en el archivo php.ini.',
    'LBL_ALL' => 'All',
    'LBL_MARK_POINT' => 'Marcar Punto',
    'LBL_NEXT_' => 'Siguiente>>',
    'LBL_REFRESH_FROM_MARK' => 'Actualizar Desde Marca',
    'LBL_SEARCH' => 'Buscar:',
    'LBL_REG_EXP' => 'Exp. Reg.:',
    'LBL_IGNORE_SELF' => 'Ignorar Datos Propios:',
    'LBL_MARKING_WHERE_START_LOGGING' => 'Marcando Desde Donde Iniciar la Traza',
    'LBL_DISPLAYING_LOG' => 'Mostrando Traza',
    'LBL_YOUR_PROCESS_ID' => 'Su ID de proceso',
    'LBL_YOUR_IP_ADDRESS' => 'Su Dirección IP es',
    'LBL_IT_WILL_BE_IGNORED' => 'Será ignorado',
    'LBL_LOG_NOT_CHANGED' => 'La traza no ha cambiado',
    'LBL_ALERT_JPG_IMAGE' => 'El formato de archivo de la imagen debe ser JPEG.  Suba un nuevo archivo cuya extensión sea .jpg.',
    'LBL_ALERT_TYPE_IMAGE' => 'El formato de archivo de la imagen debe ser JPEG o PNG.  Suba un nuevo archivo cuya extensión sea .jpg o .png.',
    'LBL_ALERT_SIZE_RATIO' => 'La relación de aspecto de la imagen debería estar entre 1:1 y 10:1.  La imagen será redimensionada.',
    'ERR_ALERT_FILE_UPLOAD' => 'Error al subir la imagen.',
    'LBL_LOGGER' => 'Configuración de Traza',
    'LBL_LOGGER_FILENAME' => 'Nombre de Archivo de Traza',
    'LBL_LOGGER_FILE_EXTENSION' => 'Extensión',
    'LBL_LOGGER_MAX_LOG_SIZE' => 'Tamaño máximo de traza',
    'LBL_STACK_TRACE' => 'Habilitar seguimiento del stack',
    'LBL_LOGGER_DEFAULT_DATE_FORMAT' => 'Default date format',
    'LBL_LOGGER_LOG_LEVEL' => 'Nivel de Traza',
    'LBL_LEAD_CONV_OPTION' => 'Opciones de conversión del cliente potencial',
    'LEAD_CONV_OPT_HELP' => "<b>Copiar</b> - Crea y se relaciona con copias de todas las actividades del cliente potencial para los nuevos registros que se han seleccionado por el usuario durante la conversión. Las copias se crean para cada uno de los registros seleccionados.<br><br><b>Mover</b> - Mueve todas las actividades del cliente potencial al nuevo registro que ha seleccionado el usuario durante la conversión.<br><br><b>No hacer nada</b> - No se hace nada con las actividades del cliente potencial durante la conversión. Las actividades continuaran vinculadas sólo al cliente potencial.",
    'LBL_CONFIG_AJAX' => 'Configure AJAX User Interface',
    'LBL_CONFIG_AJAX_DESC' => 'Activar o desactivar el uso de la interfaz de usuario AJAX para módulos específicos',
    'LBL_LOGGER_MAX_LOGS' => 'Número máximo de trazas (antes de rotación)',
    'LBL_LOGGER_FILENAME_SUFFIX' => 'Agregar tras el nombre de archivo',
    'LBL_VCAL_PERIOD' => 'Período de Tiempo para Actualizaciones vCal:',
    'LBL_IMPORT_MAX_RECORDS' => 'Importación - Número máximo de registros:',
    'LBL_IMPORT_MAX_RECORDS_HELP' => 'Especificar cuántas filas se permiten dentro de los archivos a importar.<br>Si el número de filas en un archivo de importación supera este número, el usuario recibirá una alerta.<br>Si no se introduce un valor se tendra un número ilimitado de filas.',
    'vCAL_HELP' => 'Utilice esta opción para determinar el número de meses de antelación sobre la fecha actual con la que se publica la información relativa al estado de Disponible/Ocupado sobre llamadas y reuniones.<BR>Para desactivar la publicación del estado Disponible/Ocupado, introduzca "0".  El mínimo es 1 mes; el máximo 12 meses.',

// Wizard
    //Wizard Scenarios
    'LBL_WIZARD_SCENARIOS' => 'Tus escenarios',
    'LBL_WIZARD_SCENARIOS_EMPTY_LIST' => 'No se han configurado escenarios',
    'LBL_WIZARD_SCENARIOS_DESC' => 'Elige cuáles escenarios son los indicados para tu instalación. Estas opciones pueden ser cambias después de la instalación.',

    'LBL_WIZARD_TITLE' => 'Asistente de Administración',
    'LBL_WIZARD_WELCOME_TAB' => 'Welcome',
    'LBL_WIZARD_WELCOME_TITLE' => '¡Bienvenido a SuiteCRM!',
    'LBL_WIZARD_WELCOME' => 'Haga clic en <b>Siguiente</b> para establecer una imagen de marca, localizar y configurar SuiteCRM ahora. Si desea configurar SuiteCRM más tarde, haga clic en <b>Saltar</b>.',
    'LBL_WIZARD_NEXT_BUTTON' => 'Siguiente >',
    'LBL_WIZARD_BACK_BUTTON' => '< Anterior',
    'LBL_WIZARD_SKIP_BUTTON' => 'Skip',
    'LBL_WIZARD_CONTINUE_BUTTON' => 'Continuar',
    'LBL_WIZARD_FINISH_TITLE' => 'La configuración básica del sistema ha sido completada',
    'LBL_WIZARD_SYSTEM_TITLE' => 'Branding',
    'LBL_WIZARD_SYSTEM_DESC' => 'Provide your organization\'s name and logo in order to brand your SuiteCRM.',
    'LBL_WIZARD_LOCALE_DESC' => 'Specify how you would like data in SuiteCRM to be displayed, based on your geographical location. The settings you provide here will be the default settings. Users will be able set their own preferences.',
    'LBL_WIZARD_SMTP_DESC' => 'Provide the email account that will be used to send emails, such as the assignment notifications and new user passwords. Users will receive emails from SuiteCRM, as sent from the specified email account.',
    'LBL_LOADING' => 'Cargando ...' /*for 508 compliance fix*/,
    'LBL_DELETE' => 'Delete' /*for 508 compliance fix*/,
    'LBL_WELCOME' => 'Welcome' /*for 508 compliance fix*/,
    'LBL_LOGO' => 'Logotipo' /*for 508 compliance fix*/,
    'LBL_ENABLE_HISTORY_CONTACTS_EMAILS' => 'Muestra los emails de contactos relacionados en el subpanel History para módulos',
    'LBL_HISTORY_SUBPANEL' => 'History Subpanel',
);
