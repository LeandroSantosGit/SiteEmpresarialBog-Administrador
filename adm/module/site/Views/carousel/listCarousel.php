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
                <h2 class="display-4 titulo">Listar Carousel</h2>
            </div>
            <?php
            if ($this->dados['buttonsCarousel']['cadCarousel']) {
                echo "<a href='" . URLADM . "register-new-carousel/register-info-carousel'>
                    <div class='p-2'>
                        <button class='btn btn-outline-success btn-sm'>Cadastrar</button>
                    </div>
                </a>";
            }
            ?>
        </div>
        <?php
        if (empty($this->dados['listCarousel'])) {
            ?>
            <div class="alert alert-danger" role="alert">
                Nenhum slide de carousel encontrado!
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
                        <th class="d-none d-sm-table-cell">Imagem</th>
                        <th>Ordem</th>
                        <th class="d-none d-lg-table-cell text-center">Situação</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $qtnLinhaEx = 1;
                    foreach ($this->dados['listCarousel'] as $carousel) {
                        extract($carousel);
                        ?>
                        <tr>
                            <th><?php echo $id; ?></th>
                            <td><?php echo $nome; ?></td>
                            <td class="d-none d-sm-table-cell">
                                <?php echo "<img src='" . URL . "site/assets/images/carousel/$id/$imagem'"
                                            . "width='150' height='60'>"; ?>
                            </td>
                            <td><?php echo $ordem; ?></td>
                            <td class="d-none d-lg-table-cell text-center">
                                <?php
                                if ($this->dados['buttonsCarousel']['alterSitCarousel']) {
                                    echo "<a href='" 
                                            . URLADM . "modify-situation-carousel/alter-situation-carousel/$id'>"
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
                                        if ($this->dados['buttonsCarousel']['alterOrderCarousel']) {
                                            echo "<button class='btn btn-outline-secondary btn-sm mr-2 disabled'
                                                          title='Não permitido alterar ordem de slide do carousel'>
                                                     <i class='fas fa-angle-double-up'></i>
                                                  </button>";
                                        }
                                    } else {
                                        if ($this->dados['buttonsCarousel']['alterOrderCarousel']) {
                                            echo "<a href='" . URLADM 
                                                             . "modify-order-carousel/alter-order-carousel/$id'
                                                     class='btn btn-outline-secondary btn-sm mr-2'
                                                     title='Alterar ordem de slide do carousel'>
                                                        <i class='fas fa-angle-double-up'></i>
                                                  </a>";
                                        }
                                    }
                                    $qtnLinhaEx++;
                                    if ($this->dados['buttonsCarousel']['viewCarousel']) {
                                        echo "<a href='" . URLADM . "view-info-carousel/detail-info-carousel/$id'
                                            class='btn btn-outline-success btn-sm mr-2'>Visualizar
                                         </a>";
                                    }
                                    if ($this->dados['buttonsCarousel']['editCarousel']) {
                                        echo "<a href='" . URLADM . "edit-carousel/edit-info-carousel/$id' 
                                            class='btn btn-outline-warning btn-sm mr-2'>Editar
                                         </a>";
                                    }
                                    if ($this->dados['buttonsCarousel']['deleteCarousel']) {
                                        echo "<a href='" . URLADM . "delete-carousel/remove-carousel/$id'
                                            class='btn btn-outline-danger btn-sm mr-2'
                                            data-confirm='Tem certeza que deseja apagar carousel ?'>
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
                                            if ($this->dados['buttonsCarousel']['alterOrderCarousel']) {
                                                echo "<a href='" . URLADM 
                                                                 . "modify-order-carousel/alter-order-carousel/$id'
                                                         class='dropdown-item'
                                                         title='Alterar Ordem'>
                                                            Subir Ordem
                                                      </a>";
                                            }
                                        }
                                        $qtnLinhaEx++;
                                        if ($this->dados['buttonsCarousel']['viewCarousel']) {
                                            echo "<a href='" . URLADM . "view-info-carousel/detail-info-carousel/$id'
                                                class='dropdown-item'>Visualizar
                                             </a>";
                                        }
                                        if ($this->dados['buttonsCarousel']['editCarousel']) {
                                            echo "<a href='" . URLADM . "edit-carousel/edit-info-carousel/$id' 
                                                class='dropdown-item'>Editar
                                             </a>";
                                        }
                                        if ($this->dados['buttonsCarousel']['deleteCarousel']) {
                                            echo "<a href='" . URLADM . "delete-carousel/remove-carousel/$id'
                                                class='dropdown-item'
                                                data-confirm='Tem certeza que deseja apagar carousel ?'>
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
