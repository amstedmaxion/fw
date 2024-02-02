<?php

namespace src\repositories;

use PDO;
use PDOException;
use src\database\Database;
use src\database\Paginate;
use src\traits\BaseRepositoryFunctions;

abstract class BaseRepository
{
    use BaseRepositoryFunctions;
    private $queryString;
    public $results;


    private $where = false;
    protected $relations = [];
    public $paginate = null;
    public mixed $model;


    /**
     * This method aims to define the model that will be treated as a repository
     * 
     * @param mixed $model 
     * 
     * @return self
     */
    public function setModel(mixed $model): self
    {
        $this->model = $model;
        return $this;
    }


    /**
     * Method responsible for configuring the columns and table that the data will be sought
     * 
     * @param array $columns Array of columns that will be sought
     * 
     * @return self
     */
    public function select(array $columns): self
    {
        $columnsString = implode(", ", $columns);
        $this->queryString = "SELECT {$columnsString} FROM {$this->model->table} ";
        return $this;
    }

    /**
     * Add Where clauses on query
     * 
     * @param string $column
     * @param string $operator
     * @param mixed $value
     * @param string $logic
     */
    public function where(string $column, string $operator, mixed $value, string $logic = ''): self
    {
        $this->queryString .= !$this->where ? "WHERE " : "";
        $this->queryString .= "{$column} {$operator} {$value} {$logic} ";
        $this->where = true;
        return $this;
    }


    /**
     * Method responsible for performing the search in the database effectively
     * 
     * @param bool $onlyOne When true, it will bring only one record and the return of the method will be the class that called the method itself
     * @param bool $returnResults When true, it will return an array of objects of the type of model that called the method, otherwise it will store in the object responsible for the call on the "results" property
     * 
     * @return self
     */
    public function done(bool $onlyOne = true, object $paginate = null, bool $debug = false): self
    {
        if ($debug) {
            echo "<pre>{$this->queryString}</pre>";
            die;
        }

        if (!empty($paginate)) {
            $totalItems = count($this->connect($this->model->db)->query($this->queryString)->fetchAll() ?? []);
            $paginateClass = new Paginate($totalItems, $paginate->perPage, $paginate->page);
            $this->paginate = (object) ['links' => $paginateClass->links()];
            $this->limit($paginate->perPage)->offset($paginate->perPage * ($paginate->page - 1));
        }



        $this->results = $this->connect($this->model->db)->query($this->queryString)->fetchAll(PDO::FETCH_CLASS, get_class($this->model));



        if ($onlyOne) $this->results = array_shift($this->results);

        return $this;
    }

    /**
     * If the "ID" property does not exist in the object, it means that an Insert should be performed, otherwise an update should be performed.
     * 
     * @return bool|object
     */
    public function save(bool $debug = false): bool|object
    {

        try {
            $properties = array_excepts(get_object_vars($this->model), ["table", "db", "relations"]);
            
            if (!isset($this->model->id)) {
                $fields = implode(', ', array_keys($properties));
                $values = ":" . implode(', :', array_keys($properties));
                $query = "INSERT INTO {$this->model->table} ({$fields}) VALUES ({$values})";

                if($debug)
                    dd($query);

                $database = $this->connect($this->model->db);
                $stmt = $database->prepare($query);
                $stmt->execute($properties);
                $this->model->id = $database->lastInsertId();
                return $this->model;
            } else {
                $fields = array_keys($properties);
                $sets = [];
                foreach ($fields as $index => $field) {
                    $sets[] = "{$field} = :{$field}";
                }
                $setsString = implode(", ", $sets);

                $query = "UPDATE {$this->model->table} SET {$setsString} WHERE id = {$this->model->id}";
                $stmt = $this->connect($this->model->db)->prepare($query);
                return $stmt->execute($properties);
            }
        } catch (PDOException $e) {
            if (DEBUG) dd($e->getMessage());
            return null;
        }
    }

    /**
     * Performs the creation of a join between tables
     * 
     * @param $type inner,Outer and others.
     * @param $firstTable
     * @param $secondTable
     * @param $firstComparator
     * @param $secondComparator
     * 
     * @return self
     */
    public function join(string $type = null, string $firstTable = null, string $secondTable = null, string $firstComparator = null, string $secondComparator = null): self
    {
        $this->queryString .= "{$type} JOIN {$secondTable} ON {$secondTable}.{$secondComparator} = {$firstTable}.{$firstComparator} ";
        return $this;
    }

    /**
     * Delete the database item according to object table and id
     * 
     * @return bool
     */
    public function destroy(): bool
    {
        $this->queryString = "DELETE FROM {$this->model->table} WHERE id = {$this->model->id}";
        return $this->connect($this->model->db)->exec($this->queryString);
    }


    /**
     * Add the clause to limit the search
     * 
     * @param int $limit
     * 
     * @return self
     */
    public function limit(int $limit): self
    {
        if ($limit)
            $this->queryString .= " LIMIT {$limit} ";

        return $this;
    }

    /**
     * add GROUP BY in query
     * 
     * @param string $column Column that will be grouped
     * 
     * @return self
     */
    public function group(string $column): self
    {
        $this->queryString .= "GROUP BY {$column} ";
        return $this;
    }

    /**
     * Add the ORDER BY in query
     * 
     * @param string $column
     * @param string $oder ASC or DESC
     * 
     * @return self
     */
    public function order(string $column, string $order = "ASC"): self
    {
        $this->queryString .= "ORDER BY {$column} {$order} ";
        return $this;
    }

    /**
     * Method responsible for adding the Having clause in query
     * 
     * @param string $firstValue
     * @param string $operator
     * @param string $secondValue
     * 
     * @return self
     */
    public function having(string $firstValue, string $operator, mixed $secondValue): self
    {
        $this->queryString .= "HAVING {$firstValue} {$operator} {$secondValue}";
        return $this;
    }


    /**
     * Method responsible for setting up the amount of items that will be jumped
     * 
     * @param int $lenght Number of items that will be discarded
     * 
     * @return self
     */
    public function offset(int $lenght): self
    {
        $this->queryString .= "offset {$lenght}";
        return $this;
    }


    /**
     * This method is responsible for count all registers from table
     * 
     * @return int Total records found in the table
     */
    public function count(): int
    {
        $result = $this->connect($this->model->db)->query("SELECT COUNT(*) as total FROM {$this->model->table}")->fetch();

        return $result->total;
    }

    /**
     * This method is responsible for connecting to the database and this connection happens only when a method is called, be it insert, update, delete or doe
     * 
     * @param string $whatIsConnection Name of the connection that will connect to execute the queries
     * 
     * @return PDO
     */
    public function connect(string $whatIsConnection): PDO
    {
        return (new Database($whatIsConnection))->connect();
    }

    /**
     * This method is responsible for performing basic filters with the model columns
     * 
     * @param string $filter
     * 
     * @return self
     */
    public function applyFilters(string $filter): self
    {
        $properties = array_keys(array_excepts(get_object_vars($this), ["queryString", "results", "table", "db", "where", "relations", 'paginate', "validations"]));


        foreach ($properties as $indexProperty => $property) {
            $last = $indexProperty === count($properties) - 1;
            $typeOf = gettype($this->$property);
            if ($typeOf === "string") $this->where(column: $property, operator: "LIKE", value: "'%$filter%'", logic: $last ? "" : "OR");
            else if (
                $typeOf !== "string" &&
                (is_numeric(value: $filter) or
                    is_bool(value: $filter)
                )
            ) $this->where(column: $property, operator: "=", value: $filter, logic: $last ? "" : "OR");
        }

        $this->queryString = trim($this->queryString, "OR ");
        return $this;
    }


    /**
     * This method is responsible for configuring the fields
     * 
     * @param array $data
     * 
     * @return self
     */
    public function fill(array $data): self
    {
        foreach ($data as $name => $value) {
            $this->$name = $value;
        }
        return $this;
    }


    /**
     * This method is responsible for seeking the registration of relationships with the model
     * @return self
     */
    public function relations(): self
    {
        if (isset($this->model->relations) && count($this->model->relations)) {
            if (is_array($this->results)) {
                foreach ($this->results as $index => $result) {
                    foreach ($this->model->relations as $class => $options) {
                        $classNamespace = "src\database\models\\{$class}";
                        $query = "SELECT * FROM {$options['table']} WHERE {$options['column']} = {$result->id}";

                        $newIndex = $options['index'];
                        $result->$newIndex = $options['relation'] === 'hasOne' ? $this->connect($this->model->db)->query($query)->fetchObject($classNamespace) : $this->connect($this->model->db)->query($query)->fetchAll(PDO::FETCH_CLASS, $classNamespace);
                    }
                }
            } else if (is_object($this->results)) {
                foreach ($this->model->relations as $class => $options) {
                    $classNamespace = "src\database\models\\{$class}";
                    $query = "SELECT * FROM {$options['table']} WHERE {$options['column']} = {$this->results->id}";

                    $newIndex = $options['index'];
                    $this->results->$newIndex = $options['relation'] === 'hasOne' ? $this->connect($this->model->db)->query($query)->fetchObject($classNamespace) : $this->connect($this->model->db)->query($query)->fetchAll(PDO::FETCH_CLASS, $classNamespace);
                }
            }
        }

        return $this;
    }

    /**
     * Method responsible for seeking the results
     * 
     * @return array|object|null
     */
    public function get(): array|object|null
    {
        return $this?->results;
    }
}
