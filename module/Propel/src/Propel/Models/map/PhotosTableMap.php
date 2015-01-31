<?php

namespace Propel\Models\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'photos' table.
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
class PhotosTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.map.PhotosTableMap';

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
        $this->setName('photos');
        $this->setPhpName('Photos');
        $this->setClassname('Propel\\Models\\Photos');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('gallery_id', 'GalleryId', 'INTEGER', 'galleries', 'id', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 45, null);
        $this->addColumn('path', 'Path', 'VARCHAR', true, 100, null);
        $this->addColumn('path_min', 'PathMin', 'VARCHAR', true, 100, null);
        $this->addColumn('description', 'Description', 'LONGVARCHAR', false, null, null);
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
        $this->addRelation('Galleries', 'Propel\\Models\\Galleries', RelationMap::MANY_TO_ONE, array('gallery_id' => 'id', ), 'CASCADE', 'CASCADE');
    } // buildRelations()

} // PhotosTableMap
