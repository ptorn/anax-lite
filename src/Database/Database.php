<?php

namespace Peto16\Database;

/**
 * Database class to handle the database connection.
 *
 */
class Database implements \Anax\Common\ConfigureInterface
{
    use \Anax\Common\ConfigureTrait;
    /**
     * @var array        $options used when creating the PDO object
     * @var PDO          $pdo     the PDO object
     * @var PDOStatement $stmt    the latest PDOStatement used
     */
    private $pdo = null;
    private $stmt = null;



    /**
     * Connect to the database.
     *
     * @return self
     *
     * @throws \Anax\Database\Exception
     */
    public function connect()
    {
        if (!isset($this->config)) {
            throw new Exception("You can not connect, missing config.");
        }

        try {
            $this->pdo = new \PDO(
                $this->config['dsn'],
                $this->config['username'],
                $this->config['password'],
                $this->config['driver_options']
            );

            $this->pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, $this->config['fetch_mode']);
            $this->pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
        } catch (\PDOException $e) {
            if ($this->config['debug_connect']) {
                throw $e;
            }
            throw new Exception("Could not connect to database, hiding connection details.");
        }
        return $this;
    }



    /**
     * Execute a select-query with arguments and return the resultset.
     *
     * @param string $query  the SQL statement
     * @param array  $params the params array
     *
     * @return array with resultset
     */
    public function executeFetchAll($query, $params = [])
    {
        $this->execute($query, $params);
        return $this->fetchAll();
    }



    /**
     * Execute a SQL-query and ignore the resultset.
     *
     * @param string $query  the SQL statement
     * @param array  $params the params array
     *
     * @return boolean returns TRUE on success or FALSE on failure.
     *
     * @throws Exception when failing to prepare question.
     */
    public function execute($query, $params = [])
    {
        $this->stmt = $this->pdo->prepare($query);
        if (!$this->stmt) {
            throw new \PDOException("Error preparing SQL query: $query");
        }

        $res = $this->stmt->execute(is_array($params) ? $params : [$params]);
        if (!$res) {
            throw new \PDOException("Error execute SQL query: $query");
        }
        return $res;
    }



    /**
     * FetchAll data from the database.
     * @method fetchAll
     * @return array   Returns the result from the database.
     */
    public function fetchAll()
    {
        return $this->stmt->fetchAll();
    }



    /**
     * Fetch the first one result from the database.
     * @method fetchOne
     * @return array   With the result
     */
    public function fetchOne()
    {
        return $this->stmt->fetch();
    }



    /**
     * Execute and fetch data from the database.
     * @method executeFetch
     * @param  string       $query to be executed
     * @param  array       $param to insert into query.
     * @return array              Result from query.
     */
    public function executeFetch($query, $param)
    {
        $this->execute($query, $param);
        return $this->stmt->fetch();
    }



    /**
     * Check if data excist in database.
     * @method dataExcist
     * @param  string     $query      To check.
     * @param  string     $checkValue String to search for.
     * @return array                  Result from search.
     */
    public function dataExcist($query, $checkValue)
    {
        $this->execute($query, [$checkValue]);
        return $this->fetchOne();
    }
}
