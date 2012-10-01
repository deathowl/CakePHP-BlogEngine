<?php
App::uses('AppController', 'Controller');
/**
 * PostRatings Controller
 *
 * @property PostRating $PostRating
 */
class PostRatingsController extends AppController {

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->PostRating->create();
			if ($this->PostRating->save($this->request->data)) {
				$this->Session->setFlash(__('A posztot sikeresen értékelted!'));
			} else {
				$this->Session->setFlash(__('Hiba történt, próbáld újra!'));
			}
			$this->redirect(array('controller' => 'Posts', 
                      'action' => 'view',
                      $this->request->data['PostRating']['post_id'])
		);
		}
		

	}


}
