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
    //module
    'LBL_MODULE_NAME' => 'Documents',
    'LBL_MODULE_TITLE' => 'Documents: Home',
    'LNK_NEW_DOCUMENT' => 'Create Document',
    'LNK_DOCUMENT_LIST' => 'View Documents',
    'LBL_DOC_REV_HEADER' => 'Document Revisions',
    'LBL_NEW_REVISION' => 'Add Revision',
    'LBL_FILENAME_REVISION_HINT' => 'Remove and replace this file to create a new revision.',
    'LBL_SEARCH_FORM_TITLE' => 'Document Search',
    //vardef labels
    'LBL_NAME' => 'Document Name',
    'LBL_DESCRIPTION' => 'Descripción',
    'LBL_CATEGORY' => 'Category',
    'LBL_SUBCATEGORY' => 'Sub Category',
    'LBL_STATUS' => 'Estado',
    'LBL_CREATED_BY' => 'Created by',
    'LBL_DATE_ENTERED' => 'Fecha de Creación',
    'LBL_DATE_MODIFIED' => 'Fecha de Modificación',
    'LBL_DELETED' => 'Eliminado',
    'LBL_MODIFIED' => 'Modificado por Id',
    'LBL_MODIFIED_USER' => 'Modified by',
    'LBL_CREATED' => 'Created by',
    'LBL_REVISIONS' => 'Revisions',
    'LBL_RELATED_DOCUMENT_ID' => 'ID de Documento Relacionado',
    'LBL_RELATED_DOCUMENT_REVISION_ID' => 'ID de Versión de Documento Relacionado',
    'LBL_IS_TEMPLATE' => 'Is a Template',
    'LBL_TEMPLATE_TYPE' => 'Document Type',
    'LBL_ASSIGNED_TO_NAME' => 'Asignado a:',
    'LBL_REVISION_NAME' => 'Revision Number',
    'LBL_MIME' => 'Mime Type',
    'LBL_REVISION' => 'Revision',
    'LBL_DOCUMENT' => 'Related Document',
    'LBL_LATEST_REVISION' => 'Latest Revision',
    'LBL_CHANGE_LOG' => 'Change Log',
    'LBL_ACTIVE_DATE' => 'Publish Date',
    'LBL_EXPIRATION_DATE' => 'Expiration Date',
    'LBL_FILE_EXTENSION' => 'File Extension',
    'LBL_LAST_REV_MIME_TYPE' => 'Tipo MIME de la última versión',
    'LBL_CAT_OR_SUBCAT_UNSPEC' => 'Unspecified',
    'LBL_HOMEPAGE_TITLE' => 'Mis documentos',
    //quick search
    'LBL_NEW_FORM_TITLE' => 'New Document',
    //document edit and detail view
    'LBL_DOC_NAME' => 'Document Name:',
    'LBL_FILENAME' => 'Archivo:',
    'LBL_LIST_FILENAME' => 'Archivo:',
    'LBL_DOC_VERSION' => 'Revision:',
    'LBL_FILE_UPLOAD' => 'Archivo:',

    'LBL_CATEGORY_VALUE' => 'Category:',
    'LBL_LIST_CATEGORY' => 'Category',
    'LBL_SUBCATEGORY_VALUE' => 'Sub Category:',
    'LBL_DOC_STATUS' => 'Status:',
    'LBL_LAST_REV_CREATOR' => 'Versión Creada Por:',
    'LBL_LASTEST_REVISION_NAME' => 'Nombre de la última versión:',
    'LBL_SELECTED_REVISION_NAME' => 'Nombre de la versión seleccionada:',
    'LBL_CONTRACT_STATUS' => 'Estado del contrato:',
    'LBL_CONTRACT_NAME' => 'Nombre del Contrato:',
    'LBL_DET_RELATED_DOCUMENT' => 'Documento Relacionado:',
    'LBL_DET_RELATED_DOCUMENT_VERSION' => "Versión de Documento Relacionado:",
    'LBL_DET_IS_TEMPLATE' => '¿Plantilla? :',
    'LBL_DET_TEMPLATE_TYPE' => 'Document Type:',
    'LBL_DOC_DESCRIPTION' => 'Descripción:',
    'LBL_DOC_ACTIVE_DATE' => 'Publish Date:',
    'LBL_DOC_EXP_DATE' => 'Expiration Date:',

    //document list view.
    'LBL_LIST_FORM_TITLE' => 'Document List',
    'LBL_LIST_DOCUMENT' => 'Document',
    'LBL_LIST_SUBCATEGORY' => 'Sub Category',
    'LBL_LIST_REVISION' => 'Revision',
    'LBL_LIST_LAST_REV_CREATOR' => 'Published By',
    'LBL_LIST_LAST_REV_DATE' => 'Revision Date',
    'LBL_LIST_VIEW_DOCUMENT' => 'View',
    'LBL_LIST_ACTIVE_DATE' => 'Publish Date',
    'LBL_LIST_EXP_DATE' => 'Expiration Date',
    'LBL_LIST_STATUS' => 'Estado',
    'LBL_LINKED_ID' => 'Id enlace',
    'LBL_SELECTED_REVISION_ID' => 'Id de versión seleccionada',
    'LBL_LATEST_REVISION_ID' => 'Id de última versión',
    'LBL_SELECTED_REVISION_FILENAME' => 'Nombre de archivo de versión seleccionada',
    'LBL_FILE_URL' => 'URL del archivo',

    //document search form.
    'LBL_SF_CATEGORY' => 'Category:',
    'LBL_SF_SUBCATEGORY' => 'Sub Category:',

    'DEF_CREATE_LOG' => 'Document Created',

    //error messages
    'ERR_DOC_NAME' => 'Document Name',
    'ERR_DOC_ACTIVE_DATE' => 'Publish Date',
    'ERR_FILENAME' => 'File Name',
    'ERR_DOC_VERSION' => 'Document Version',
    'ERR_DELETE_CONFIRM' => 'Do you want to delete this document revision?',
    'ERR_DELETE_LATEST_VERSION' => 'You are not allowed to delete the latest revision of a document.',
    'LNK_NEW_MAIL_MERGE' => 'Mail Merge',
    'ERR_MISSING_FILE' => 'Este documento no se encuentra un archivo, es muy probable que el error se haya generado durante la carga. Por favor vuelva a intentar cargar el archivo o póngase en contacto con su administrador.',

    //sub-panel vardefs.
    'LBL_LIST_DOCUMENT_NAME' => 'Nombre',
    'LBL_LIST_IS_TEMPLATE' => '¿Plantilla?',
    'LBL_LIST_TEMPLATE_TYPE' => 'Document Type',
    'LBL_LAST_REV_CREATE_DATE' => 'Fecha de Creación de Última Versión',
    'LBL_CONTRACTS' => 'Contracts',
    'LBL_CREATED_USER' => 'Created User',
    'LBL_DOCUMENT_INFORMATION' => 'OVERVIEW', //No need to be translated in all caps. Translation used just in menu action items when using the SuiteP template
    'LBL_DOC_ID' => 'Document Source ID',
    'LBL_DOC_TYPE' => 'Source',
    'LBL_DOC_TYPE_POPUP' => 'Seleccione un origen para que este documento sea cargado <br> y del cual estará disponible.',
    'LBL_DOC_URL' => 'Document Source URL',
    'LBL_SEARCH_EXTERNAL_DOCUMENT' => 'File Name',
    'LBL_EXTERNAL_DOCUMENT_NOTE' => 'Los primeros 20 archivos modificados más recientemente se muestran en orden descendente en la lista a continuación. Use la búsqueda para encontrar otros archivos.',
    'LBL_LIST_EXT_DOCUMENT_NAME' => 'File Name',
    'ERR_INVALID_EXTERNAL_API_ACCESS' => 'El usuario ha intentado acceder a una API externa no válida ({0})',
    'ERR_INVALID_EXTERNAL_API_LOGIN' => 'La comprobación de inicio de sesión ha sido errónea para la API externa ({0})',

    // Links around the world
    'LBL_ACCOUNTS_SUBPANEL_TITLE' => 'Cuentas',
    'LBL_CONTACTS_SUBPANEL_TITLE' => 'Contactos',
    'LBL_OPPORTUNITIES_SUBPANEL_TITLE' => 'Opportunities',
    'LBL_CASES_SUBPANEL_TITLE' => 'Casos',
    'LBL_BUGS_SUBPANEL_TITLE' => 'Bugs',

    'LBL_AOS_CONTRACTS' => 'Contracts',

    'LBL_REV_LIST_REVISION' => 'Revision',
    'LBL_REV_LIST_ENTERED' => 'Fecha de Creación',
    'LBL_REV_LIST_CREATED' => 'Created by',
    'LBL_REV_LIST_LOG' => 'Change Log',
    'LBL_REV_LIST_FILENAME' => 'Archivo',
);
