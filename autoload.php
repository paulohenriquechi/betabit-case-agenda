<?php 

    function autoload($class){
        $file = __DIR__."/classes/".$class.".php";
        if(is_file($file)){
            require_once($file);
        }
    }

    spl_autoload('autoload');
?>