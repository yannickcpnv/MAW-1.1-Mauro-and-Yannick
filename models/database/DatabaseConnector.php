<?php

namespace Looper\Models\database;

use PDO;
use PDOStatement;
use Looper\Models\database\entities\AbstractEntity;

/**
 * This class interact with the SQL database.
 */
class DatabaseConnector
{

    //region Fields
    private PDO|null     $connection;
    private PDOStatement $statement;
    //endregion

    //region Constructor
    /**
     * Instantiate a new database object.
     *
     * @param string $dsn      The Data Source Name, contains the information required to connect to the database.
     * @param string $username The username for the DSN string.
     * @param string $password The password for the DSN string.
     */
    public function __construct(string $dsn, string $username, string $password)
    {
        $this->connection = new PDO($dsn, $username, $password);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    //endregion

    //region Methods
    /**
     * Returns the result of an executed query.
     *
     * @param string     $query      The query. It needs to be correctly build for sql syntax.
     * @param string     $className  Name of the class type wanted in return.
     * @param array|null $queryArray An array of values with as many elements as there are bound parameters in the SQL
     *                               statement being executed.
     *
     * @return array An array of entities that represent the records, empty array if there are no records.
     */
    public function fetchRecords(string $query, string $className, array $queryArray = null): array
    {
        $this->executeQuery($query, $queryArray);
        $this->statement->setFetchMode(PDO::FETCH_CLASS, $className);

        return $this->statement->fetchAll();
    }

    /**
     * Return a single row of an executed query.
     *
     * @param string     $query       The query. It needs to be correctly build for sql syntax.
     * @param string     $className   Name of the class type wanted in return.
     * @param array|null $queryArray  An array of values with as many elements as there are bound parameters in the SQL
     *                                statement being executed.
     *
     * @return AbstractEntity|false - An entity that represent the record, false if there are no record.
     */
    public function fetchOne(string $query, string $className, array $queryArray = null): AbstractEntity|false
    {
        $this->executeQuery($query, $queryArray);
        $this->statement->setFetchMode(PDO::FETCH_CLASS, $className);

        return $this->statement->fetch();
    }

    /**
     * Only check if the query returned at lest a row or not.
     *
     * @param string $query      The query. It needs to be correctly build for sql syntax.
     * @param array  $queryArray An array of values with as many elements as there are bound parameters in the SQL
     *                           statement being executed.
     */
    public function check(string $query, array $queryArray): array|bool
    {
        $this->executeQuery($query, $queryArray);
        $this->statement->setFetchMode(PDO::FETCH_BOUND);

        return $this->statement->fetch();
    }

    /**
     * Insert data from an executed query.
     *
     * @param string $query      The query. It needs to be correctly build for sql syntax.
     * @param array  $queryArray An array of values with as many elements as there are bound parameters in the SQL
     *                           statement being executed.
     *
     * @return int The new id of the inserted row.
     */
    public function insert(string $query, array $queryArray): int
    {
        $this->executeQuery($query, $queryArray);

        return (int)$this->connection->lastInsertId();
    }

    /**
     * Update data from an executed query.
     *
     * @param string $query      The query. It needs to be correctly build for sql syntax.
     * @param array  $queryArray An array of values with as many elements as there are bound parameters in the SQL
     *                           statement being executed.
     *
     * @return int  The number of rows affected.
     */
    public function update(string $query, array $queryArray): int
    {
        $this->executeQuery($query, $queryArray);

        return $this->statement->rowCount();
    }

    /**
     * Update data from an executed query.
     *
     * @param string $query      The query. It needs to be correctly build for sql syntax.
     * @param array  $queryArray An array of values with as many elements as there are bound parameters in the SQL
     *                           statement being executed.
     *
     * @return bool True if the query is ok, otherwise false.
     */
    public function delete(string $query, array $queryArray): bool
    {
        return $this->executeQuery($query, $queryArray);
    }

    /**
     * Execute a query received as parameter.
     *
     * @param string     $query      The query. It needs to be correctly build for sql syntax.
     * @param array|null $queryArray An array of values with as many elements as there are bound parameters in the SQL
     *                               statement being executed
     *
     * @return bool True if the query is ok, otherwise false.
     */
    public function executeQuery(string $query, array $queryArray = null): bool
    {
        $this->statement = $this->connection->prepare($query);

        return $this->statement->execute($queryArray);
    }
    //endregion
}
