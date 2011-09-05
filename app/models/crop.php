<?php
class Crop extends AppModel {
	var $name = 'Crop';
	var $displayField = 'titulo';
	var $validate = array(
		'titulo' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Tienes que poner un título a este formato',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'ancho' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Es necesario indicar el ancho en pixeles',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'alto' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Es necesario indicar el alto en pixeles',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'submodulo_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Tiene que seleccionar un módulo. Si no hay ninguno consulte con el administrador.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'para' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Debe indicar a que elemento se aplicará este formato.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
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

	var $hasAndBelongsToMany = array(
		'Imagen' => array(
			'className' => 'Imagen',
			'joinTable' => 'imagenes_crops',
			'foreignKey' => 'crop_id',
			'associationForeignKey' => 'imagen_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);
        
        var $hasMany = array(
		'Tipogaleria' => array(
			'className' => 'Tipogaleria',
			'foreignKey' => 'crop_id',
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
