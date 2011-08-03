<?php
class Tipoevento extends AppModel {
	var $name = 'Tipoevento';
	var $displayField = 'tipo';
	var $validate = array(
		'tipo' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Es necesario indicar el tipo de evento',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		)
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'Evento' => array(
			'className' => 'Evento',
			'foreignKey' => 'tipoevento_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
?>