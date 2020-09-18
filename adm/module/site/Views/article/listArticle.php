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
                <h2 class="display-4 titulo">Listar Artigo</h2>
            </div>
            <?php
            if ($this->dados['buttonsArticle']['cadArticle']) {
                echo "<a href='" . URLADM . "register-new-article/register-info-article'>
                    <div class='p-2'>
                        <button class='btn btn-outline-success btn-sm'>Cadastrar</button>
                    </div>
                </a>";
            }
            ?>
        </div>
        <?php
        if (empty($this->dados['listArticle'])) {
            ?>
            <div class="alert alert-danger" role="alert">
                Nenhum artigo encontrado!
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
                        <th class="d-none d-sm-table-cell text-center">Categoria</th>
                        <th class="d-none d-sm-table-cell text-center">Situação</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($this->dados['listArticle'] as $article) {
                        extract($article);
                        ?>
                        <tr>
                            <th><?php echo $id; ?></th>
                            <td><?php echo $titulo; ?></td>
                            <td class="d-none d-sm-table-cell text-center">
                                <?php echo $nomeCat; ?>
                            </td>
                            <td class="d-none d-sm-table-cell text-center">
                                <?php
                                if ($this->dados['buttonsArticle']['alterSitArticle']) {
                                    echo "<a href='" 
                                        . URLADM 
                                        . "modify-sit-article/alter-sit-article/$id'>
                                            <span class='badge badge-pill badge-$color'>$nomeSit</span>
                                          </a>";
                                } else {
                                    echo "<span class='badge badge-pill badge-$color'>$nomeSit</span>";
                                }
                                ?>
                            </td>
                            <td class="text-center">
                                <span class="d-none d-md-block">
                                    <?php
                                    if ($this->dados['buttonsArticle']['viewArticle']) {
                                        echo "<a href='" . URLADM . "view-info-article/detail-info-article/$id'
                                            class='btn btn-outline-success btn-sm mr-2'>Visualizar
                                         </a>";
                                    }
                                    if ($this->dados['buttonsArticle']['editArticle']) {
                                        echo "<a href='" . URLADM . "edit-article/edit-info-article/$id' 
                                            class='btn btn-outline-warning btn-sm mr-2'>Editar
                                         </a>";
                                    }
                                    if ($this->dados['buttonsArticle']['deleteArticle']) {
                                        echo "<a href='" . URLADM . "delete-article/remove-article/$id'
                                            class='btn btn-outline-danger btn-sm mr-2'
                                            data-confirm='Tem certeza que deseja apagar artigo ?'>
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
                                        if ($this->dados['buttonsArticle']['viewArticle']) {
                                            echo "<a href='" . URLADM . "view-info-article/detail-info-article/$id'
                                                class='dropdown-item'>Visualizar
                                             </a>";
                                        }
                                        if ($this->dados['buttonsArticle']['editArticle']) {
                                            echo "<a href='" . URLADM . "edit-article/edit-info-article/$id' 
                                                class='dropdown-item'>Editar
                                             </a>";
                                        }
                                        if ($this->dados['buttonsArticle']['deleteArticle']) {
                                            echo "<a href='" . URLADM . "delete-article/remove-article/$id'
                                                class='dropdown-item'
                                                data-confirm='Tem certeza que deseja apagar artigo ?'>
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
