<?php

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
