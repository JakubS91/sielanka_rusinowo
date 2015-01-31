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
use Propel\Models\House;
use Propel\Models\PriceList;
use Propel\Models\PriceListPeer;
use Propel\Models\PriceListQuery;

/**
 * Base class that represents a query for the 'price_list' table.
 *
 *
 *
 * @method PriceListQuery orderById($order = Criteria::ASC) Order by the id column
 * @method PriceListQuery orderByHouseId($order = Criteria::ASC) Order by the house_id column
 * @method PriceListQuery orderByDateFrom($order = Criteria::ASC) Order by the date_from column
 * @method PriceListQuery orderByDateTo($order = Criteria::ASC) Order by the date_to column
 * @method PriceListQuery orderByPrice($order = Criteria::ASC) Order by the price column
 * @method PriceListQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method PriceListQuery orderByActive($order = Criteria::ASC) Order by the active column
 * @method PriceListQuery orderByCreated($order = Criteria::ASC) Order by the created column
 * @method PriceListQuery orderByLastModified($order = Criteria::ASC) Order by the last_modified column
 *
 * @method PriceListQuery groupById() Group by the id column
 * @method PriceListQuery groupByHouseId() Group by the house_id column
 * @method PriceListQuery groupByDateFrom() Group by the date_from column
 * @method PriceListQuery groupByDateTo() Group by the date_to column
 * @method PriceListQuery groupByPrice() Group by the price column
 * @method PriceListQuery groupByStatus() Group by the status column
 * @method PriceListQuery groupByActive() Group by the active column
 * @method PriceListQuery groupByCreated() Group by the created column
 * @method PriceListQuery groupByLastModified() Group by the last_modified column
 *
 * @method PriceListQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method PriceListQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method PriceListQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method PriceListQuery leftJoinHouse($relationAlias = null) Adds a LEFT JOIN clause to the query using the House relation
 * @method PriceListQuery rightJoinHouse($relationAlias = null) Adds a RIGHT JOIN clause to the query using the House relation
 * @method PriceListQuery innerJoinHouse($relationAlias = null) Adds a INNER JOIN clause to the query using the House relation
 *
 * @method PriceList findOne(PropelPDO $con = null) Return the first PriceList matching the query
 * @method PriceList findOneOrCreate(PropelPDO $con = null) Return the first PriceList matching the query, or a new PriceList object populated from the query conditions when no match is found
 *
 * @method PriceList findOneByHouseId(int $house_id) Return the first PriceList filtered by the house_id column
 * @method PriceList findOneByDateFrom(string $date_from) Return the first PriceList filtered by the date_from column
 * @method PriceList findOneByDateTo(string $date_to) Return the first PriceList filtered by the date_to column
 * @method PriceList findOneByPrice(int $price) Return the first PriceList filtered by the price column
 * @method PriceList findOneByStatus(string $status) Return the first PriceList filtered by the status column
 * @method PriceList findOneByActive(int $active) Return the first PriceList filtered by the active column
 * @method PriceList findOneByCreated(string $created) Return the first PriceList filtered by the created column
 * @method PriceList findOneByLastModified(string $last_modified) Return the first PriceList filtered by the last_modified column
 *
 * @method array findById(int $id) Return PriceList objects filtered by the id column
 * @method array findByHouseId(int $house_id) Return PriceList objects filtered by the house_id column
 * @method array findByDateFrom(string $date_from) Return PriceList objects filtered by the date_from column
 * @method array findByDateTo(string $date_to) Return PriceList objects filtered by the date_to column
 * @method array findByPrice(int $price) Return PriceList objects filtered by the price column
 * @method array findByStatus(string $status) Return PriceList objects filtered by the status column
 * @method array findByActive(int $active) Return PriceList objects filtered by the active column
 * @method array findByCreated(string $created) Return PriceList objects filtered by the created column
 * @method array findByLastModified(string $last_modified) Return PriceList objects filtered by the last_modified column
 *
 * @package    propel.generator..om
 */
abstract class BasePriceListQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BasePriceListQuery object.
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
            $modelName = 'Propel\\Models\\PriceList';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new PriceListQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   PriceListQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return PriceListQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof PriceListQuery) {
            return $criteria;
        }
        $query = new PriceListQuery(null, null, $modelAlias);

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
     * @return   PriceList|PriceList[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = PriceListPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(PriceListPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 PriceList A model object, or null if the key is not found
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
     * @return                 PriceList A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `house_id`, `date_from`, `date_to`, `price`, `status`, `active`, `created`, `last_modified` FROM `price_list` WHERE `id` = :p0';
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
            $obj = new PriceList();
            $obj->hydrate($row);
            PriceListPeer::addInstanceToPool($obj, (string) $key);
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
     * @return PriceList|PriceList[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|PriceList[]|mixed the list of results, formatted by the current formatter
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
     * @return PriceListQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PriceListPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return PriceListQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PriceListPeer::ID, $keys, Criteria::IN);
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
     * @return PriceListQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(PriceListPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(PriceListPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PriceListPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the house_id column
     *
     * Example usage:
     * <code>
     * $query->filterByHouseId(1234); // WHERE house_id = 1234
     * $query->filterByHouseId(array(12, 34)); // WHERE house_id IN (12, 34)
     * $query->filterByHouseId(array('min' => 12)); // WHERE house_id >= 12
     * $query->filterByHouseId(array('max' => 12)); // WHERE house_id <= 12
     * </code>
     *
     * @see       filterByHouse()
     *
     * @param     mixed $houseId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PriceListQuery The current query, for fluid interface
     */
    public function filterByHouseId($houseId = null, $comparison = null)
    {
        if (is_array($houseId)) {
            $useMinMax = false;
            if (isset($houseId['min'])) {
                $this->addUsingAlias(PriceListPeer::HOUSE_ID, $houseId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($houseId['max'])) {
                $this->addUsingAlias(PriceListPeer::HOUSE_ID, $houseId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PriceListPeer::HOUSE_ID, $houseId, $comparison);
    }

    /**
     * Filter the query on the date_from column
     *
     * Example usage:
     * <code>
     * $query->filterByDateFrom('2011-03-14'); // WHERE date_from = '2011-03-14'
     * $query->filterByDateFrom('now'); // WHERE date_from = '2011-03-14'
     * $query->filterByDateFrom(array('max' => 'yesterday')); // WHERE date_from < '2011-03-13'
     * </code>
     *
     * @param     mixed $dateFrom The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PriceListQuery The current query, for fluid interface
     */
    public function filterByDateFrom($dateFrom = null, $comparison = null)
    {
        if (is_array($dateFrom)) {
            $useMinMax = false;
            if (isset($dateFrom['min'])) {
                $this->addUsingAlias(PriceListPeer::DATE_FROM, $dateFrom['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dateFrom['max'])) {
                $this->addUsingAlias(PriceListPeer::DATE_FROM, $dateFrom['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PriceListPeer::DATE_FROM, $dateFrom, $comparison);
    }

    /**
     * Filter the query on the date_to column
     *
     * Example usage:
     * <code>
     * $query->filterByDateTo('2011-03-14'); // WHERE date_to = '2011-03-14'
     * $query->filterByDateTo('now'); // WHERE date_to = '2011-03-14'
     * $query->filterByDateTo(array('max' => 'yesterday')); // WHERE date_to < '2011-03-13'
     * </code>
     *
     * @param     mixed $dateTo The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PriceListQuery The current query, for fluid interface
     */
    public function filterByDateTo($dateTo = null, $comparison = null)
    {
        if (is_array($dateTo)) {
            $useMinMax = false;
            if (isset($dateTo['min'])) {
                $this->addUsingAlias(PriceListPeer::DATE_TO, $dateTo['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dateTo['max'])) {
                $this->addUsingAlias(PriceListPeer::DATE_TO, $dateTo['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PriceListPeer::DATE_TO, $dateTo, $comparison);
    }

    /**
     * Filter the query on the price column
     *
     * Example usage:
     * <code>
     * $query->filterByPrice(1234); // WHERE price = 1234
     * $query->filterByPrice(array(12, 34)); // WHERE price IN (12, 34)
     * $query->filterByPrice(array('min' => 12)); // WHERE price >= 12
     * $query->filterByPrice(array('max' => 12)); // WHERE price <= 12
     * </code>
     *
     * @param     mixed $price The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PriceListQuery The current query, for fluid interface
     */
    public function filterByPrice($price = null, $comparison = null)
    {
        if (is_array($price)) {
            $useMinMax = false;
            if (isset($price['min'])) {
                $this->addUsingAlias(PriceListPeer::PRICE, $price['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($price['max'])) {
                $this->addUsingAlias(PriceListPeer::PRICE, $price['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PriceListPeer::PRICE, $price, $comparison);
    }

    /**
     * Filter the query on the status column
     *
     * Example usage:
     * <code>
     * $query->filterByStatus('fooValue');   // WHERE status = 'fooValue'
     * $query->filterByStatus('%fooValue%'); // WHERE status LIKE '%fooValue%'
     * </code>
     *
     * @param     string $status The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PriceListQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($status)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $status)) {
                $status = str_replace('*', '%', $status);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PriceListPeer::STATUS, $status, $comparison);
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
     * @return PriceListQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_array($active)) {
            $useMinMax = false;
            if (isset($active['min'])) {
                $this->addUsingAlias(PriceListPeer::ACTIVE, $active['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($active['max'])) {
                $this->addUsingAlias(PriceListPeer::ACTIVE, $active['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PriceListPeer::ACTIVE, $active, $comparison);
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
     * @return PriceListQuery The current query, for fluid interface
     */
    public function filterByCreated($created = null, $comparison = null)
    {
        if (is_array($created)) {
            $useMinMax = false;
            if (isset($created['min'])) {
                $this->addUsingAlias(PriceListPeer::CREATED, $created['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($created['max'])) {
                $this->addUsingAlias(PriceListPeer::CREATED, $created['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PriceListPeer::CREATED, $created, $comparison);
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
     * @return PriceListQuery The current query, for fluid interface
     */
    public function filterByLastModified($lastModified = null, $comparison = null)
    {
        if (is_array($lastModified)) {
            $useMinMax = false;
            if (isset($lastModified['min'])) {
                $this->addUsingAlias(PriceListPeer::LAST_MODIFIED, $lastModified['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastModified['max'])) {
                $this->addUsingAlias(PriceListPeer::LAST_MODIFIED, $lastModified['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PriceListPeer::LAST_MODIFIED, $lastModified, $comparison);
    }

    /**
     * Filter the query by a related House object
     *
     * @param   House|PropelObjectCollection $house The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 PriceListQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByHouse($house, $comparison = null)
    {
        if ($house instanceof House) {
            return $this
                ->addUsingAlias(PriceListPeer::HOUSE_ID, $house->getId(), $comparison);
        } elseif ($house instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PriceListPeer::HOUSE_ID, $house->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByHouse() only accepts arguments of type House or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the House relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return PriceListQuery The current query, for fluid interface
     */
    public function joinHouse($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('House');

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
            $this->addJoinObject($join, 'House');
        }

        return $this;
    }

    /**
     * Use the House relation House object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Propel\Models\HouseQuery A secondary query class using the current class as primary query
     */
    public function useHouseQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinHouse($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'House', '\Propel\Models\HouseQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   PriceList $priceList Object to remove from the list of results
     *
     * @return PriceListQuery The current query, for fluid interface
     */
    public function prune($priceList = null)
    {
        if ($priceList) {
            $this->addUsingAlias(PriceListPeer::ID, $priceList->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
