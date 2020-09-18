<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}
if (!empty($this->dados['infoArticle'][0])) {
    extract($this->dados['infoArticle'][0]);
?>
<div class="content p-1">
    <div class="list-group-item">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 titulo">Visualizar Artigo</h2>
            </div>
            <div class="p-2">
                <span class="d-none d-md-block">
                    <?php
                    if ($this->dados['buttonsArticle']['listArticle']) {
                        echo "<a href='" . URLADM . "list-article/list-info-article'
                                class='btn btn-outline-info btn-sm mr-2'>
                                 Listar
                             </a>";
                    }
                    if ($this->dados['buttonsArticle']['editArticle']) {
                        echo "<a href='" . URLADM . "edit-article/edit-info-article/$id' 
                            class='btn btn-outline-warning btn-sm mr-2'>Editar
                         </a>";
                    }
                    if ($this->dados['buttonsArticle']['editAuthorArticle']) {
                        echo "<a href='" . URLADM . "edit-author-article/edit-info-author-article/$id' 
                            class='btn btn-outline-warning btn-sm mr-2'>Editar Autor
                         </a>";
                    }
                    if ($this->dados['buttonsArticle']['deleteArticle']) {
                        echo "<a href='" . URLADM . "delete-article/remove-article/$id'
                            class='btn btn-outline-danger btn-sm'
                            data-confirm='Tem certeza que deseja apagar artigo ?'>
                             Apagar
                         </a>";
                    }
                    ?>
                </span>
                <div class="dropdown d-block d-md-none">
                    <button class="btn btn-primary dropdown-toggle btn-sm"
                            type="button"
                            id="acoeslistar"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false">
                        Ações
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoeslistar">
                        <?php
                        if ($this->dados['buttonsArticle']['listArticle']) {
                            echo "<a href='" . URLADM . "list-article/list-info-article'
                                    class='dropdown-item'>
                                     Listar
                                 </a>";
                        }
                        if ($this->dados['buttonsArticle']['editArticle']) {
                            echo "<a href='" . URLADM . "edit-article/edit-info-article/$id' 
                                class='dropdown-item'>Editar
                             </a>";
                        }
                        if ($this->dados['buttonsArticle']['editAuthorArticle']) {
                            echo "<a href='" . URLADM . "edit-author-article/edit-info-author-article/$id' 
                                class='dropdown-item'>Editar Autor
                             </a>";
                        }
                        if ($this->dados['buttonsArticle']['deleteArticle']) {
                            echo "<a href='" . URLADM . "delete-article/remove-article/$id'
                                class='dropdown-item'
                                data-confirm='Tem certeza que deseja apagar artigo ?'>
                                 Apagar
                             </a>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>
        <h2 class="display-4 titulo text-center font-weight-bold mb-5">Conteúdo</h2>
        <dl class="row">
            <dt class='col-sm-3'>Imagem </dt>
            <dd class='col-sm-9'>
                <?php
                if (!empty($imagem)) {
                    echo "<img src='" 
                        . URL . "site/assets/images/article/" 
                        . $id . "/" . $imagem . "'
                    witdh='150' height='150'>";
                }
                ?>
            </dd>
            <dt class='col-sm-3'>Id: </dt>
            <dd class='col-sm-9'><?php echo $id; ?></dd>
            <dt class='col-sm-3'>Titulo: </dt>
            <dd class='col-sm-9'><?php echo $titulo; ?></dd>
            <dt class='col-sm-3'>Prévia: </dt>
            <dd class='col-sm-9'><?php echo $descricao; ?></dd>
            <dt class='col-sm-3'>Conteúdo: </dt>
            <dd class='col-sm-9'><?php echo $conteudo; ?></dd>
            <dt class='col-sm-3'>Resumo Público: </dt>
            <dd class='col-sm-9'><?php echo $resumo_publico; ?></dd>
            <dt class='col-sm-3'>Situação: </dt>
            <dd class='col-sm-9'>
                <span class="badge badge-<?php echo $color ?>">
                    <?php echo $nomeSituation; ?>
                </span>
            </dd>
            <dt class='col-sm-3'>Tipo do artigo: </dt>
            <dd class='col-sm-9'><?php echo $nomeTypeArticle; ?></dd>
            <dt class='col-sm-3'>Categoria do artigo: </dt>
            <dd class='col-sm-9'><?php echo $nomeCategoryArticle; ?></dd>
            <dt class='col-sm-3 text-truncate'>Data de Cadastro:</dt>
            <dd class='col-sm-9'>
                <?php echo date('d/m/Y H:i', strtotime($created)); ?>
            </dd>
            <?php
            if (!empty($modified)) {
                echo "<dt class='col-sm-3 text-truncate'>Data Alteração de Cadastro:</dt>
                      <dd class='col-sm-9'>"
                        . date('d/m/Y H:i', strtotime($modified)) .
                      "</dd>";
            }
            ?>
        </dl>
        
        <hr>
            <h2 class="display-4 titulo text-center font-weight-bold mb-5">SEO</h2>
            <dl class="row">
                <dt class="col-sm-3">Slug</dt>
                <dd class="col-sm-9"><?php echo $slug; ?></dd> 
                <dt class="col-sm-3">Palavra Chave</dt>
                <dd class="col-sm-9"><?php echo $keywords; ?></dd> 
                <dt class="col-sm-3">Descrição</dt>
                <dd class="col-sm-9"><?php echo $description; ?></dd> 
                <dt class="col-sm-3">Titulo do Site</dt>
                <dd class="col-sm-9"><?php echo $author; ?></dd>  
                <dt class="col-sm-3">Situação Buscadores</dt>
                <dd class="col-sm-9">
                    <?php echo $tipoRobot ." - " . $nomeRobot; ?>
                </dd> 
                <dt class="col-sm-3">Autor do Artigo</dt>
                <dd class="col-sm-9"><?php echo $nomeUser; ?></dd> 
                <dt class="col-sm-3">Quantidade Acessos</dt>
                <dd class="col-sm-9"><?php echo $qnt_acesso; ?></dd> 
            </dl>
    </div>
</div>
<?php
} else {
    $_SESSION['msg'] = "<div class='alert alert-danger'>Artigo "
            . "não encontrado.</div>";
    $urlRedirect = URLADM . 'list-article/list-info-article';
    header("Location: $urlRedirect");
}
