<?php

namespace src\traits;

use src\core\Request;

trait BaseRepositoryFunctions
{


    /**
     * Method responsible for seeking all records in the database
     * 
     * @return array|null
     */
    public function all(): array|null
    {
        return $this->select(["*"])->done(onlyOne: false)?->results;
    }

    /**
     * This method aims to seek all records of the table configured through the model
     * 
     * @return null|array
     */
    public function allWithPaginate()
    {

        $result = $this->select(["*"])->done(onlyOne: false, paginate: (object) [PERPAGE => 4, PAGE => Request::query("page") ?? 1]);

        if (!$result) return null;

        return (object) [
            "results" => $result->results,
            "paginate" => $result->paginate
        ];
    }

    /**
     * This method's responsible for find by column id
     * 
     * @param int $id  Registration ID that is to seek
     * @return object|null
     */
    public function byId(int $id)
    {
        return $this->select(['*'])->where(column: "id", operator: "=", value: $id)->done(onlyOne: true)?->results;
    }

    /**
     * This method's responsible for find by column
     * 
     * @param mixed $id  Registration ID that is to seek
     * @return object|null
     */
    public function byColumn(string $column, string $operator, mixed $value, bool $onlyone = true)
    {
        return $this->select(['*'])->where(column: $column, operator: $operator, value: $value)->done(onlyOne: $onlyone)?->results;
    }
}
