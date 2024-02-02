<?php

use src\core\Request;
use src\support\Logger;
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


function getRandomKey(int $length = 20)
{
    $caracteres = '0123456789';
    $string = '';

    for ($i = 0; $i < $length; $i++) {
        $string .= $caracteres[rand(0, strlen($caracteres) - 1)];
    }

    return $string;
}

function dateTimeNowEN()
{
    return (new DateTime())->format("Y-m-d");
}

function dateEN2BR(string $date = null)
{
    if (empty($date)) return null;

    return (new DateTime($date))->format("d/m/Y");
}

function hourNow()
{
    return (new DateTime())->format("H:i:s");
}


function getDiffFrom(DateTime $from, string $format)
{
    $diff = $from->diff((new DateTime()));
    if ($diff->y !== 0) {
        if ($diff->y === 1)
            return "{$diff->y} ano";
        else
            return "{$diff->y} anos";
    } else if ($diff->m !== 0) {
        if ($diff->m === 1)
            return "{$diff->m} mês";
        else
            return "{$diff->m} meses";
    } else if ($diff->d !== 0) {
        if ($diff->d === 1)
            return "{$diff->d} dia";
        else
            return "{$diff->d} dias";
    } else if ($diff->h !== 0) {
        if ($diff->h === 1)
            return "{$diff->h} hora";
        else
            return "{$diff->h} horas";
    } else if ($diff->i !== 0) {
        if ($diff->i === 1)
            return "{$diff->i} minuto";
        else
            return "{$diff->i} minutos";
    } else if ($diff->s !== 0) {
        if ($diff->s === 1)
            return "{$diff->s} segundo";
        else
            return "{$diff->s} segundos";
    }
}


function logger_and_exception(string $loggerAction, string $loggerWho, int $loggerType, string|int $loggerScreenId = null, string $exceptionText, int $exceptionCode)
{
    (new Logger)->save($loggerAction, $loggerWho, $loggerScreenId, $loggerType);
    throw new Exception($exceptionText, $exceptionCode);
}



function empty_to_null(array $array)
{
    $clean = [];
    foreach ($array as $key => $value) {
        $clean[$key] = ($value === '') ? null : $value;
    }
    return $clean;
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
