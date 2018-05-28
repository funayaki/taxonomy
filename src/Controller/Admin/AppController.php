<?php

namespace Taxonomy\Controller\Admin;

use App\Controller\Admin\AppController as BaseController;
use Crud\Controller\ControllerTrait;

/**
 * Taxonomy Admin Controller
 *
 * @category Taxonomy.Controller
 * @package  Croogo.Taxonomy
 * @since  1.5
 * @author   Fahad Ibnay Heylaal <contact@fahad19.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.croogo.org
 */
class AppController extends BaseController
{
    use ControllerTrait;

    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Crud.Crud', [
            'actions' => [
                'index' => [
                    'className' => 'Crud.Index',
                ],
                'add' => [
                    'className' => 'Crud.Add',
                    'view' => 'form',
                    'messages' => [
                        'success' => [
                            'text' => __d('croogo', 'The {name} has been saved.'),
                        ],
                        'error' => [
                            'text' => __d('croogo', 'The {name} could not be saved. Please, try again.'),
                        ]
                    ],
                ],
                'edit' => [
                    'className' => 'Crud.Edit',
                    'view' => 'form',
                    'messages' => [
                        'success' => [
                            'text' => __d('croogo', 'The {name} has been saved.'),
                        ],
                        'error' => [
                            'text' => __d('croogo', 'The {name} could not be saved. Please, try again.'),
                        ]
                    ],
                ],
                'delete' => [
                    'className' => 'Crud.Delete',
                    'messages' => [
                        'success' => [
                            'text' => __d('croogo', 'The {name} has been deleted.'),
                        ],
                        'error' => [
                            'text' => __d('croogo', 'The {name} could not be deleted. Please, try again.'),
                        ]
                    ],
                ],
            ]
        ]);
    }

    public function index()
    {
        $this->Crud->execute();
    }

    public function add()
    {
        $this->Crud->execute();
    }

    public function edit()
    {
        $this->Crud->execute();
    }

    public function delete()
    {
        $this->Crud->execute();
    }
}
