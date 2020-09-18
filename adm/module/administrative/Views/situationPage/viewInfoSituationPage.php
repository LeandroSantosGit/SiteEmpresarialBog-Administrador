<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}
if (!empty($this->dados['infoSitPage'][0])) {
    extract($this->dados['infoSitPage'][0]);
?>
<div class="content p-1">
    <div class="list-group-item">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 titulo">Visualizar Detalhes da Situação de Página</h2>
            </div>
            <div class="p-2">
                <span class="d-none d-md-block">
                    <?php
                    if ($this->dados['buttonSitPage']['listSitPage']) {
                        echo "<a href='" . URLADM . "list-situation-page/list-situation-pages'
                                class='btn btn-outline-info btn-sm mr-2'>
                                 Listar
                             </a>";
                    }
                    if ($this->dados['buttonSitPage']['editSitPage']) {
                        echo "<a href='" . URLADM . "edit-situation-page/edit-info-situation-page/$id'
                                class='btn btn-outline-warning btn-sm mr-2'>
                                 Editar
                             </a>";
                    }
                    if ($this->dados['buttonSitPage']['deleteSitPage']) {
                        echo "<a href='" . URLADM . "delete-situation-page/remove-situation-page/$id'
                            class='btn btn-outline-danger btn-sm'
                            data-confirm='Tem certeza que deseja apagar situação de página ?'>
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
                        if ($this->dados['buttonSitPage']['listSitPage']) {
                            echo "<a href='" . URLADM . "list-situation-page/list-situation-pages'
                                    class='dropdown-item'>
                                     Listar
                                 </a>";
                        }
                        if ($this->dados['buttonSitPage']['editSitPage']) {
                            echo "<a href='" . URLADM . "edit-situation-page/edit-info-situation-page/$id'
                                    class='dropdown-item'>
                                     Editar
                                 </a>";
                        }
                        if ($this->dados['buttonSitPage']['deleteSitPage']) {
                            echo "<a href='" . URLADM . "delete-situation-page/remove-situation-page/$id'
                                class='dropdown-item'
                                data-confirm='Tem certeza que deseja apagar situação de página ?'>
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
            <dt class='col-sm-3'>Id:</dt>
            <dd class='col-sm-9'><?php echo $id; ?></dd>
            <dt class='col-sm-3'>Nome:</dt>
            <dd class='col-sm-9'><?php echo $nome; ?></dd>
            <dt class='col-sm-3 text-truncate'>Situação:</dt>
            <dd class='col-sm-9'>
                <span class="badge badge-<?php echo $cor ?>">
                    <?php echo $nome; ?>
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
    $_SESSION['msg'] = "<div class='alert alert-danger'>Situação não encontrado.</div>";
    $urlRedirect = URLADM . 'list-situation/list-situations';
    header("Location: $urlRedirect");
}