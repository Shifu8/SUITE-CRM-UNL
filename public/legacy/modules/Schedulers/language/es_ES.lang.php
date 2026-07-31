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
// OOTB Scheduler Job Names:
    'LBL_OOTB_WORKFLOW' => 'Procesar Tareas de Flujo de Trabajo',
    'LBL_OOTB_REPORTS' => 'Ejecutar Tareas Programadas de Generación de Informes',
    'LBL_OOTB_IE' => 'Comprobar Bandejas de Entrada',
    'LBL_OOTB_BOUNCE' => 'Ejecutar Proceso Nocturno de Emails de Campaña Rebotados',
    'LBL_OOTB_CAMPAIGN' => 'Ejecutar Proceso Nocturno de Campañas de Email Masivo',
    'LBL_OOTB_PRUNE' => 'Truncar Base de datos al Inicio del Mes',
    'LBL_OOTB_TRACKER' => 'Truncar Tablas de Monitorización',
    'LBL_OOTB_SUITEFEEDS' => 'Limpiar las Tablas de SuiteCRM Feed',
    'LBL_OOTB_SEND_EMAIL_REMINDERS' => 'Ejecutar Envío de Emails de Recordatorios',
    'LBL_OOTB_CLEANUP_QUEUE' => 'Limpiar Cola de Trabajos',
    'LBL_OOTB_REMOVE_DOCUMENTS_FROM_FS' => 'Extracción de documentos del sistema de archivos',
    'LBL_OOTB_GOOGLE_CAL_SYNC' => 'Sincronización de Google Calendar',
    'LBL_OOTB_ELASTIC_INDEX' => 'Perform Elasticsearch Index',
    'LBL_OOTB_CAL_ACC_SYNC' => 'Calendar Accounts Sync',
    'LBL_OOTB_SEND_EMAIL_TO_QUEUE' => 'Queue Campaign Emails',
    'LBL_OOTB_SEND_EMAIL_FROM_QUEUE' => 'Send Campaign Emails',
    'LBL_OOTB_CLEAN_UP_TEMP_FILES' => 'Clean Up Temporary Files',

// List Labels
    'LBL_LIST_JOB_INTERVAL' => 'Intervalo:',
    'LBL_LIST_LIST_ORDER' => 'Planificadores:',
    'LBL_LIST_NAME' => 'Planificador:',
    'LBL_LIST_RANGE' => 'Rango:',
    'LBL_LIST_STATUS' => 'Status:',
    'LBL_LIST_TITLE' => 'Lista de Planificación:',
// human readable:
    'LBL_SUN' => 'Sunday',
    'LBL_MON' => 'Monday',
    'LBL_TUE' => 'Tuesday',
    'LBL_WED' => 'Wednesday',
    'LBL_THU' => 'Thursday',
    'LBL_FRI' => 'Friday',
    'LBL_SAT' => 'Saturday',
    'LBL_ALL' => 'Todos los días',
    'LBL_EVERY' => 'Cada',
    'LBL_FROM' => 'Desde',
    'LBL_ON_THE' => 'En el',
    'LBL_RANGE' => 'a',
    'LBL_AND' => 'y',
    'LBL_MINUTES' => 'minutos',
    'LBL_HOUR' => 'horas',
    'LBL_HOUR_SING' => 'hora',
    'LBL_OFTEN' => 'Tan a menudo como sea posible.',
    'LBL_MIN_MARK' => 'marca por minuto',


// crontabs
    'LBL_MINS' => 'min',
    'LBL_HOURS' => 'horas',
    'LBL_DAY_OF_MONTH' => 'fecha',
    'LBL_MONTHS' => 'me',
    'LBL_DAY_OF_WEEK' => 'day',
    'LBL_CRONTAB_EXAMPLES' => 'Lo arriba mostrado utiliza notación estándar de crontab.',
// Labels
    'LBL_ALWAYS' => 'Always',
    'LBL_CATCH_UP' => 'Ejecutar Si Falla',
    'LBL_CATCH_UP_WARNING' => 'Desmarque si la ejecución de esta tarea puede durar más de un momento.',
    'LBL_DATE_TIME_END' => 'Fecha y Hora de Fin',
    'LBL_DATE_TIME_START' => 'Fecha y Hora de Inicio',
    'LBL_INTERVAL' => 'Intervalo',
    'LBL_JOB' => 'Tarea',
    'LBL_JOB_URL' => 'URL de la tarea',
    'LBL_LAST_RUN' => 'Última Ejecución Exitosa',
    'LBL_MODULE_NAME' => 'Planificador SuiteCRM',
    'LBL_MODULE_TITLE' => 'Schedulers',
    'LBL_NAME' => 'Scheduler Name',
    'LBL_NEVER' => 'Never',
    'LBL_NEW_FORM_TITLE' => 'Nueva Planificación',
    'LBL_PERENNIAL' => 'continuo',
    'LBL_SEARCH_FORM_TITLE' => 'Búsqueda de Planificación',
    'LBL_SCHEDULER' => 'Scheduler:',
    'LBL_STATUS' => 'Estado',
    'LBL_TIME_FROM' => 'Activo Desde',
    'LBL_TIME_TO' => 'Activo Hasta',
    'LBL_WARN_CURL_TITLE' => 'Aviso cURL:',
    'LBL_WARN_CURL' => 'Warning:',
    'LBL_WARN_NO_CURL' => 'Este sistema no tiene las librerías cURL habilitadas/compiladas en el módulo de PHP (--with-curl=/ruta/a/libreria_curl).  Por favor, contacte con su administrador para resolver el problema.  Sin la funcionalidad que provee cURL, el Planificador no puede utilizar hilos con sus tareas.',
    'LBL_BASIC_OPTIONS' => 'Configuración Básica',
    'LBL_ADV_OPTIONS' => 'Opciones Avanzadas',
    'LBL_TOGGLE_ADV' => 'Show Advanced Options',
    'LBL_TOGGLE_BASIC' => 'Mostrar Opciones Básicas',
// Links
    'LNK_LIST_SCHEDULER' => 'Schedulers',
    'LNK_NEW_SCHEDULER' => 'Nuevo Planificador',
// Cron
    'ERR_CRON_SYNTAX' => 'Sintaxis de Cron inválida',
    'LBL_CRON_SETUP' => 'Setup Schedulers',
    'NTC_LIST_ORDER' => 'Establezca el orden en que esta planificación aparecerá en las listas desplegables de selección de Planificador',
    'LBL_CRON_INSTRUCTIONS_WINDOWS' => 'Para configurar el Planificador de Windows',
    'LBL_CRON_INSTRUCTIONS_LINUX' => 'Para configurar Crontab',
    'LBL_CRON_LINUX_DESC1' => 'In order to run SuiteCRM Schedulers',
    'LBL_CRON_LINUX_DESC2' => '1. Edit your web server user\'s crontab file with this command',
    'LBL_CRON_LINUX_DESC3' => '2. Then update and add the following line to the crontab file:',
    'LBL_CRON_LINUX_DESC4' => 'Usted debería hacer esto una vez que la instalación ha finalizado.',
    'LBL_CRON_LINUX_DESC5' => '2(i). To define the environment variables, add the following line:',
    'LBL_CRON_LINUX_DESC6' => 'Please update [path/to/php] and [path/to/suite/instance] to reflect your environment.',
    'LBL_CRON_WINDOWS_DESC' => 'In order to run the SuiteCRM Schedulers',
    'LBL_CRON_WINDOWS_DESC2' => '1. Create a batch file to run using Windows Scheduled Tasks. The batch file should include the following commands:',
    'LBL_CRON_WINDOWS_DESC3' => 'Please update [path\to\php.exe] and [path\to\suite\instance] to reflect your environment.',
    'LBL_SCHEDULERS_INFO' => 'Scheduler Information',
    'LBL_SCHEDULERS_NEVER_RUN' => 'Schedulers have never been run.',
    // Subpanels
    'LBL_JOBS_SUBPANEL_TITLE' => 'Registro de Tareas',
    'LBL_EXECUTE_TIME' => 'Hora de Ejecución',

//jobstrings
    'LBL_REFRESHJOBS' => 'Refrescar trabajos',
    'LBL_POLLMONITOREDINBOXES' => 'Comprobar cuentas de correo entrante',
    'LBL_PERFORMFULLFTSINDEX' => 'Sistema de índice de búsqueda de texto completo',

    'LBL_RUNMASSEMAILCAMPAIGN' => 'Run Nightly Mass Email Campaigns',
    'LBL_POLLMONITOREDINBOXESFORBOUNCEDCAMPAIGNEMAILS' => 'Run Nightly Process Bounced Campaign Emails',
    'LBL_PRUNEDATABASE' => 'Prune Database on 1st of Month',
    'LBL_TRIMTRACKER' => 'Truncar Tablas de Monitorización',
    'LBL_TRIMSUGARFEEDS' => 'Prune SuiteCRM Feed Tables',
    'LBL_SENDEMAILREMINDERS' => 'Ejecutar envío de correos recordatorios',
    'LBL_CLEANJOBQUEUE' => 'Limpiar cola de trabajos',
    'LBL_REMOVEDOCUMENTSFROMFS' => 'Removal of documents from filesystem',

    'LBL_POLLMONITOREDINBOXESAOP' => 'Bandejas de entrada monitoreadas por Encuestas de AOP',
    'LBL_AORRUNSCHEDULEDREPORTS' => 'Ejecutar informes programados',
    'LBL_PROCESSAOW_WORKFLOW' => 'Procesar flujos de trabajo de AOW',

    'LBL_RUNELASTICSEARCHINDEXERSCHEDULER' => 'Creador de índices de Elasticsearch',
    'LBL_CALENDARSYNCJOB' => 'Sync Calendar Accounts',
    'LBL_SENDFROMQUEUE' => 'Send Emails from Email Queue',
    'LBL_CLEANUPTEMPORARYFILES' => 'Clean Up Temporary Files',
    'LBL_EMAILTOQUEUE' => 'Send Scheduled Emails to Email Queue',

    'LBL_SCHEDULER_TIMES' => 'Horarios del Calendarizador',
    'LBL_SYNCGOOGLECALENDAR' => 'Sincronizar los calendarios de Google',
);

global $sugar_config;
