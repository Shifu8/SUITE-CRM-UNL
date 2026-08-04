<?php
/**
 * Layout de Conversión de Leads para Admisiones de Posgrado UNL
 * 
 * Flujo: Lead -> Contacto
 * - No requiere Account Name.
 * - Muestra Maestría de interés y Estado del proceso (inicializado en Nuevo).
 * - Conserva toda la información del aspirante.
 */
$viewdefs['Contacts']['ConvertLead'] = array(
    'copyData' => true,
    'required' => true,
    'select' => "report_to_name",
    'default_action' => 'create',
    'templateMeta' => array(
        'form' => array(
            'hidden' => array(
                '<input type="hidden" name="opportunity_id" value="{$smarty.request.opportunity_id}">',
                '<input type="hidden" name="case_id" value="{$smarty.request.case_id}">',
                '<input type="hidden" name="bug_id" value="{$smarty.request.bug_id}">',
                '<input type="hidden" name="email_id" value="{$smarty.request.email_id}">',
                '<input type="hidden" name="inbound_email_id" value="{$smarty.request.inbound_email_id}">'
            )
        ),
        'maxColumns' => '2',
        'widths' => array(
            array('label' => '10', 'field' => '30'),
            array('label' => '10', 'field' => '30'),
        ),
    ),
    'panels' => array(
        'LNK_NEW_CONTACT' => array(
            array(
                array(
                    'name' => 'first_name',
                    'customCode' => '{html_options name="Contactssalutation" options=$fields.salutation.options selected=$fields.salutation.value}&nbsp;<input name="Contactsfirst_name" size="25" maxlength="25" type="text" value="{$fields.first_name.value}">',
                ),
                'last_name',
            ),
            array(
                'maestria_interesada_c',
                'estado_aspirante_c',
            ),
            array(
                'department',
                'phone_mobile',
            ),
            array(
                'email1',
                'campaign_name',
            ),
            array(
                'cedula_c',
                'ciclo_convocatoria_c',
            ),
            array(
                'description',
            ),
        )
    ),
);

// Desactivar módulo Accounts en la conversión
$viewdefs['Accounts']['ConvertLead'] = array(
    'copyData' => false,
    'required' => false,
    'default_action' => 'none',
    'templateMeta' => array(
        'form' => array('hidden' => array()),
        'maxColumns' => '2',
        'widths' => array(
            array('label' => '10', 'field' => '30'),
            array('label' => '10', 'field' => '30'),
        ),
    ),
    'panels' => array(
        'LNK_NEW_ACCOUNT' => array()
    ),
);
