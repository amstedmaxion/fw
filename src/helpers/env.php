<?php

//CONFIG DIRECTORY NAME
$directory = "fw";
if (!isProduction())
    $directory .= "-dev";

//URL_BASE
define('URL_BASE', "{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['HTTP_HOST']}/amsted/{$directory}");

//PATH_BASE
define("PATH_BASE", "/var/htdocs/amsted/{$directory}");


//LANG
/** Define Language (pt-br or en) */
define('LANG', 'pt-br');


//DEBUG
define('DEBUG', true);


//MESSAGES
define('MESSAGE_ERROR', 'error');
define('MESSAGE_INFO', 'info');
define('MESSAGE_SUCCESS', 'success');
define('MESSAGE_WARNING', 'warning');



//DATABASE
define("API_DATABASE", "{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['HTTP_HOST']}/amsted/framework-setup/what-is-connection/");
define("INTRANET_OLD_PRODUCTION", 'intranet-old-production');
define("INTRANET_OLD_HOMOLOGATION", 'intranet-old-homologation');
define("INTRANET_LATEST_PRODUCTION", 'intranet-latest-production');
define("INTRANET_LATEST_HOMOLOGATION", 'intranet-latest-homologation');
define("POWERBI_PRODUCTION", 'powerbi-production');
define("SUPPLIER_PORTAL_PRODUCTION", 'suppplier-portal-production');
define("LOGIX_PRODUCTION", 'logix-production');
define("LOGIX_GLASS", 'logix-glass');
define("TABLEAU_PRODUCTION", 'tableau-production');
define("WORKFLOW_OLD_PRODUCTION", 'workflow-old-production');
define("WORKFLOW_LATEST_PRODUCTION", 'workflow-latest-production');
define("WORKFLOW_LATEST_HOMOLOGATION", 'workflow-latest-homologation');
define("INTRANET_DEFAULT", INTRANET_LATEST_HOMOLOGATION);



//PAGINATION
define("PERPAGE", 'perPage');
define("PAGE", 'page');



//CONFIG MENU ID
define("MENU_ID", "number or text");

//CONFIG USER
$emailDomain = (!empty($_SESSION["usuarioEmpresa"]) &&
    $_SESSION["usuarioEmpresa"] === '09' &&
    (!empty($_SESSION["usuarioCorporativo"]) &&
        !$_SESSION["usuarioCorporativo"]
    )) ? "@amstedmaxion.com.br" : "@gbmx.com.br";
$user = [
    "identifier" => $_SESSION["usuarioID"] ?? null,
    "name" => $_SESSION["usuarioNome"] ?? null,
    "company" => $_SESSION["usuarioEmpresa"] ?? null,
    "isCorporate" => $_SESSION["usuarioCorporativo"] ?? null,
    "isCruzeiro" => $_SESSION["usuarioCruzeiro"] ?? null,
    "code" => $_SESSION["user"]["codigo"] ?? null,
    "group" => $_SESSION["user"]["area"] ?? null,
    "center_cost" => $_SESSION["user"]["centro_custo"] ?? null,
    "unit_name" => $_SESSION["user"]["unidade"] ?? null,
    "ramal" => $_SESSION["user"]["ramal"] ?? null,
    "email_partial" => $_SESSION["user"]["email"] ?? null,
    "email_full" => $_SESSION["user"]["email"] . $emailDomain ?? null,
];
/* Defining a constant named "USER" with the value of the  variable, which is an object containing
information about the current user. This constant can be accessed throughout the code and its value
cannot be changed during runtime. */

define("USER", $user);
