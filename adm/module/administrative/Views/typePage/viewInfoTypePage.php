<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}
if (!empty($this->dados['infoTypPage'][0])) {
    extract($this->dados['infoTypPage'][0]);
    ?>
    <div class="content p-1">
        <div class="list-group-item">
            <div class="d-flex">
                <div class="mr-auto p-2">
                    <h2 class="display-4 titulo">Visualizar Tipo de Páginas</h2>
                </div>
                <div class="p-2">
                    <span class="d-none d-md-block">
                        <?php
                        if ($this->dados['buttonsTypPage']['listTypPage']) {
                            echo "<a href='" . URLADM . "list-type-page/list-types-pages'
                                     class='btn btn-outline-success btn-sm'>
                                        Listar
                                  </a> ";
                        }
                        if ($this->dados['buttonsTypPage']['editTypPage']) {
                            echo "<a href='" . URLADM . "edit-type-page/edit-info-type-page/$id'
                                     class='btn btn-outline-warning btn-sm'>
                                        Editar
                                  </a> ";
                        }
                        if ($this->dados['buttonsTypPage']['deleteTypPage']) {
                            echo "<a href='" . URLADM . "delete-type-page/remove-type-page/$id'
                                class='btn btn-outline-danger btn-sm'
                                data-confirm='Tem certeza que deseja apagar tipo de páginas ?'>
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
                            if ($this->dados['buttonsTypPage']['listTypPage']) {
                                echo "<a href='" . URLADM . "list-type-page/list-types-pages'
                                    class='dropdown-item'>Listar
                                 </a>";
                            }
                            if ($this->dados['buttonsTypPage']['editTypPage']) {
                                echo "<a href='" . URLADM . "edit-type-page/edit-info-type-page/$id'
                                    class='dropdown-item'>Editar
                                 </a>";
                            }
                            if ($this->dados['buttonsTypPage']['deleteTypPage']) {
                                echo "<a href='" . URLADM . "delete-type-page/remove-type-page/$id'
                                    class='dropdown-item'
                                    data-confirm='Tem certeza que deseja apagar tipo de páginas ?'>
                                     Apagar
                                 </a>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
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
                <dt class='col-sm-3'>Tipo:</dt>
                <dd class='col-sm-9'><?php echo $tipo; ?></dd>
                <dt class='col-sm-3'>Ordem:</dt>
                <dd class='col-sm-9'><?php echo $ordem ?></dd>
                <dt class='col-sm-3'>Observação:</dt>
                <dd class='col-sm-9'><?php echo $obs; ?></dd>
                <dt class='col-sm-3'>Data de Cadastro:</dt>
                <dd class='col-sm-9'>
                    <?php echo date('d/m/Y H:i', strtotime($created)); ?>
                </dd>
                <?php
                if (!empty($modified)) {
                    echo "<dt class='col-sm-3'>Data Alteração de Cadastro:</dt>
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
    $_SESSION['msg'] = "<div class='alert alert-danger'>Tipo de páginas "
            . "não encontrado.</div>";
    $urlRedirect = URLADM . 'list-type-page/list-types-pages';
    header("Location: $urlRedirect");
}
