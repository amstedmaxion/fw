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



//DATABASE INTRANET
define("INTRANET_PROD_02", "intranet_prod_02");
define("INTRANET_PROD_094", "intranet_prod_94");
define("INTRANET_HOMO_252", "intranet_homo_252");

//DATABASE WORKFLOW
define("WORKFLOW_PROD_54", "workflow_prod_54");
define("WORKFLOW_PROD_50", "workflow_prod_50");

//DATABASE LOGIX
define("LOGIX_PROD", "logix_prod");

//DATABASE POWERBI

//DATABASE TABLEAU

//DATABASE DEFAULT
define("DATABASE_DEFAULT", INTRANET_PROD_02);



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
