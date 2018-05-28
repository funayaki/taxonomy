<?php

namespace Taxonomy\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * @property TaxonomiesTable Taxonomies
 */
class VocabulariesTable extends Table
{

    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->addBehavior('ADmad/Sequence.Sequence', [
            'order' => 'weight',
        ]);

        $this->addBehavior('Timestamp', [
            'events' => [
                'Model.beforeSave' => [
                    'created' => 'new',
                    'updated' => 'always'
                ]
            ]
        ]);
        $this->addBehavior('Search.Search');
        $this->addBehavior('Croogo/Core.Cached', [
            'groups' => ['taxonomy']
        ]);
        $this->belongsToMany('Taxonomy.Types', [
            'joinTable' => 'types_vocabularies',
        ]);
        $this->hasMany('Taxonomy.Taxonomies', [
            'dependent' => true,
        ]);
    }

    /**
     * @param \Cake\Validation\Validator $validator
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->notBlank('title', __d('croogo', 'The title cannot be empty'))
            ->notBlank('alias', __d('croogo', 'The alias cannot be empty'));

        return parent::validationDefault($validator);
    }

    /**
     * @param \Cake\ORM\RulesChecker $rules
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(
            ['alias'],
            __d('croogo', 'That alias is already taken')
        ));
        return parent::buildRules($rules);
    }
}
