<?php

namespace Core;

/**
 * Description of ConfigView
 *
 * @copyrigth (c) year, Leandro Santos - Leandro
 */
class ConfigView
{
    private $nome;
    private $dados;
    
    public function __construct($nome, array $dados = null)
    {
        $this->nome = (string) $nome;
        $this->dados = $dados;
    }
    
    public function renderView()
    {
        if (file_exists('app/' . $this->nome . '.php'))
        {
            include 'app/sts/Views/include/header.php';
            include 'app/sts/Views/include/menu.php';
            include 'app/' . $this->nome . '.php';
            include 'app/sts/Views/include/footer.php';
        } else {
            echo "Erro ao acessar Página: {$this->nome}";
        }
    }
}
