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
                <h2 class="display-4 titulo">Listar Níveis de Acessos</h2>
            </div>
            <div class="p-2">
                <span class="d-none d-md-block">
                    <?php
                    if ($this->dados['buttonAcesso']['synchronizePerm']) {
                        echo "<a href='" . URLADM . "synchronize-level-access-page/synchronize-access-pg'
                                 class='btn btn-outline-warning btn-sm'>
                                    Sincronizar
                              </a> ";
                    }
                    if ($this->dados['buttonAcesso']['cadAcess']) {
                        echo "<a href='" . URLADM . "register-level-access/register-access'
                                 class='btn btn-outline-success btn-sm'>
                                    Cadastrar
                              </a> ";
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
                        if ($this->dados['buttonAcesso']['synchronizePerm']) {
                            echo "<a href='" . URLADM . "synchronize-level-access-page/synchronize-access-pg'
                                class='dropdown-item'>Sincronizar
                             </a>";
                        }
                        if ($this->dados['buttonAcesso']['cadAcess']) {
                            echo "<a href='" . URLADM . "register-level-access/register-access'
                                class='dropdown-item'>Cadastrar
                             </a>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
        if (empty($this->dados['listNivAc'])) {
            ?>
            <div class="alert alert-danger" role="alert">
                Nenhum usuário encontrado!
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
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $qtnLinhaEx = 1;
                    foreach ($this->dados['listNivAc'] as $nivAcc) {
                        extract($nivAcc);
                        ?>
                        <tr>
                            <th><?php echo $id; ?></th>
                            <td><?php echo $nome; ?></td>
                            <td class="d-none d-sm-table-cell text-center"><?php echo $ordem ?></td>
                            <td class="text-center">
                                <span class="d-none d-md-block">
                                    <?php
                                    if ($qtnLinhaEx <= 2) {
                                        if ($this->dados['buttonAcesso']['ordemLevelAcess']) {
                                            echo "<button class='btn btn-outline-secondary btn-sm mr-2 disabled'
                                                          title='Não permitido alterar ordem do nível de acesso'>
                                                     <i class='fas fa-angle-double-up'></i>
                                                  </button>";
                                        }
                                    } else {
                                        if ($this->dados['buttonAcesso']['ordemLevelAcess']) {
                                            echo "<a href='" . URLADM . "modify-order-access/modify-orderAcc/$id'
                                                     class='btn btn-outline-secondary btn-sm mr-2'
                                                     title='Alterar ordem do nível de acesso'>
                                                        <i class='fas fa-angle-double-up'></i>
                                                  </a>";
                                        }
                                    }
                                    $qtnLinhaEx++;
                                    if ($this->dados['buttonAcesso']['listPermission']) {
                                        echo "<a href='" . URLADM . "permission/list-permission/1?level=$id'
                                            class='btn btn-outline-info btn-sm mr-2'>Permissões
                                         </a>";
                                    }
                                    if ($this->dados['buttonAcesso']['viewAcess']) {
                                        echo "<a href='" . URLADM . "view-level-access/detail-access/$id'
                                            class='btn btn-outline-success btn-sm mr-2'>Visualizar
                                         </a>";
                                    }
                                    if ($this->dados['buttonAcesso']['editAcess']) {
                                        echo "<a href='" . URLADM . "edit-level-access/edit-access/$id' 
                                            class='btn btn-outline-warning btn-sm mr-2'>Editar
                                         </a>";
                                    }
                                    if ($this->dados['buttonAcesso']['deleteAcess']) {
                                        echo "<a href='" . URLADM . "delete-level-access/remove-acess/$id'
                                            class='btn btn-outline-danger btn-sm mr-2'
                                            data-confirm='Tem certeza que deseja apagar nível de acesso ?'>
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
                                            if ($this->dados['buttonAcesso']['ordemLevelAcess']) {
                                                echo "<a href='" . URLADM . "modify-order-access/modify-orderAcc/$id'
                                                         class='dropdown-item'
                                                         title='Alterar Ordem'>
                                                            Subir Ordem
                                                      </a>";
                                            }
                                        }
                                        $qtnLinhaEx++;
                                        if ($this->dados['buttonAcesso']['listPermission']) {
                                            echo "<a href='" . URLADM . "permission/list-permission/1?level=$id'
                                                class='dropdown-item'>Permissões
                                             </a>";
                                        }
                                        if ($this->dados['buttonAcesso']['viewAcess']) {
                                            echo "<a href='" . URLADM . "view-level-access/detail-access/$id'
                                                class='dropdown-item'>Visualizar
                                             </a>";
                                        }
                                        if ($this->dados['buttonAcesso']['editAcess']) {
                                            echo "<a href='" . URLADM . "edit-level-access/edit-access/$id' 
                                                class='dropdown-item'>Editar
                                             </a>";
                                        }
                                        if ($this->dados['buttonAcesso']['deleteAcess']) {
                                            echo "<a href='" . URLADM . "delete-level-access/remove-acess/$id'
                                                class='dropdown-item'
                                                data-confirm='Tem certeza que deseja nível de acesso ?'>
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