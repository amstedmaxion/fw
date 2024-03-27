<?php

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





function empty_to_null(array $array)
{
    $clean = [];
    foreach ($array as $key => $value) {
        $clean[$key] = ($value === '') ? null : $value;
    }
    return $clean;
}
