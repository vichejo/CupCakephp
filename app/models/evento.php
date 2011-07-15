<?php
class Evento extends AppModel {
	var $name = 'Evento';
	var $displayField = 'titulo';
	var $validate = array(
		'tipoevento_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'seccion_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'titulo' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		/*'zoom' => array(
			'range' => array(
				'rule' => array('range',0,10),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),*/
		'esactivo' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'esdestacado' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Tipoevento' => array(
			'className' => 'Tipoevento',
			'foreignKey' => 'tipoevento_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Seccion' => array(
			'className' => 'Seccion',
			'foreignKey' => 'seccion_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	// Complementamos las fechas con la hora
        //----------------------
        function beforeSave() {
            if(!empty($this->data['Evento']['fechainicio']) && !empty($this->data['Calendario']['horainicio'])) {
                    $this->data['Evento']['fechainicio'] = $this->data['Evento']['fechainicio']." ".$this->data['Calendario']['horainicio'].":00";
            }
            if(!empty($this->data['Evento']['fechafin']) && !empty($this->data['Calendario']['horafin'])) {
                    $this->data['Evento']['fechafin'] = $this->data['Evento']['fechafin']." ".$this->data['Calendario']['horafin'].":00";
            }

            return true;
        }
        //---------------
        //Rellenamos los campos visibles de la fecha y la hora con los datos de la bbdd
        function afterFind($results,$primary) {           
            foreach ($results as $key => $val) {
		if (isset($val['Evento']['fechainicio']) AND $val['Evento']['fechainicio']!="0000-00-00 00:00:00" ) {
                    $results[$key]['Evento']['fechainicio']=substr($val['Evento']['fechainicio'],0,10);
                    $results[$key]['Calendario']['fechainicio'] = substr($val['Evento']['fechainicio'],8,2)."/".substr($val['Evento']['fechainicio'],5,2)."/".substr($val['Evento']['fechainicio'],0,4);
                    $results[$key]['Calendario']['horainicio'] = substr($val['Evento']['fechainicio'],11,5);
		}else{
                    $results[$key]['Calendario']['fechainicio'] = "";
                    $results[$key]['Calendario']['horainicio'] = "";
                }
                if (isset($val['Evento']['fechainicio']) AND $val['Evento']['fechafin']!="0000-00-00 00:00:00"){
                    $results[$key]['Evento']['fechafin']=substr($val['Evento']['fechafin'],0,10);
                    $results[$key]['Calendario']['fechafin'] = substr($val['Evento']['fechafin'],8,2)."/".substr($val['Evento']['fechainicio'],5,2)."/".substr($val['Evento']['fechainicio'],0,4);
                    $results[$key]['Calendario']['horafin'] = substr($val['Evento']['fechafin'],11,5);
                }else{
                    $results[$key]['Calendario']['fechafin'] = "";
                    $results[$key]['Calendario']['horafin'] = "";
                }
            }
            //print_r($results);exit();
            return $results;            
        }


}
?>
