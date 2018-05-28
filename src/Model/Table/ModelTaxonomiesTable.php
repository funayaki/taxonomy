<?php

namespace Taxonomy\Model\Table;
use Cake\ORM\Table;

/**
 * ModelTaxonomies
 *
 * @category Taxonomy.Model
 * @package  Croogo.Taxonomy.Model
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.croogo.org
 */
class ModelTaxonomiesTable extends Table
{

    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->table('model_taxonomies');
    }

}
