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
                    if ($this->dados['buttonAcesso']['listPage']) {
                        echo "<a href='" . URLADM . "list-page/list-pages'
                                class='btn btn-outline-info btn-sm mr-2'>
                                 Listar Páginas
                             </a>";
                    }
                    if ($this->dados['buttonAcesso']['editPage']) {
                        echo "<a href='" . URLADM . "edit-page/edit-info-page/$id'
                                class='btn btn-outline-warning btn-sm mr-2'>
                                 Editar Página
                             </a>";
                    }
                    if ($this->dados['buttonAcesso']['deletePage']) {
                        echo "<a href='" . URLADM . "delete-page/remove-page/$id'
                            class='btn btn-outline-danger btn-sm'
                            data-confirm='Tem certeza que deseja apagar página ?'>
                             Apagar Página
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
                        if ($this->dados['buttonAcesso']['listPage']) {
                            echo "<a href='" . URLADM . "list-page/list-pages'
                                    class='dropdown-item'>
                                     Listar Página
                                 </a>";
                        }
                        if ($this->dados['buttonAcesso']['editPage']) {
                            echo "<a href='" . URLADM . "edit-page/edit-info-page/$id'
                                    class='dropdown-item'>
                                     Editar Página
                                 </a>";
                        }
                        if ($this->dados['buttonAcesso']['deletePage']) {
                            echo "<a href='" . URLADM . "delete-page/remove-page/$id'
                                class='dropdown-item'
                                data-confirm='Tem certeza que deseja apagar página ?'>
                                 Apagar Página
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
            <dt class='col-sm-3'>Id:</dt>
            <dd class='col-sm-9'><?php echo $id; ?></dd>
            <dt class='col-sm-3'>Nome da pádina:</dt>
            <dd class='col-sm-9'><?php echo $nome_pagina; ?></dd>
            <dt class='col-sm-3'>Classe:</dt>
            <dd class='col-sm-9'><?php echo $controller; ?></dd>
            <dt class='col-sm-3'>Método:</dt>
            <dd class='col-sm-9'><?php echo $metodo; ?></dd>
            <dt class="col-sm-3">Classe no Menu:</dt>
            <dd class="col-sm-9"><?php echo $menu_controller; ?></dd>
            <dt class="col-sm-3">Metodo no Menu:</dt>
            <dd class="col-sm-9"><?php echo $menu_metodo; ?></dd>
            <dt class="col-sm-3">Observação:</dt>
            <dd class="col-sm-9"><?php echo $observacao; ?></dd>
            <dt class="col-sm-3">Ícone:</dt>
            <dd class="col-sm-9">
                <?php echo "<i class='" . $icone . "'></i> - " . $icone; ?>
            </dd>
            <dt class="col-sm-3">Grupo da Página:</dt>
            <dd class="col-sm-9"><?php echo $nomeGru; ?></dd>
            <dt class="col-sm-3">Tipo da Página:</dt>
            <dd class="col-sm-9"><?php echo $tipoTip . " - " . $nomeTip; ?></dd>
            <dt class='col-sm-3 text-truncate'>Situação:</dt>
            <dd class='col-sm-9'>
                <span class="badge badge-<?php echo $corSit ?>">
                    <?php echo $nomeSit; ?>
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
    $_SESSION['msg'] = "<div class='alert alert-danger'>Página não encontrado.</div>";
    $urlRedirect = URLADM . 'list-page/list-pages';
    header("Location: $urlRedirect");
}