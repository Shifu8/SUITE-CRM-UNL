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
    'ERR_DELETE_RECORD' => 'You must specify a record number to delete the account.',
    'LBL_ACCOUNT_ID' => 'ID de Cuenta:',
    'LBL_CASE_ID' => 'ID Caso:',
    'LBL_CLOSE' => 'Close:',
    'LBL_CONTACT_ID' => 'ID Contacto:',
    'LBL_CONTACT_NAME' => 'Contact:',
    'LBL_DEFAULT_SUBPANEL_TITLE' => 'Notes',
    'LBL_DESCRIPTION' => 'Note',
    'LBL_EMAIL_ADDRESS' => 'Email Address:',
    'LBL_EMAIL_ATTACHMENT' => 'Email Attachment',
    'LBL_FILE_MIME_TYPE' => 'Mime Type',
    'LBL_FILE_URL' => 'URL del archivo',
    'LBL_FILENAME' => 'Adjunto:',
    'LBL_LEAD_ID' => 'ID Cliente Potencial:',
    'LBL_LIST_CONTACT_NAME' => 'Contact',
    'LBL_LIST_DATE_MODIFIED' => 'Última Modificación',
    'LBL_LIST_FILENAME' => 'Archivo',
    'LBL_LIST_FILE' => 'Archivo',
    'LBL_LIST_FORM_TITLE' => 'Lista de Notas',
    'LBL_LIST_RELATED_TO' => 'Related To',
    'LBL_LIST_SUBJECT' => 'Subject',
    'LBL_LIST_STATUS' => 'Estado',
    'LBL_LIST_CONTACT' => 'Contact',
    'LBL_MODULE_NAME' => 'Notes',
    'LBL_MODULE_TITLE' => 'Notas: Inicio',
    'LBL_NEW_FORM_TITLE' => 'Create Note or Add Attachment',
    'LBL_NOTE_STATUS' => 'Note',
    'LBL_NOTE_SUBJECT' => 'Subject:',
    'LBL_NOTES_SUBPANEL_TITLE' => 'Attachments',
    'LBL_NOTE' => 'Nota:',
    'LBL_OPPORTUNITY_ID' => 'ID Oportunidad:',
    'LBL_PARENT_ID' => 'ID Padre:',
    'LBL_PARENT_TYPE' => 'Parent Type',
    'LBL_PHONE' => 'Phone:',
    'LBL_PORTAL_FLAG' => '¿Mostrar en el Portal?',
    'LBL_EMBED_FLAG' => '¿Incluir en Correo?',
    'LBL_PRODUCT_ID' => 'ID Producto:',
    'LBL_QUOTE_ID' => 'ID Cotización:',
    'LBL_RELATED_TO' => 'Related To:',
    'LBL_SEARCH_FORM_TITLE' => 'Búsqueda de Notas',
    'LBL_STATUS' => 'Estado',
    'LBL_SUBJECT' => 'Subject:',
    'LNK_IMPORT_NOTES' => 'Import Notes',
    'LNK_NEW_NOTE' => 'Create Note or Attachment',
    'LNK_NOTE_LIST' => 'View Notes',
    'LBL_MEMBER_OF' => 'Member of:',
    'LBL_LIST_ASSIGNED_TO_NAME' => 'Assigned User',
    'LBL_REMOVING_ATTACHMENT' => 'Quitando adjunto...',
    'ERR_REMOVING_ATTACHMENT' => 'Error al quitar adjunto...',
    'LBL_CREATED_BY' => 'Creado Por',
    'LBL_MODIFIED_BY' => 'Modificado Por',
    'LBL_SEND_ANYWAYS' => 'This email has no subject. Send/save anyway?',
    'LBL_NOTE_INFORMATION' => 'OVERVIEW', //No need to be translated in all caps. Translation used just in menu action items when using the SuiteP template
    'LBL_MY_NOTES_DASHLETNAME' => 'Mis Notas',
    'LBL_EDITLAYOUT' => 'Edit Layout' /*for 508 compliance fix*/,
    //For export labels
    'LBL_FIRST_NAME' => 'Nombre',
    'LBL_LAST_NAME' => 'Last Name',
    'LBL_DATE_ENTERED' => 'Fecha de Creación',
    'LBL_DATE_MODIFIED' => 'Fecha de Modificación',
    'LBL_DELETED' => 'Eliminado',
    'LBL_FILE_CONTENTS' => 'Contenido del archivo',

    'LBL_ASCENDING' => 'Ascendente',
    'LBL_DESCENDING' => 'Descendente',
);
