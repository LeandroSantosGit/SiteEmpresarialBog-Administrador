<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}
if (!empty($this->dados['infoRobot'][0])) {
    extract($this->dados['infoRobot'][0]);
?>
<div class="content p-1">
    <div class="list-group-item">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 titulo">Visualizar Robot de Página</h2>
            </div>
            <div class="p-2">
                <span class="d-none d-md-block">
                    <?php
                    if ($this->dados['buttonsRobots']['listRobots']) {
                        echo "<a href='" . URLADM . "list-robots/list-info-robots'
                                class='btn btn-outline-info btn-sm mr-2'>
                                 Listar
                             </a>";
                    }
                    if ($this->dados['buttonsRobots']['editRobots']) {
                        echo "<a href='" . URLADM . "edit-robots/edit-info-robots/$id' 
                            class='btn btn-outline-warning btn-sm mr-2'>Editar
                         </a>";
                    }
                    if ($this->dados['buttonsRobots']['deleteRobots']) {
                        echo "<a href='" . URLADM . "delete-robots/remove-robots/$id'
                            class='btn btn-outline-danger btn-sm'
                            data-confirm='Tem certeza que deseja apagar robot ?'>
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
                        if ($this->dados['buttonsRobots']['listRobots']) {
                            echo "<a href='" . URLADM . "list-robots/list-info-robots'
                                    class='dropdown-item'>
                                     Listar
                                 </a>";
                        }if ($this->dados['buttonsRobots']['editRobots']) {
                            echo "<a href='" . URLADM . "edit-robots/edit-info-robots/$id' 
                                class='dropdown-item'>Editar
                             </a>";
                        }
                        if ($this->dados['buttonsRobots']['deleteRobots']) {
                            echo "<a href='" . URLADM . "delete-robots/remove-robots/$id'
                                class='dropdown-item'
                                data-confirm='Tem certeza que deseja apagar robot ?'>
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
            <dt class='col-sm-3'>Id: </dt>
            <dd class='col-sm-9'><?php echo $id; ?></dd>
            <dt class='col-sm-3'>Nome: </dt>
            <dd class='col-sm-9'><?php echo $nome; ?></dd>
            <dt class='col-sm-3'>Tipo: </dt>
            <dd class='col-sm-9'><?php echo $tipo; ?></dd>
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
    $_SESSION['msg'] = "<div class='alert alert-danger'>Robot de "
            . "página não encontrada.</div>";
    $urlRedirect = URLADM . 'list-robots/list-info-robots';
    header("Location: $urlRedirect");
}
