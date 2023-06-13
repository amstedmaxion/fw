<?php

namespace src\database;

use Exception;
use PDO;
use PDOException;
use src\support\Database as SupportDatabase;

class Database
{
    private string $typeConnection;
    private string $host;
    private string $dbname;
    private string $username;
    private string $password;
    private ?string $service;
    private ?string $server;

    private ?PDO $pdo;

    public function __construct(string $typeConnection)
    {
        $settings = (new SupportDatabase)->getFromSettings($typeConnection);

        $this->typeConnection = $settings['typeConnection'];
        $this->host = $settings['host'] ?? null;
        $this->dbname = $settings['dbname'] ?? null;
        $this->username = $settings['username'] ?? null;
        $this->password = $settings['password'] ?? null;
        $this->service = $settings["service"] ?? null;
        $this->server = $settings["server"] ?? null;
    }

    /**
     * Method performs the database connection
     * @return PDO
     */
    public function connect(): PDO
    {
        try {
            $this->pdo = new PDO($this->getDsn(), $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->pdo;
        } catch (PDOException $e) {
            dd("Erro ao conectar com o banco de dados: " . $e->getMessage());
        }
    }

    /**
     * Obtains the type of DNS according to the informed connection
     * 
     * @return string
     */
    private function getDsn(): string
    {
        switch ($this->typeConnection) {
            case 'mysql':
                return "mysql:host={$this->host};dbname={$this->dbname};charset=utf8mb4";
            case 'sqlserver':
                return "sqlsrv:Server={$this->host};Database={$this->dbname}";
            case 'informix':
                return "informix:host={$this->host}; service={$this->service}; database={$this->dbname}; server={$this->server}; protocol=olsoctcp";
            default:
                throw new Exception("Tipo de conexão inválido: {$this->typeConnection}");
        }
    }
}
