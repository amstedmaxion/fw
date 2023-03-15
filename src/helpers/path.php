<?php



/**
 * Its responsible for concat css directory with filename
 *
 * @param string $path
 * @return string
 */
function css_directory($path = '')
{
    $request_scheme = URL_BASE;
    return $request_scheme . "/public/css{$path}";
}

/**
 * Its responsible for concat js directory with filename
 *
 * @param string $path
 * @return string
 */
function js_directory($path = '')
{
    $request_scheme = URL_BASE;
    return $request_scheme  . "/public/js{$path}";
}

/**
 * Its responsible for concat uploads directory with filename
 *
 * @param string $path
 * @return string
 */
function uploads_directory($path = '')
{
    $request_scheme = URL_BASE;
    return $request_scheme  . "/public/uploads{$path}";
}

function base_url()
{
    $request_scheme = URL_BASE;
    return $request_scheme;
}



/**
 * Its responsible for concat image directory with filename
 *
 * @param string $path
 * @return string
 */
function image_directory($image)
{
    $request_scheme = URL_BASE;
    return $request_scheme  . '/public/images/' . $image;
}


/**
 * Its responsible for return path for migrations
 *
 * @return string
 */
function migrations_path()
{
    return URL_BASE . '/docs/migrations.sql';
}
