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
use Propel\Models\Galleries;
use Propel\Models\Photos;
use Propel\Models\PhotosPeer;
use Propel\Models\PhotosQuery;

/**
 * Base class that represents a query for the 'photos' table.
 *
 *
 *
 * @method PhotosQuery orderById($order = Criteria::ASC) Order by the id column
 * @method PhotosQuery orderByGalleryId($order = Criteria::ASC) Order by the gallery_id column
 * @method PhotosQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method PhotosQuery orderByPath($order = Criteria::ASC) Order by the path column
 * @method PhotosQuery orderByPathMin($order = Criteria::ASC) Order by the path_min column
 * @method PhotosQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method PhotosQuery orderByActive($order = Criteria::ASC) Order by the active column
 * @method PhotosQuery orderByLastModified($order = Criteria::ASC) Order by the last_modified column
 * @method PhotosQuery orderByCreated($order = Criteria::ASC) Order by the created column
 *
 * @method PhotosQuery groupById() Group by the id column
 * @method PhotosQuery groupByGalleryId() Group by the gallery_id column
 * @method PhotosQuery groupByName() Group by the name column
 * @method PhotosQuery groupByPath() Group by the path column
 * @method PhotosQuery groupByPathMin() Group by the path_min column
 * @method PhotosQuery groupByDescription() Group by the description column
 * @method PhotosQuery groupByActive() Group by the active column
 * @method PhotosQuery groupByLastModified() Group by the last_modified column
 * @method PhotosQuery groupByCreated() Group by the created column
 *
 * @method PhotosQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method PhotosQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method PhotosQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method PhotosQuery leftJoinGalleries($relationAlias = null) Adds a LEFT JOIN clause to the query using the Galleries relation
 * @method PhotosQuery rightJoinGalleries($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Galleries relation
 * @method PhotosQuery innerJoinGalleries($relationAlias = null) Adds a INNER JOIN clause to the query using the Galleries relation
 *
 * @method Photos findOne(PropelPDO $con = null) Return the first Photos matching the query
 * @method Photos findOneOrCreate(PropelPDO $con = null) Return the first Photos matching the query, or a new Photos object populated from the query conditions when no match is found
 *
 * @method Photos findOneByGalleryId(int $gallery_id) Return the first Photos filtered by the gallery_id column
 * @method Photos findOneByName(string $name) Return the first Photos filtered by the name column
 * @method Photos findOneByPath(string $path) Return the first Photos filtered by the path column
 * @method Photos findOneByPathMin(string $path_min) Return the first Photos filtered by the path_min column
 * @method Photos findOneByDescription(string $description) Return the first Photos filtered by the description column
 * @method Photos findOneByActive(int $active) Return the first Photos filtered by the active column
 * @method Photos findOneByLastModified(string $last_modified) Return the first Photos filtered by the last_modified column
 * @method Photos findOneByCreated(string $created) Return the first Photos filtered by the created column
 *
 * @method array findById(int $id) Return Photos objects filtered by the id column
 * @method array findByGalleryId(int $gallery_id) Return Photos objects filtered by the gallery_id column
 * @method array findByName(string $name) Return Photos objects filtered by the name column
 * @method array findByPath(string $path) Return Photos objects filtered by the path column
 * @method array findByPathMin(string $path_min) Return Photos objects filtered by the path_min column
 * @method array findByDescription(string $description) Return Photos objects filtered by the description column
 * @method array findByActive(int $active) Return Photos objects filtered by the active column
 * @method array findByLastModified(string $last_modified) Return Photos objects filtered by the last_modified column
 * @method array findByCreated(string $created) Return Photos objects filtered by the created column
 *
 * @package    propel.generator..om
 */
abstract class BasePhotosQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BasePhotosQuery object.
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
            $modelName = 'Propel\\Models\\Photos';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new PhotosQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   PhotosQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return PhotosQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof PhotosQuery) {
            return $criteria;
        }
        $query = new PhotosQuery(null, null, $modelAlias);

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
     * @return   Photos|Photos[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = PhotosPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(PhotosPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Photos A model object, or null if the key is not found
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
     * @return                 Photos A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `gallery_id`, `name`, `path`, `path_min`, `description`, `active`, `last_modified`, `created` FROM `photos` WHERE `id` = :p0';
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
            $obj = new Photos();
            $obj->hydrate($row);
            PhotosPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Photos|Photos[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Photos[]|mixed the list of results, formatted by the current formatter
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
     * @return PhotosQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PhotosPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return PhotosQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PhotosPeer::ID, $keys, Criteria::IN);
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
     * @return PhotosQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(PhotosPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(PhotosPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PhotosPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the gallery_id column
     *
     * Example usage:
     * <code>
     * $query->filterByGalleryId(1234); // WHERE gallery_id = 1234
     * $query->filterByGalleryId(array(12, 34)); // WHERE gallery_id IN (12, 34)
     * $query->filterByGalleryId(array('min' => 12)); // WHERE gallery_id >= 12
     * $query->filterByGalleryId(array('max' => 12)); // WHERE gallery_id <= 12
     * </code>
     *
     * @see       filterByGalleries()
     *
     * @param     mixed $galleryId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PhotosQuery The current query, for fluid interface
     */
    public function filterByGalleryId($galleryId = null, $comparison = null)
    {
        if (is_array($galleryId)) {
            $useMinMax = false;
            if (isset($galleryId['min'])) {
                $this->addUsingAlias(PhotosPeer::GALLERY_ID, $galleryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($galleryId['max'])) {
                $this->addUsingAlias(PhotosPeer::GALLERY_ID, $galleryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PhotosPeer::GALLERY_ID, $galleryId, $comparison);
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
     * @return PhotosQuery The current query, for fluid interface
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

        return $this->addUsingAlias(PhotosPeer::NAME, $name, $comparison);
    }

    /**
     * Filter the query on the path column
     *
     * Example usage:
     * <code>
     * $query->filterByPath('fooValue');   // WHERE path = 'fooValue'
     * $query->filterByPath('%fooValue%'); // WHERE path LIKE '%fooValue%'
     * </code>
     *
     * @param     string $path The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PhotosQuery The current query, for fluid interface
     */
    public function filterByPath($path = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($path)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $path)) {
                $path = str_replace('*', '%', $path);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PhotosPeer::PATH, $path, $comparison);
    }

    /**
     * Filter the query on the path_min column
     *
     * Example usage:
     * <code>
     * $query->filterByPathMin('fooValue');   // WHERE path_min = 'fooValue'
     * $query->filterByPathMin('%fooValue%'); // WHERE path_min LIKE '%fooValue%'
     * </code>
     *
     * @param     string $pathMin The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PhotosQuery The current query, for fluid interface
     */
    public function filterByPathMin($pathMin = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($pathMin)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $pathMin)) {
                $pathMin = str_replace('*', '%', $pathMin);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PhotosPeer::PATH_MIN, $pathMin, $comparison);
    }

    /**
     * Filter the query on the description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
     * $query->filterByDescription('%fooValue%'); // WHERE description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $description The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PhotosQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $description)) {
                $description = str_replace('*', '%', $description);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PhotosPeer::DESCRIPTION, $description, $comparison);
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
     * @return PhotosQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_array($active)) {
            $useMinMax = false;
            if (isset($active['min'])) {
                $this->addUsingAlias(PhotosPeer::ACTIVE, $active['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($active['max'])) {
                $this->addUsingAlias(PhotosPeer::ACTIVE, $active['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PhotosPeer::ACTIVE, $active, $comparison);
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
     * @return PhotosQuery The current query, for fluid interface
     */
    public function filterByLastModified($lastModified = null, $comparison = null)
    {
        if (is_array($lastModified)) {
            $useMinMax = false;
            if (isset($lastModified['min'])) {
                $this->addUsingAlias(PhotosPeer::LAST_MODIFIED, $lastModified['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastModified['max'])) {
                $this->addUsingAlias(PhotosPeer::LAST_MODIFIED, $lastModified['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PhotosPeer::LAST_MODIFIED, $lastModified, $comparison);
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
     * @return PhotosQuery The current query, for fluid interface
     */
    public function filterByCreated($created = null, $comparison = null)
    {
        if (is_array($created)) {
            $useMinMax = false;
            if (isset($created['min'])) {
                $this->addUsingAlias(PhotosPeer::CREATED, $created['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($created['max'])) {
                $this->addUsingAlias(PhotosPeer::CREATED, $created['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PhotosPeer::CREATED, $created, $comparison);
    }

    /**
     * Filter the query by a related Galleries object
     *
     * @param   Galleries|PropelObjectCollection $galleries The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 PhotosQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByGalleries($galleries, $comparison = null)
    {
        if ($galleries instanceof Galleries) {
            return $this
                ->addUsingAlias(PhotosPeer::GALLERY_ID, $galleries->getId(), $comparison);
        } elseif ($galleries instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PhotosPeer::GALLERY_ID, $galleries->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByGalleries() only accepts arguments of type Galleries or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Galleries relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return PhotosQuery The current query, for fluid interface
     */
    public function joinGalleries($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Galleries');

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
            $this->addJoinObject($join, 'Galleries');
        }

        return $this;
    }

    /**
     * Use the Galleries relation Galleries object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Propel\Models\GalleriesQuery A secondary query class using the current class as primary query
     */
    public function useGalleriesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinGalleries($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Galleries', '\Propel\Models\GalleriesQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Photos $photos Object to remove from the list of results
     *
     * @return PhotosQuery The current query, for fluid interface
     */
    public function prune($photos = null)
    {
        if ($photos) {
            $this->addUsingAlias(PhotosPeer::ID, $photos->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
