<?php

namespace src\traits;

use src\core\Request;

trait BaseRepositoryFunctions
{


    /**
     * Method responsible for seeking all records in the database
     * 
     * @return object|null
     */
    public function all(): object|null
    {
        return $this->select(["*"])->done(onlyOne: false);
    }

    /**
     * This method aims to seek all records of the table configured through the model
     * 
     * @return object|null
     */
    public function allWithPaginate(): object|null
    {
        return $this->select(["*"])->done(onlyOne: false, paginate: (object) [PERPAGE => 4, PAGE => Request::query("page") ?? 1]) ?? null;
    }

    /**
     * This method's responsible for find by column id
     * 
     * @param int $id  Registration ID that is to seek
     * @return object|null
     */
    public function byId(int $id)
    {
        return $this->select(['*'])->where(column: "id", operator: "=", value: $id)->done(onlyOne: true);
    }

    /**
     * This method's responsible for find by column
     * 
     * @param string $column Column that will be used in comparative condition
     * @param string $operator Operator that will be used in comparative condition
     * @param mixed $value Value that will be used in comparative condition
     * @param bool $onlyOne Whether the result should be just a record or not
     * @return object|null
     */
    public function byColumn(string $column, string $operator, mixed $value, bool $onlyone = true)
    {
        return $this->select(['*'])->where(column: $column, operator: $operator, value: $value)->done(onlyOne: $onlyone);
    }
}
