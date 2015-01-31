<?php

namespace Propel\Models\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'contact_number' table.
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
class ContactNumberTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.map.ContactNumberTableMap';

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
        $this->setName('contact_number');
        $this->setPhpName('ContactNumber');
        $this->setClassname('Propel\\Models\\ContactNumber');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('contact_id', 'ContactId', 'INTEGER', 'contact', 'id', true, null, null);
        $this->addColumn('phone', 'Phone', 'VARCHAR', true, 9, null);
        $this->addColumn('active', 'Active', 'TINYINT', true, null, 1);
        $this->addColumn('created', 'Created', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Contact', 'Propel\\Models\\Contact', RelationMap::MANY_TO_ONE, array('contact_id' => 'id', ), null, null);
    } // buildRelations()

} // ContactNumberTableMap
