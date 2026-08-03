<?php
// Auto-merged by rebuild script

// From: _override_sugarfield_canal_captacion_c.php
// created: 2026-07-31 00:20:53
$dictionary['Contact']['fields']['canal_captacion_c']['inline_edit']='1';
$dictionary['Contact']['fields']['canal_captacion_c']['labelValue']='Canal de Captación';

 ?>

// From: _override_sugarfield_jjwg_maps_address_c.php
// created: 2026-07-23 06:10:26
$dictionary['Contact']['fields']['jjwg_maps_address_c']['inline_edit']=1;

 ?>

// From: _override_sugarfield_jjwg_maps_geocode_status_c.php
// created: 2026-07-23 06:10:26
$dictionary['Contact']['fields']['jjwg_maps_geocode_status_c']['inline_edit']=1;

 ?>

// From: _override_sugarfield_jjwg_maps_lat_c.php
// created: 2026-07-23 06:10:25
$dictionary['Contact']['fields']['jjwg_maps_lat_c']['inline_edit']=1;

 ?>

// From: _override_sugarfield_jjwg_maps_lng_c.php
// created: 2026-07-23 06:10:25
$dictionary['Contact']['fields']['jjwg_maps_lng_c']['inline_edit']=1;

 ?>

// From: _override_sugarfield_numero_documento_c.php
// created: 2026-07-31 00:16:10
$dictionary['Contact']['fields']['numero_documento_c']['inline_edit']='1';
$dictionary['Contact']['fields']['numero_documento_c']['labelValue']='Número de Documento';

 ?>

// From: _override_sugarfield_programa_interes_c.php
// created: 2026-07-31 00:40:10
$dictionary['Contact']['fields']['programa_interes_c']['inline_edit']='1';
$dictionary['Contact']['fields']['programa_interes_c']['labelValue']='Programa de Interés';

 ?>

// From: _override_sugarfield_score_aspirante_c.php
// created: 2026-07-31 00:22:13
$dictionary['Contact']['fields']['score_aspirante_c']['inline_edit']='1';
$dictionary['Contact']['fields']['score_aspirante_c']['labelValue']='Score del Aspirante ';

 ?>

// From: estado_aspirante_c.php
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


// From: maestria_interesada_c.php
$dictionary['Contact']['fields']['maestria_interesada_c'] = array(
  'name'                    => 'maestria_interesada_c',
  'vname'                   => 'LBL_MAESTRIA_INTERESADA',
  'type'                    => 'enum',
  'options'                 => 'maestria_interesada_list',
  'len'                     => 100,
  'audited'                 => false,
  'required'                => false,
  'merge_filter'            => 'disabled',
  'duplicate_on_record_copy'=> 'always',
  'unified_search'          => true,
  'calculated'              => false,
  'custom_module'           => 'Contacts',
);
