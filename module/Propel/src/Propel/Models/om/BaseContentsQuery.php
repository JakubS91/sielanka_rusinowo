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
use Propel\Models\Contents;
use Propel\Models\ContentsPeer;
use Propel\Models\ContentsQuery;
use Propel\Models\PageContents;

/**
 * Base class that represents a query for the 'contents' table.
 *
 *
 *
 * @method ContentsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method ContentsQuery orderByCode($order = Criteria::ASC) Order by the code column
 * @method ContentsQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method ContentsQuery orderByContent($order = Criteria::ASC) Order by the content column
 * @method ContentsQuery orderByActive($order = Criteria::ASC) Order by the active column
 * @method ContentsQuery orderByLastModified($order = Criteria::ASC) Order by the last_modified column
 * @method ContentsQuery orderByCreated($order = Criteria::ASC) Order by the created column
 *
 * @method ContentsQuery groupById() Group by the id column
 * @method ContentsQuery groupByCode() Group by the code column
 * @method ContentsQuery groupByTitle() Group by the title column
 * @method ContentsQuery groupByContent() Group by the content column
 * @method ContentsQuery groupByActive() Group by the active column
 * @method ContentsQuery groupByLastModified() Group by the last_modified column
 * @method ContentsQuery groupByCreated() Group by the created column
 *
 * @method ContentsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method ContentsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method ContentsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method ContentsQuery leftJoinContentGalleries($relationAlias = null) Adds a LEFT JOIN clause to the query using the ContentGalleries relation
 * @method ContentsQuery rightJoinContentGalleries($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ContentGalleries relation
 * @method ContentsQuery innerJoinContentGalleries($relationAlias = null) Adds a INNER JOIN clause to the query using the ContentGalleries relation
 *
 * @method ContentsQuery leftJoinPageContents($relationAlias = null) Adds a LEFT JOIN clause to the query using the PageContents relation
 * @method ContentsQuery rightJoinPageContents($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PageContents relation
 * @method ContentsQuery innerJoinPageContents($relationAlias = null) Adds a INNER JOIN clause to the query using the PageContents relation
 *
 * @method Contents findOne(PropelPDO $con = null) Return the first Contents matching the query
 * @method Contents findOneOrCreate(PropelPDO $con = null) Return the first Contents matching the query, or a new Contents object populated from the query conditions when no match is found
 *
 * @method Contents findOneByCode(string $code) Return the first Contents filtered by the code column
 * @method Contents findOneByTitle(string $title) Return the first Contents filtered by the title column
 * @method Contents findOneByContent(string $content) Return the first Contents filtered by the content column
 * @method Contents findOneByActive(int $active) Return the first Contents filtered by the active column
 * @method Contents findOneByLastModified(string $last_modified) Return the first Contents filtered by the last_modified column
 * @method Contents findOneByCreated(string $created) Return the first Contents filtered by the created column
 *
 * @method array findById(int $id) Return Contents objects filtered by the id column
 * @method array findByCode(string $code) Return Contents objects filtered by the code column
 * @method array findByTitle(string $title) Return Contents objects filtered by the title column
 * @method array findByContent(string $content) Return Contents objects filtered by the content column
 * @method array findByActive(int $active) Return Contents objects filtered by the active column
 * @method array findByLastModified(string $last_modified) Return Contents objects filtered by the last_modified column
 * @method array findByCreated(string $created) Return Contents objects filtered by the created column
 *
 * @package    propel.generator..om
 */
abstract class BaseContentsQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseContentsQuery object.
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
            $modelName = 'Propel\\Models\\Contents';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ContentsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   ContentsQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return ContentsQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof ContentsQuery) {
            return $criteria;
        }
        $query = new ContentsQuery(null, null, $modelAlias);

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
     * @return   Contents|Contents[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ContentsPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(ContentsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Contents A model object, or null if the key is not found
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
     * @return                 Contents A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `code`, `title`, `content`, `active`, `last_modified`, `created` FROM `contents` WHERE `id` = :p0';
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
            $obj = new Contents();
            $obj->hydrate($row);
            ContentsPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Contents|Contents[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Contents[]|mixed the list of results, formatted by the current formatter
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
     * @return ContentsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ContentsPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ContentsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ContentsPeer::ID, $keys, Criteria::IN);
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
     * @return ContentsQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ContentsPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ContentsPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContentsPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the code column
     *
     * Example usage:
     * <code>
     * $query->filterByCode('fooValue');   // WHERE code = 'fooValue'
     * $query->filterByCode('%fooValue%'); // WHERE code LIKE '%fooValue%'
     * </code>
     *
     * @param     string $code The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ContentsQuery The current query, for fluid interface
     */
    public function filterByCode($code = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($code)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $code)) {
                $code = str_replace('*', '%', $code);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ContentsPeer::CODE, $code, $comparison);
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
     * @return ContentsQuery The current query, for fluid interface
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

        return $this->addUsingAlias(ContentsPeer::TITLE, $title, $comparison);
    }

    /**
     * Filter the query on the content column
     *
     * Example usage:
     * <code>
     * $query->filterByContent('fooValue');   // WHERE content = 'fooValue'
     * $query->filterByContent('%fooValue%'); // WHERE content LIKE '%fooValue%'
     * </code>
     *
     * @param     string $content The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ContentsQuery The current query, for fluid interface
     */
    public function filterByContent($content = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($content)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $content)) {
                $content = str_replace('*', '%', $content);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ContentsPeer::CONTENT, $content, $comparison);
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
     * @return ContentsQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_array($active)) {
            $useMinMax = false;
            if (isset($active['min'])) {
                $this->addUsingAlias(ContentsPeer::ACTIVE, $active['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($active['max'])) {
                $this->addUsingAlias(ContentsPeer::ACTIVE, $active['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContentsPeer::ACTIVE, $active, $comparison);
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
     * @return ContentsQuery The current query, for fluid interface
     */
    public function filterByLastModified($lastModified = null, $comparison = null)
    {
        if (is_array($lastModified)) {
            $useMinMax = false;
            if (isset($lastModified['min'])) {
                $this->addUsingAlias(ContentsPeer::LAST_MODIFIED, $lastModified['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastModified['max'])) {
                $this->addUsingAlias(ContentsPeer::LAST_MODIFIED, $lastModified['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContentsPeer::LAST_MODIFIED, $lastModified, $comparison);
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
     * @return ContentsQuery The current query, for fluid interface
     */
    public function filterByCreated($created = null, $comparison = null)
    {
        if (is_array($created)) {
            $useMinMax = false;
            if (isset($created['min'])) {
                $this->addUsingAlias(ContentsPeer::CREATED, $created['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($created['max'])) {
                $this->addUsingAlias(ContentsPeer::CREATED, $created['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ContentsPeer::CREATED, $created, $comparison);
    }

    /**
     * Filter the query by a related ContentGalleries object
     *
     * @param   ContentGalleries|PropelObjectCollection $contentGalleries  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 ContentsQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByContentGalleries($contentGalleries, $comparison = null)
    {
        if ($contentGalleries instanceof ContentGalleries) {
            return $this
                ->addUsingAlias(ContentsPeer::ID, $contentGalleries->getContentId(), $comparison);
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
     * @return ContentsQuery The current query, for fluid interface
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
     * Filter the query by a related PageContents object
     *
     * @param   PageContents|PropelObjectCollection $pageContents  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 ContentsQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByPageContents($pageContents, $comparison = null)
    {
        if ($pageContents instanceof PageContents) {
            return $this
                ->addUsingAlias(ContentsPeer::ID, $pageContents->getContentId(), $comparison);
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
     * @return ContentsQuery The current query, for fluid interface
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
     * @param   Contents $contents Object to remove from the list of results
     *
     * @return ContentsQuery The current query, for fluid interface
     */
    public function prune($contents = null)
    {
        if ($contents) {
            $this->addUsingAlias(ContentsPeer::ID, $contents->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
