<?php

//CONFIG DIRECTORY NAME

define("DIRECTORY", "phpparchment");
define("COMPANY", "amsted");


//APP_URL
define('APP_URL', "{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['HTTP_HOST']}/" . COMPANY . "/" . DIRECTORY . "");
