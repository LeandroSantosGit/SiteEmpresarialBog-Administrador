<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}
if (!empty($this->dados['infoPage'][0])) {
    extract($this->dados['infoPage'][0]);
?>
<div class="content p-1">
    <div class="list-group-item">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 titulo">Visualizar Página</h2>
            </div>
            <div class="p-2">
                <span class="d-none d-md-block">
                    <?php
                    if ($this->dados['buttonsPage']['listPage']) {
                        echo "<a href='" . URLADM . "list-page-site/list-info-page-site'
                                class='btn btn-outline-info btn-sm mr-2'>
                                 Listar
                             </a>";
                    }
                    if ($this->dados['buttonsPage']['editPage']) {
                        echo "<a href='" . URLADM . "edit-page-site/edit-info-page-site/$id' 
                            class='btn btn-outline-warning btn-sm mr-2'>Editar
                         </a>";
                    }
                    if ($this->dados['buttonsPage']['deletePage']) {
                        echo "<a href='" . URLADM . "delete-page-site/remove-page-site/$id'
                            class='btn btn-outline-danger btn-sm'
                            data-confirm='Tem certeza que deseja apagar página ?'>
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
                        if ($this->dados['buttonsPage']['listPage']) {
                            echo "<a href='" . URLADM . "list-page-site/list-info-page-site'
                                    class='dropdown-item'>
                                     Listar
                                 </a>";
                        }if ($this->dados['buttonsPage']['editPage']) {
                            echo "<a href='" . URLADM . "edit-page-site/edit-info-page-site/$id' 
                                class='dropdown-item'>Editar
                             </a>";
                        }
                        if ($this->dados['buttonsPage']['deletePage']) {
                            echo "<a href='" . URLADM . "delete-page-site/remove-page-site/$id'
                                class='dropdown-item'
                                data-confirm='Tem certeza que deseja apagar página ?'>
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
        <dl class="row">
            <dt class='col-sm-3'>Imagem </dt>
            <dd class='col-sm-9'>
                <?php
                if (!empty($imagem)) {
                    echo "<img src='" 
                        . URL . "site/assets/images/page/" 
                        . $id . "/" . $imagem . "'
                    witdh='150' height='150'>";
                }
                ?>
            </dd>
            <dt class='col-sm-3'>Id: </dt>
            <dd class='col-sm-9'><?php echo $id; ?></dd>
            <dt class='col-sm-3'>Classe: </dt>
            <dd class='col-sm-9'><?php echo $controller; ?></dd>
            <dt class='col-sm-3'>Endereço: </dt>
            <dd class='col-sm-9'><?php echo $endereco; ?></dd>
            <dt class='col-sm-3'>Nome da Página: </dt>
            <dd class='col-sm-9'><?php echo $nome_pagina; ?></dd>
            <dt class='col-sm-3'>Titulo: </dt>
            <dd class='col-sm-9'><?php echo $titulo; ?></dd>
            <dt class='col-sm-3'>Observação: </dt>
            <dd class='col-sm-9'><?php echo $obs; ?></dd>
            <dt class='col-sm-3'>Palavra Chave: </dt>
            <dd class='col-sm-9'><?php echo $keywords; ?></dd>
            <dt class='col-sm-3'>Descrição: </dt>
            <dd class='col-sm-9'><?php echo $description; ?></dd>
            <dt class='col-sm-3'>Empresa: </dt>
            <dd class='col-sm-9'><?php echo $author; ?></dd>
            <dt class='col-sm-3'>Liberado no Menu: </dt>
            <dd class='col-sm-9'>
                <?php
                if ($lib_bloqueado == 1) {
                    echo "<span class='badge badge-pill badge-success'>Sim</span>";
                } else {
                    echo "<span class='badge badge-pill badge-danger'>Não</span>";
                }
                ?>
            </dd>
            <dt class='col-sm-3'>Ordem: </dt>
            <dd class='col-sm-9'><?php echo $ordem_paginas; ?></dd>
            <dt class='col-sm-3'>Tipo de página: </dt>
            <dd class='col-sm-9'><?php echo $tipoPage . " - " . $nomeTipoPg; ?></dd>
            <dt class='col-sm-3'>Página nos Buscadores: </dt>
            <dd class='col-sm-9'><?php echo $tipoRobot . " - " . $nomeRobot; ?></dd>
            <dt class='col-sm-3'>Situação: </dt>
            <dd class='col-sm-9'>
                <span class="badge badge-<?php echo $color ?>">
                    <?php echo $nomeSitPage; ?>
                </span>
            </dd>
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
    </div>
</div>
<?php
} else {
    $_SESSION['msg'] = "<div class='alert alert-danger'>Página não encontrada.</div>";
    $urlRedirect = URLADM . 'list-page-site/list-info-page-site';
    header("Location: $urlRedirect");
}
