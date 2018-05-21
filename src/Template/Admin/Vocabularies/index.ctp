<?php
/**
 * @var \App\View\AppView $this
 * @var \Taxonomy\Model\Entity\Vocabulary[]|\Cake\Collection\CollectionInterface $vocabularies
 */
$this->extend('Cirici/AdminLTE./Common/index');

$this->assign('subtitle', __d('croogo', 'Index'));

$this->start('breadcrumb');
$this->Breadcrumbs
    ->add(__d('croogo', 'Vocabularies'), ['action' => 'index'])
    ->add(__d('croogo', 'Index'), null, ['class' => 'active']);

echo $this->Breadcrumbs->render();
$this->end();

$this->start('table-header');
$tableHeaders = $this->Html->tableHeaders([
    $this->Paginator->sort('title', __d('croogo', 'Title')),
    $this->Paginator->sort('alias', __d('croogo', 'Alias')),
    $this->Paginator->sort('plugin', __d('croogo', 'Plugin')),
    __d('croogo', 'Actions'),
]);

echo $this->Html->tag('thead', $tableHeaders);
$this->end();

$this->append('table-body');
$rows = [];
foreach ($vocabularies as $vocabulary) :
    $actions = [];
    $actions[] = $this->Html->link(__d('croogo', 'View terms'),
        ['controller' => 'Terms', 'action' => 'index', '?' => ['vocabulary_id' => $vocabulary->id]],
        ['class' => 'btn btn-default btn-xs']
    );
    $actions[] = $this->Html->link(__d('croogo', 'Move up'),
        ['controller' => 'vocabularies', 'action' => 'moveUp', $vocabulary->id],
        ['class' => 'btn btn-default btn-xs']
    );
    $actions[] = $this->Html->link(__d('croogo', 'Move down'),
        ['controller' => 'vocabularies', 'action' => 'moveDown', $vocabulary->id],
        ['class' => 'btn btn-default btn-xs']
    );
    $actions[] = $this->Html->link(__d('croogo', 'Edit this item'),
        ['controller' => 'vocabularies', 'action' => 'edit', $vocabulary->id],
        ['class' => 'btn btn-default btn-xs']
    );
    $actions[] = $this->Form->postLink(__d('croogo', 'Remove this item'),
        ['controller' => 'vocabularies', 'action' => 'delete', $vocabulary->id],
        ['confirm' => __d('croogo', 'Are you sure?'), 'class' => 'btn btn-danger btn-xs']
    );
    $actions = $this->Html->div('item-actions', implode(' ', $actions));
    $rows[] = [
        $this->Html->link($vocabulary->title, ['controller' => 'Terms', 'action' => 'index', '?' => ['vocabulary_id' => $vocabulary->id]]),
        $vocabulary->alias,
        $vocabulary->plugin,
        [$actions, ['class' => 'actions', 'style' => 'white-space:nowrap']],
    ];
endforeach;

echo $this->Html->tableCells($rows);

$this->end();
