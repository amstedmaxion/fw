<?php

//CONFIG DIRECTORY NAME
$directory = "route";
if (!isProduction())
    $directory .= "-pro";

//URL_BASE
define('URL_BASE', "{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['HTTP_HOST']}/amsted/{$directory}");

//PATH_BASE
define("PATH_BASE", "/var/www/htdocs/amsted/{$directory}");


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

