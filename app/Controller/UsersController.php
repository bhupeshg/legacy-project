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
        if ($this->Auth->user('user_type') != 2) {
            return $this->redirect(array('controller' => 'users', 'action' => 'update_profile', 'admin' => false));
        } else {
            return $this->redirect(array('controller' => 'users', 'action' => 'list_users', 'admin' => true));
        }
    }

    public function update_profile()
    {
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->User->id = $this->Auth->user('id');
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(
                    __('Your Profile has been updated successfully'),
                    'default',
                    array('class' => SUCCESS)
                );
            } else {
                $this->Session->setFlash(
                    __('Profile can not be updated at this moment. Please try again.'),
                    'default',
                    array('class' => ERROR)
                );
            }
        }
        $this->request->data = $this->User->findById($this->Auth->user('id'));
    }

    /**
     *
     */
    public function login()
    {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                return $this->redirect($this->Auth->redirect());
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
        $this->set('title_for_layout', 'Registration');
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

    public function admin_logout()
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
        $this->Paginator->settings = $this->paginate;
        $this->Paginator->settings = array(
            'conditions' => array('User.status' => 0), 'limit' => 50, 'order' => array('created' => 'ASC'));
        $this->set('users', $this->Paginator->paginate('User'));
    }

    public function admin_list_users()
    {
        $this->Paginator->settings = $this->paginate;
        $this->Paginator->settings = array(
            'conditions' => array('User.status' => 1, 'User.legacy_status' => 1, 'User.user_type' => 1), 'limit' => 50, 'order' => array('initiated_name' => 'ASC'));
        $this->set('users', $this->Paginator->paginate('User'));
    }

    public function admin_list_departed_users()
    {
        $this->Paginator->settings = $this->paginate;
        $this->Paginator->settings = array(
            'conditions' => array('User.status' => 1, 'User.legacy_status' => 2, 'User.user_type' => 1), 'limit' => 1, 'order' => array('initiated_name' => 'ASC'));
        $this->set('users', $this->Paginator->paginate('User'));
    }

    public function admin_verify_user($id = null)
    {
        $user = $this->User->findById($id);
        if ($user) {
            $data['User']['id'] = $id;
            $data['User']['status'] = 1;
            if ($this->User->save($data)) {
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


    public function admin_reject_user($id = null)
    {
        if ($this->request->is('post')) {
            $user = $this->User->find('first', array('conditions' => array('User.id' => $this->request->data['User']['id'], 'User.status' => 0, 'User.user_type' => 1)));
            if ($user) {
                if ($this->User->delete($this->request->data['User']['id'])) {
                    /*$Email = new CakeEmail('gmail');
                    $Email->to($user['User']['username']);
                    $Email->subject('Registration Verified');
                    $Email->from('bhupesh.gupta143@gmail.com');
                    $Email->message($this->request->data['User']['reason']);
                    $Email->send();*/

                    $this->Session->setFlash(
                        __('User has been deleted and sent an email with the given content.'),
                        'default',
                        array('class' => SUCCESS)
                    );
                } else {
                    $this->Session->setFlash(
                        __('User can not be rejected at this moment. Please try again.'),
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
        } else {
            $this->redirect('list_verification_requests');
        }
    }

    public function admin_depart_user($id = null)
    {
        $user = $this->User->find('first', array('conditions' => array('User.id' => $id, 'User.legacy_status' => 1, 'User.user_type' => 1)));
        if ($user) {
            $data['User']['id'] = $id;
            $data['User']['legacy_status'] = 2;
            $data['User']['active'] = 0;
            if ($this->User->save($data)) {
                $this->Session->setFlash(
                    __('User has marked as Departed.'),
                    'default',
                    array('class' => SUCCESS)
                );
            } else {
                $this->Session->setFlash(
                    __('User can not be marked departed at this moment. Please try again.'),
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
        $this->redirect('list_users');
    }

    public function admin_user_status($id = null, $active = 1)
    {
        $user = $this->User->find('first', array('conditions' => array('User.id' => $id, 'User.legacy_status' => 1, 'User.user_type' => 1)));
        if ($user) {
            $data['User']['id'] = $id;
            $data['User']['active'] = $active;
            if ($this->User->save($data)) {
                if ($active == 1) {
                    $this->Session->setFlash(
                        __('User has marked as Active.'),
                        'default',
                        array('class' => SUCCESS)
                    );
                } else {
                    $this->Session->setFlash(
                        __('User has marked as Inactive.'),
                        'default',
                        array('class' => SUCCESS)
                    );
                }
            } else {
                $this->Session->setFlash(
                    __('User can not be marked departed at this moment. Please try again.'),
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
        $this->redirect('list_users');
    }


    public function admin_user_memoir()
    {
        if ($this->request->is('post')) {
            $user = $this->User->find('first', array('conditions' => array('User.id' => $this->request->data['User']['id'], 'User.status' => 1, 'User.user_type' => 1, 'User.legacy_status' => 2)));
            if ($user) {
                $data['User']['id'] = $this->request->data['User']['id'];
                $data['User']['memoir'] = $this->request->data['User']['memoir'];
                if ($this->User->save($data)) {
                    $this->Session->setFlash(
                        __('Memoir has been added successfully.'),
                        'default',
                        array('class' => SUCCESS)
                    );
                } else {
                    $this->Session->setFlash(
                        __('Memoir can not be added at this moment. Please try again.'),
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
            $this->redirect('list_departed_users');
        } else {
            $this->redirect('list_departed_users');
        }
    }

    public function admin_get_user_memoir($id = null)
    {
        if ($this->request->is('ajax')) {
            $user = $this->User->find('first', array('conditions' => array('User.id' => $id, 'User.legacy_status' => 2, 'User.user_type' => 1)));
            if ($user) {
                $this->response->body($user['User']['memoir']);
            } else {
                $this->response->body('');
            }
            return $this->response;
        } else {
            $this->redirect('list_users');
        }
    }

    public function change_password()
    {
        $this->set('title_for_layout', 'Change Password');
        if ($this->request->is('post')) {
            $this->do_change_password($this->request->data);
        }
        $this->render('change_password');
    }

    public function admin_change_password()
    {
        $this->set('title_for_layout', 'Change Password');
        if ($this->request->is('post')) {
            $this->do_change_password($this->request->data);
        }
        $this->render('change_password');
    }

    private function do_change_password($data)
    {
        App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
        $passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha256'));
        if (!empty($data['User']['old_password']) && !empty($data['User']['new_password'])) {
            $user = $this->User->find('first', array('conditions' => array('User.id' => $this->Auth->user('id'), 'User.password' => $passwordHasher->hash($data['User']['old_password']))));
            if ($user) {
                $new_data['User']['id'] = $this->Auth->user('id');
                $new_data['User']['password'] = $data['User']['new_password'];
                if ($this->User->save($new_data)) {
                    $this->Session->setFlash(
                        __('Password has been updated successfully.'),
                        'default',
                        array('class' => SUCCESS)
                    );
                } else {
                    $this->Session->setFlash(
                        __('Password can not be updated at this moment. Please try again.'),
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
        }
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

	public function admin_list_material($user_id)
	{
		$this->loadModel('Folder');
		$folders = $this->Folder->find('all', array('conditions' => array('Folder.user_id' => $user_id), 'order' => array('Folder.created' => 'ASC')));

		$this->loadModel('Gallery');
		$images = $this->Gallery->find('all', array('conditions' => array('Folder.user_id' => $user_id, 'folder_id' => 0), 'order' => array('Gallery.created' => 'ASC')));

		$this->set('folders', $folders);
		$this->set('images', $images);
		$this->set('user_id', $user_id);
		$this->set('folderId', null);
	}

	public function admin_add_folder()
	{
		$this->loadModel('Folder');
		if ($this->request->is('post')) {
			$user_id = $this->request->data['Folder']['user_id'];
			if ($this->Folder->save($this->request->data)) {
				$this->Session->setFlash(
					__('Folder added successfully'),
					'default',
					array('class' => SUCCESS)
				);
			}

			return $this->redirect(array('controller'=>'users','action'=>'admin_list_material', $user_id));
		}
	}

	public function admin_add_images($folderId)
	{
		$this->set('folderId',$folderId);
	}

	public function admin_upload_images($userId = null, $folderId = null)
	{
		$this->layout = "ajax";
		App::import('Vendor','UploadHandler',array('file' => 'UploadHandler/UploadHandler.php'));

		$this->loadModel('Gallery');

		$uploadUrl = Router::url('/').'img/upload/';

		if(!empty($userId))
		{
			$uploadUrl .= $userId.'/';
		}

		$options = array
		(
			'script_url' => Router::url('/').'admin/users/upload_images',
			'upload_dir' => APP.WEBROOT_DIR.DS.'img'.DS.'upload'.DS,
			'upload_url' => $uploadUrl,
			'max_number_of_files' => 10,
			'thumbnail' => array
			(
				'max_width' => 150,
				'max_height' => 150
			)
		);

		$upload_handler = new UploadHandler($options, $initialize = false);
		switch ($_SERVER['REQUEST_METHOD'])
		{
			case 'HEAD':
			case 'GET':
				$upload_handler->get();
				break;
			case 'POST':
				$upload_handler->post();

				if(!empty($result['files']))
				{
					foreach($result['files'] as $file)
					{
						if(!empty($file->name))
						{
							$gallery = array();
							$gallery['Gallery']['name'] = $file->name;
							$gallery['Gallery']['url'] = $uploadUrl;
							$gallery['Gallery']['folder_id'] = $folderId;
							$gallery['Gallery']['user_id'] = 1;
							$this->Gallery->save($gallery);
						}
					}
				}
				break;
			case 'DELETE':
				$upload_handler->delete();
				break;
			default:
				header('HTTP/1.0 405 Method Not Allowed');
		}
		exit;
	}

	public function admin_delete_folder($user_id, $folderId)
	{
		$this->loadModel('Folder');
		if ($this->request->is('post')) {
			if ($this->Folder->delete($folderId)) {
				$this->Session->setFlash(
					__('Folder deleted successfully'),
					'default',
					array('class' => SUCCESS)
				);
			}

			return $this->redirect(array('controller'=>'users','action'=>'admin_list_material', $user_id));
		}
	}
}