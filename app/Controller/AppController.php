<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 */

App::uses('Controller', 'Controller');
App::uses('CakeEmail', 'Network/Email');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package        app.Controller
 * @link        http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    public $components = array(
        'Auth' => array(
            'loginAction' => array(
                'controller' => 'users',
                'action' => 'login',
                'admin' => false
            ),
            'authError' => 'Did you really think you are allowed to see that?',
            'authenticate' => array(
                'Form' => array(
                    'passwordHasher' => array(
                        'className' => 'Simple',
                        'hashType' => 'sha256'
                    ),
                    'scope' => array('User.status' => 1, 'User.active' => 1)
                )
            ),
            'loginRedirect' => array(
                'controller' => 'users',
                'action' => 'index'
            ),
            'authorize' => 'controller'
        ),
        'Paginator',
        'RequestHandler',
        'Session'
    );

    public $paginate = array(
        'limit' => 25);

    /**
     *
     */
    public function beforeFilter()
    {
        $this->layout = 'bootstrap';
    }

    public function isAuthorized($user = null)
    {
        if (!empty($this->params['prefix']) && $this->params['prefix'] == 'admin') {
            if ($this->Auth->user('user_type') != 2) {
                return false;
            }
            $this->layout = 'admin';
        }
        if ($this->Auth->user('user_type') == 1) {
            $this->layout = 'bootstrap';
        }
        return true;
    }
}
