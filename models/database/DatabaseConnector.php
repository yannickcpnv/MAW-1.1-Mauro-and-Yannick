<?php

namespace Looper\Models\database;

use PDO;
use PDOStatement;

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
     * @param string     $query The query, be correctly build for sql syntax.
     * @param string     $className  Name of the class type wanted in return.
     * @param array|null $queryArray
     *
     * @return array
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
     * @param string     $query The query, be correctly build for sql syntax.
     * @param string     $className  Name of the class type wanted in return.
     * @param array|null $queryArray
     *
     * @return array
     */
    public function fetchOne(string $query, string $className, array $queryArray = null): array
    {
        $this->executeQuery($query, $queryArray);
        $this->statement->setFetchMode(PDO::FETCH_CLASS, $className);
        return $this->statement->fetch();
    }

    /**
     * Insert data from an executed query.
     *
     * @param string $query The query, be correctly build for sql syntax.
     * @param array  $queryArray
     *
     * @return int
     */
    public function insert(string $query, array $queryArray): int
    {
        $this->executeQuery($query, $queryArray);
        return intval($this->connection->lastInsertId());
    }

    /**
     * Update data from an executed query.
     *
     * @param string $query The query, be correctly build for sql syntax.
     * @param array  $queryArray
     *
     * @return int
     */
    public function update(string $query, array $queryArray): int
    {
        $this->executeQuery($query, $queryArray);
        return $this->statement->rowCount();
    }

    /**
     * Execute a query received as parameter.
     *
     * @param string     $query      The query, be correctly build for sql syntax.
     * @param array|null $queryArray An array of values with as many elements as there are bound parameters in the SQL
     *                               statement being executed
     *
     * @return void True if the query is ok, otherwise false.
     */
    public function executeQuery(string $query, array $queryArray = null): void
    {
        $this->statement = $this->connection->prepare($query);
        $this->statement->execute($queryArray);
    }
    //endregion
}
