<?php
class Opinionesmodulo extends AppModel {
	var $name = 'Opinionesmodulo';
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
		'Opinion' => array(
			'className' => 'Opinion',
			'foreignKey' => 'opinion_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
?>