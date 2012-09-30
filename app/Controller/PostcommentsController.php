<?php
App::uses('AppController', 'Controller');
/**
 * Postcomments Controller
 *
 * @property Postcomment $Postcomment
 */
class PostcommentsController extends AppController {

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Postcomment->create();
			if ($this->Postcomment->save($this->request->data)) {
				$this->Session->setFlash(__('A hozzászólást mentettük'));
			} else {
				$this->Session->setFlash(__('A hozzászólás mentése nem sikerült'));
			}
		}
		$this->redirect(array('controller' => 'Posts', 
                      'action' => 'view',
                      $this->request->data['Postcomment']['post_id'])
		);
	}


}
