<?php

$pesquisar = $_REQUEST['pesquisar'] ?? '';

$db = new DB;

$livros = $db->query(

    query: "select * from livros where titulo like :filtro", 

    class: Livro::class,

    params: ['filtro' => "%$pesquisar%"]
    
)->fetchAll();

view('index', compact('livros'));