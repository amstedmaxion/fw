<?php

namespace src\core;

class Request
{
    /**
     * This method is responsible for returning a single index of the super global $_POST
     *
     * @param string $name
     * @return string|null|array
     */
    public static function input(string $name): string|null|array
    {
        return $_POST[$name] ?? null;
    }

    /**
     * It's responsible for set an index in super global $_POST
     *
     * @param string $key
     * @param mixed $value
     * @return mixed
     */
    public static function setInput(string $key, mixed $value): mixed
    {
        $_POST[$key] = $value;
        return $_POST[$key];
    }


    /**
     * Method responsible for returning all fields of the request form
     *
     * @return array
     */
    public function get(): array
    {
        return $_POST;
    }


    /**
     * Method responsible for returning all fields of the request form
     *
     * @return array
     */
    public static function all(): array
    {
        return $_POST;
    }

    /**
     * This method returns only the fields from the $_POST super global that were requested
     *
     * @param string|array $only
     * @return array
     */
    public static function only(string|array $only): array
    {
        $fieldsPost = self::all();
        $fieldsPostKeys = array_keys($fieldsPost);

        $fieldsFiltered = [];
        foreach ($fieldsPostKeys as $index => $value) {
            $onlyField = (is_string($only) ? $only : (isset($only[$index]) ? $only[$index] : null));
            if (isset($fieldsPost[$onlyField]))
                $fieldsFiltered[$onlyField] = $fieldsPost[$onlyField];
        }

        return $fieldsFiltered;
    }




    /**
     * This method returns all fields from the $_POST super global except the fields provided.
     *
     * @param string|array $excepts
     * @return array
     */
    public static function excepts(string|array $excepts): array
    {
        $fieldsPost = self::all();

        if (is_array($excepts)) {
            foreach ($excepts as $index => $value) {
                if (isset($fieldsPost[$value]))
                    unset($fieldsPost[$value]);
            }
        } else if (is_string($excepts)) {
            if (isset($fieldsPost[$excepts]))
                unset($fieldsPost[$excepts]);
        }

        return $fieldsPost;
    }


    public static function getQuery(string $param = null)
    {
        if ($param)
            return self::query($param);
        return $_GET;
    }


    /**
     * Method responsible for obtaining a parameter from the URL (Query String);
     *
     * @param string $name
     * @return string|null
     */
    public static function query(string $name): string|null
    {
        if (!isset($_GET[$name]))
            return null;
        return $_GET[$name] != '' ? $_GET[$name] : null;
    }


    /**
     * Method responsible for converting an array to JSON
     *
     * @param array $data
     * @return string
     */
    public static function toJson(array $data): string
    {
        return json_encode($data);
    }

    /**
     * Method responsible for counting the number of items within the field
     *
     * @param string $input
     * @return int
     */
    public static function countPost(string $input): int
    {
        return count($_POST[$input]);
    }
}
