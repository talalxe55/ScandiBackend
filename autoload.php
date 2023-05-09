<?php ob_start();

spl_autoload_register(function($className){

    # List all the class directories in the array.
    $array_paths = array(
        '.',
        'Controllers',
        'Database',
        'Factories',
        'Models',
        'Models/Core',
        'Models/Products'
    );

    foreach($array_paths as $path) {
        $file = $path ."/". $className . ".php";

        if (file_exists($file)) {

            include_once($file);
        }
    }




});

