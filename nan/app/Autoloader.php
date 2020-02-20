<?php
    class Autoloader {

        static function service_autoload($class_name){
            require '../php/services/' . $class_name . '.php';
        }

        static function service_register(){
            spl_autoload_register(array(__CLASS__, 'service_autoload'));
        }
    }

?>