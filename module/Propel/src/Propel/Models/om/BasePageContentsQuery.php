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
use Propel\Models\Contents;
use Propel\Models\PageContents;
use Propel\Models\PageContentsPeer;
use Propel\Models\PageContentsQuery;
use Propel\Models\Pages;

/**
 * Base class that represents a query for the 'page_contents' table.
 *
 *
 *
 * @method PageContentsQuery orderByPageId($order = Criteria::ASC) Order by the page_id column
 * @method PageContentsQuery orderByContentId($order = Criteria::ASC) Order by the content_id column
 *
 * @method PageContentsQuery groupByPageId() Group by the page_id column
 * @method PageContentsQuery groupByContentId() Group by the content_id column
 *
 * @method PageContentsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method PageContentsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method PageContentsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method PageContentsQuery leftJoinContents($relationAlias = null) Adds a LEFT JOIN clause to the query using the Contents relation
 * @method PageContentsQuery rightJoinContents($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Contents relation
 * @method PageContentsQuery innerJoinContents($relationAlias = null) Adds a INNER JOIN clause to the query using the Contents relation
 *
 * @method PageContentsQuery leftJoinPages($relationAlias = null) Adds a LEFT JOIN clause to the query using the Pages relation
 * @method PageContentsQuery rightJoinPages($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Pages relation
 * @method PageContentsQuery innerJoinPages($relationAlias = null) Adds a INNER JOIN clause to the query using the Pages relation
 *
 * @method PageContents findOne(PropelPDO $con = null) Return the first PageContents matching the query
 * @method PageContents findOneOrCreate(PropelPDO $con = null) Return the first PageContents matching the query, or a new PageContents object populated from the query conditions when no match is found
 *
 * @method PageContents findOneByPageId(int $page_id) Return the first PageContents filtered by the page_id column
 * @method PageContents findOneByContentId(int $content_id) Return the first PageContents filtered by the content_id column
 *
 * @method array findByPageId(int $page_id) Return PageContents objects filtered by the page_id column
 * @method array findByContentId(int $content_id) Return PageContents objects filtered by the content_id column
 *
 * @package    propel.generator..om
 */
abstract class BasePageContentsQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BasePageContentsQuery object.
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
            $modelName = 'Propel\\Models\\PageContents';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new PageContentsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   PageContentsQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return PageContentsQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof PageContentsQuery) {
            return $criteria;
        }
        $query = new PageContentsQuery(null, null, $modelAlias);

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
                         A Primary key composition: [$page_id, $content_id]
     * @param     PropelPDO $con an optional connection object
     *
     * @return   PageContents|PageContents[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = PageContentsPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(PageContentsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 PageContents A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `page_id`, `content_id` FROM `page_contents` WHERE `page_id` = :p0 AND `content_id` = :p1';
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
            $obj = new PageContents();
            $obj->hydrate($row);
            PageContentsPeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return PageContents|PageContents[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|PageContents[]|mixed the list of results, formatted by the current formatter
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
     * @return PageContentsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(PageContentsPeer::PAGE_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(PageContentsPeer::CONTENT_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return PageContentsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(PageContentsPeer::PAGE_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(PageContentsPeer::CONTENT_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the page_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPageId(1234); // WHERE page_id = 1234
     * $query->filterByPageId(array(12, 34)); // WHERE page_id IN (12, 34)
     * $query->filterByPageId(array('min' => 12)); // WHERE page_id >= 12
     * $query->filterByPageId(array('max' => 12)); // WHERE page_id <= 12
     * </code>
     *
     * @see       filterByPages()
     *
     * @param     mixed $pageId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PageContentsQuery The current query, for fluid interface
     */
    public function filterByPageId($pageId = null, $comparison = null)
    {
        if (is_array($pageId)) {
            $useMinMax = false;
            if (isset($pageId['min'])) {
                $this->addUsingAlias(PageContentsPeer::PAGE_ID, $pageId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($pageId['max'])) {
                $this->addUsingAlias(PageContentsPeer::PAGE_ID, $pageId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PageContentsPeer::PAGE_ID, $pageId, $comparison);
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
     * @return PageContentsQuery The current query, for fluid interface
     */
    public function filterByContentId($contentId = null, $comparison = null)
    {
        if (is_array($contentId)) {
            $useMinMax = false;
            if (isset($contentId['min'])) {
                $this->addUsingAlias(PageContentsPeer::CONTENT_ID, $contentId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($contentId['max'])) {
                $this->addUsingAlias(PageContentsPeer::CONTENT_ID, $contentId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PageContentsPeer::CONTENT_ID, $contentId, $comparison);
    }

    /**
     * Filter the query by a related Contents object
     *
     * @param   Contents|PropelObjectCollection $contents The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 PageContentsQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByContents($contents, $comparison = null)
    {
        if ($contents instanceof Contents) {
            return $this
                ->addUsingAlias(PageContentsPeer::CONTENT_ID, $contents->getId(), $comparison);
        } elseif ($contents instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PageContentsPeer::CONTENT_ID, $contents->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return PageContentsQuery The current query, for fluid interface
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
     * Filter the query by a related Pages object
     *
     * @param   Pages|PropelObjectCollection $pages The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 PageContentsQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByPages($pages, $comparison = null)
    {
        if ($pages instanceof Pages) {
            return $this
                ->addUsingAlias(PageContentsPeer::PAGE_ID, $pages->getId(), $comparison);
        } elseif ($pages instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PageContentsPeer::PAGE_ID, $pages->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByPages() only accepts arguments of type Pages or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Pages relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return PageContentsQuery The current query, for fluid interface
     */
    public function joinPages($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Pages');

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
            $this->addJoinObject($join, 'Pages');
        }

        return $this;
    }

    /**
     * Use the Pages relation Pages object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Propel\Models\PagesQuery A secondary query class using the current class as primary query
     */
    public function usePagesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPages($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Pages', '\Propel\Models\PagesQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   PageContents $pageContents Object to remove from the list of results
     *
     * @return PageContentsQuery The current query, for fluid interface
     */
    public function prune($pageContents = null)
    {
        if ($pageContents) {
            $this->addCond('pruneCond0', $this->getAliasedColName(PageContentsPeer::PAGE_ID), $pageContents->getPageId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(PageContentsPeer::CONTENT_ID), $pageContents->getContentId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

}
