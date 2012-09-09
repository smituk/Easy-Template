<?php
    define('D_S', DIRECTORY_SEPARATOR);
    define('DIR_ROOT', dirname(__FILE__) . D_S);
    define('DIR_MODELS', DIR_ROOT . 'models' . D_S);
    define('DIR_VIEWS', DIR_ROOT . 'views' . D_S);
    define('DIR_CONTROLLERS', DIR_ROOT . 'controllers' . D_S);
    define('PHP_EXT', '.php');
    define('TEMPLATE_EXT', '.tpl');
    define('DIRECTORY_INDEX', 'index.php');

    function __autoload($class)
    {
        if(file_exists(DIR_MODELS . $class . PHP_EXT))
        {
            include_once(DIR_MODELS . $class . PHP_EXT);
        }
        else if(file_exists(DIR_CONTROLLERS . $class . PHP_EXT))
        {
            include_once(DIR_CONTROLLERS . $class . PHP_EXT);
        }
    }
?>
