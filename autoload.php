<?php 

function contollerAutoload($class){

    include 'Controllers/' .$class. '.php';
}

spl_autoload_register('contollerAutoload');


?>