<?php
/**
 * Vardef: estado_aspirante_c en Contacts
 * 
 * Estado del aspirante dentro del proceso de posgrado.
 * Visible en la lista de contactos del Director de Maestría.
 */
$dictionary['Contact']['fields']['estado_aspirante_c'] = array(
    'name'                     => 'estado_aspirante_c',
    'vname'                    => 'LBL_ESTADO_ASPIRANTE',
    'type'                     => 'enum',
    'options'                  => 'estado_aspirante_list',
    'len'                      => 100,
    'audited'                  => true,
    'required'                 => false,
    'merge_filter'             => 'disabled',
    'duplicate_on_record_copy' => 'always',
    'unified_search'           => true,
    'calculated'               => false,
    'custom_module'            => 'Contacts',
    'default'                  => 'Interesado',
);
