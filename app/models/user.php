<?php
class User extends AppModel {
	var $name = 'User';
	var $displayField = 'username';
	var $validate = array(
		'username' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'password' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'group_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
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
		'esvisible' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'esmodificable' => array(
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

	var $belongsTo = array(
		'Group' => array(
			'className' => 'Group',
			'foreignKey' => 'group_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);


        var $actsAs = array('Acl' => array('type' => 'requester'));


        function parentNode() {
            if (!$this->id && empty($this->data)) {
                return null;
            }
            if (isset($this->data['User']['group_id'])) {
                $groupId = $this->data['User']['group_id'];
            } else {
                $groupId = $this->field('group_id');
            }
            if (!$groupId) {
                return null;
            } else {
                return array('Group' => array('id' => $groupId));
            }
        }

        /**    
	 * After save callback
	 *
	 * Update the aro for the user.
	 * Este código se usaba en la versión 1.2 de Cake... necesario aun???
         * 
	 * @access public
	 * @return void
	 */
	function afterSave($created) {
	        if (!$created) {
	            $parent = $this->parentNode();
	            $parent = $this->node($parent);
	            $node = $this->node();
	            $aro = $node[0];
	            $aro['Aro']['parent_id'] = $parent[0]['Aro']['id'];
	            $this->Aro->save($aro);
	        }
	}
        
        //Función para usar la autenticación a nivel de Grupos solamente
        //Hay que estar pendiente porque parece que no funciona correctamente
        //debería hacer que en la tabla de aros, solo apareciesen grupos.
        function bindNode($user) {
            return array('model' => 'Group', 'foreign_key' => $user['User']['group_id']);
        }

        
}
?>
