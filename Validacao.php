<?php

/**
 * 
 * 
 * $validacao = Validacao::validar([

        'nome' => 'required',
        'email' => ['required', 'email', 'confirmed'],
        'senha' => ['required', 'min:8', 'max:30', 'strong']

    ], $_POST);

    if ($validacao->naoPassou()) {

        $_SESSION['validacoes'] = $validacao->validacoes;

        header("Location: /login");

        exit();

    }
 * 
 * $validacoes = [];

    $nome = $_POST['nome'];

    $email = $_POST['email'];

    $email_confirmacao = $_POST['email_confirmacao'];

    $senha = $_POST['senha'];

    if (strlen($nome) == 0) {

        $validacoes[] = 'O nome é obrigatório.';

    }

    if (strlen($email) == 0) {

        $validacoes[] = 'O email é obrigatório.';

    }

    if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $validacoes[] = 'O email é inválido.';

    }

    if ($email != $email_confirmacao) {

        $validacoes[] = 'O email de confirmação está diferente.';

    }

    if (strlen($senha) == 0) {

        $validacoes[] = 'A senha é obrigatória.';

    }

    if (strlen($senha) < 8 || strlen($senha) > 30) {

        $validacoes[] = 'A senha precisa ter entre 8 e 30 caracteres.';

    }

    if (!str_contains($senha, '*')) {

        $validacoes[] = 'A senha precisa um * nela.';

    }

    if (sizeof($validacoes) > 0) {

        $_SESSION['validacoes'] = $validacoes;

        header("Location: /login");

        exit();

    }
 * 
 * 
 */

class Validacao {

    public $validacoes;

    public static function validar($regras, $dados)
    {

        $validacao = new self;

        foreach($regras as $campo => $regrasDoCampo) {

            foreach($regrasDoCampo as $regra) {

                $valorDoCampo = $dados[$campo]; // dados[post] por ex

                if ($regra == 'confirmed') {

                    $validacao->$regra($campo, $valorDoCampo, $dados["{$campo}_confirmacao"]);
                        
                } else {

                    $validacao->$regra($campo, $valorDoCampo);

                }

            }

        }

        return $validacao;

    }

    private function required($campo, $valor)
    {

        if (strlen($valor) == 0) {

            $this->validacoes[] = "O $campo é obrigatório.";
    
        }

    }

    private function email($campo, $valor)
    {

        if (! filter_var($valor, FILTER_VALIDATE_EMAIL)) {

            $this->validacoes[] = "O $campo é inválido.";
    
        }

    }

    private function confirmed($campo, $valor, $valorDeConfirmacao)
    {

        if ($valor != $valorDeConfirmacao) {

            $this->validacoes[] = "O $campo de confirmação está diferente.";
    
        }

    }

    public function naoPassou()
    {

        return sizeof($this->validacoes) > 0;

    }

}
