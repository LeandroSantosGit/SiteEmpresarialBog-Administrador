<?php

namespace Config;

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
        include 'module/administrative/Views/include/headerAdm.php';
        include 'module/administrative/Views/include/headerNavigate.php';
        include 'module/administrative/Views/include/sidebar.php';
        if (file_exists('module/' . $this->nome . '.php'))
        {
            include 'module/' . $this->nome . '.php';
        } else {
            echo "Erro ao acessar Página: {$this->nome}";
        }
        include 'module/administrative/Views/include/footerAdm.php';
    }
    
    public function renderViewList()
    {
        if (file_exists('module/' . $this->nome . '.php'))
        {
            include 'module/' . $this->nome . '.php';
        } else {
            echo "Erro ao acessar Página: {$this->nome}";
        }
    }
    
    public function renderViewLogin()
    {
        include 'module/administrative/Views/include/headerLogin.php';
        if (file_exists('module/' . $this->nome . '.php'))
        {
            include 'module/' . $this->nome . '.php';
        } else {
            echo "Erro ao acessar Página: {$this->nome}";
        }
    }
}
