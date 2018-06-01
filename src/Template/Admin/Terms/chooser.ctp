<?php
/**
 * @var \App\View\AppView $this
 * @var \Taxonomy\Model\Entity\Term[]|\Cake\Collection\CollectionInterface $terms
 */

$this->extend('Cirici/AdminLTE./Common/index');

$tableHeaders = $this->Html->tableHeaders([
    '',
    __d('croogo', 'Id'),
    __d('croogo', 'Title'),
    __d('croogo', 'Slug'),
]);

$this->start('table-header');
echo $this->Html->tag('thead', $tableHeaders);
$this->end();

$this->append('table-body');

$rows = [];

foreach ($terms as $term):
    $titleCol = $term->title;
    if (isset($defaultType)) {
        $titleCol = $this->Html->link($term->title, [
            'plugin' => 'Croogo/Nodes',
            'controller' => 'Nodes',
            'action' => 'term',
            'type' => $defaultType['alias'],
            'slug' => $term->slug,
            'prefix' => false,
        ], [
            'class' => 'item-choose',
            'data-chooser-type' => 'Node',
            'data-chooser-id' => $term->id,
            'data-chooser-title' => $term->title,
            'rel' => sprintf('plugin:%s/controller:%s/action:%s/type:%s/slug:%s', 'Croogo/Nodes', 'Nodes', 'term',
                $defaultType['alias'], $term->slug),
        ]);
    }

    $rows[] = [
        '',
        $term->id,
        $titleCol,
        $term->slug,
    ];

endforeach;

echo $this->Html->tableCells($rows);
$this->end();
