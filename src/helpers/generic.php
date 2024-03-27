<?php

use src\core\Request;
use src\support\Validate;



/**
 * Its responsible for find a letter ou text in sentence
 *
 * @param mixed $haystack
 * @param string $needle
 * @return void
 */
function string_contains($haystack, $needle)
{
    return strpos($haystack, $needle) !== false;
}



/**
 * Method responsible for validating each of the fields informed in the array
 * 
 * @param $validations Validation array
 * @return array|bool Form data or false if data is not valid
 */
function formValidate(array $validations): array|bool
{
    $data = (new Validate)->validate($validations);
    $isArray = is_array($data);


    if ($isArray) return $data;
    else {
        setSession('old', Request::excepts(['token']));
        return false;
    }
}




function clearResultsFromLogix(array $items)
{
    $return = [];
    foreach ($items as $key => $item) {
        $item = (object) $item;
        foreach ($item as $itemKey => $itemValue) {
            $itemModify[$itemKey] = trim($itemValue);
        }
        $return[$key] = (object) $itemModify;
    }
    return $return;
}





/**
 * Returns the content of the variable or the content of the $replace
 * @param mixed $value
 * @param mixed $replace
 * @return mixed
 */
function prevent(mixed $value, mixed $replace = ''): mixed
{
    return empty($value) ? $replace : $value;
}



function getPage(string $page): mixed
{
    return file_get_contents($page);
}
