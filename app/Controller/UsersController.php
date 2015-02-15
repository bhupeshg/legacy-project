<?php
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AppController', 'Controller');
/**
 * Users Controller
 * @property Code $Code
 * @property user $User
 *
 */
class UsersController extends AppController
{

    function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('register');
    }

    /**
     *
     */
    public function index()
    {
        $this->User->recursive = 0;
        $this->set('users', $this->Paginator->paginate());
    }

    /**
     *
     */
    public function login()
    {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                if ($this->Auth->user('user_type') != 2) {
                    return $this->redirect(array('controller' => 'users', 'action' => 'list_users', 'admin' => false));
                } else {
                    return $this->redirect(array('controller' => 'users', 'action' => 'list_users', 'admin' => true));
                }
            }
            $this->Session->setFlash(
                __('Username or password is incorrect'),
                'default',
                array('class' => ERROR)
            );
        }
    }

    public function register($code = null)
    {
        $this->loadModel('Code');
        if ($this->request->is('post')) {
            $isCode = $this->Code->findCode($this->request->data['User']['code']);
            if (!$isCode) {
                $this->Session->setFlash(
                    __('Invalid request'),
                    'default',
                    array('class' => ERROR)
                );
                return $this->redirect('login');
            } else {
                if ($this->User->save($this->request->data)) {
                    $this->Code->delete($isCode['Code']['id']);
                    $this->Session->setFlash(
                        __('You application is under process. You can login once you are verified. You will be informed by an email for the same'),
                        'default',
                        array('class' => SUCCESS)
                    );
                    return $this->redirect('login');
                }
            }
        } else {
            if (!$this->Code->findCode($code)) {
                $this->Session->setFlash(
                    __('Invalid request'),
                    'default',
                    array('class' => ERROR)
                );
                return $this->redirect('login');
            } else {
                $this->request->data['User']['code'] = $code;
            }
        }
    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

    public function admin_generate_code()
    {
        $this->set('title_for_layout', 'Generate random registration link');
        if ($this->request->is('ajax')) {
            App::import('model', 'Code');
            $codeModel = new Code();
            $code = $this->cvf_ps_generate_random_code();
            $data = array('Code' => array('code' => $code));
            if ($codeModel->save($data)) {
                $url = Router::url(array('controller' => 'users', 'action' => 'register', $code, 'admin' => false), true);
                $this->response->body($url);
                return $this->response;
            }
        }
    }

    public function admin_list_verification_requests()
    {
        $this->set('users', $this->User->find('all', array('conditions' => array('User.status' => 0), 'order' => array('created' => 'ASC'))));
    }

    public function admin_list_users()
    {
        $this->set('users', $this->User->find('all', array('conditions' => array('User.status' => 1, 'User.user_type' => '1'), 'order' => array('created' => 'ASC'))));
    }

    public function admin_verify_user($id = null)
    {
        $user = $this->User->findById($id);
        if ($user) {
            $this->User->id = $id;
            $this->User->set(array('status' => 1));
            if ($this->User->save()) {

                /*$Email = new CakeEmail('gmail');
                $Email->to($user['User']['username']);
                $Email->subject('Registration Verified');
                $Email->from('bhupesh.gupta143@gmail.com');
                $Email->message('Registration verified');
                $Email->send();*/

                $this->Session->setFlash(
                    __('User has been verified and an email has been sent to the user for the same.'),
                    'default',
                    array('class' => SUCCESS)
                );
            } else {
                $this->Session->setFlash(
                    __('User can not be verified at this moment. Please try again.'),
                    'default',
                    array('class' => ERROR)
                );
            }
        } else {
            $this->Session->setFlash(
                __('User not found'),
                'default',
                array('class' => ERROR)
            );
        }
        $this->redirect('list_verification_requests');
    }


    private function cvf_ps_generate_random_code($length = 10)
    {
        $string = '';
        $characters = "23456789ABCDEFHJKLMNPRTVWXYZabcdefghijklmnopqrstuvwxyz";
        for ($p = 0; $p < $length; $p++) {
            $string .= $characters[mt_rand(0, strlen($characters) - 1)];
        }
        return $string;
    }
}