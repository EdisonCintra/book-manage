<?php

namespace App\Models;

use Core\Database;

class Nota
{
    public $id;
    public $usuario_id;
    public $titulo;
    public $nota;
    public $data_criacao;
    public $data_atualizacao;

    public function nota()
    {
        if (session()->get('mostrar')) {

            return decrypt($this->nota);

        }

        return str_repeat('*', rand(10, 100));

    }

    public static function all($pesquisar = null)
    {
        $db = new Database(config('database'));

        return $db->query(
            query: "select * from notas where usuario_id = :usuario_id " . (
            $pesquisar ? "and titulo like :pesquisar" : null
            ),
            class: self::class,
            params: array_merge(['usuario_id' => auth()->id], $pesquisar ? ['pesquisar' => "%$pesquisar%"] : [])
        )->fetchAll();
    }


    public static function create($data)
    {
        $database = new Database(config('database'));

        $database->query(
            query: "insert into notas (usuario_id, titulo, nota, data_criacao, data_atualizacao)
                values (
                    :usuario_id,
                    :titulo,
                    :nota,
                    :data_criacao,
                    :data_atualizacao
                )
            ",
            params: array_merge($data, [
                'data_criacao' => date('Y-m-d H:i:s'),
                'data_atualizacao' => date('Y-m-d H:i:s')
            ])
        );
    }


    public static function update($id, $titulo, $nota)
    {
        $db = new Database(config('database'));

        $set = "titulo = :titulo";

        if ($nota) {

            $set .= ", nota = :nota";

        }

        $db->query(
            query: "
                update notas
                set $set
                where id = :id
            ",
            params: array_merge(
                [
                    'titulo' => $titulo,
                    'id' => $id
                ],
                $nota ? ['nota' => encrypt($nota)] : []
            )
        );
    }

    public static function delete($id)
    {
        $db = new Database(config('database'));

        $db->query(
            query: "
                delete from notas
                where id = :id
            ",
            params: [
                'id' => $id
            ]
        );
    }
}