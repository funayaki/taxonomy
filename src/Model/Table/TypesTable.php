<?php

namespace Taxonomy\Model\Table;

use Cake\Database\Schema\TableSchema;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Utility\Hash;
use Cake\Utility\Inflector;
use Cake\Validation\Validator;

class TypesTable extends Table
{

    /**
     * Display fields for this model
     *
     * @var array
     */
    protected $_displayFields = [
        'title' => [
            'url' => [
                'prefix' => false,
                'plugin' => 'Croogo/Nodes',
                'controller' => 'Nodes',
                'action' => 'index',
                'named' => [
                    'alias' => 'type'
                ],
            ]
        ],
        'description',
    ];

    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->addBehavior('Timestamp', [
            'events' => [
                'Model.beforeSave' => [
                    'created' => 'new',
                    'updated' => 'always'
                ]
            ]
        ]);
        $this->addBehavior('Croogo/Core.Url', [
            'url' => [
                'plugin' => 'Croogo/Nodes',
                'controller' => 'Nodes',
                'action' => 'index'
            ],
            'fields' => [
                'type' => 'alias'
            ]
        ]);
        $this->addBehavior('Search.Search');
        $this->addBehavior('Croogo/Core.Cached', [
            'groups' => ['nodes', 'taxonomy']
        ]);
        $this->addBehavior('Croogo/Core.Trackable');
        $this->belongsToMany('Taxonomy.Vocabularies', [
            'joinTable' => 'types_vocabularies',
        ]);
    }

    /**
     * @param \Cake\Validation\Validator $validator Validator
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator->notBlank('title', __d('croogo', 'Title cannot be empty.'));
        $validator->notBlank('alias', __d('croogo', 'Alias cannot be empty.'));
        return $validator;
    }

    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(
            ['alias'],
            __d('croogo', 'That alias is already taken.')
        ));
        return $rules;
    }

    /**
     * Get a list of relevant types for given plugin
     */
    public function pluginTypes($plugin = null)
    {
        if ($plugin === null) {
            $conditions = [];
        } elseif ($plugin) {
            $conditions = ['plugin' => $plugin];
        } else {
            $conditions = [
                'OR' => [
                    'plugin LIKE' => '',
                    'plugin' => null,
                ],
            ];
        }
        return $this->find('list', compact('conditions'));
    }

    protected function _initializeSchema(TableSchema $table)
    {
        $table->columnType('params', 'params');
        return parent::_initializeSchema($table);
    }

    /**
     * https://github.com/croogo/core/blob/a4c39287b001f4847e73edde75a15439b4bb0ec9/src/Model/Table/CroogoTable.php#L127-L159
     *
     * Return formatted display fields
     *
     * @param array $displayFields
     * @return array
     */
    public function displayFields($displayFields = null)
    {
        if (isset($displayFields)) {
            $this->_displayFields = $displayFields;
        }
        $out = [];
        $defaults = ['sort' => true, 'type' => 'text', 'url' => [], 'options' => []];
        foreach ($this->_displayFields as $field => $label) {
            if (is_int($field)) {
                $field = $label;
                list(, $label) = pluginSplit($label);
                $out[$field] = Hash::merge($defaults, [
                    'label' => Inflector::humanize($label),
                ]);
            } elseif (is_array($label)) {
                $out[$field] = Hash::merge($defaults, $label);
                if (!isset($out[$field]['label'])) {
                    $out[$field]['label'] = Inflector::humanize($field);
                }
            } else {
                $out[$field] = Hash::merge($defaults, [
                    'label' => $label,
                ]);
            }
        }
        return $out;
    }
}
