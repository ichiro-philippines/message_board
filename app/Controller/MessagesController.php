<?php
App::uses('AppController', 'Controller');
App::uses('UserController', 'Controller');

/**
 * Messages Controller
 *
 * @property Message $Message
 * @property PaginatorComponent $Paginator
 */
class MessagesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Message->recursive = 0;
		$this->set('messages', $this->Paginator->paginate());
	}

	public function list() {
		$userId = $this->Auth->user('id');
		if (!$userId) {
			return $this->redirect('/users/login');
		}
		$data = $this->Message->find('all',array(
			'conditions' => array(
			'Message.destination_user_id' => array($userId),
			// 'Message.sender_user_id' => array($userId),
			),
			'order' => array('Message.created' => 'desc'),
			'group' => 'Message.sender_user_id',

			));
		// $destinetion_user_id = [];
		// foreach ($data as $val) {
		// 	$destinetion_user_id[] = $val['Message']['destination_user_id'];
		// }
		// var_dump($data);exit;
		$this->set('message', $data);
	}

	public function detail($senderId) {
		$userId = $this->Auth->user('id');
		if ($this->request->is('post')) {
			$this->Message->create();
			if ($this->Message->save($this->request->data)) {
				$this->Flash->success(__('The message has been saved.'));
				return $this->redirect('/messages/detail');
			} else {
				$this->Flash->error(__('The message could not be saved. Please, try again.'));
			}
		}

		$data = $this->Message->find('all',array(
			'conditions' => array(
			'Message.destination_user_id' => array($userId, $senderId),
			'Message.sender_user_id' => array($senderId, $userId),
			),
			'order' => array('Message.created' => 'desc'),

			));
			rsort($data);
			// var_dump($data);exit;
		$this->set(array('message' => $data, 'senderId' => $senderId));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Message->exists($id)) {
			throw new NotFoundException(__('Invalid message'));
		}
		$options = array('conditions' => array('Message.' . $this->Message->primaryKey => $id));
		$this->set('message', $this->Message->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Message->create();
			if ($this->Message->save($this->request->data)) {
				$this->Flash->success(__('The message has been saved.'));
				return $this->redirect('list');
			} else {
				$this->Flash->error(__('The message could not be saved. Please, try again.'));
			}
		}
		$users = $this->Message->User->find('all');
		$userInfo = [];
		foreach ($users as $key => $val) {
			// $userInfo[$key]['destination_user_id'] = $val['User']['id'];
			// $userInfo[$key]['username'] = $val['User']['username'];
			$userInfo['usernames'][] = $val['User']['username'];
		}
		$this->set('users', $userInfo);
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Message->exists($id)) {
			throw new NotFoundException(__('Invalid message'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Message->save($this->request->data)) {
				$this->Flash->success(__('The message has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The message could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Message.' . $this->Message->primaryKey => $id));
			$this->request->data = $this->Message->find('first', $options);
		}
		$users = $this->Message->User->find('list');
		$this->set(compact('users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->Message->exists($id)) {
			throw new NotFoundException(__('Invalid message'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Message->delete($id)) {
			$this->Flash->success(__('The message has been deleted.'));
		} else {
			$this->Flash->error(__('The message could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
