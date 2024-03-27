<?php

namespace src\traits;

use src\core\Request;
use src\support\Flash;

trait Validations
{

    /**
     * Responsible for verifying if a particular record is already registered
     * 
     * @param string $field
     * @param string $repository
     * @return mixed
     */
    public function unique(string $field, $repository): mixed
    {
        $id = Request::input('id');

        $data = Request::input($field);
        $repositoryFullPath = "src\\repositories\\{$repository}Repository";
        $repository = new $repositoryFullPath();

        if ($id) {
            $d = $repository
                ->select(["*"])
                ->where("{$field}", "=", "'$data'", "AND")
                ->where("id", "<>", "$id")
                ->done(true)?->results;
            if ($d) {
                if (LANG === 'en') $message = "The value {$data} is already registered";
                else if (LANG === 'pt-br') $message = "Informação já cadastrada";
                Flash::set($field, $message);
                return null;
            }
        } else {
            if ($repository->byColumn($field, "=", "\"$data\"")) {
                if (LANG === 'en') $message = "The value {$data} is already registered";
                else if (LANG === 'pt-br') $message = "Informação já cadastrada";
                Flash::set($field, $message);
                return null;
            }
        }



        return strip_tags($data);
    }

    /**
     * Responsible for checking if the email provided is valid
     * @param string $field
     * @return string 
     */
    public function email(string $field): string
    {
        if (!filter_input(INPUT_POST, $field, FILTER_VALIDATE_EMAIL)) {
            if (LANG === 'en') $message = "The email provided is not valid";
            else if (LANG === 'pt-br') $message = "O e-mail fornecido não é válido";
            Flash::set($field, $message);
            return null;
        }

        return strip_tags(Request::input($field), '<p>');
    }

    /**
     * Check if the field contains the amount of characters in its maximum limit
     * @param string $field
     * @param int $length
     * @return mixed
     */
    public function maxLen(string $field, int $length): mixed
    {
        $data = Request::input($field);
        if (strlen($data) > $length) {
            if (LANG === 'en') $message = "Field limit is {$length} characters";
            else if (LANG === 'pt-br') $message = "O limite do campo é de {$length} caracteres";
            Flash::set($field, $message);
            return null;
        }

        return strip_tags($data, '<p>');
    }

    /**
     * Checks if the field has been completed
     * @param string $field
     * @return mixed
     */
    public function required(string $field): mixed
    {
        $data = Request::input($field);
        if (empty($data)) {
            if ($data !== '0') {
                if (LANG === 'en') $message = "The field is required";
                else if (LANG === 'pt-br') $message = "O campo é obrigatório";
                Flash::set($field, $message);
                return null;
            }
        }

        if (is_array($data)) return $data;
        else return strip_tags($data, '<p><b><ul><span><em>');
    }


    /**
     * Only returns the informed content
     * @param string $field
     * @return mixed
     */
    public function isOptional(string $field): mixed
    {
        return Request::input($field);
    }
}
