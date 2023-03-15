<?php

namespace src\database;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use PDO;
use PDOException;

class Database
{

    private $connection = null;
    private $whatIsConnection = null;

    private array $servers = [
        'intranet-latest-production' => 'instanceMySQLOrMariaDB',
        'intranet-old-production' => 'instanceMySQLOrMariaDB',
        'intranet-old-homologation' => 'instanceMySQLOrMariaDB',
        'intranet-latest-homologation' => 'instanceMySQLOrMariaDB',
        'logix-production' => 'instanceInformix',
        'logix-glass' => 'instanceInformix',
        'powerbi-production' => 'instanceMySQLOrMariaDB',
        'tableau-production' => 'instanceMySQLOrMariaDB',
        'suppplier-portal-production' => 'instanceMySQLOrMariaDB',
        'workflow-old-production' => 'instanceMySQLOrMariaDB',
        'workflow-latest-production' => 'instanceMSSQL',
        'workflow-latest-homologation' => 'instanceMSSQL',
    ];

    /**
     * Builder Method for Startup
     * 
     * @param string $whatIsConnection  Which connection will connect
     * 
     * @return self
     */
    public function __construct(string $whatIsConnection)
    {
        if (!$whatIsConnection)
            throw new Exception("Necessary to inform the connection name", 1);
        $this->setWhatIsConnection($whatIsConnection);
        return $this;
    }


    /**
     * Method for setting the database that will be connected
     * 
     * @param string $whatIsconnection Which connection will connect
     * 
     * @return void
     */
    private function setWhatIsConnection(string $whatIsConnection): void
    {
        $this->whatIsConnection = $whatIsConnection;
    }


    /**
     * Method responsible for connecting to the previously selected database
     * 
     * @return self
     */
    public function connect(): self
    {
        $typeInstance = $this->servers[$this->whatIsConnection];
        $this->$typeInstance($this->whatIsConnection);
        return $this;
    }


    /**
     * Method to verify that the connection is open with the database
     * 
     * @return self|null whether it is connected or not
     */
    public function isConnected(): self|null
    {
        if($this->connection !== null) return $this;
        return null;
    }


    /**
     * Responsible for closing the connection
     * @return self
     */
    public function close(): self
    {
        $this->connection = null;
        return $this;
    }


    /**
     * Get connection
     * 
     * @return PDO|null connection to database or null
     */
    public function getConnection(): PDO|null
    {
        return $this->connection;
    }


    /**
     * Method responsible for opening a connection to the MySQL or Mariadb database
     * 
     * @return PDO|null
     */
    private function instanceMySQLOrMariaDB(): PDO|null
    {
        if (!$this->connection) {
            $res = $this->findParams();
            try {
                $this->connection = new PDO("mysql:host={$res->properties->host};dbname={$res->properties->databaseName}", $res->properties->userName, $res->properties->password, [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ]);
                return $this->connection;
            } catch (PDOException $e) {
                throw $e;
            }
        }
        return $this->connection;
    }


    /**
     * Method responsible for opening a connection to the informix
     * 
     * @return PDO|null
     */
    private function instanceInformix(): PDO|null
    {

        if (!$this->connection) {
            $res = $this->findParams();
            try {
                $this->connection = new PDO("informix:host=" . $res->properties->host . "; service={$res->properties->service}; database=" . $res->properties->databaseName . "; server={$res->properties->server}; protocol=olsoctcp", $res->properties->userName, $res->properties->password, [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ]);
                return $this->connection;
            } catch (PDOException $e) {
                throw $e;
            }
        }
        return $this->connection;
    }


    /**
     * Method responsible for opening a connection to the MSSQL
     * 
     * @return PDO|null
     */
    private function instanceMSSQL(): PDO|null
    {

        if (!$this->connection) {
            $res = $this->findParams();
            try {
                $this->connection = new PDO("sqlsrv:Server={$res->properties->host};Database={$res->properties->databaseName}", $res->properties->userName, $res->properties->password, [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ]);
                return $this->connection;
            } catch (PDOException $e) {
                throw $e;
            }
        }
        return $this->connection;
    }


    /**
     * Method responsible for seeking connection parameters with the database
     * 
     * @return object|null
     */
    private function findParams(): object|null
    {
        $endpoint = API_DATABASE . "?database={$this->whatIsConnection}";
        try {
            $client = new Client();
            $res = $client->get($endpoint, ["headers" => ["Accept" => "application/json", "Content-type" => "application/json"]])->getBody()->getContents();
            return isJson($res);
        } catch (ClientException $th) {
            throw $th;
        }
    }
}
