<h1 align="center">
    <p>Site Empresarial e Administrativo</p>
</h1>

<p align="center">
  <img alt="GitHub language count" src="https://img.shields.io/github/languages/count/LeandroSantosGit/SiteEmpresarialBog-Administrador?color=34cb70">

  <img alt="Repository size" src="https://img.shields.io/github/repo-size/LeandroSantosGit/SiteEmpresarialBog-Administrador?color=34cb70">
  
  <a href="https://github.com/LeandroSantosGit/SiteEmpresarialBog-Administrador/commits/master">
    <img alt="GitHub last commit" src="https://img.shields.io/github/last-commit/LeandroSantosGit/SiteEmpresarialBog-Administrador?color=34cb70">
  </a>

  <a href="https://github.com/LeandroSantosGit/SiteEmpresarialBog-Administrador/issues">
    <img alt="Repository issues" src="https://img.shields.io/github/issues/LeandroSantosGit/SiteEmpresarialBog-Administrador?color=34cb70">
  </a>
  <img alt="License" src="https://img.shields.io/badge/license-MIT-brightgreen?color=34cb70">
</p>

<p align="center">
  <a href="#computer-projeto"> :computer: Projeto</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#rocket-tecnologias"> :rocket: Tecnologias</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#gear-instalação"> :gear: Instalação</a>&nbsp;&nbsp;&nbsp;
  <a href="#🤔-como-contribuir">🤔 Como Contribuir</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#memo-licença"> :memo: Licença</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#mailbox_with_mail-Entrar-em-contato"> :mailbox_with_mail: Entrar em Contato</a>
</p>

## :computer: Projeto

Projeto de desenvolvimento do Site, Blog integrado com comentários, e contato para envio de email ao admnistrador do site. O principal intuito é colocar em prática estudos da lingagem PHP, Bootstrap, HTML, CSS, Composer, Banco de dados e pradrão de projeto MVC.

O site possui Sistema Administrativo de conteúdo, com camadas de usuários, permissões e níveis de acesso as configurações. Configuração como páginas, grupo, tipo, situação e configuração envio de email para contato. 

No site o usuário tem acesso a edição do carousel, serviços, vídeo, sobre empresa, contato. E gerenciar o blog com publicações e edição de artigos, tipo e categoria do artigo, e configuração de SEO.

<h2 style="margin-top: 30px; text-align: center; font-weight: 600;">Site e Blog</h2>
<p align="center">
  <img alt="Site e Blog" src=".github/site.png" style="margin-top: 15px; border-radius: 3px; width: 80%;">
</p>


<h2 align="center">Administrativo do Site</h2>
<p align="center">
  <img alt="Administrativo do Site" src=".github/login.png" style="margin-top: 15px; border-radius: 3px; width: 400px; height: 300px;">
<img alt="Administrativo do Site" src=".github/dashboard.png" style="margin-top: 15px; border-radius: 3px; width: 400px; height: 300px;">
</p>

## :rocket: Tecnologias

Esse projeto foi desenvolvido com as seguintes tecnologias:

- [PHP 7.4](https://www.php.net/)
- [MySQL](https://www.mysql.com/)
- [phpmailer 6.1](https://github.com/PHPMailer/PHPMailer)
- [Composer 1.8](https://getcomposer.org/)
- [Bootstrap 4.0](https://getbootstrap.com/)
- [Font Awesome 5.9](https://fontawesome.com/)

## :gear: Instalação


* Clone o repo: ```git clone https://github.com/LeandroSantosGit/SiteEmpresarialBog-Administrador.git```

* Vá para o diretório adm: ```cd adm```

* Instale as dependências com o [composer](https://getcomposer.org/): ```php composer install```

* Crie uma base de dados chamada `php_site_gerenciador` no MySQL: ```CREATE DATABASE php_site_gerenciador```
* Em seguida importe o banco de dados que está no diretório: ```cd database```

* Agora configure a URL e credênciais de acesso ao banco de dados:
    * No diretório adm/config: ```cd adm/config``` e configure o arquivo ```Config.php```
    * Vá para o diretório site/core: ```cd site/core```  e configure o arquivo ```Config.php```

* Agora você pode acessar o site e o sistema administrativo nas URLs configuradas para visualizar o projeto.

* **Aceso ao Sistema ->** Login: ```administrador``` Senha: ```123456789```

* **Observação:** para enviar email é necessario configurar as credências como `email`, `host`, `username`, `password`, `smtp`, `port`.

## :memo: Licença

Esse projeto está sob a licença MIT. Veja o arquivo [LICENSE](LICENSE.md) para mais detalhes.

## :mailbox_with_mail: Entrar em contato

<a href="https://twitter.com/rockgolmetal" target="_blank" >
  <img alt="Twitter - Leandro Santos" src="https://img.shields.io/badge/Twitter--%23F8952D?style=social&logo=twitter"></a>&nbsp;&nbsp;&nbsp;
<a href="https://www.linkedin.com/in/leandro-s-7811b1151/" target="_blank" >
  <img alt="Linkedin - Leandro Santos" src="https://img.shields.io/badge/Linkedin--%23F8952D?style=social&logo=linkedin"></a>&nbsp;&nbsp;&nbsp;
<a href="mailto:santosdeveloper19@gmail.com" target="_blank" >
  <img alt="Email - Leandro Santos" src="https://img.shields.io/badge/Email--%23F8952D?style=social&logo=gmail">
</a> 