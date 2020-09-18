<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}
if (!empty($this->dados['infoCarousel'][0])) {
    extract($this->dados['infoCarousel'][0]);
?>
<div class="content p-1">
    <div class="list-group-item">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 titulo">Visualizar Carousel</h2>
            </div>
            <div class="p-2">
                <span class="d-none d-md-block">
                    <?php
                    if ($this->dados['buttonsCarousel']['listCarousel']) {
                        echo "<a href='" . URLADM . "list-carousel/list-carousels'
                                class='btn btn-outline-info btn-sm mr-2'>
                                 Listar
                             </a>";
                    }
                    if ($this->dados['buttonsCarousel']['editCarousel']) {
                        echo "<a href='" . URLADM . "edit-carousel/edit-info-carousel/$id'
                                class='btn btn-outline-warning btn-sm mr-2'>
                                 Editar
                             </a>";
                    }
                    if ($this->dados['buttonsCarousel']['deleteCarousel']) {
                        echo "<a href='" . URLADM . "delete-carousel/remove-carousel/$id'
                            class='btn btn-outline-danger btn-sm'
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
                        if ($this->dados['buttonsCarousel']['listCarousel']) {
                            echo "<a href='" . URLADM . "list-carousel/list-carousels'
                                    class='dropdown-item'>
                                     Listar
                                 </a>";
                        }
                        if ($this->dados['buttonsCarousel']['editCarousel']) {
                            echo "<a href='" . URLADM . "edit-carousel/edit-info-carousel/$id'
                                    class='dropdown-item'>
                                     Editar
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
            </div>
        </div>
        <hr>
        <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>
        <dl class="row">
            <dt class='col-sm-3'>Foto </dt>
            <dd class='col-sm-9'>
                <?php
                if (!empty($imagem)) {
                    echo "<img src='" . URL . "site/assets/images/carousel/" 
                    . $id . "/" . $imagem . "'
                    witdh='150' height='150'>";
                }
                ?>
            </dd>
            <dt class='col-sm-3'>Id: </dt>
            <dd class='col-sm-9'><?php echo $id; ?></dd>
            <dt class='col-sm-3'>Nome: </dt>
            <dd class='col-sm-9'><?php echo $nome; ?></dd>
            <dt class='col-sm-3'>Titulo: </dt>
            <dd class='col-sm-9'><?php echo $titulo; ?></dd>
            <dt class='col-sm-3'>Descrição: </dt>
            <dd class='col-sm-9'><?php echo $descricao; ?></dd>
            <dt class='col-sm-3'>Posição do texto:</dt>
            <dd class='col-sm-9'>
                <?php
                if ($posicao_text == 'text-left') {
                    echo "Esquerdo";
                }
                if ($posicao_text == 'text-center') {
                    echo "centralizado";
                }
                if ($posicao_text == 'text-right') {
                    echo "Direito";
                }
                ?>
            </dd>
            <dt class='col-sm-3'>Botão:</dt>
            <dd class='col-sm-9'>
                <?php echo "<a href='$link' class='btn btn-outline-$color btn-sm'>$titulo_botao</a>"; ?>
            </dd>
            <dt class='col-sm-3'>Link:</dt>
            <dd class='col-sm-9'><?php echo $link; ?></dd>
            <dt class='col-sm-3'>Ordem:</dt>
            <dd class='col-sm-9'><?php echo $ordem; ?></dd>
            <dt class='col-sm-3 text-truncate'>Situação:</dt>
            <dd class='col-sm-9'>
                <span class="badge badge-<?php echo $corBtn ?>">
                    <?php echo $nomeSit; ?>
                </span>
            </dd>
            <dt class='col-sm-3 text-truncate'>Data de Cadastro:</dt>
            <dd class='col-sm-9'>
                <?php echo date('d/m/Y H:i', strtotime($created)); ?>
            </dd>
            <?php
            if (!empty($modified)) {
                echo "<dt class='col-sm-3 text-truncate'>Data Alteração de Cadastro:</dt>
                      <dd class='col-sm-9'>"
                        . date('d/m/Y H:i', strtotime($modified)) .
                      "</dd>";
            }
            ?>
        </dl>
    </div>
</div>
<?php
} else {
    $_SESSION['msg'] = "<div class='alert alert-danger'>Slide carousel "
            . "não encontrado.</div>";
    $urlRedirect = URLADM . 'list-carousel/list-carousels';
    header("Location: $urlRedirect");
}