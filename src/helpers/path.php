<?php



/**
 * Its responsible for concat css directory with filename
 *
 * @param string $path
 * @return string
 */
function css_directory($path = '')
{
    return APP_URL . "/public/css{$path}";
}

/**
 * Its responsible for concat js directory with filename
 *
 * @param string $path
 * @return string
 */
function js_directory($path = '')
{
    return APP_URL  . "/public/js{$path}";
}

/**
 * Its responsible for concat uploads directory with filename
 *
 * @param string $path
 * @return string
 */
function uploads_directory($path = '')
{
    return APP_URL  . "/public/uploads{$path}";
}

function base_url(string $complement = null)
{
    return APP_URL . $complement;
}



/**
 * Its responsible for concat image directory with filename
 *
 * @param string $path
 * @return string
 */
function image_directory($image)
{
    return APP_URL  . '/public/images/' . $image;
}


/**
 * Its responsible for return path for migrations
 *
 * @return string
 */
function migrations_path()
{
    return APP_URL . '/docs/migrations.sql';
}
