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
 * Its responsible for return select when the options are equals
 *
 * @param mixed $variableValue
 * @param mixed $value
 * @return string
 */
function isSelect($variableValue, $value)
{
    if ($variableValue === $value) return 'selected';
    return '';
}

/**
 * Its responsible for return select when the options are equals
 *
 * @param mixed $array
 * @param mixed $value
 * @return string
 */
function isSelectArray($array, $value)
{
    if (!is_null($array)) {
        if (in_array($value, $array)) return 'selected';
    }
    return '';
}






/**
 * Its responsible for return only indexes selecteds
 *
 * @param array $array
 * @param array $keys
 * @return array
 */
function array_only(array $array, array $keys)
{
    $return = [];
    foreach ($keys as $key) {
        $return[$key] = $array[$key];
    }
    return $return;
}


/**
 * Its responsible for return only one index from array
 *
 * @param array $array
 * @param string $key
 * @return void
 */
function array_only_one($array, $key)
{
    if (isset($array[$key])) return $array[$key];
    else return [];
}


/**
 * Its responsible for return all indexes, excepts that will passed by parameter
 *
 * @param array $array
 * @param array $keys
 * @return array
 */
function array_excepts($array, $keys)
{
    $return = [];
    foreach ($array as $key => $value) {
        if (!in_array($key, $keys)) $return[$key] = $array[$key];
    }
    return $return;
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