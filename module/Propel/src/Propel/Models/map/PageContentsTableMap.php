<?php

namespace Propel\Models\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'page_contents' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator..map
 */
class PageContentsTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.map.PageContentsTableMap';

    /**
     * Initialize the table attributes, columns and validators
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('page_contents');
        $this->setPhpName('PageContents');
        $this->setClassname('Propel\\Models\\PageContents');
        $this->setPackage('');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignPrimaryKey('page_id', 'PageId', 'INTEGER' , 'pages', 'id', true, null, null);
        $this->addForeignPrimaryKey('content_id', 'ContentId', 'INTEGER' , 'contents', 'id', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Contents', 'Propel\\Models\\Contents', RelationMap::MANY_TO_ONE, array('content_id' => 'id', ), null, null);
        $this->addRelation('Pages', 'Propel\\Models\\Pages', RelationMap::MANY_TO_ONE, array('page_id' => 'id', ), null, null);
    } // buildRelations()

} // PageContentsTableMap
