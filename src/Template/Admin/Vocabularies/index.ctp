<?php
/**
 * @var \App\View\AppView $this
 * @var \Taxonomy\Model\Entity\Vocabulary[]|\Cake\Collection\CollectionInterface $vocabularies
 */

$this->extend('Cirici/AdminLTE./Common/index');

// TODO
//$this->Breadcrumbs->add(__d('croogo', 'Content'),
//    ['plugin' => 'Html/Nodes', 'controller' => 'Nodes', 'action' => 'index'])
//    ->add(__d('croogo', 'Vocabularies'), $this->request->getRequestTarget());

$this->Breadcrumbs
    ->add(__d('croogo', 'Vocabularies'), $this->request->getRequestTarget());

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
        ['action' => 'moveUp', $vocabulary->id],
        ['class' => 'btn btn-default btn-xs']
    );
    $actions[] = $this->Html->link(__d('croogo', 'Move down'),
        ['action' => 'moveDown', $vocabulary->id],
        ['class' => 'btn btn-default btn-xs']
    );
    $actions[] = $this->Html->link(__d('croogo', 'Edit this item'),
        ['action' => 'edit', $vocabulary->id],
        ['class' => 'btn btn-default btn-xs']
    );
    $actions[] = $this->Html->link(__d('croogo', 'Remove this item'),
        ['action' => 'delete', $vocabulary->id],
        ['class' => 'btn btn-danger btn-xs', 'confirm' => __d('croogo', 'Are you sure?')]
    );
    $actions = $this->Html->div('item-actions', implode(' ', $actions));
    $rows[] = [
        $this->Html->link($vocabulary->title, ['controller' => 'Terms', 'action' => 'index', '?' => ['vocabulary_id' => $vocabulary->id]]),
        $vocabulary->alias,
        $vocabulary->plugin,
        [$actions, ['style' => 'white-space:nowrap']]
    ];
endforeach;

echo $this->Html->tableCells($rows);

$this->end();

$this->append('header-actions');
echo $this->Html->link(__d('croogo', 'New Vocabulary'),
    ['action' => 'add'],
    ['class' => 'btn btn-default pull-right']
);
$this->end();
