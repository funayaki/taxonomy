<?php
/**
 * @var \App\View\AppView $this
 * @var \Taxonomy\Model\Entity\Vocabulary $vocabulary
 */

//$this->Croogo->adminScript('Croogo/Taxonomy.vocabularies');

$this->extend('Cirici/AdminLTE./Common/form');

// TODO
//$this->Breadcrumbs->add(__d('croogo', 'Content'),
//    ['plugin' => 'Croogo/Nodes', 'controller' => 'Nodes', 'action' => 'index']);

if ($this->request->params['action'] == 'edit') {
    $this->assign('title', __d('croogo', 'Edit Vocabulary'));

    $this->Breadcrumbs->add(__d('croogo', 'Vocabularies'), ['action' => 'index', $vocabulary->id])
        ->add($vocabulary->title);
}

if ($this->request->params['action'] == 'add') {
    $this->assign('title', __d('croogo', 'Add Vocabulary'));

    $this->Breadcrumbs->add(__d('croogo', 'Vocabularies'), ['action' => 'index'])
        ->add(__d('croogo', 'Add'), $this->request->getRequestTarget());
}

$this->append('form-start', $this->Form->create($vocabulary, [
    'novalidate' => true,
]));

//$this->start('tab-header');
//echo $this->Croogo->adminTab(__d('croogo', 'Vocabulary'), '#vocabulary-basic');
//$this->end();

$this->start('form-content');
echo $this->Form->control('title', [
    'label' => __d('croogo', 'Title'),
    'data-slug' => '#alias',
]);
echo $this->Form->control('alias', [
    'label' => __d('croogo', 'Alias'),
    'class' => 'slug',
]);
echo $this->Form->control('description', [
    'label' => __d('croogo', 'Description'),
]);
echo $this->Form->control('types._ids', [
    'label' => __d('croogo', 'Content types'),
    'class' => 'c-select',
    'help' => __d('croogo', 'Select which content types will use this vocabulary')
]);
echo $this->Form->control('required', [
    'label' => __d('croogo', 'Required'),
    'class' => false,
    'help' => __d('croogo', 'Required to select a term from the vocabulary.'),
]);
echo $this->Form->control('multiple', [
    'label' => __d('croogo', 'Multiple selections'),
    'class' => false,
    'help' => __d('croogo', 'Allow multiple terms to be selected.'),
]);
echo $this->Form->control('tags', [
    'label' => __d('croogo', 'Freetags'),
    'class' => false,
    'help' => __d('croogo', 'Allow free-typing of terms/tags.'),
]);
$this->end();

$this->assign('form-button', $this->Form->button(__d('croogo', 'Submit')));

$this->assign('form-end', $this->Form->end());
