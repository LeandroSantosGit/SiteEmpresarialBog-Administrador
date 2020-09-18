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
                <h2 class="display-4 titulo">
                    <?php
                    if (!empty($this->dados['levelAcess'])) {
                        echo "Listar Permissões - {$this->dados['levelAcess'][0]['nome']}";
                    }
                    ?>
                </h2>
            </div>
            <?php
            if ($this->dados['buttonAcesso']['listLevAc']) {
                echo "<a href='" . URLADM . "access-level/list-access'>
                    <div class='p-2'>
                        <button class='btn btn-outline-success btn-sm'>Níveis de Acesso</button>
                    </div>
                </a>";
            }
            ?>
        </div>
        <?php
        if (empty($this->dados['listPerm'])) {
            ?>
            <div class="alert alert-danger" role="alert">
                Permissão não encontrada!
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
                        <th>Página</th>
                        <th class="d-none d-sm-table-cell text-center">Permissão</th>
                        <th class="d-none d-sm-table-cell text-center">Menu</th>
                        <th class="d-none d-sm-table-cell text-center">Dropdown</th>
                        <th class="d-none d-sm-table-cell text-center">Ordem</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $qtnLinhaEx = 1;
                    foreach ($this->dados['listPerm'] as $permis) {
                        extract($permis);
                        ?>
                        <tr>
                            <th><?php echo $id; ?></th>
                            <td><?php echo $nome_pagina; ?></td>
                            <td class="d-none d-sm-table-cell text-center">
                                <?php
                                if ($this->dados['buttonAcesso']['listPermission']) {
                                    if ($permissao == 1) {
                                        echo "<a href='" . URLADM . "release-permission/liberate-permission/"
                                                . "$id?niv={$this->dados['levelAcess'][0]['id']}"
                                                . "&page={$this->dados['pg']}'>
                                                <span class='badge badge-pill badge-success'>
                                                    Liberado
                                                </span>
                                              </a>";
                                    }
                                    if ($permissao == 2) {
                                        echo "<a href='" . URLADM . "release-permission/liberate-permission/"
                                                . "$id?niv={$this->dados['levelAcess'][0]['id']}"
                                                . "&page={$this->dados['pg']}'>
                                                <span class='badge badge-pill badge-danger'>
                                                    Bloqueado
                                                </span>
                                              </a>";
                                    }
                                } else {
                                    if ($permissao == 1) {
                                        echo "<span class='badge badge-pill badge-success'>
                                                    Liberado
                                              </span>";
                                    } else {
                                        echo "<span class='badge badge-pill badge-danger'>
                                                    Bloqueado
                                              </span>";
                                    }
                                }
                                ?>
                            </td>
                            <td class="d-none d-sm-table-cell text-center">
                                <?php
                                if ($this->dados['buttonAcesso']['listPermission']) {
                                    if ($lib_menu == 1) {
                                        echo "<a href='" . URLADM . "release-menu/liberate-menu/"
                                                . "$id?niv={$this->dados['levelAcess'][0]['id']}"
                                                . "&page={$this->dados['pg']}'>
                                                <span class='badge badge-pill badge-success'>
                                                    Liberado
                                                </span>
                                              </a>";
                                    }
                                    if ($lib_menu == 2) {
                                        echo "<a href='" . URLADM . "release-menu/liberate-menu/"
                                                . "$id?niv={$this->dados['levelAcess'][0]['id']}"
                                                . "&page={$this->dados['pg']}'>
                                                <span class='badge badge-pill badge-danger'>
                                                    Bloqueado
                                                </span>
                                              </a>";
                                    }
                                } else {
                                    if ($lib_menu == 1) {
                                        echo "<span class='badge badge-pill badge-success'>
                                                    Liberado
                                              </span>";
                                    } else {
                                        echo "<span class='badge badge-pill badge-danger'>
                                                    Bloqueado
                                              </span>";
                                    }
                                }
                                ?>
                            </td>
                            <td class="d-none d-sm-table-cell text-center">
                                <?php
                                if ($this->dados['buttonAcesso']['libDropdown']) {
                                    if ($dropdown == 1) {
                                        echo "<a href='" . URLADM . "release-dropdown/liberate-dropdown/"
                                                . "$id?niv={$this->dados['levelAcess'][0]['id']}"
                                                . "&page={$this->dados['pg']}'>
                                                <span class='badge badge-pill badge-success'>
                                                    Sim
                                                </span>
                                              </a>";
                                    }
                                    if ($dropdown == 2) {
                                        echo "<a href='" . URLADM . "release-dropdown/liberate-dropdown/"
                                                . "$id?niv={$this->dados['levelAcess'][0]['id']}"
                                                . "&page={$this->dados['pg']}'>
                                                <span class='badge badge-pill badge-danger'>
                                                    Não
                                                </span>
                                              </a>";
                                    }
                                } else {
                                    if ($dropdown == 1) {
                                        echo "<span class='badge badge-pill badge-success'>
                                                    Sim
                                              </span>";
                                    } else {
                                        echo "<span class='badge badge-pill badge-danger'>
                                                    Não
                                              </span>";
                                    }
                                }
                                ?>
                            </td>
                            <td class="d-none d-sm-table-cell text-center">
                                <?php echo $ordem; ?>
                            </td>
                            <td class="text-center">
                                <span class="d-none d-md-block">
                                    <?php
                                    if ($this->dados['buttonAcesso']['orderMenu']) {
                                        if (($qtnLinhaEx <= 1) && ($this->dados['pg'] == 1)) {
                                            echo "<button class='btn btn-outline-secondary btn-sm mr-2 disabled'
                                                          title='Não permitido alterar ordem do nível de acesso'>
                                                    <i class='fas fa-angle-double-up'></i>
                                                  </button>";
                                        } else {
                                            echo "<a href='" . URLADM . "modify-order-menu/alter-order-menu/"
                                                        . "$id?niv={$this->dados['levelAcess'][0]['id']}"
                                                        . "&page={$this->dados['pg']}'
                                                     class='btn btn-outline-secondary btn-sm mr-2'
                                                     title='Alterar ordem do nível de acesso'>
                                                        <i class='fas fa-angle-double-up'></i>
                                                  </a>";
                                        }
                                    }
                                    $qtnLinhaEx++;
                                    if ($this->dados['buttonAcesso']['editItemMenu']) {
                                        echo "<a href='" . URLADM . "edit-level-access-page-menu/edit-access-pg-menu/"
                                                    . "$id?niv={$this->dados['levelAcess'][0]['id']}"
                                                    . "&page={$this->dados['pg']}'
                                                 class='btn btn-outline-warning btn-sm'>Editar
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
                                        if ($this->dados['buttonAcesso']['orderMenu']) {
                                            if (($qtnLinhaEx != 2) && ($this->dados['pg'] == 1)) {
                                                echo "<a href='" . URLADM . "modify-order-menu/alter-order-menu/"
                                                            . "$id?niv={$this->dados['levelAcess'][0]['id']}"
                                                            . "&page={$this->dados['pg']}'
                                                         class='dropdown-item'
                                                         title='Alterar Ordem'>
                                                            Subir Ordem
                                                      </a>";
                                            }
                                        }
                                        $qtnLinhaEx++;
                                        if ($this->dados['buttonAcesso']['editPermis']) {
                                            echo "<a href='" . URLADM . "edit-permission/edit-ordem-permission/$id'
                                                     class='dropdown-item'>Editar
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