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
                <h2 class="display-4 titulo">Listar Sobre Empresa</h2>
            </div>
            <?php
            if ($this->dados['buttonsSobCompany']['cadSobCompany']) {
                echo "<a href='" . URLADM . "register-new-sob-company/register-info-sob-company'>
                    <div class='p-2'>
                        <button class='btn btn-outline-success btn-sm'>Cadastrar</button>
                    </div>
                </a>";
            }
            ?>
        </div>
        <?php
        if (empty($this->dados['listSobCompany'])) {
            ?>
            <div class="alert alert-danger" role="alert">
                Nenhum sobre empresa encontrado!
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
                        <th class="d-none d-sm-table-cell">Imagem</th>
                        <th>Ordem</th>
                        <th class="d-none d-lg-table-cell text-center">Situação</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $qtnLinhaEx = 1;
                    foreach ($this->dados['listSobCompany'] as $sobCompany) {
                        extract($sobCompany);
                        ?>
                        <tr>
                            <th><?php echo $id; ?></th>
                            <td><?php echo $titulo; ?></td>
                            <td class="d-none d-sm-table-cell">
                                <?php echo "<img src='"
                                    . URL
                                    . "site/assets/images/imgsInfoCompany/$id/$imagem'"
                                    . "width='150' height='60'>"; ?>
                            </td>
                            <td><?php echo $ordem; ?></td>
                            <td class="d-none d-lg-table-cell text-center">
                                <?php
                                if ($this->dados['buttonsSobCompany']['alterSitSobCompany']) {
                                    echo "<a href='"
                                        . URLADM
                                        . "modify-situation-sob-company/alter-situation-sob-company/$id'>"
                                            . "<span class='badge badge-pill badge-$color'>$nomeSit</span>"
                                        . "</a>";
                                } else {
                                    echo "<span class='badge badge-pill badge-$color'>$nomeSit</span>";
                                }
                                ?>
                            </td>
                            <td class="text-center">
                                <span class="d-none d-md-block">
                                    <?php
                                    if ($qtnLinhaEx <= 1) {
                                        if ($this->dados['buttonsSobCompany']['alterOrderSobCompany']) {
                                            echo "<button class='btn btn-outline-secondary btn-sm mr-2 disabled'
                                                          title='Não permitido alterar ordem de slide do carousel'>
                                                     <i class='fas fa-angle-double-up'></i>
                                                  </button>";
                                        }
                                    } else {
                                        if ($this->dados['buttonsSobCompany']['alterOrderSobCompany']) {
                                            echo "<a href='" . URLADM 
                                                             . "modify-order-sob-company/alter-order-sob-company/$id'
                                                     class='btn btn-outline-secondary btn-sm mr-2'
                                                     title='Alterar ordem de slide do carousel'>
                                                        <i class='fas fa-angle-double-up'></i>
                                                  </a>";
                                        }
                                    }
                                    if ($this->dados['buttonsSobCompany']['viewSobCompany']) {
                                        echo "<a href='" . URLADM . "view-info-sob-company/detail-info-sob-company/$id'
                                            class='btn btn-outline-success btn-sm mr-2'>Visualizar
                                         </a>";
                                    }
                                    if ($this->dados['buttonsSobCompany']['editSobCompany']) {
                                        echo "<a href='" . URLADM . "edit-sob-company/edit-info-sob-company/$id' 
                                            class='btn btn-outline-warning btn-sm mr-2'>Editar
                                         </a>";
                                    }
                                    if ($this->dados['buttonsSobCompany']['deleteSobCompany']) {
                                        echo "<a href='" . URLADM . "delete-sob-company/remove-sob-company/$id'
                                            class='btn btn-outline-danger btn-sm mr-2'
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
                                        if ($qtnLinhaEx != 2) {
                                            if ($this->dados['buttonsSobCompany']['alterOrderSobCompany']) {
                                                echo "<a href='" . URLADM 
                                                                 . "modify-order-sob-company/alter-order-sob-company/$id'
                                                         class='dropdown-item'
                                                         title='Alterar Ordem'>
                                                            Subir Ordem
                                                      </a>";
                                            }
                                        }
                                        $qtnLinhaEx++;
                                        if ($this->dados['buttonsSobCompany']['viewSobCompany']) {
                                            echo "<a href='" . URLADM 
                                                    . "view-info-sob-company/detail-info-sob-company/$id'
                                                class='dropdown-item'>Visualizar
                                             </a>";
                                        }
                                        if ($this->dados['buttonsSobCompany']['editSobCompany']) {
                                            echo "<a href='" . URLADM . "edit-sob-company/edit-info-sob-company/$id' 
                                                class='dropdown-item'>Editar
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
</div>