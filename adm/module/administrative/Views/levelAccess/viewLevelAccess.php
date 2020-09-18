<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}
if (!empty($this->dados['dadosNivAc'][0])) {
    extract($this->dados['dadosNivAc'][0]);
?>
<div class="content p-1">
    <div class="list-group-item">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 titulo">Visualizar Nível de Acesso</h2>
            </div>
            <div class="p-2">
                <span class="d-none d-md-block">
                    <?php
                    if ($this->dados['buttonAcesso']['listAcess']) {
                        echo "<a href='" . URLADM . "access-level/list-access'
                                class='btn btn-outline-info btn-sm mr-2'>
                                 Listar Acessos
                             </a>";
                    }
                    if ($this->dados['buttonAcesso']['editAcess']) {
                        echo "<a href='" . URLADM . "edit-level-access/edit-access/$id'
                                class='btn btn-outline-warning btn-sm mr-2'>
                                 Editar Acesso
                             </a>";
                    }
                    if ($this->dados['buttonAcesso']['deleteAcess']) {
                        echo "<a href='" . URLADM . "delete-level-access/remove-acess/$id'
                            class='btn btn-outline-danger btn-sm'
                            data-confirm='Tem certeza que deseja apagar usuário ?'>
                             Apagar Acesso
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
                        if ($this->dados['buttonAcesso']['listAcess']) {
                            echo "<a href='" . URLADM . "access-level/list-access'
                                    class='dropdown-item'>
                                     Listar Acessos
                                 </a>";
                        }
                        if ($this->dados['buttonAcesso']['editAcess']) {
                            echo "<a href='" . URLADM . "edit-level-access/edit-access/$id'
                                    class='dropdown-item'>
                                     Editar Acesso
                                 </a>";
                        }
                        if ($this->dados['buttonAcesso']['deleteAcess']) {
                            echo "<a href='" . URLADM . "edit-level-access/edit-access/$id'
                                class='dropdown-item'
                                data-confirm='Tem certeza que deseja apagar usuário ?'>
                                 Apagar Acesso
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
            <dt class='col-sm-3'>Id: </dt>
            <dd class='col-sm-9'><?php echo $id; ?></dd>
            <dt class='col-sm-3'>Nome: </dt>
            <dd class='col-sm-9'><?php echo $nome; ?></dd>
            <dt class='col-sm-3'>Ordem: </dt>
            <dd class='col-sm-9'><?php echo $ordem; ?></dd>
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
    $_SESSION['msg'] = "<div class='alert alert-danger'>Nível de acesso não encontrado.</div>";
    $urlRedirect = URLADM . 'access-level/list-access';
    header("Location: $urlRedirect");
}