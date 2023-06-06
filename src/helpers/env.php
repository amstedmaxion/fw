<?php

//CONFIG DIRECTORY NAME
$directory = "framework-am-gb";
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



//PAGINATION
define("PERPAGE", 'perPage');
define("PAGE", 'page');
