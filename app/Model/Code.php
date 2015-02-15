<?php
App::uses('AppModel', 'Model');
/**
 * Code Model
 *
 */
class Code extends AppModel {

    public $actsAs = array('Containable');
    public $recursive = -1;
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'code' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		)
	);


    public function findCode($code = null)
    {
        return $this->findByCode($code);
    }
}
