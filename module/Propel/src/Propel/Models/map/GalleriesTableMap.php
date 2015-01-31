<?php

namespace Propel\Models\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'galleries' table.
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
class GalleriesTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.map.GalleriesTableMap';

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
        $this->setName('galleries');
        $this->setPhpName('Galleries');
        $this->setClassname('Propel\\Models\\Galleries');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 100, null);
        $this->addColumn('base_photo', 'BasePhoto', 'VARCHAR', false, 100, null);
        $this->addColumn('active', 'Active', 'TINYINT', true, null, 1);
        $this->addColumn('last_modified', 'LastModified', 'TIMESTAMP', false, null, null);
        $this->addColumn('created', 'Created', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('ContentGalleries', 'Propel\\Models\\ContentGalleries', RelationMap::ONE_TO_MANY, array('id' => 'gallery_id', ), 'CASCADE', 'CASCADE', 'ContentGalleriess');
        $this->addRelation('Photos', 'Propel\\Models\\Photos', RelationMap::ONE_TO_MANY, array('id' => 'gallery_id', ), 'CASCADE', 'CASCADE', 'Photoss');
    } // buildRelations()

} // GalleriesTableMap
