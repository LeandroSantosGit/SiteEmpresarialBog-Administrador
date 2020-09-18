<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}
?>
<div class="content p-1">
    <div class="list-group-item">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 titulo">Listar Grupos das Páginas</h2>
            </div>
            <?php
            if ($this->dados['buttonsGrupPg']['cadGrupPg']) {
                echo "<a href='" . URLADM . "register-new-group-pg/register-info-group-pg'>
                    <div class='p-2'>
                        <button class='btn btn-outline-success btn-sm'>Cadastrar</button>
                    </div>
                </a>";
            }
            ?>
        </div>
        <?php
        if (empty($this->dados['listGrupPg'])) {
            ?>
            <div class="alert alert-danger" role="alert">
                Nenhuma grupo da página encontrado!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
        }
        ?>
        <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th class="d-none d-lg-table-cell text-center">Ordem</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $qtnLinhaEx = 1;
                    foreach ($this->dados['listGrupPg'] as $pages) {
                        extract($pages);
                        ?>
                        <tr>
                            <th><?php echo $id; ?></th>
                            <td><?php echo $nome; ?></td>
                            <td class="d-none d-sm-table-cell text-center"><?php echo $ordem; ?></td>
                            <td class="text-center">
                                <span class="d-none d-md-block">
                                    <?php
                                    if ($qtnLinhaEx <= 2) {
                                        if ($this->dados['buttonsGrupPg']['alterOrderGrupPg']) {
                                            echo "<button class='btn btn-outline-secondary btn-sm mr-2 disabled'
                                                          title='Não permitido alterar ordem do grupo de páginas'>
                                                     <i class='fas fa-angle-double-up'></i>
                                                  </button>";
                                        }
                                    } else {
                                        if ($this->dados['buttonsGrupPg']['alterOrderGrupPg']) {
                                            echo "<a href='" . URLADM . "modify-order-group-pg/alter-order-group-pg/$id'
                                                     class='btn btn-outline-secondary btn-sm mr-2'
                                                     title='Alterar ordem do grupo de páginas'>
                                                        <i class='fas fa-angle-double-up'></i>
                                                  </a>";
                                        }
                                    }
                                    $qtnLinhaEx++;
                                    if ($this->dados['buttonsGrupPg']['viewGrupPg']) {
                                        echo "<a href='" . URLADM . "view-info-group-pg/detail-info-group-pg/$id'
                                            class='btn btn-outline-success btn-sm mr-2'>Visualizar
                                         </a>";
                                    }
                                    if ($this->dados['buttonsGrupPg']['editGrupPg']) {
                                        echo "<a href='" . URLADM . "edit-group-pg/edit-info-group-pg/$id' 
                                            class='btn btn-outline-warning btn-sm mr-2'>Editar
                                         </a>";
                                    }
                                    if ($this->dados['buttonsGrupPg']['deleteGrupPg']) {
                                        echo "<a href='" . URLADM . "delete-group-pg/remove-group-pg/$id'
                                            class='btn btn-outline-danger btn-sm mr-2'
                                            data-confirm='Tem certeza que deseja apagar grupo da página ?'>
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
                                        if ($qtnLinhaEx != 2) {
                                            if ($this->dados['buttonsGrupPg']['alterOrderGrupPg']) {
                                                echo "<a href='" . URLADM . "modify-order-group-pg/alter-order-group-pg/$id'
                                                         class='dropdown-item'
                                                         title='Alterar Ordem'>
                                                            Subir Ordem
                                                      </a>";
                                            }
                                        }
                                        $qtnLinhaEx++;
                                        if ($this->dados['buttonsGrupPg']['viewGrupPg']) {
                                            echo "<a href='" . URLADM . "view-info-group-pg/detail-info-group-pg/$id'
                                                class='dropdown-item'>Visualizar
                                             </a>";
                                        }
                                        if ($this->dados['buttonsGrupPg']['editGrupPg']) {
                                            echo "<a href='" . URLADM . "edit-group-pg/edit-info-group-pg/$id' 
                                                class='dropdown-item'>Editar
                                             </a>";
                                        }
                                        if ($this->dados['buttonsGrupPg']['deleteGrupPg']) {
                                            echo "<a href='" . URLADM . "delete-group-pg/remove-group-pg/$id'
                                                class='dropdown-item'
                                                data-confirm='Tem certeza que deseja apagar grupo página ?'>
                                                 Apagar
                                             </a>";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
            <?php
            echo $this->dados['pagination'];
            ?>
        </div>
    </div>
</div>