<?php

namespace Propel\Models\om;

use \BaseObject;
use \BasePeer;
use \Criteria;
use \DateTime;
use \Exception;
use \PDO;
use \Persistent;
use \Propel;
use \PropelCollection;
use \PropelDateTime;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use Propel\Models\ContentGalleries;
use Propel\Models\ContentGalleriesQuery;
use Propel\Models\Galleries;
use Propel\Models\GalleriesPeer;
use Propel\Models\GalleriesQuery;
use Propel\Models\Photos;
use Propel\Models\PhotosQuery;

/**
 * Base class that represents a row from the 'galleries' table.
 *
 *
 *
 * @package    propel.generator..om
 */
abstract class BaseGalleries extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Propel\\Models\\GalleriesPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        GalleriesPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinite loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the id field.
     * @var        int
     */
    protected $id;

    /**
     * The value for the name field.
     * @var        string
     */
    protected $name;

    /**
     * The value for the base_photo field.
     * @var        string
     */
    protected $base_photo;

    /**
     * The value for the active field.
     * Note: this column has a database default value of: 1
     * @var        int
     */
    protected $active;

    /**
     * The value for the last_modified field.
     * @var        string
     */
    protected $last_modified;

    /**
     * The value for the created field.
     * Note: this column has a database default value of: (expression) CURRENT_TIMESTAMP
     * @var        string
     */
    protected $created;

    /**
     * @var        PropelObjectCollection|ContentGalleries[] Collection to store aggregation of ContentGalleries objects.
     */
    protected $collContentGalleriess;
    protected $collContentGalleriessPartial;

    /**
     * @var        PropelObjectCollection|Photos[] Collection to store aggregation of Photos objects.
     */
    protected $collPhotoss;
    protected $collPhotossPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInSave = false;

    /**
     * Flag to prevent endless validation loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInValidation = false;

    /**
     * Flag to prevent endless clearAllReferences($deep=true) loop, if this object is referenced
     * @var        boolean
     */
    protected $alreadyInClearAllReferencesDeep = false;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $contentGalleriessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $photossScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see        __construct()
     */
    public function applyDefaultValues()
    {
        $this->active = 1;
    }

    /**
     * Initializes internal state of BaseGalleries object.
     * @see        applyDefaults()
     */
    public function __construct()
    {
        parent::__construct();
        $this->applyDefaultValues();
    }

    /**
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {

        return $this->id;
    }

    /**
     * Get the [name] column value.
     *
     * @return string
     */
    public function getName()
    {

        return $this->name;
    }

    /**
     * Get the [base_photo] column value.
     *
     * @return string
     */
    public function getBasePhoto()
    {

        return $this->base_photo;
    }

    /**
     * Get the [active] column value.
     *
     * @return int
     */
    public function getActive()
    {

        return $this->active;
    }

    /**
     * Get the [optionally formatted] temporal [last_modified] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getLastModified($format = 'Y-m-d H:i:s')
    {
        if ($this->last_modified === null) {
            return null;
        }

        if ($this->last_modified === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->last_modified);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->last_modified, true), $x);
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        }

        if (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        }

        return $dt->format($format);

    }

    /**
     * Get the [optionally formatted] temporal [created] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getCreated($format = 'Y-m-d H:i:s')
    {
        if ($this->created === null) {
            return null;
        }

        if ($this->created === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->created);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->created, true), $x);
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        }

        if (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        }

        return $dt->format($format);

    }

    /**
     * Set the value of [id] column.
     *
     * @param  int $v new value
     * @return Galleries The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = GalleriesPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [name] column.
     *
     * @param  string $v new value
     * @return Galleries The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[] = GalleriesPeer::NAME;
        }


        return $this;
    } // setName()

    /**
     * Set the value of [base_photo] column.
     *
     * @param  string $v new value
     * @return Galleries The current object (for fluent API support)
     */
    public function setBasePhoto($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->base_photo !== $v) {
            $this->base_photo = $v;
            $this->modifiedColumns[] = GalleriesPeer::BASE_PHOTO;
        }


        return $this;
    } // setBasePhoto()

    /**
     * Set the value of [active] column.
     *
     * @param  int $v new value
     * @return Galleries The current object (for fluent API support)
     */
    public function setActive($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->active !== $v) {
            $this->active = $v;
            $this->modifiedColumns[] = GalleriesPeer::ACTIVE;
        }


        return $this;
    } // setActive()

    /**
     * Sets the value of [last_modified] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Galleries The current object (for fluent API support)
     */
    public function setLastModified($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->last_modified !== null || $dt !== null) {
            $currentDateAsString = ($this->last_modified !== null && $tmpDt = new DateTime($this->last_modified)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->last_modified = $newDateAsString;
                $this->modifiedColumns[] = GalleriesPeer::LAST_MODIFIED;
            }
        } // if either are not null


        return $this;
    } // setLastModified()

    /**
     * Sets the value of [created] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Galleries The current object (for fluent API support)
     */
    public function setCreated($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created !== null || $dt !== null) {
            $currentDateAsString = ($this->created !== null && $tmpDt = new DateTime($this->created)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->created = $newDateAsString;
                $this->modifiedColumns[] = GalleriesPeer::CREATED;
            }
        } // if either are not null


        return $this;
    } // setCreated()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
            if ($this->active !== 1) {
                return false;
            }

        // otherwise, everything was equal, so return true
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
     * @param int $startcol 0-based offset column which indicates which resultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false)
    {
        try {

            $this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->name = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->base_photo = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->active = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
            $this->last_modified = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->created = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 6; // 6 = GalleriesPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Galleries object", $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {

    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param boolean $deep (optional) Whether to also de-associated any related objects.
     * @param PropelPDO $con (optional) The PropelPDO connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getConnection(GalleriesPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = GalleriesPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collContentGalleriess = null;

            $this->collPhotoss = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param PropelPDO $con
     * @return void
     * @throws PropelException
     * @throws Exception
     * @see        BaseObject::setDeleted()
     * @see        BaseObject::isDeleted()
     */
    public function delete(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(GalleriesPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = GalleriesQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $con->commit();
                $this->setDeleted(true);
            } else {
                $con->commit();
            }
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @throws Exception
     * @see        doSave()
     */
    public function save(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(GalleriesPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                GalleriesPeer::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see        save()
     */
    protected function doSave(PropelPDO $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                } else {
                    $this->doUpdate($con);
                }
                $affectedRows += 1;
                $this->resetModified();
            }

            if ($this->contentGalleriessScheduledForDeletion !== null) {
                if (!$this->contentGalleriessScheduledForDeletion->isEmpty()) {
                    ContentGalleriesQuery::create()
                        ->filterByPrimaryKeys($this->contentGalleriessScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->contentGalleriessScheduledForDeletion = null;
                }
            }

            if ($this->collContentGalleriess !== null) {
                foreach ($this->collContentGalleriess as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->photossScheduledForDeletion !== null) {
                if (!$this->photossScheduledForDeletion->isEmpty()) {
                    PhotosQuery::create()
                        ->filterByPrimaryKeys($this->photossScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->photossScheduledForDeletion = null;
                }
            }

            if ($this->collPhotoss !== null) {
                foreach ($this->collPhotoss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param PropelPDO $con
     *
     * @throws PropelException
     * @see        doSave()
     */
    protected function doInsert(PropelPDO $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[] = GalleriesPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . GalleriesPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(GalleriesPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(GalleriesPeer::NAME)) {
            $modifiedColumns[':p' . $index++]  = '`name`';
        }
        if ($this->isColumnModified(GalleriesPeer::BASE_PHOTO)) {
            $modifiedColumns[':p' . $index++]  = '`base_photo`';
        }
        if ($this->isColumnModified(GalleriesPeer::ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = '`active`';
        }
        if ($this->isColumnModified(GalleriesPeer::LAST_MODIFIED)) {
            $modifiedColumns[':p' . $index++]  = '`last_modified`';
        }
        if ($this->isColumnModified(GalleriesPeer::CREATED)) {
            $modifiedColumns[':p' . $index++]  = '`created`';
        }

        $sql = sprintf(
            'INSERT INTO `galleries` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`id`':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case '`name`':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
                        break;
                    case '`base_photo`':
                        $stmt->bindValue($identifier, $this->base_photo, PDO::PARAM_STR);
                        break;
                    case '`active`':
                        $stmt->bindValue($identifier, $this->active, PDO::PARAM_INT);
                        break;
                    case '`last_modified`':
                        $stmt->bindValue($identifier, $this->last_modified, PDO::PARAM_STR);
                        break;
                    case '`created`':
                        $stmt->bindValue($identifier, $this->created, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param PropelPDO $con
     *
     * @see        doSave()
     */
    protected function doUpdate(PropelPDO $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();
        BasePeer::doUpdate($selectCriteria, $valuesCriteria, $con);
    }

    /**
     * Array of ValidationFailed objects.
     * @var        array ValidationFailed[]
     */
    protected $validationFailures = array();

    /**
     * Gets any ValidationFailed objects that resulted from last call to validate().
     *
     *
     * @return array ValidationFailed[]
     * @see        validate()
     */
    public function getValidationFailures()
    {
        return $this->validationFailures;
    }

    /**
     * Validates the objects modified field values and all objects related to this table.
     *
     * If $columns is either a column name or an array of column names
     * only those columns are validated.
     *
     * @param mixed $columns Column name or an array of column names.
     * @return boolean Whether all columns pass validation.
     * @see        doValidate()
     * @see        getValidationFailures()
     */
    public function validate($columns = null)
    {
        $res = $this->doValidate($columns);
        if ($res === true) {
            $this->validationFailures = array();

            return true;
        }

        $this->validationFailures = $res;

        return false;
    }

    /**
     * This function performs the validation work for complex object models.
     *
     * In addition to checking the current object, all related objects will
     * also be validated.  If all pass then <code>true</code> is returned; otherwise
     * an aggregated array of ValidationFailed objects will be returned.
     *
     * @param array $columns Array of column names to validate.
     * @return mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objects otherwise.
     */
    protected function doValidate($columns = null)
    {
        if (!$this->alreadyInValidation) {
            $this->alreadyInValidation = true;
            $retval = null;

            $failureMap = array();


            if (($retval = GalleriesPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collContentGalleriess !== null) {
                    foreach ($this->collContentGalleriess as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collPhotoss !== null) {
                    foreach ($this->collPhotoss as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }


            $this->alreadyInValidation = false;
        }

        return (!empty($failureMap) ? $failureMap : true);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param string $name name
     * @param string $type The type of fieldname the $name is of:
     *               one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *               BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *               Defaults to BasePeer::TYPE_PHPNAME
     * @return mixed Value of field.
     */
    public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = GalleriesPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getName();
                break;
            case 2:
                return $this->getBasePhoto();
                break;
            case 3:
                return $this->getActive();
                break;
            case 4:
                return $this->getLastModified();
                break;
            case 5:
                return $this->getCreated();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     *                    BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                    Defaults to BasePeer::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to true.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {
        if (isset($alreadyDumpedObjects['Galleries'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Galleries'][$this->getPrimaryKey()] = true;
        $keys = GalleriesPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getBasePhoto(),
            $keys[3] => $this->getActive(),
            $keys[4] => $this->getLastModified(),
            $keys[5] => $this->getCreated(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collContentGalleriess) {
                $result['ContentGalleriess'] = $this->collContentGalleriess->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPhotoss) {
                $result['Photoss'] = $this->collPhotoss->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param string $name peer name
     * @param mixed $value field value
     * @param string $type The type of fieldname the $name is of:
     *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                     Defaults to BasePeer::TYPE_PHPNAME
     * @return void
     */
    public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = GalleriesPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

        $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @param mixed $value field value
     * @return void
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setName($value);
                break;
            case 2:
                $this->setBasePhoto($value);
                break;
            case 3:
                $this->setActive($value);
                break;
            case 4:
                $this->setLastModified($value);
                break;
            case 5:
                $this->setCreated($value);
                break;
        } // switch()
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     * The default key type is the column's BasePeer::TYPE_PHPNAME
     *
     * @param array  $arr     An array to populate the object from.
     * @param string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
    {
        $keys = GalleriesPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setBasePhoto($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setActive($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setLastModified($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setCreated($arr[$keys[5]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(GalleriesPeer::DATABASE_NAME);

        if ($this->isColumnModified(GalleriesPeer::ID)) $criteria->add(GalleriesPeer::ID, $this->id);
        if ($this->isColumnModified(GalleriesPeer::NAME)) $criteria->add(GalleriesPeer::NAME, $this->name);
        if ($this->isColumnModified(GalleriesPeer::BASE_PHOTO)) $criteria->add(GalleriesPeer::BASE_PHOTO, $this->base_photo);
        if ($this->isColumnModified(GalleriesPeer::ACTIVE)) $criteria->add(GalleriesPeer::ACTIVE, $this->active);
        if ($this->isColumnModified(GalleriesPeer::LAST_MODIFIED)) $criteria->add(GalleriesPeer::LAST_MODIFIED, $this->last_modified);
        if ($this->isColumnModified(GalleriesPeer::CREATED)) $criteria->add(GalleriesPeer::CREATED, $this->created);

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = new Criteria(GalleriesPeer::DATABASE_NAME);
        $criteria->add(GalleriesPeer::ID, $this->id);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param  int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of Galleries (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setName($this->getName());
        $copyObj->setBasePhoto($this->getBasePhoto());
        $copyObj->setActive($this->getActive());
        $copyObj->setLastModified($this->getLastModified());
        $copyObj->setCreated($this->getCreated());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getContentGalleriess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addContentGalleries($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPhotoss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPhotos($relObj->copy($deepCopy));
                }
            }

            //unflag object copy
            $this->startCopy = false;
        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return Galleries Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Returns a peer instance associated with this om.
     *
     * Since Peer classes are not to have any instance attributes, this method returns the
     * same instance for all member of this class. The method could therefore
     * be static, but this would prevent one from overriding the behavior.
     *
     * @return GalleriesPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new GalleriesPeer();
        }

        return self::$peer;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('ContentGalleries' == $relationName) {
            $this->initContentGalleriess();
        }
        if ('Photos' == $relationName) {
            $this->initPhotoss();
        }
    }

    /**
     * Clears out the collContentGalleriess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Galleries The current object (for fluent API support)
     * @see        addContentGalleriess()
     */
    public function clearContentGalleriess()
    {
        $this->collContentGalleriess = null; // important to set this to null since that means it is uninitialized
        $this->collContentGalleriessPartial = null;

        return $this;
    }

    /**
     * reset is the collContentGalleriess collection loaded partially
     *
     * @return void
     */
    public function resetPartialContentGalleriess($v = true)
    {
        $this->collContentGalleriessPartial = $v;
    }

    /**
     * Initializes the collContentGalleriess collection.
     *
     * By default this just sets the collContentGalleriess collection to an empty array (like clearcollContentGalleriess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initContentGalleriess($overrideExisting = true)
    {
        if (null !== $this->collContentGalleriess && !$overrideExisting) {
            return;
        }
        $this->collContentGalleriess = new PropelObjectCollection();
        $this->collContentGalleriess->setModel('ContentGalleries');
    }

    /**
     * Gets an array of ContentGalleries objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Galleries is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|ContentGalleries[] List of ContentGalleries objects
     * @throws PropelException
     */
    public function getContentGalleriess($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collContentGalleriessPartial && !$this->isNew();
        if (null === $this->collContentGalleriess || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collContentGalleriess) {
                // return empty collection
                $this->initContentGalleriess();
            } else {
                $collContentGalleriess = ContentGalleriesQuery::create(null, $criteria)
                    ->filterByGalleries($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collContentGalleriessPartial && count($collContentGalleriess)) {
                      $this->initContentGalleriess(false);

                      foreach ($collContentGalleriess as $obj) {
                        if (false == $this->collContentGalleriess->contains($obj)) {
                          $this->collContentGalleriess->append($obj);
                        }
                      }

                      $this->collContentGalleriessPartial = true;
                    }

                    $collContentGalleriess->getInternalIterator()->rewind();

                    return $collContentGalleriess;
                }

                if ($partial && $this->collContentGalleriess) {
                    foreach ($this->collContentGalleriess as $obj) {
                        if ($obj->isNew()) {
                            $collContentGalleriess[] = $obj;
                        }
                    }
                }

                $this->collContentGalleriess = $collContentGalleriess;
                $this->collContentGalleriessPartial = false;
            }
        }

        return $this->collContentGalleriess;
    }

    /**
     * Sets a collection of ContentGalleries objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $contentGalleriess A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Galleries The current object (for fluent API support)
     */
    public function setContentGalleriess(PropelCollection $contentGalleriess, PropelPDO $con = null)
    {
        $contentGalleriessToDelete = $this->getContentGalleriess(new Criteria(), $con)->diff($contentGalleriess);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->contentGalleriessScheduledForDeletion = clone $contentGalleriessToDelete;

        foreach ($contentGalleriessToDelete as $contentGalleriesRemoved) {
            $contentGalleriesRemoved->setGalleries(null);
        }

        $this->collContentGalleriess = null;
        foreach ($contentGalleriess as $contentGalleries) {
            $this->addContentGalleries($contentGalleries);
        }

        $this->collContentGalleriess = $contentGalleriess;
        $this->collContentGalleriessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ContentGalleries objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related ContentGalleries objects.
     * @throws PropelException
     */
    public function countContentGalleriess(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collContentGalleriessPartial && !$this->isNew();
        if (null === $this->collContentGalleriess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collContentGalleriess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getContentGalleriess());
            }
            $query = ContentGalleriesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByGalleries($this)
                ->count($con);
        }

        return count($this->collContentGalleriess);
    }

    /**
     * Method called to associate a ContentGalleries object to this object
     * through the ContentGalleries foreign key attribute.
     *
     * @param    ContentGalleries $l ContentGalleries
     * @return Galleries The current object (for fluent API support)
     */
    public function addContentGalleries(ContentGalleries $l)
    {
        if ($this->collContentGalleriess === null) {
            $this->initContentGalleriess();
            $this->collContentGalleriessPartial = true;
        }

        if (!in_array($l, $this->collContentGalleriess->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddContentGalleries($l);

            if ($this->contentGalleriessScheduledForDeletion and $this->contentGalleriessScheduledForDeletion->contains($l)) {
                $this->contentGalleriessScheduledForDeletion->remove($this->contentGalleriessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	ContentGalleries $contentGalleries The contentGalleries object to add.
     */
    protected function doAddContentGalleries($contentGalleries)
    {
        $this->collContentGalleriess[]= $contentGalleries;
        $contentGalleries->setGalleries($this);
    }

    /**
     * @param	ContentGalleries $contentGalleries The contentGalleries object to remove.
     * @return Galleries The current object (for fluent API support)
     */
    public function removeContentGalleries($contentGalleries)
    {
        if ($this->getContentGalleriess()->contains($contentGalleries)) {
            $this->collContentGalleriess->remove($this->collContentGalleriess->search($contentGalleries));
            if (null === $this->contentGalleriessScheduledForDeletion) {
                $this->contentGalleriessScheduledForDeletion = clone $this->collContentGalleriess;
                $this->contentGalleriessScheduledForDeletion->clear();
            }
            $this->contentGalleriessScheduledForDeletion[]= clone $contentGalleries;
            $contentGalleries->setGalleries(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Galleries is new, it will return
     * an empty collection; or if this Galleries has previously
     * been saved, it will retrieve related ContentGalleriess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Galleries.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|ContentGalleries[] List of ContentGalleries objects
     */
    public function getContentGalleriessJoinContents($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ContentGalleriesQuery::create(null, $criteria);
        $query->joinWith('Contents', $join_behavior);

        return $this->getContentGalleriess($query, $con);
    }

    /**
     * Clears out the collPhotoss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Galleries The current object (for fluent API support)
     * @see        addPhotoss()
     */
    public function clearPhotoss()
    {
        $this->collPhotoss = null; // important to set this to null since that means it is uninitialized
        $this->collPhotossPartial = null;

        return $this;
    }

    /**
     * reset is the collPhotoss collection loaded partially
     *
     * @return void
     */
    public function resetPartialPhotoss($v = true)
    {
        $this->collPhotossPartial = $v;
    }

    /**
     * Initializes the collPhotoss collection.
     *
     * By default this just sets the collPhotoss collection to an empty array (like clearcollPhotoss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPhotoss($overrideExisting = true)
    {
        if (null !== $this->collPhotoss && !$overrideExisting) {
            return;
        }
        $this->collPhotoss = new PropelObjectCollection();
        $this->collPhotoss->setModel('Photos');
    }

    /**
     * Gets an array of Photos objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Galleries is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Photos[] List of Photos objects
     * @throws PropelException
     */
    public function getPhotoss($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collPhotossPartial && !$this->isNew();
        if (null === $this->collPhotoss || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPhotoss) {
                // return empty collection
                $this->initPhotoss();
            } else {
                $collPhotoss = PhotosQuery::create(null, $criteria)
                    ->filterByGalleries($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collPhotossPartial && count($collPhotoss)) {
                      $this->initPhotoss(false);

                      foreach ($collPhotoss as $obj) {
                        if (false == $this->collPhotoss->contains($obj)) {
                          $this->collPhotoss->append($obj);
                        }
                      }

                      $this->collPhotossPartial = true;
                    }

                    $collPhotoss->getInternalIterator()->rewind();

                    return $collPhotoss;
                }

                if ($partial && $this->collPhotoss) {
                    foreach ($this->collPhotoss as $obj) {
                        if ($obj->isNew()) {
                            $collPhotoss[] = $obj;
                        }
                    }
                }

                $this->collPhotoss = $collPhotoss;
                $this->collPhotossPartial = false;
            }
        }

        return $this->collPhotoss;
    }

    /**
     * Sets a collection of Photos objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $photoss A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Galleries The current object (for fluent API support)
     */
    public function setPhotoss(PropelCollection $photoss, PropelPDO $con = null)
    {
        $photossToDelete = $this->getPhotoss(new Criteria(), $con)->diff($photoss);


        $this->photossScheduledForDeletion = $photossToDelete;

        foreach ($photossToDelete as $photosRemoved) {
            $photosRemoved->setGalleries(null);
        }

        $this->collPhotoss = null;
        foreach ($photoss as $photos) {
            $this->addPhotos($photos);
        }

        $this->collPhotoss = $photoss;
        $this->collPhotossPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Photos objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Photos objects.
     * @throws PropelException
     */
    public function countPhotoss(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collPhotossPartial && !$this->isNew();
        if (null === $this->collPhotoss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPhotoss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPhotoss());
            }
            $query = PhotosQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByGalleries($this)
                ->count($con);
        }

        return count($this->collPhotoss);
    }

    /**
     * Method called to associate a Photos object to this object
     * through the Photos foreign key attribute.
     *
     * @param    Photos $l Photos
     * @return Galleries The current object (for fluent API support)
     */
    public function addPhotos(Photos $l)
    {
        if ($this->collPhotoss === null) {
            $this->initPhotoss();
            $this->collPhotossPartial = true;
        }

        if (!in_array($l, $this->collPhotoss->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddPhotos($l);

            if ($this->photossScheduledForDeletion and $this->photossScheduledForDeletion->contains($l)) {
                $this->photossScheduledForDeletion->remove($this->photossScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	Photos $photos The photos object to add.
     */
    protected function doAddPhotos($photos)
    {
        $this->collPhotoss[]= $photos;
        $photos->setGalleries($this);
    }

    /**
     * @param	Photos $photos The photos object to remove.
     * @return Galleries The current object (for fluent API support)
     */
    public function removePhotos($photos)
    {
        if ($this->getPhotoss()->contains($photos)) {
            $this->collPhotoss->remove($this->collPhotoss->search($photos));
            if (null === $this->photossScheduledForDeletion) {
                $this->photossScheduledForDeletion = clone $this->collPhotoss;
                $this->photossScheduledForDeletion->clear();
            }
            $this->photossScheduledForDeletion[]= clone $photos;
            $photos->setGalleries(null);
        }

        return $this;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->name = null;
        $this->base_photo = null;
        $this->active = null;
        $this->last_modified = null;
        $this->created = null;
        $this->alreadyInSave = false;
        $this->alreadyInValidation = false;
        $this->alreadyInClearAllReferencesDeep = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references to other model objects or collections of model objects.
     *
     * This method is a user-space workaround for PHP's inability to garbage collect
     * objects with circular references (even in PHP 5.3). This is currently necessary
     * when using Propel in certain daemon or large-volume/high-memory operations.
     *
     * @param boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep && !$this->alreadyInClearAllReferencesDeep) {
            $this->alreadyInClearAllReferencesDeep = true;
            if ($this->collContentGalleriess) {
                foreach ($this->collContentGalleriess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPhotoss) {
                foreach ($this->collPhotoss as $o) {
                    $o->clearAllReferences($deep);
                }
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        if ($this->collContentGalleriess instanceof PropelCollection) {
            $this->collContentGalleriess->clearIterator();
        }
        $this->collContentGalleriess = null;
        if ($this->collPhotoss instanceof PropelCollection) {
            $this->collPhotoss->clearIterator();
        }
        $this->collPhotoss = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(GalleriesPeer::DEFAULT_STRING_FORMAT);
    }

    /**
     * return true is the object is in saving state
     *
     * @return boolean
     */
    public function isAlreadyInSave()
    {
        return $this->alreadyInSave;
    }

}
