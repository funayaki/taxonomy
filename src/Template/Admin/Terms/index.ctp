<?php
/**
 * @var \App\View\AppView $this
 * @var \Taxonomy\Model\Entity\Term[]|\Cake\Collection\CollectionInterface $terms
 * @var \Taxonomy\Model\Entity\Vocabulary[] $vocabulary
 */

$this->assign('title', __d('croogo', 'Vocabulary: {0}', $vocabulary->title));

$this->extend('Cirici/AdminLTE./Common/index');

// TODO
//$this->Breadcrumbs->add(__d('croogo', 'Content'),
//    ['plugin' => 'Croogo/Nodes', 'controller' => 'Nodes', 'action' => 'index'])
//    ->add(__d('croogo', 'Vocabularies'),
//        ['plugin' => 'Croogo/Taxonomy', 'controller' => 'Vocabularies', 'action' => 'index'])
//    ->add($vocabulary->title, $this->request->getRequestTarget());

$this->Breadcrumbs
    ->add(__d('croogo', 'Vocabularies'), ['plugin' => 'Taxonomy', 'controller' => 'Vocabularies', 'action' => 'index'])
    ->add($vocabulary->title, $this->request->getRequestTarget());

//$this->append('action-buttons');
//echo $this->Croogo->adminAction(__d('croogo', 'Create term'), [
//    'action' => 'add',
//    'vocabulary_id' => $vocabulary->id,
//], [
//    'class' => 'btn btn-success',
//]);
//$this->end();

$this->start('table-header');
$tableHeaders = $this->Html->tableHeaders([
    __d('croogo', 'Title'),
    __d('croogo', 'Slug'),
    __d('croogo', 'Actions'),
]);
echo $this->Html->tag('thead', $tableHeaders);
$this->end();

$this->append('table-body');
$rows = [];

foreach ($terms as $term):
    $actions = [];
    $actions[] = $this->Html->link(__d('croogo', 'Move up'),
        ['action' => 'moveUp', $term->id, $vocabulary->id],
        ['class' => 'btn btn-default btn-xs']
    );
    $actions[] = $this->Html->link(__d('croogo', 'Move down'),
        ['action' => 'moveDown', $term->id, $vocabulary->id],
        ['class' => 'btn btn-default btn-xs']
    );
    $actions[] = $this->Html->link(__d('croogo', 'Edit this item'),
        ['action' => 'edit', $term->id, 'vocabulary_id' => $vocabulary->id],
        ['class' => 'btn btn-default btn-xs']
    );
    $actions[] = $this->Html->link(__d('croogo', 'Remove this item'),
        ['action' => 'delete', $term->id, $vocabulary->id],
        ['class' => 'btn btn-danger btn-xs', 'confirm' => __d('croogo', 'Are you sure?')]
    );
    $actions = $this->Html->div('item-actions', implode(' ', $actions));

    // Title Column
    $titleCol = $term->title;
    if (isset($defaultType['alias'])) {
//TODO
//        $titleCol = $this->Html->link($term->title, [
//            'prefix' => false,
//            'plugin' => 'Croogo/Nodes',
//            'controller' => 'Nodes',
//            'action' => 'term',
//            'type' => $defaultType->alias,
//            'slug' => $term->slug,
//        ], [
//            'target' => '_blank',
//        ]);
    }

    if (!empty($term['Term']['indent'])):
        $titleCol = str_repeat('&emsp;', $term['Term']['indent']) . $titleCol;
    endif;

    // Build link list
// TODO
//    $typeLinks = $this->Taxonomies->generateTypeLinks($vocabulary->types, $term);
//    if (!empty($typeLinks)) {
//        $titleCol .= $this->Html->tag('small', $typeLinks);
//    }

    $rows[] = [
        $titleCol,
        $term->slug,
        $actions,
    ];
endforeach;
echo $this->Html->tableCells($rows);
$this->end();

$this->append('header-actions');
echo $this->Html->link(__d('croogo', 'New Term'),
    ['action' => 'add', 'vocabulary_id' => $vocabulary->id],
    ['class' => 'btn btn-default pull-right']
);
$this->end();
