<?php

namespace src\requests;

use src\core\Request as httpRequest;

abstract class Request
{

    protected $rules;

    /**
     * This method returns all inputs except the token
     * 
     * @return array
     */
    public function get(): array
    {
        return httpRequest::excepts(["token"]);
    }


    /**
     * This method returns an index of Superglobal $ _Post
     * @param string $input
     * @return string|array
     */
    public function input(string $input): string|array
    {
        return httpRequest::input($input);
    }

    /**
     * This method is responsible for returning the validation rules
     * 
     * @return array
     */
    public function rules(): array
    {
        return $this->rules;
    }

    /**
     * Method responsible for performing validation
     * 
     */
    public function execute()
    {
        if (!formValidate($this->rules())) {
            notification("Whoops! Não foi possível prosseguir com a solicitação.", MESSAGE_ERROR);
            return redirect(url_back());
        }

        return [];
    }
}
