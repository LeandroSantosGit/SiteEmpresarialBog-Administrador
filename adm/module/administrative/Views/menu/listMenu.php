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
                <h2 class="display-4 titulo">Listar Itens do Menu</h2>
            </div>
            <?php
            if ($this->dados['buttonsMenu']['cadMenu']) {
                echo "<a href='" . URLADM . "register-new-menu/register-info-menu'>
                    <div class='p-2'>
                        <button class='btn btn-outline-success btn-sm'>Cadastrar</button>
                    </div>
                </a>";
            }
            ?>
        </div>
        <?php
        if (empty($this->dados['listItensMenu'])) {
            ?>
            <div class="alert alert-danger" role="alert">
                Nenhuma página encontrada!
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
                        <th class="d-none d-sm-table-cell text-center">Ordem</th>
                        <th class="d-none d-lg-table-cell text-center">Situação</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $qtnLinhaEx = 1;
                    foreach ($this->dados['listItensMenu'] as $itensMenu) {
                        extract($itensMenu);
                        ?>
                        <tr>
                            <th><?php echo $id; ?></th>
                            <td><?php echo "<i class='" . $icone . "'></i> - " . $nome; ?></td>
                            <td class="d-none d-sm-table-cell text-center"><?php echo $ordem; ?></td>
                            <td class="d-none d-lg-table-cell text-center">
                                <span class="badge badge-<?php echo $crCor; ?>">
                                    <?php echo $sitNome; ?>
                                </span>
                            </td>
                            <td class="text-center">
                                <span class="d-none d-md-block">
                                    <?php
                                    if ($qtnLinhaEx <= 2) {
                                        if ($this->dados['buttonsMenu']['alterOrderMenu']) {
                                            echo "<a href='" . URLADM . "modify-order-item-menu/alter-order-item-menu/$id'
                                                     class='btn btn-outline-secondary btn-sm mr-2 disabled'
                                                     title='Não permitido alterar ordem item do menu'>
                                                        <i class='fas fa-angle-double-up'></i>
                                                  </a>";
                                        }
                                    } else {
                                        if ($this->dados['buttonsMenu']['alterOrderMenu']) {
                                            echo "<a href='" . URLADM . "modify-order-item-menu/alter-order-item-menu/$id'
                                                     class='btn btn-outline-secondary btn-sm mr-2'
                                                     title='Alterar ordem item do menu'>
                                                        <i class='fas fa-angle-double-up'></i>
                                                  </a>";
                                        }
                                    }
                                    $qtnLinhaEx++;
                                    if ($this->dados['buttonsMenu']['viewMenu']) {
                                        echo "<a href='" . URLADM . "view-info-menu/detail-info-menu/$id'
                                            class='btn btn-outline-success btn-sm mr-2'>Visualizar
                                         </a>";
                                    }
                                    if ($this->dados['buttonsMenu']['editMenu']) {
                                        echo "<a href='" . URLADM . "edit-menu/edit-info-menu/$id' 
                                            class='btn btn-outline-warning btn-sm mr-2'>Editar
                                         </a>";
                                    }
                                    if ($this->dados['buttonsMenu']['deleteMenu']) {
                                        echo "<a href='" . URLADM . "delete-menu/remove-menu/$id'
                                            class='btn btn-outline-danger btn-sm mr-2'
                                            data-confirm='Tem certeza que deseja apagar item do menu ?'>
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
                                            if ($this->dados['buttonsMenu']['alterOrderMenu']) {
                                                echo "<a href='" . URLADM . "modify-order-item-menu/alter-order-item-menu/$id'
                                                         class='dropdown-item'
                                                         title='Alterar Ordem'>
                                                            Subir Ordem
                                                      </a>";
                                            }
                                        }
                                        $qtnLinhaEx++;
                                        
                                        if ($this->dados['buttonsMenu']['viewMenu']) {
                                            echo "<a href='" . URLADM . "view-info-menu/detail-info-menu/$id'
                                                class='dropdown-item'>Visualizar
                                             </a>";
                                        }
                                        if ($this->dados['buttonsMenu']['editMenu']) {
                                            echo "<a href='" . URLADM . "edit-menu/edit-info-menu/$id' 
                                                class='dropdown-item'>Editar
                                             </a>";
                                        }
                                        if ($this->dados['buttonsMenu']['deleteMenu']) {
                                            echo "<a href='" . URLADM . "delete-menu/remove-menu/$id'
                                                class='dropdown-item'
                                                data-confirm='Tem certeza que deseja apagar item do menu ?'>
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