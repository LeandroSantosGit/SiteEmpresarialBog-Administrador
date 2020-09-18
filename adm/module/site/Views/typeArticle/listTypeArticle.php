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
                <h2 class="display-4 titulo">Listar Tipo de Artigo</h2>
            </div>
            <?php
            if ($this->dados['buttonsTypeArticle']['cadTypeArticle']) {
                echo "<a href='" . URLADM . "register-new-type-article/register-info-type-article'>
                    <div class='p-2'>
                        <button class='btn btn-outline-success btn-sm'>Cadastrar</button>
                    </div>
                </a>";
            }
            ?>
        </div>
        <?php
        if (empty($this->dados['listTypeArticle'])) {
            ?>
            <div class="alert alert-danger" role="alert">
                Nenhum tipo de artigo encontrado!
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
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($this->dados['listTypeArticle'] as $tpArticle) {
                        extract($tpArticle);
                        ?>
                        <tr>
                            <th><?php echo $id; ?></th>
                            <td><?php echo $nome; ?></td>
                            <td class="text-center">
                                <span class="d-none d-md-block">
                                    <?php
                                    if ($this->dados['buttonsTypeArticle']['viewTypeArticle']) {
                                        echo "<a href='" . URLADM . "view-info-type-article/detail-info-type-article/$id'
                                            class='btn btn-outline-success btn-sm mr-2'>Visualizar
                                         </a>";
                                    }
                                    if ($this->dados['buttonsTypeArticle']['editTypeArticle']) {
                                        echo "<a href='" . URLADM . "edit-type-article/edit-info-type-article/$id' 
                                            class='btn btn-outline-warning btn-sm mr-2'>Editar
                                         </a>";
                                    }
                                    if ($this->dados['buttonsTypeArticle']['deleteTypeArticle']) {
                                        echo "<a href='" . URLADM . "delete-type-article/remove-type-article/$id'
                                            class='btn btn-outline-danger btn-sm mr-2'
                                            data-confirm='Tem certeza que deseja apagar tipo de artigo ?'>
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
                                        if ($this->dados['buttonsTypeArticle']['viewTypeArticle']) {
                                            echo "<a href='" . URLADM 
                                                    . "view-info-type-article/detail-info-type-article/$id'
                                                class='dropdown-item'>Visualizar
                                             </a>";
                                        }
                                        if ($this->dados['buttonsTypeArticle']['editTypeArticle']) {
                                            echo "<a href='" . URLADM . "edit-type-article/edit-info-type-article/$id' 
                                                class='dropdown-item'>Editar
                                             </a>";
                                        }
                                        if ($this->dados['buttonsTypeArticle']['deleteTypeArticle']) {
                                            echo "<a href='" . URLADM . "delete-type-article/remove-type-article/$id'
                                                class='dropdown-item'
                                                data-confirm='Tem certeza que deseja apagar tipo de artigo ?'>
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
