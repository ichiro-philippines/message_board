<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 * @property FlashComponent $Flash
 */
class UsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'Flash',);

	public function beforeFilter() {
		$this->Auth->allow('add', 'thanks');
	}

	public function login() {
		// if user already login, display homepage
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$userId = $this->Auth->user('id');
				$this->User->updateLastLogin($userId);
				$data = $this->User->findById($userId);
				if (empty($data['User']['picture'])) {
					return $this->redirect('/users/addprofile');
				} else {
					return $this->redirect('/messages/list');
				}
				
			} else {
				$this->Session->setFlash('Invalid email or password');
			}
		}
	}

	public function logout() {
		$this->Auth->logout();
		$this->redirect('login');
	}
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			$this->request->data['User']['password'] = AuthComponent::password($this->request->data['User']['password']);
			$this->request->data['User']['confirm_password'] = AuthComponent::password($this->request->data['User']['confirm_password']);
			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('The user has been saved.'));
				return $this->redirect('thanks');
			} else {
				$this->Flash->error(__('The user could not be saved. Please, try again.'));
			}
		}
	}
	public function thanks() {

	}

	public function profile() {
		$userId = $this->Auth->user('id');
		$data = $this->User->findById($userId);
		$this->set('user', $data);
	}

	public function addProfile() {
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->User->create();
			$file = $this->request->data['User']['picture'];
			$this->request->data['User']['picture'] = $this->request->data['User']['picture']['name'];
			if ($this->User->save($this->request->data)) {
				$path = PICTURES;
				$picture = $file['name'];
				$picture = basename($picture);
				$tempName = $file['tmp_name'];

				// upload the picture
				move_uploaded_file($tempName, $path . $picture);
				$this->Flash->success(__('The profile has been saved.'));
				return $this->redirect('/users/profile');
			} else {
				$this->Flash->error(__('The profile could not be saved. Please, try again.'));
			}
		}
		$userId = $this->Auth->user('id');
		$data = $this->User->findById($userId);
		$this->set('user', $data);
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$this->User->create();
			$file = $this->request->data['User']['picture'];
			$this->request->data['User']['picture'] = $this->request->data['User']['picture']['name'];
			if ($this->User->save($this->request->data)) {
				$path = PICTURES;
				$picture = $file['name'];
				$picture = basename($picture);
				$tempName = $file['tmp_name'];

				// upload the picture
				move_uploaded_file($tempName, $path . $picture);
				$this->Flash->success(__('The profile has been saved.'));
				return $this->redirect('/users/profile');
			} else {
				$this->Flash->error(__('The profile could not be saved. Please, try again.'));
			}
		}
		$userId = $this->Auth->user('id');
		$data = $this->User->findById($userId);
		$this->set('user', $data);
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->User->delete($id)) {
			$this->Flash->success(__('The user has been deleted.'));
		} else {
			$this->Flash->error(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
