<?php
/**
 * @var \App\View\AppView $this
 * @var \Taxonomy\Model\Entity\Term $term
 * @var \Taxonomy\Model\Entity\Vocabulary $vocabulary
 */

//$this->Croogo->adminScript('Croogo/Taxonomy.terms');

$this->extend('Cirici/AdminLTE./Common/form');

// TODO
//$this->Breadcrumbs->add(__d('croogo', 'Content'),
//    ['plugin' => 'Croogo/Nodes', 'controller' => 'Nodes', 'action' => 'index']);

if ($this->request->param('action') === 'edit'):
    $this->Breadcrumbs->add(__d('croogo', 'Vocabularies'), ['controller' => 'Vocabularies', 'action' => 'index'])
        ->add($vocabulary->title, ['action' => 'index', 'vocabulary_id' => $vocabulary->id])
        ->add($term->title, $this->request->getRequestTarget());
endif;

if ($this->request->param('action') === 'add'):
    $this->assign('title', __d('croogo', '{0}: Add Term', $vocabulary->title));

    $this->Breadcrumbs->add(__d('croogo', 'Vocabularies'),
        ['controller' => 'Vocabularies', 'action' => 'index', $vocabulary->id])
        ->add($vocabulary->title, ['action' => 'index', 'vocabulary_id' => $vocabulary->id])
        ->add(__d('croogo', 'Add'), $this->request->getRequestTarget());
endif;

$this->set('cancelUrl', ['action' => 'index', $vocabularyId]);

$formUrl = [
    'action' => $this->request->param('action'),
    isset($this->request->pass[0]) ? $this->request->pass[0] : null,
    'vocabulary_id' => $vocabulary->id,
];

$this->assign('form-start', $this->Form->create($term, [
    'url' => $formUrl,
    'novalidate' => true,
]));

//$this->append('tab-heading');
//echo $this->Croogo->adminTab(__d('croogo', 'Term'), '#term-basic');
//$this->end();

$this->append('form-content');
//echo $this->Html->tabStart('term-basic');
echo $this->Form->control('title', [
    'label' => __d('croogo', 'Title'),
    'data-slug' => '#slug',
]);

echo $this->Form->control('slug', [
    'label' => __d('croogo', 'Slug'),
]);

echo $this->Form->control('taxonomies.0.parent_id', [
    'options' => $parentTree,
    'empty' => '(no parent)',
    'label' => __d('croogo', 'Parent'),
    'class' => 'c-select',
]);
echo $this->Form->control('taxonomies.0.id');
echo $this->Form->hidden('taxonomies.0.vocabulary_id', [
    'value' => $vocabulary->id,
]);
echo $this->Form->control('description', [
    'label' => __d('croogo', 'Description'),
]);

//echo $this->Html->tabEnd();
$this->end();

//$this->start('buttons');
//echo $this->Html->beginBox(__d('croogo', 'Publishing'));
//echo $this->element('Croogo/Core.admin/buttons', ['type' => 'Terms']);
//echo $this->Html->endBox();
//$this->end();

$this->assign('form-button', $this->Form->button(__d('croogo', 'Submit')));

$this->assign('form-end', $this->Form->end());
