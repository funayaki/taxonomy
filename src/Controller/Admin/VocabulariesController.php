<?php

namespace Taxonomy\Controller\Admin;

/**
 * Vocabularies Controller
 *
 * @category Taxonomy.Controller
 * @package  Croogo
 * @version  1.0
 * @author   Fahad Ibnay Heylaal <contact@fahad19.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.croogo.org
 *
 * @property \Taxonomy\Model\Table\VocabulariesTable Vocabularies
 */
class VocabulariesController extends AppController
{

    /**
     * Index
     *
     * @return void
     * @access public
     */
    public function index()
    {
        $vocabularies = $this->paginate();
        $this->set('vocabularies', $vocabularies);
    }

    /**
     * Add
     *
     * @return \Cake\Http\Response|null
     * @access public
     */
    public function add()
    {
        $this->viewBuilder()->setTemplate('form');
        $this->set('title_for_layout', __d('croogo', 'Add Vocabulary'));

        $vocabulary = $this->Vocabularies->newEntity();
        if ($this->request->is('post')) {
            $vocabulary = $this->Vocabularies->patchEntity($vocabulary, $this->request->getData());
            if ($this->Vocabularies->save($vocabulary)) {
                $this->Flash->success(__d('croogo', 'The vocabulary has been saved'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__d('croogo', 'The vocabulary could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('vocabulary'));
    }

    /**
     * Edit
     *
     * @param integer $id
     * @return \Cake\Http\Response|null
     * @access public
     */
    public function edit($id = null)
    {
        $this->viewBuilder()->setTemplate('form');
        $this->set('title_for_layout', __d('croogo', 'Edit Vocabulary'));

        $vocabulary = $this->Vocabularies->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $vocabulary = $this->Vocabularies->patchEntity($vocabulary, $this->request->getData());
            if ($this->Vocabularies->save($vocabulary)) {
                $this->Flash->success(__d('croogo', 'The vocabulary has been saved'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__d('croogo', 'The vocabulary could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('vocabulary'));
    }

    /**
     * Delete
     *
     * @param null $id
     * @return \Cake\Http\Response|null
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $vocabulary = $this->Vocabularies->get($id);
        if ($this->Vocabularies->delete($vocabulary)) {
            $this->Flash->success(__d('croogo', 'The vocabulary has been deleted.'));
        } else {
            $this->Flash->error(__d('croogo', 'The vocabulary could not be deleted. Please, try again.'));
        }

        if (!$redirect = $this->referer()) {
            $redirect = array(
                'admin' => true,
                'plugin' => 'taxonomy',
                'controller' => 'vocabularies',
                'action' => 'index'
            );
        }
        return $this->redirect($redirect);
    }

    /**
     * Move Up
     *
     * @param null $id
     * @return \Cake\Http\Response|null
     */
    public function moveUp($id = null)
    {
        $vocabulary = $this->Vocabularies->get($id);
        if ($this->Vocabularies->moveUp($vocabulary)) {
            $this->Flash->success(__d('croogo', 'Moved up successfully'));
        } else {
            $this->Flash->error(__d('croogo', 'Could not move up'));
        }

        if (!$redirect = $this->referer()) {
            $redirect = array(
                'admin' => true,
                'plugin' => 'vocabularies',
                'controller' => 'vocabularies',
                'action' => 'index'
            );
        }
        return $this->redirect($redirect);
    }

    /**
     * Move Down
     *
     * @param null $id
     * @return \Cake\Http\Response|null
     */
    public function moveDown($id = null)
    {
        $vocabulary = $this->Vocabularies->get($id);
        if ($this->Vocabularies->moveDown($vocabulary)) {
            $this->Flash->success(__d('croogo', 'Moved down successfully'));
        } else {
            $this->Flash->error(__d('croogo', 'Could not move down'));
        }

        if (!$redirect = $this->referer()) {
            $redirect = array(
                'admin' => true,
                'plugin' => 'vocabularies',
                'controller' => 'vocabularies',
                'action' => 'index'
            );
        }
        return $this->redirect($redirect);
    }
}
