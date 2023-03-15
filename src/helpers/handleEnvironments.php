<?php

/**
 * This method is responsible for verifying that the application is in the production host
 * 
 * @return boolean If you are at host 0.94 or not
 */
function isProduction()
{
    return $_SERVER['HTTP_HOST'] === '172.30.0.94';
}


/**
 * Method responsible for seeking the first name of the company that the user belongs
 * 
 * @return null|string Null or first name of the employee's company
 */
function whatsCompany(): null|string
{
    $companySession = $_SESSION["usuarioEmpresa"] ?? null;
    $isCorporate = $_SESSION["usuarioCorporativo"] ?? null;
    if($isCorporate) return "greenbrier";
    if (!$companySession) return "amsted";
    return ($companySession === '09') ? "amsted" : "greenbrier";
}
