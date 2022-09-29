<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 * @property Message $Message
 */
class User extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

	public function confirmPassword($field, $password) {
		var_dump($field);
		var_dump($this->data);exit;
        if ($field['confirm_password'] === $this->data[$this->name][$password]) {
            return true;
        }
    }
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'id' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'name' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'lengthBetween' => array(
				'rule' => array('lengthBetween', 5, 20),
				'message' => 'Set with 5 to 20 characters.',
			),
		),
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'isUnique' => array(
				'rule' => array('isUnique'),
				'message' => 'Duplicate email address.',
			),
		),
		'password' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
			),
			// 'match' => array( 
			// 	'rule' => array('confirmPassword', 'confirm_password'),
			// 	'message' => 'Passwords do not match'
			// ),
		),
        'confirm_password' => array(
			'match' => array( 
				'rule' => array('confirmPassword', 'password'),
				'message' => 'Passwords do not match'
			),
        ),
		'picture' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Message' => array(
			'className' => 'Message',
			'foreignKey' => 'user_id',
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
