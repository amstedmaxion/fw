<?php

namespace src\support;

use PDOException;
use src\database\Database;

class Logger
{
    private $screnId = MENU_ID;
    private $database;

    public function __construct()
    {
        /** @var PDO */
        $this->database = (new Database(DATABASE_DEFAULT))?->connect();
    }

    /**
     * Method responsible for recording in table tb_app_loggers
     * 
     * @param string $action
     * @param string $who
     * @param string|int $screenId
     * @return ?bool
     */
    public function save(string $action, string $who, string|int $screenId = null, int $typeInt): ?bool
    {
        if (!$this->database) return false;

        try {
            $query = "INSERT INTO tb_app_loggers (action, who, screen_id, type_int) VALUES (:action, :who, :screen_id, :type_int)";
            $stmt = $this->database->prepare($query);
            return $stmt->execute([
                ":action" => $action,
                ":who" => $who,
                ":screen_id" => $screenId ?? $this->screnId,
                ":type_int" => $typeInt
            ]);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }
}
