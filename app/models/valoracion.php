<?php
class Valoracion extends AppModel {
	var $name = 'Valoracion';
	var $displayField = 'valoracion';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Submodulo' => array(
			'className' => 'Submodulo',
			'foreignKey' => 'submodulo_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
?>