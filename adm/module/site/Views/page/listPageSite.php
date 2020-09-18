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
                <h2 class="display-4 titulo">Listar Página</h2>
            </div>
            <?php
            if ($this->dados['buttonsPage']['cadPage']) {
                echo "<a href='" . URLADM 
                        . "register-new-page-site/register-info-page-site'>
                    <div class='p-2'>
                        <button class='btn btn-outline-success btn-sm'>Cadastrar</button>
                    </div>
                </a>";
            }
            ?>
        </div>
        <?php
        if (empty($this->dados['listPage'])) {
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
                        <th>Titulo</th>
                        <th class="d-none d-sm-table-cell text-center">Tipo de Página</th>
                        <th class="d-none d-sm-table-cell text-center">Menu</th>
                        <th class="d-none d-sm-table-cell text-center">Situação</th>
                        <th class="d-none d-sm-table-cell text-center">Ordem</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $qtnLinhaEx = 1;
                    foreach ($this->dados['listPage'] as $page) {
                        extract($page);
                        ?>
                        <tr>
                            <th><?php echo $id; ?></th>
                            <td><?php echo $nome_pagina; ?></td>
                            <td class="d-none d-sm-table-cell text-center">
                                <?php echo $tipoPage . " - " . $nomePage; ?>
                            </td>
                            <td class="d-none d-sm-table-cell text-center">
                                <?php
                                if ($this->dados['buttonsPage']['alterPermissonPage']) {
                                    if ($lib_bloqueado == 1) {
                                        echo "<a href='" 
                                        . URLADM 
                                        . "modify-permission-page-site/alter-permission-page-site/$id'>
                                            <span class='badge badge-pill badge-success'>Sim</span>
                                          </a>";
                                    } else {
                                        echo "<a href='" 
                                        . URLADM 
                                        . "modify-permission-page-site/alter-permission-page-site/$id'>
                                            <span class='badge badge-pill badge-danger'>Não</span>
                                          </a>";
                                    }
                                } else {
                                    if ($lib_bloqueado == 1) {
                                        echo "<span class='badge badge-pill badge-success'>Sim</span>";
                                    } else {
                                        echo "<span class='badge badge-pill badge-success'>Não</span>";
                                    }
                                }
                                ?>
                            </td>
                            <td class="d-none d-sm-table-cell text-center">
                                <?php
                                if ($this->dados['buttonsPage']['alterSitPage']) {
                                    echo "<a href='" 
                                        . URLADM 
                                        . "modify-sit-page-site/alter-sit-page-site/$id'>
                                            <span class='badge badge-pill badge-$color'>$nomeSit</span>
                                          </a>";
                                } else {
                                    echo "<span class='badge badge-pill badge-$color'>$nomeSit</span>";
                                }
                                ?>
                            </td>
                            <td class="d-none d-sm-table-cell text-center">
                                <?php echo $ordem_paginas; ?>
                            </td>
                            <td class="text-center">
                                <span class="d-none d-md-block">
                                    <?php
                                    if ($qtnLinhaEx <= 1) {
                                        if ($this->dados['buttonsPage']['alterOrderPage']) {
                                            echo "<button class='btn btn-outline-secondary btn-sm mr-2 disabled'
                                                          title='Não permitido alterar ordem da página'>
                                                     <i class='fas fa-angle-double-up'></i>
                                                  </button>";
                                        }
                                    } else {
                                        if ($this->dados['buttonsPage']['alterOrderPage']) {
                                            echo "<a href='" . URLADM 
                                                             . "modify-order-page-site/alter-order-page-site/$id'
                                                     class='btn btn-outline-secondary btn-sm mr-2'
                                                     title='Alterar ordem da página'>
                                                        <i class='fas fa-angle-double-up'></i>
                                                  </a>";
                                        }
                                    }
                                    $qtnLinhaEx++;
                                    if ($this->dados['buttonsPage']['viewPage']) {
                                        echo "<a href='" . URLADM . "view-info-page-site/detail-info-page-site/$id'
                                            class='btn btn-outline-success btn-sm mr-2'>Visualizar
                                         </a>";
                                    }
                                    if ($this->dados['buttonsPage']['editPage']) {
                                        echo "<a href='" . URLADM . "edit-page-site/edit-info-page-site/$id' 
                                            class='btn btn-outline-warning btn-sm mr-2'>Editar
                                         </a>";
                                    }
                                    if ($this->dados['buttonsPage']['deletePage']) {
                                        echo "<a href='" . URLADM . "delete-page-site/remove-page-site/$id'
                                            class='btn btn-outline-danger btn-sm mr-2'
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
                                        if ($qtnLinhaEx != 1) {
                                            if ($this->dados['buttonsPage']['alterOrderPage']) {
                                                echo "<a href='" . URLADM 
                                                            . "modify-order-page-site/alter-order-page-site/$id'
                                                         class='dropdown-item'
                                                         title='Alterar Ordem'>
                                                            Subir Ordem
                                                      </a>";
                                            }
                                        }
                                        $qtnLinhaEx++;
                                        if ($this->dados['buttonsPage']['viewPage']) {
                                            echo "<a href='" . URLADM . "view-info-page-site/detail-info-page-site/$id'
                                                class='dropdown-item'>Visualizar
                                             </a>";
                                        }
                                        if ($this->dados['buttonsPage']['editPage']) {
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
