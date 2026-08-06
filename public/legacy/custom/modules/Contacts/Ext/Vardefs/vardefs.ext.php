<?php 
 //WARNING: The contents of this file are auto-generated


$dictionary['Contact']['fields']['cedula_c'] = array(
    'name'                     => 'cedula_c',
    'vname'                    => 'LBL_CEDULA',
    'type'                     => 'varchar',
    'len'                      => 20,
    'audited'                  => false,
    'required'                 => false,
    'merge_filter'             => 'disabled',
    'duplicate_on_record_copy' => 'always',
    'unified_search'           => true,
    'calculated'               => false,
    'custom_module'            => 'Contacts',
);


$dictionary['Contact']['fields']['ciclo_convocatoria_c'] = array(
    'name'                     => 'ciclo_convocatoria_c',
    'vname'                    => 'LBL_CICLO_CONVOCATORIA',
    'type'                     => 'varchar',
    'len'                      => 100,
    'audited'                  => false,
    'required'                 => false,
    'merge_filter'             => 'disabled',
    'duplicate_on_record_copy' => 'always',
    'unified_search'           => false,
    'calculated'               => false,
    'custom_module'            => 'Contacts',
);


$dictionary['Contact']['fields']['email1']['vname'] = 'LBL_LIST_EMAIL_ADDRESS';
$dictionary['Contact']['fields']['email1']['labelValue'] = 'Correo Electrónico';

$dictionary['Contact']['fields']['phone_mobile']['vname'] = 'LBL_MOBILE_PHONE';
$dictionary['Contact']['fields']['phone_mobile']['labelValue'] = 'Teléfono Móvil';


/**
 * Vardef: estado_aspirante_c en Contacts
 * 
 * Estado del proceso de admisión de Posgrados UNL.
 * Inicializado automáticamente en "Nuevo" al convertir un Lead en Contacto.
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
    'default'                  => 'Nuevo',
);


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

 // created: 2026-07-31 00:20:53
$dictionary['Contact']['fields']['canal_captacion_c']['inline_edit']='1';
$dictionary['Contact']['fields']['canal_captacion_c']['labelValue']='Canal de Captación';

 

 // created: 2026-07-23 06:10:26
$dictionary['Contact']['fields']['jjwg_maps_address_c']['inline_edit']=1;

 

 // created: 2026-07-23 06:10:26
$dictionary['Contact']['fields']['jjwg_maps_geocode_status_c']['inline_edit']=1;

 

 // created: 2026-07-23 06:10:25
$dictionary['Contact']['fields']['jjwg_maps_lat_c']['inline_edit']=1;

 

 // created: 2026-07-23 06:10:25
$dictionary['Contact']['fields']['jjwg_maps_lng_c']['inline_edit']=1;

 

 // created: 2026-07-31 00:16:10
$dictionary['Contact']['fields']['numero_documento_c']['inline_edit']='1';
$dictionary['Contact']['fields']['numero_documento_c']['labelValue']='Número de Documento';

 

 // created: 2026-07-31 00:40:10
$dictionary['Contact']['fields']['programa_interes_c']['inline_edit']='1';
$dictionary['Contact']['fields']['programa_interes_c']['labelValue']='Programa de Interés';

 

 // created: 2026-07-31 00:22:13
$dictionary['Contact']['fields']['score_aspirante_c']['inline_edit']='1';
$dictionary['Contact']['fields']['score_aspirante_c']['labelValue']='Score del Aspirante ';

 
?>