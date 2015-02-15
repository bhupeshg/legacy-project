<?php
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 * @property AnnouncementComment $AnnouncementComment
 * @property Announcement $Announcement
 * @property ArticleAssistance $ArticleAssistance
 * @property Article $Article
 * @property Book $Book
 * @property Folder $Folder
 * @property Gallery $Gallery
 */
class User extends AppModel
{

    public $actsAs = array('Containable');
    public $recursive = -1;

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'username' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Username is mandatory'
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'email' => array(
                'rule' => array('email'),
                'message' => 'Username must be a valid email address'
            )
        ),
        'password' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Password is mandatory'
            ),
            'minLength' => array(
                'rule' => array('minLength',6),
                'message' => 'Password must be at least 6 characters long.'
            )
        ),
        'password_confirm' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Please confirm your password'
            ),
            'compare' => array(
                'rule' => array('compare','password'),
                'message' => 'Both passwords must match.'
            )
        ),
        'karmi_name' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Karmi name is mandatory'
            ),
            'rule1' => array(
                'rule' => array('custom','/^[\\w\\s]+$/'),
                'message' => 'Karmi name should be only alphabets'
            )
        ),
        'initiated_name' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Initiated name is mandatory'
            ),
            'rule1' => array(
                'rule' => array('custom','/^[\\w\\s]+$/'),
                'message' => 'Initiated name should be only alphabets'
            )
        ),
        'place_of_initiation' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Place of initiation is mandatory'
            ),
            'alphaNumeric' => array(
                'rule' => array('alphaNumeric'),
                'message' => 'Name should be only alphabets'
            )
        ),
        'date_of_initiation' => array(
            'date' => array(
                'rule' => array('date'),
                'message' => 'Please enter a valid date'
            ),
        ),
        'profile_pic' => array(
            'image' => array(
                'extension' => array(
                    'rule' => array(
                        'extension',
                        array('gif', 'jpeg', 'png', 'jpg')
                    ),
                    'message' => 'Please supply a valid image.',
                    'on' => 'update', // Limit validation to 'create' or 'update' operations
                ),
                'fileSize' => array(
                    'rule' => array('fileSize', '<=', '1MB'),
                    'message' => 'Image must be less than 1MB',
                    'on' => 'update',
                )
            ),
        ),
    );

    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
        'AnnouncementComment' => array(
            'className' => 'AnnouncementComment',
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
        ),
        'Announcement' => array(
            'className' => 'Announcement',
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
        ),
        'ArticleAssistance' => array(
            'className' => 'ArticleAssistance',
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
        ),
        'Article' => array(
            'className' => 'Article',
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
        ),
        'Book' => array(
            'className' => 'Book',
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
        ),
        'Folder' => array(
            'className' => 'Folder',
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
        ),
        'Gallery' => array(
            'className' => 'Gallery',
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

    public function beforeSave($options = array()) {
        if (!empty($this->data[$this->alias]['password'])) {
            $passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha256'));
            $this->data[$this->alias]['password'] = $passwordHasher->hash(
                $this->data[$this->alias]['password']
            );
        }
        return true;
    }

}
