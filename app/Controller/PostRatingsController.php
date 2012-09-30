<?php
App::uses('AppController', 'Controller');
/**
 * PostRatings Controller
 *
 * @property PostRating $PostRating
 */
class PostRatingsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->PostRating->recursive = 0;
		$this->set('postRatings', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->PostRating->id = $id;
		if (!$this->PostRating->exists()) {
			throw new NotFoundException(__('Invalid post rating'));
		}
		$this->set('postRating', $this->PostRating->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->PostRating->create();
			if ($this->PostRating->save($this->request->data)) {
				$this->Session->setFlash(__('The post rating has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The post rating could not be saved. Please, try again.'));
			}
		}
		$users = $this->PostRating->User->find('list');
		$posts = $this->PostRating->Post->find('list');
		$this->set(compact('users', 'posts'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->PostRating->id = $id;
		if (!$this->PostRating->exists()) {
			throw new NotFoundException(__('Invalid post rating'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->PostRating->save($this->request->data)) {
				$this->Session->setFlash(__('The post rating has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The post rating could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->PostRating->read(null, $id);
		}
		$users = $this->PostRating->User->find('list');
		$posts = $this->PostRating->Post->find('list');
		$this->set(compact('users', 'posts'));
	}

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->PostRating->id = $id;
		if (!$this->PostRating->exists()) {
			throw new NotFoundException(__('Invalid post rating'));
		}
		if ($this->PostRating->delete()) {
			$this->Session->setFlash(__('Post rating deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Post rating was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
