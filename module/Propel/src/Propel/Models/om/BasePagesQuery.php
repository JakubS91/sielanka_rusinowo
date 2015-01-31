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
use Propel\Models\PageContents;
use Propel\Models\Pages;
use Propel\Models\PagesPeer;
use Propel\Models\PagesQuery;

/**
 * Base class that represents a query for the 'pages' table.
 *
 *
 *
 * @method PagesQuery orderById($order = Criteria::ASC) Order by the id column
 * @method PagesQuery orderByAction($order = Criteria::ASC) Order by the action column
 * @method PagesQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method PagesQuery orderByActive($order = Criteria::ASC) Order by the active column
 * @method PagesQuery orderByLastModified($order = Criteria::ASC) Order by the last_modified column
 * @method PagesQuery orderByCreated($order = Criteria::ASC) Order by the created column
 *
 * @method PagesQuery groupById() Group by the id column
 * @method PagesQuery groupByAction() Group by the action column
 * @method PagesQuery groupByTitle() Group by the title column
 * @method PagesQuery groupByActive() Group by the active column
 * @method PagesQuery groupByLastModified() Group by the last_modified column
 * @method PagesQuery groupByCreated() Group by the created column
 *
 * @method PagesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method PagesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method PagesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method PagesQuery leftJoinPageContents($relationAlias = null) Adds a LEFT JOIN clause to the query using the PageContents relation
 * @method PagesQuery rightJoinPageContents($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PageContents relation
 * @method PagesQuery innerJoinPageContents($relationAlias = null) Adds a INNER JOIN clause to the query using the PageContents relation
 *
 * @method Pages findOne(PropelPDO $con = null) Return the first Pages matching the query
 * @method Pages findOneOrCreate(PropelPDO $con = null) Return the first Pages matching the query, or a new Pages object populated from the query conditions when no match is found
 *
 * @method Pages findOneByAction(string $action) Return the first Pages filtered by the action column
 * @method Pages findOneByTitle(string $title) Return the first Pages filtered by the title column
 * @method Pages findOneByActive(int $active) Return the first Pages filtered by the active column
 * @method Pages findOneByLastModified(string $last_modified) Return the first Pages filtered by the last_modified column
 * @method Pages findOneByCreated(string $created) Return the first Pages filtered by the created column
 *
 * @method array findById(int $id) Return Pages objects filtered by the id column
 * @method array findByAction(string $action) Return Pages objects filtered by the action column
 * @method array findByTitle(string $title) Return Pages objects filtered by the title column
 * @method array findByActive(int $active) Return Pages objects filtered by the active column
 * @method array findByLastModified(string $last_modified) Return Pages objects filtered by the last_modified column
 * @method array findByCreated(string $created) Return Pages objects filtered by the created column
 *
 * @package    propel.generator..om
 */
abstract class BasePagesQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BasePagesQuery object.
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
            $modelName = 'Propel\\Models\\Pages';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new PagesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   PagesQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return PagesQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof PagesQuery) {
            return $criteria;
        }
        $query = new PagesQuery(null, null, $modelAlias);

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
     * @return   Pages|Pages[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = PagesPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(PagesPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Pages A model object, or null if the key is not found
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
     * @return                 Pages A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `action`, `title`, `active`, `last_modified`, `created` FROM `pages` WHERE `id` = :p0';
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
            $obj = new Pages();
            $obj->hydrate($row);
            PagesPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Pages|Pages[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Pages[]|mixed the list of results, formatted by the current formatter
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
     * @return PagesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PagesPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return PagesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PagesPeer::ID, $keys, Criteria::IN);
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
     * @return PagesQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(PagesPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(PagesPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PagesPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the action column
     *
     * Example usage:
     * <code>
     * $query->filterByAction('fooValue');   // WHERE action = 'fooValue'
     * $query->filterByAction('%fooValue%'); // WHERE action LIKE '%fooValue%'
     * </code>
     *
     * @param     string $action The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PagesQuery The current query, for fluid interface
     */
    public function filterByAction($action = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($action)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $action)) {
                $action = str_replace('*', '%', $action);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PagesPeer::ACTION, $action, $comparison);
    }

    /**
     * Filter the query on the title column
     *
     * Example usage:
     * <code>
     * $query->filterByTitle('fooValue');   // WHERE title = 'fooValue'
     * $query->filterByTitle('%fooValue%'); // WHERE title LIKE '%fooValue%'
     * </code>
     *
     * @param     string $title The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PagesQuery The current query, for fluid interface
     */
    public function filterByTitle($title = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($title)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $title)) {
                $title = str_replace('*', '%', $title);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PagesPeer::TITLE, $title, $comparison);
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
     * @return PagesQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_array($active)) {
            $useMinMax = false;
            if (isset($active['min'])) {
                $this->addUsingAlias(PagesPeer::ACTIVE, $active['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($active['max'])) {
                $this->addUsingAlias(PagesPeer::ACTIVE, $active['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PagesPeer::ACTIVE, $active, $comparison);
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
     * @return PagesQuery The current query, for fluid interface
     */
    public function filterByLastModified($lastModified = null, $comparison = null)
    {
        if (is_array($lastModified)) {
            $useMinMax = false;
            if (isset($lastModified['min'])) {
                $this->addUsingAlias(PagesPeer::LAST_MODIFIED, $lastModified['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastModified['max'])) {
                $this->addUsingAlias(PagesPeer::LAST_MODIFIED, $lastModified['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PagesPeer::LAST_MODIFIED, $lastModified, $comparison);
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
     * @return PagesQuery The current query, for fluid interface
     */
    public function filterByCreated($created = null, $comparison = null)
    {
        if (is_array($created)) {
            $useMinMax = false;
            if (isset($created['min'])) {
                $this->addUsingAlias(PagesPeer::CREATED, $created['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($created['max'])) {
                $this->addUsingAlias(PagesPeer::CREATED, $created['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PagesPeer::CREATED, $created, $comparison);
    }

    /**
     * Filter the query by a related PageContents object
     *
     * @param   PageContents|PropelObjectCollection $pageContents  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 PagesQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByPageContents($pageContents, $comparison = null)
    {
        if ($pageContents instanceof PageContents) {
            return $this
                ->addUsingAlias(PagesPeer::ID, $pageContents->getPageId(), $comparison);
        } elseif ($pageContents instanceof PropelObjectCollection) {
            return $this
                ->usePageContentsQuery()
                ->filterByPrimaryKeys($pageContents->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPageContents() only accepts arguments of type PageContents or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PageContents relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return PagesQuery The current query, for fluid interface
     */
    public function joinPageContents($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PageContents');

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
            $this->addJoinObject($join, 'PageContents');
        }

        return $this;
    }

    /**
     * Use the PageContents relation PageContents object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Propel\Models\PageContentsQuery A secondary query class using the current class as primary query
     */
    public function usePageContentsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPageContents($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PageContents', '\Propel\Models\PageContentsQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Pages $pages Object to remove from the list of results
     *
     * @return PagesQuery The current query, for fluid interface
     */
    public function prune($pages = null)
    {
        if ($pages) {
            $this->addUsingAlias(PagesPeer::ID, $pages->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
