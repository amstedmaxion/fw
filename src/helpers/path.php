<?php



/**
 * Its responsible for concat css directory with filename
 *
 * @param string $path
 * @return string
 */
function css_directory($path = '')
{
    return URL_BASE . "/public/css{$path}";
}

/**
 * Its responsible for concat js directory with filename
 *
 * @param string $path
 * @return string
 */
function js_directory($path = '')
{
    return URL_BASE  . "/public/js{$path}";
}

/**
 * Its responsible for concat uploads directory with filename
 *
 * @param string $path
 * @return string
 */
function uploads_directory($path = '')
{
    return URL_BASE  . "/public/uploads{$path}";
}

function base_url()
{
    return URL_BASE;
}



/**
 * Its responsible for concat image directory with filename
 *
 * @param string $path
 * @return string
 */
function image_directory($image)
{
    return URL_BASE  . '/public/images/' . $image;
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
