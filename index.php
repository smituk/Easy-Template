<?php
    require(dirname(__FILE__) . '/config.php');
    Http::_()->out( Http::_()->route() );
?>
