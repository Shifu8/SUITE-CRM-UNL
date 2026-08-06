<?php
/**
 * Vardef: maestria_interesada_c en Leads (Combo box / enum)
 */
$dictionary['Lead']['fields']['maestria_interesada_c'] = array (
  'name'                     => 'maestria_interesada_c',
  'vname'                    => 'LBL_MAESTRIA_INTERESADA',
  'type'                     => 'enum',
  'options'                  => 'maestria_interesada_list',
  'len'                      => '100',
  'audited'                  => true,
  'required'                 => false,
  'merge_filter'             => 'disabled',
  'duplicate_on_record_copy' => 'always',
  'unified_search'           => true,
  'calculated'               => false,
  'custom_module'            => 'Leads',
  'default'                  => '',
);
