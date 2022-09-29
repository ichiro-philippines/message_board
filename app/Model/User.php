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
        if ($field['confirm_password'] === $this->data[$this->name][$password]) {
            return true;
        }
    }
	function updateLastLogin($id) {
		$this->id = $id;
		$data = array(
				'last_login_time' => date('Y-m-d H:i:s'),
				'modified' => false
				);
		return $this->save($data);
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
			),
		),
		'username' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
			),
			'lengthBetween' => array(
				'rule' => array('lengthBetween', 5, 20),
				'message' => 'Set with 5 to 20 characters.',
			),
		),
		'email' => array(
			'email' => array(
				'rule' => array('email'),
			),
			'isUnique' => array(
				'rule' => array('isUnique'),
				'message' => 'Duplicate email address.',
			),
			'notBlank' => array(
				'rule' => array('notBlank'),
			),
		),
		'password' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
			),
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
			),
		),
		'birthdate' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
			),
		),
		'gender' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
			),
		),
		'hobby' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
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
			'foreignKey' => 'sender_user_id',
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
