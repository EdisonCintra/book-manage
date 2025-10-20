<?php

function view($view, $data = []){


    foreach ($data as $key => $value) {
        $$key = $value; //variavel dinamica
    }

    require "views/template/app.php";
}

function dd(...$dump){
    var_dump($dump);
    die();
}


function abort($code){
    http_response_code($code);
    view($code);
    die();
}
