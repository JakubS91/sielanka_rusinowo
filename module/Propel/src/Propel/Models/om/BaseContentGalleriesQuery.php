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
use Propel\Models\ContentGalleriesPeer;
use Propel\Models\ContentGalleriesQuery;
use Propel\Models\Contents;
use Propel\Models\Galleries;

/**
 * Base class that represents a query for the 'content_galleries' table.
 *
 *
 *
 * @method ContentGalleriesQuery orderByGalleryId($order = Criteria::ASC) Order by the gallery_id column
 * @method ContentGalleriesQuery orderByContentId($order = Criteria::ASC) Order by the content_id column
 * @method ContentGalleriesQuery orderByCreated($order = Criteria::ASC) Order by the created column
 *
 * @method ContentGalleriesQuery groupByGalleryId() Group by the gallery_id column
 * @method ContentGalleriesQuery groupByContentId() Group by the content_id column
 * @method ContentGalleriesQuery groupByCreated() Group by the created column
 *
 * @method ContentGalleriesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method ContentGalleriesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method ContentGalleriesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method ContentGalleriesQuery leftJoinContents($relationAlias = null) Adds a LEFT JOIN clause to the query using the Contents relation
 * @method ContentGalleriesQuery rightJoinContents($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Contents relation
 * @method ContentGalleriesQuery innerJoinContents($relationAlias = null) Adds a INNER JOIN clause to the query using the Contents relation
 *
 * @method ContentGalleriesQuery leftJoinGalleries($relationAlias = null) Adds a LEFT JOIN clause to the query using the Galleries relation
 * @method ContentGalleriesQuery rightJoinGalleries($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Galleries relation
 * @method ContentGalleriesQuery innerJoinGalleries($relationAlias = null) Adds a INNER JOIN clause to the query using the Galleries relation
 *
 * @method ContentGalleries findOne(PropelPDO $con = null) Return the first ContentGalleries matching the query
 * @method ContentGalleries findOneOrCreate(PropelPDO $con = null) Return the first ContentGalleries matching the query, or a new ContentGalleries object populated from the query conditions when no match is found
 *
 * @method ContentGalleries findOneByGalleryId(int $gallery_id) Return the first ContentGalleries filtered by the gallery_id column
 * @method ContentGalleries findOneByContentId(int $content_id) Return the first ContentGalleries filtered by the content_id column
 * @method ContentGalleries findOneByCreated(string $created) Return the first ContentGalleries filtered by the created column
 *
 * @method array findByGalleryId(int $gallery_id) Return ContentGalleries objects filtered by the gallery_id column
 * @method array findByContentId(int $content_id) Return ContentGalleries objects filtered by the content_id column
 * @method array findByCreated(string $created) Return ContentGalleries objects filtered by the created column
 *
 * @package    propel.generator..om
 */
abstract class BaseContentGalleriesQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseContentGalleriesQuery object.
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
            $modelName = 'Propel\\Models\\ContentGalleries';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ContentGalleriesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   ContentGalleriesQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return ContentGalleriesQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof ContentGalleriesQuery) {
            return $criteria;
        }
        $query = new ContentGalleriesQuery(null, null, $modelAlias);

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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array $key Primary key to use for the query
                         A Primary key composition: [$gallery_id, $content_id]
     * @param     PropelPDO $con an optional connection object
     *
     * @return   ContentGalleries|ContentGalleries[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ContentGalleriesPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(ContentGalleriesPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 ContentGalleries A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `gallery_id`, `content_id`, `created` FROM `content_galleries` WHERE `gallery_id` = :p0 AND `content_id` = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new ContentGalleries();
            $obj->hydrate($row);
            ContentGalleriesPeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return ContentGalleries|ContentGalleries[]|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|ContentGalleries[]|mixed the list of results, formatted by the current formatter
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
     * @return ContentGalleriesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(ContentGalleriesPeer::GALLERY_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(ContentGalleriesPeer::CONTENT_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ContentGalleriesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(ContentGalleriesPeer::GALLERY_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(ContentGalleriesPeer::CONTENT_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
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
     * @return ContentGalleriesQuery The current query, for fluid interface
     */
    public function filterByGalleryId($galleryId = null, $comparison = null)
    {
        if (is_array($galleryId)) {
            $useMinMax = false;
            if (isset($galleryId['min'])) {
                $this->addUsingAlias(ContentGalleriesPeer::GALLERY_ID, $galleryId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($galleryId['max'])) {
                $this->addUsingAlias(ContentGalleriesPeer::GALLERY_ID, $galleryId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContentGalleriesPeer::GALLERY_ID, $galleryId, $comparison);
    }

    /**
     * Filter the query on the content_id column
     *
     * Example usage:
     * <code>
     * $query->filterByContentId(1234); // WHERE content_id = 1234
     * $query->filterByContentId(array(12, 34)); // WHERE content_id IN (12, 34)
     * $query->filterByContentId(array('min' => 12)); // WHERE content_id >= 12
     * $query->filterByContentId(array('max' => 12)); // WHERE content_id <= 12
     * </code>
     *
     * @see       filterByContents()
     *
     * @param     mixed $contentId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ContentGalleriesQuery The current query, for fluid interface
     */
    public function filterByContentId($contentId = null, $comparison = null)
    {
        if (is_array($contentId)) {
            $useMinMax = false;
            if (isset($contentId['min'])) {
                $this->addUsingAlias(ContentGalleriesPeer::CONTENT_ID, $contentId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($contentId['max'])) {
                $this->addUsingAlias(ContentGalleriesPeer::CONTENT_ID, $contentId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContentGalleriesPeer::CONTENT_ID, $contentId, $comparison);
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
     * @return ContentGalleriesQuery The current query, for fluid interface
     */
    public function filterByCreated($created = null, $comparison = null)
    {
        if (is_array($created)) {
            $useMinMax = false;
            if (isset($created['min'])) {
                $this->addUsingAlias(ContentGalleriesPeer::CREATED, $created['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($created['max'])) {
                $this->addUsingAlias(ContentGalleriesPeer::CREATED, $created['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContentGalleriesPeer::CREATED, $created, $comparison);
    }

    /**
     * Filter the query by a related Contents object
     *
     * @param   Contents|PropelObjectCollection $contents The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 ContentGalleriesQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByContents($contents, $comparison = null)
    {
        if ($contents instanceof Contents) {
            return $this
                ->addUsingAlias(ContentGalleriesPeer::CONTENT_ID, $contents->getId(), $comparison);
        } elseif ($contents instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ContentGalleriesPeer::CONTENT_ID, $contents->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByContents() only accepts arguments of type Contents or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Contents relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ContentGalleriesQuery The current query, for fluid interface
     */
    public function joinContents($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Contents');

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
            $this->addJoinObject($join, 'Contents');
        }

        return $this;
    }

    /**
     * Use the Contents relation Contents object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Propel\Models\ContentsQuery A secondary query class using the current class as primary query
     */
    public function useContentsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinContents($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Contents', '\Propel\Models\ContentsQuery');
    }

    /**
     * Filter the query by a related Galleries object
     *
     * @param   Galleries|PropelObjectCollection $galleries The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 ContentGalleriesQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByGalleries($galleries, $comparison = null)
    {
        if ($galleries instanceof Galleries) {
            return $this
                ->addUsingAlias(ContentGalleriesPeer::GALLERY_ID, $galleries->getId(), $comparison);
        } elseif ($galleries instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ContentGalleriesPeer::GALLERY_ID, $galleries->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return ContentGalleriesQuery The current query, for fluid interface
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
     * @param   ContentGalleries $contentGalleries Object to remove from the list of results
     *
     * @return ContentGalleriesQuery The current query, for fluid interface
     */
    public function prune($contentGalleries = null)
    {
        if ($contentGalleries) {
            $this->addCond('pruneCond0', $this->getAliasedColName(ContentGalleriesPeer::GALLERY_ID), $contentGalleries->getGalleryId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(ContentGalleriesPeer::CONTENT_ID), $contentGalleries->getContentId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

}
