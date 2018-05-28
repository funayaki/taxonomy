<?php

namespace Taxonomy\Controller\Admin;

use Cake\Event\Event;

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
    public function initialize()
    {
        parent::initialize();

        $this->Crud->config('actions.moveUp', [
            'className' => 'Croogo/Core.Admin/MoveUp'
        ]);
        $this->Crud->config('actions.moveDown', [
            'className' => 'Croogo/Core.Admin/MoveDown'
        ]);
    }

    public function beforeCrudRender(Event $event)
    {
        if (!isset($event->subject()->entity)) {
            return;
        }

        $entity = $event->subject()->entity;

        $this->set('types', $this->Vocabularies->Types->pluginTypes($entity->plugin));
    }

    public function implementedEvents()
    {
        return parent::implementedEvents() + [
            'Crud.beforeRender' => 'beforeCrudRender'
        ];
    }

    /**
     * TODO Delegate action to Crud.Crud
     * Admin moveup
     *
     * @param int $id
     * @param int $step
     * @return \Cake\Http\Response|null
     * @access public
     */
    public function moveup($id, $step = 1)
    {
        $vocabulary = $this->Vocabularies->get($id);
        if ($this->Vocabularies->moveUp($vocabulary)) {
            $this->Flash->success(__d('croogo', 'Moved up successfully'));
        } else {
            $this->Flash->error(__d('croogo', 'Could not move up'));
        }
        if (!$redirect = $this->referer()) {
            $redirect = [
                'prefix' => 'admin',
                'plugin' => 'vocabularies',
                'controller' => 'vocabularies',
                'action' => 'index'
            ];
        }
        return $this->redirect($redirect);
    }

    /**
     * TODO Delegate action to Crud.Crud
     * Admin moveup
     *
     * @param int $id
     * @param int $step
     * @return \Cake\Http\Response|null
     * @access public
     */
    public function movedown($id, $step = 1)
    {
        $vocabulary = $this->Vocabularies->get($id);
        if ($this->Vocabularies->moveDown($vocabulary)) {
            $this->Flash->success(__d('croogo', 'Moved down successfully'));
        } else {
            $this->Flash->error(__d('croogo', 'Could not move down'));
        }
        return $this->redirect(['prefix' => 'admin', 'controller' => 'vocabularies', 'action' => 'index']);
    }
}
