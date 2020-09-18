<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}
if (!empty($this->dados['infoSobCompany'][0])) {
    extract($this->dados['infoSobCompany'][0]);
?>
<div class="content p-1">
    <div class="list-group-item">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 titulo">Visualizar Sobre Empresa</h2>
            </div>
            <div class="p-2">
                <span class="d-none d-md-block">
                    <?php
                    if ($this->dados['buttonsSobCompany']['listSobCompany']) {
                        echo "<a href='" . URLADM . "list-sob-company/list-info-company'
                                class='btn btn-outline-info btn-sm mr-2'>
                                 Listar
                             </a>";
                    }
                    if ($this->dados['buttonsSobCompany']['listSobCompany']) {
                        echo "<a href='" . URLADM . "edit-sob-company/edit-info-sob-company/$id'
                                class='btn btn-outline-warning btn-sm mr-2'>
                                 Editar
                             </a>";
                    }
                    if ($this->dados['buttonsSobCompany']['deleteSobCompany']) {
                        echo "<a href='" . URLADM . "delete-sob-company/remove-sob-company/$id'
                            class='btn btn-outline-danger btn-sm'
                            data-confirm='Tem certeza que deseja apagar sobre empresa ?'>
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
                        if ($this->dados['buttonsSobCompany']['listSobCompany']) {
                            echo "<a href='" . URLADM . "list-sob-company/list-sob-company'
                                    class='dropdown-item'>
                                     Listar
                                 </a>";
                        }
                        if ($this->dados['buttonsSobCompany']['listSobCompany']) {
                            echo "<a href='" . URLADM . "edit-sob-company/edit-info-sob-company/$id'
                                    class='dropdown-item'>
                                     Editar
                                 </a>";
                        }
                        if ($this->dados['buttonsSobCompany']['deleteSobCompany']) {
                            echo "<a href='" . URLADM . "delete-sob-company/remove-sob-company/$id'
                                class='dropdown-item'
                                data-confirm='Tem certeza que deseja apagar sobre empresa ?'>
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
                        . URL . "site/assets/images/imgsInfoCompany/" 
                        . $id . "/" . $imagem . "'
                    witdh='150' height='150'>";
                }
                ?>
            </dd>
            <dt class='col-sm-3'>Id: </dt>
            <dd class='col-sm-9'><?php echo $id; ?></dd>
            <dt class='col-sm-3'>Titulo: </dt>
            <dd class='col-sm-9'><?php echo $titulo; ?></dd>
            <dt class='col-sm-3'>Descrição: </dt>
            <dd class='col-sm-9'><?php echo $descricao; ?></dd>
            <dt class='col-sm-3'>Ordem: </dt>
            <dd class='col-sm-9'><?php echo $ordem; ?></dd>
            <dt class='col-sm-3'>Situação:</dt>
            <dd class='col-sm-9'>
                <span class="badge badge-<?php echo $color ?>">
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
    $_SESSION['msg'] = "<div class='alert alert-danger'>Sobre empresa"
            . " não encontrado.</div>";
    $urlRedirect = URLADM . 'list-sob-company/list-info-company';
    header("Location: $urlRedirect");
}