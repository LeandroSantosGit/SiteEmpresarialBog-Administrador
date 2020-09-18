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
                <h2 class="display-4 titulo">Listar Tipo de Páginas</h2>
            </div>
            <?php
            if ($this->dados['buttonsTypePg']['cadTypePg']) {
                echo "<a href='" . URLADM 
                        . "register-new-typepg-site/register-info-typepg-site'>
                    <div class='p-2'>
                        <button class='btn btn-outline-success btn-sm'>Cadastrar</button>
                    </div>
                </a>";
            }
            ?>
        </div>
        <?php
        if (empty($this->dados['listTypePg'])) {
            ?>
            <div class="alert alert-danger" role="alert">
                Nenhum tipo de página encontrado!
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
                        <th class="d-none d-sm-table-cell">Ordem</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $qtnLinhaEx = 1;
                    foreach ($this->dados['listTypePg'] as $typePg) {
                        extract($typePg);
                        ?>
                        <tr>
                            <th><?php echo $id; ?></th>
                            <td><?php echo $tipo . "-" . $nome; ?></td>
                            <td class="d-none d-sm-table-cell"><?php echo $ordem; ?></td>
                            <td class="text-center">
                                <span class="d-none d-md-block">
                                    <?php
                                    if ($qtnLinhaEx <= 1) {
                                        if ($this->dados['buttonsTypePg']['alterOrderTypePg']) {
                                            echo "<button class='btn btn-outline-secondary btn-sm mr-2 disabled'
                                                          title='Não permitido alterar ordem do tipo de página'>
                                                     <i class='fas fa-angle-double-up'></i>
                                                  </button>";
                                        }
                                    } else {
                                        if ($this->dados['buttonsTypePg']['alterOrderTypePg']) {
                                            echo "<a href='" . URLADM 
                                                             . "modify-order-typepg-site/alter-order-typepg-site/$id'
                                                     class='btn btn-outline-secondary btn-sm mr-2'
                                                     title='Alterar ordem do tipo de página'>
                                                        <i class='fas fa-angle-double-up'></i>
                                                  </a>";
                                        }
                                    }
                                    $qtnLinhaEx++;
                                    if ($this->dados['buttonsTypePg']['viewTypePg']) {
                                        echo "<a href='" . URLADM 
                                                . "view-info-typepg-site/detail-info-typepg-site/$id'
                                            class='btn btn-outline-success btn-sm mr-2'>Visualizar
                                         </a>";
                                    }
                                    if ($this->dados['buttonsTypePg']['editTypePg']) {
                                        echo "<a href='" . URLADM 
                                                . "edit-typepg-site/edit-info-typepg-site/$id' 
                                            class='btn btn-outline-warning btn-sm mr-2'>Editar
                                         </a>";
                                    }
                                    if ($this->dados['buttonsTypePg']['deleteTypePg']) {
                                        echo "<a href='" . URLADM 
                                                . "delete-typepg-site/remove-typepg-site/$id'
                                            class='btn btn-outline-danger btn-sm mr-2'
                                            data-confirm='Tem certeza que deseja apagar tipo de página ?'>
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
                                        if ($qtnLinhaEx != 1) {
                                            if ($this->dados['buttonsTypePg']['alterOrderTypePg']) {
                                                echo "<a href='" . URLADM 
                                                            . "modify-order-typepg-site/alter-order-typepg-site/$id'
                                                         class='dropdown-item'
                                                         title='Alterar Ordem'>
                                                            Subir Ordem
                                                      </a>";
                                            }
                                        }
                                        $qtnLinhaEx++;
                                        if ($this->dados['buttonsTypePg']['viewTypePg']) {
                                            echo "<a href='" . URLADM 
                                                    . "view-info-typepg-site/detail-info-typepg-site/$id'
                                                class='dropdown-item'>Visualizar
                                             </a>";
                                        }
                                        if ($this->dados['buttonsTypePg']['editTypePg']) {
                                            echo "<a href='" . URLADM 
                                                    . "edit-typepg-site/edit-info-typepg-site/$id' 
                                                class='dropdown-item'>Editar
                                             </a>";
                                        }
                                        if ($this->dados['buttonsTypePg']['deleteTypePg']) {
                                            echo "<a href='" . URLADM 
                                                    . "delete-typepg-site/remove-typepg-site/$id'
                                                class='dropdown-item'
                                                data-confirm='Tem certeza que deseja apagar tipo de página ?'>
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
