<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}
?>
<main role="main">

    <div class="jumbotron blog">
        <div class="container">
            <h2 class="display-4 text-center servicosh2">Blog</h2>
            <div class="row">
                <div class="col-md-8 blog-main">
                    <?php
                    if (empty($this->dados['artigos'])) {
                        echo "<div class='alert alert-danger'>Nenhum artigo encontrado!</div>";
                    }
                    foreach ($this->dados['artigos'] as $artigoView) {
                        extract($artigoView);
                        ?>
                        <div class="row add-shadow">
                            <div class="col-md-7 order-md-2 animation-right">
                                <div class="blog-text">
                                    <a href="<?php echo URL . 'artigo/' . $slug ; ?>">
                                        <h2 class="featurette-heading text-dark link-mouse">
                                            <?php echo $titulo; ?>
                                        </h2>
                                    </a>
                                </div>
                                <p class="lead"><?php echo $descricao; ?>
                                    <a href="<?php echo URL . 'artigo/' . $slug ; ?>"
                                       class="font-italic">
                                        Continue lendo
                                    </a>
                                </p>
                            </div>
                            <div class="col-md-5 order-md-1 animation-left img-car-blog">
                                <a href="<?php echo URL . 'artigo/' . $slug ; ?>">
                                    <img class="featurette-image img-fluid mx-auto"
                                         src="<?php echo URL . 'assets/images/article/'
                                                 . $id . '/' . $imagem; ?>"
                                         alt="<?php echo $titulo; ?>">
                                </a>
                            </div>
                        </div>
                        <hr class="featurette-divider">
                        <?php
                    }
                    echo $this->dados['paginacao'];
                    ?>
                </div>

                <aside class="col-md-4 blog-sidebar">
                <?php if (!empty($this->dados['informacaoAutor'][0])) { ?>
                    <div class="p-3 mb-3 bg-light rounded">
                        <?php extract($this->dados['informacaoAutor'][0]); ?>
                        <h4 class="font-italic"><?php echo $titulo; ?></h4>
                        <img src="<?php echo URL . 'assets/images/infoAuthor/'
                                . $id . '/' . $imagem; ?>" 
                             class="img-fluid add-shadow" 
                             alt="<?php echo $titulo; ?>">
                        <p class="mb-0"><?php echo $descricao; ?></p>
                    </div>
                <?php } ?>

                    <div class="p-3">
                        <h4 class="font-italic">Recentes</h4>
                        <ol class="list-unstyled mb-0">
                            <?php
                            foreach ($this->dados['artigosRecentes'] as $artigoRec) {
                                extract($artigoRec);
                                ?>
                                <li>
                                    <a class="text-muted link-mouse"
                                       href="<?php echo URL . 'artigo/' . $slug ?>"><?php echo $titulo ?></a>
                                </li>
                                <?php
                            }
                            ?>
                        </ol>
                    </div>

                    <div class="p-3">
                        <h4 class="font-italic">Destaques</h4>
                        <ol class="list-unstyled">
                            <?php
                            foreach ($this->dados['artigosDestaque'] as $artigoDestaque) {
                                extract($artigoDestaque);
                                ?>
                                <li>
                                    <a class="text-muted link-mouse"
                                       href="<?php echo URL . 'artigo/' . $slug ?>"><?php echo $titulo ?></a>
                                </li>
                                <?php
                            }
                            ?>
                        </ol>
                    </div>
                </aside>
            </div>
        </div>
    </div>			

</main>
