<?php

namespace App\Controllers\Notas;

use App\Models\Nota;
use Core\Database;
use Core\Validacao;

class DeleteController
{
    public function __invoke()
    {
        $validacao = Validacao::validar([
            'id' => ['required']
        ], request()->all());

        if ($validacao->naoPassou()) {
            return redirect('/lockbox/notas?id=' . request()->post('id'));
        }

        Nota::delete(request()->post('id'));

        flash()->push('mensagem', 'Registro deletado com sucesso!!');

        return redirect('/lockbox/notas');
    }
}