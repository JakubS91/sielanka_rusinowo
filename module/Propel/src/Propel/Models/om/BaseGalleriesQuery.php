<?php

namespace Propel\Models\om;

use \Criteria;
use \Exception;
use \ModelCriteria;
use \ModelJoin;
use \PDO;
use \Propel;
use \PropelCollection;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use Propel\Models\ContentGalleries;
use Propel\Models\Galleries;
use Propel\Models\GalleriesPeer;
use Propel\Models\GalleriesQuery;
use Propel\Models\Photos;

/**
 * Base class that represents a query for the 'galleries' table.
 *
 *
 *
 * @method GalleriesQuery orderById($order = Criteria::ASC) Order by the id column
 * @method GalleriesQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method GalleriesQuery orderByBasePhoto($order = Criteria::ASC) Order by the base_photo column
 * @method GalleriesQuery orderByActive($order = Criteria::ASC) Order by the active column
 * @method GalleriesQuery orderByLastModified($order = Criteria::ASC) Order by the last_modified column
 * @method GalleriesQuery orderByCreated($order = Criteria::ASC) Order by the created column
 *
 * @method GalleriesQuery groupById() Group by the id column
 * @method GalleriesQuery groupByName() Group by the name column
 * @method GalleriesQuery groupByBasePhoto() Group by the base_photo column
 * @method GalleriesQuery groupByActive() Group by the active column
 * @method GalleriesQuery groupByLastModified() Group by the last_modified column
 * @method GalleriesQuery groupByCreated() Group by the created column
 *
 * @method GalleriesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method GalleriesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method GalleriesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method GalleriesQuery leftJoinContentGalleries($relationAlias = null) Adds a LEFT JOIN clause to the query using the ContentGalleries relation
 * @method GalleriesQuery rightJoinContentGalleries($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ContentGalleries relation
 * @method GalleriesQuery innerJoinContentGalleries($relationAlias = null) Adds a INNER JOIN clause to the query using the ContentGalleries relation
 *
 * @method GalleriesQuery leftJoinPhotos($relationAlias = null) Adds a LEFT JOIN clause to the query using the Photos relation
 * @method GalleriesQuery rightJoinPhotos($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Photos relation
 * @method GalleriesQuery innerJoinPhotos($relationAlias = null) Adds a INNER JOIN clause to the query using the Photos relation
 *
 * @method Galleries findOne(PropelPDO $con = null) Return the first Galleries matching the query
 * @method Galleries findOneOrCreate(PropelPDO $con = null) Return the first Galleries matching the query, or a new Galleries object populated from the query conditions when no match is found
 *
 * @method Galleries findOneByName(string $name) Return the first Galleries filtered by the name column
 * @method Galleries findOneByBasePhoto(string $base_photo) Return the first Galleries filtered by the base_photo column
 * @method Galleries findOneByActive(int $active) Return the first Galleries filtered by the active column
 * @method Galleries findOneByLastModified(string $last_modified) Return the first Galleries filtered by the last_modified column
 * @method Galleries findOneByCreated(string $created) Return the first Galleries filtered by the created column
 *
 * @method array findById(int $id) Return Galleries objects filtered by the id column
 * @method array findByName(string $name) Return Galleries objects filtered by the name column
 * @method array findByBasePhoto(string $base_photo) Return Galleries objects filtered by the base_photo column
 * @method array findByActive(int $active) Return Galleries objects filtered by the active column
 * @method array findByLastModified(string $last_modified) Return Galleries objects filtered by the last_modified column
 * @method array findByCreated(string $created) Return Galleries objects filtered by the created column
 *
 * @package    propel.generator..om
 */
abstract class BaseGalleriesQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseGalleriesQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = null, $modelName = null, $modelAlias = null)
    {
        if (null === $dbName) {
            $dbName = 'sielanka_rusinowo';
        }
        if (null === $modelName) {
            $modelName = 'Propel\\Models\\Galleries';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new GalleriesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   GalleriesQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return GalleriesQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof GalleriesQuery) {
            return $criteria;
        }
        $query = new GalleriesQuery(null, null, $modelAlias);

        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return   Galleries|Galleries[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = GalleriesPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(GalleriesPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Alias of findPk to use instance pooling
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 Galleries A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneById($key, $con = null)
     {
        return $this->findPk($key, $con);
     }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 Galleries A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `name`, `base_photo`, `active`, `last_modified`, `created` FROM `galleries` WHERE `id` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new Galleries();
            $obj->hydrate($row);
            GalleriesPeer::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return Galleries|Galleries[]|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|Galleries[]|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($stmt);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return GalleriesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(GalleriesPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return GalleriesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(GalleriesPeer::ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id >= 12
     * $query->filterById(array('max' => 12)); // WHERE id <= 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return GalleriesQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(GalleriesPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(GalleriesPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GalleriesPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%'); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return GalleriesQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $name)) {
                $name = str_replace('*', '%', $name);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(GalleriesPeer::NAME, $name, $comparison);
    }

    /**
     * Filter the query on the base_photo column
     *
     * Example usage:
     * <code>
     * $query->filterByBasePhoto('fooValue');   // WHERE base_photo = 'fooValue'
     * $query->filterByBasePhoto('%fooValue%'); // WHERE base_photo LIKE '%fooValue%'
     * </code>
     *
     * @param     string $basePhoto The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return GalleriesQuery The current query, for fluid interface
     */
    public function filterByBasePhoto($basePhoto = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($basePhoto)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $basePhoto)) {
                $basePhoto = str_replace('*', '%', $basePhoto);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(GalleriesPeer::BASE_PHOTO, $basePhoto, $comparison);
    }

    /**
     * Filter the query on the active column
     *
     * Example usage:
     * <code>
     * $query->filterByActive(1234); // WHERE active = 1234
     * $query->filterByActive(array(12, 34)); // WHERE active IN (12, 34)
     * $query->filterByActive(array('min' => 12)); // WHERE active >= 12
     * $query->filterByActive(array('max' => 12)); // WHERE active <= 12
     * </code>
     *
     * @param     mixed $active The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return GalleriesQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_array($active)) {
            $useMinMax = false;
            if (isset($active['min'])) {
                $this->addUsingAlias(GalleriesPeer::ACTIVE, $active['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($active['max'])) {
                $this->addUsingAlias(GalleriesPeer::ACTIVE, $active['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GalleriesPeer::ACTIVE, $active, $comparison);
    }

    /**
     * Filter the query on the last_modified column
     *
     * Example usage:
     * <code>
     * $query->filterByLastModified('2011-03-14'); // WHERE last_modified = '2011-03-14'
     * $query->filterByLastModified('now'); // WHERE last_modified = '2011-03-14'
     * $query->filterByLastModified(array('max' => 'yesterday')); // WHERE last_modified < '2011-03-13'
     * </code>
     *
     * @param     mixed $lastModified The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return GalleriesQuery The current query, for fluid interface
     */
    public function filterByLastModified($lastModified = null, $comparison = null)
    {
        if (is_array($lastModified)) {
            $useMinMax = false;
            if (isset($lastModified['min'])) {
                $this->addUsingAlias(GalleriesPeer::LAST_MODIFIED, $lastModified['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastModified['max'])) {
                $this->addUsingAlias(GalleriesPeer::LAST_MODIFIED, $lastModified['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GalleriesPeer::LAST_MODIFIED, $lastModified, $comparison);
    }

    /**
     * Filter the query on the created column
     *
     * Example usage:
     * <code>
     * $query->filterByCreated('2011-03-14'); // WHERE created = '2011-03-14'
     * $query->filterByCreated('now'); // WHERE created = '2011-03-14'
     * $query->filterByCreated(array('max' => 'yesterday')); // WHERE created < '2011-03-13'
     * </code>
     *
     * @param     mixed $created The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return GalleriesQuery The current query, for fluid interface
     */
    public function filterByCreated($created = null, $comparison = null)
    {
        if (is_array($created)) {
            $useMinMax = false;
            if (isset($created['min'])) {
                $this->addUsingAlias(GalleriesPeer::CREATED, $created['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($created['max'])) {
                $this->addUsingAlias(GalleriesPeer::CREATED, $created['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(GalleriesPeer::CREATED, $created, $comparison);
    }

    /**
     * Filter the query by a related ContentGalleries object
     *
     * @param   ContentGalleries|PropelObjectCollection $contentGalleries  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 GalleriesQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByContentGalleries($contentGalleries, $comparison = null)
    {
        if ($contentGalleries instanceof ContentGalleries) {
            return $this
                ->addUsingAlias(GalleriesPeer::ID, $contentGalleries->getGalleryId(), $comparison);
        } elseif ($contentGalleries instanceof PropelObjectCollection) {
            return $this
                ->useContentGalleriesQuery()
                ->filterByPrimaryKeys($contentGalleries->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByContentGalleries() only accepts arguments of type ContentGalleries or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ContentGalleries relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return GalleriesQuery The current query, for fluid interface
     */
    public function joinContentGalleries($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ContentGalleries');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'ContentGalleries');
        }

        return $this;
    }

    /**
     * Use the ContentGalleries relation ContentGalleries object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Propel\Models\ContentGalleriesQuery A secondary query class using the current class as primary query
     */
    public function useContentGalleriesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinContentGalleries($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ContentGalleries', '\Propel\Models\ContentGalleriesQuery');
    }

    /**
     * Filter the query by a related Photos object
     *
     * @param   Photos|PropelObjectCollection $photos  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 GalleriesQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByPhotos($photos, $comparison = null)
    {
        if ($photos instanceof Photos) {
            return $this
                ->addUsingAlias(GalleriesPeer::ID, $photos->getGalleryId(), $comparison);
        } elseif ($photos instanceof PropelObjectCollection) {
            return $this
                ->usePhotosQuery()
                ->filterByPrimaryKeys($photos->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPhotos() only accepts arguments of type Photos or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Photos relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return GalleriesQuery The current query, for fluid interface
     */
    public function joinPhotos($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Photos');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Photos');
        }

        return $this;
    }

    /**
     * Use the Photos relation Photos object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Propel\Models\PhotosQuery A secondary query class using the current class as primary query
     */
    public function usePhotosQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPhotos($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Photos', '\Propel\Models\PhotosQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Galleries $galleries Object to remove from the list of results
     *
     * @return GalleriesQuery The current query, for fluid interface
     */
    public function prune($galleries = null)
    {
        if ($galleries) {
            $this->addUsingAlias(GalleriesPeer::ID, $galleries->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
