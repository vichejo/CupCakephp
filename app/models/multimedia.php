<?php
class Multimedia extends AppModel {
	var $name = 'Multimedia';
	var $displayField = 'submodulo_id';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Submodulo' => array(
			'className' => 'Submodulo',
			'foreignKey' => 'submodulo_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Imagen' => array(
			'className' => 'Imagen',
			'foreignKey' => 'imagen_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Video' => array(
			'className' => 'Video',
			'foreignKey' => 'video_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Audio' => array(
			'className' => 'Audio',
			'foreignKey' => 'audio_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Link' => array(
			'className' => 'Link',
			'foreignKey' => 'link_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Fichero' => array(
			'className' => 'Fichero',
			'foreignKey' => 'fichero_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Tipomedia' => array(
			'className' => 'Tipomedia',
			'foreignKey' => 'tipomedia_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
?>