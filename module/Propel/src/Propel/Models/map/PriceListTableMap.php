<?php

namespace Propel\Models\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'price_list' table.
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
class PriceListTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.map.PriceListTableMap';

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
        $this->setName('price_list');
        $this->setPhpName('PriceList');
        $this->setClassname('Propel\\Models\\PriceList');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('house_id', 'HouseId', 'INTEGER', 'house', 'id', true, null, null);
        $this->addColumn('date_from', 'DateFrom', 'DATE', true, null, null);
        $this->addColumn('date_to', 'DateTo', 'DATE', true, null, null);
        $this->addColumn('price', 'Price', 'INTEGER', true, null, null);
        $this->addColumn('status', 'Status', 'VARCHAR', true, 45, null);
        $this->addColumn('active', 'Active', 'TINYINT', true, null, null);
        $this->addColumn('created', 'Created', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('last_modified', 'LastModified', 'TIMESTAMP', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('House', 'Propel\\Models\\House', RelationMap::MANY_TO_ONE, array('house_id' => 'id', ), null, null);
    } // buildRelations()

} // PriceListTableMap
