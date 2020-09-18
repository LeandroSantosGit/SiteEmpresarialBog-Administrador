<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}
?>

<main role="main">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <?php
            $contMarc = 0;
            foreach ($this->dados['stsCarousels'] as $carousel) {
                echo "<li data-target='#myCarousel' data-slide-to='$contMarc'></li>";
                $contMarc++;
            }
            ?>
        </ol>
        <div class="carousel-inner">
            <?php
            $contSlide = 0;
            foreach ($this->dados['stsCarousels'] as $carousel) {
                extract($carousel);
                ?>
                <div class="carousel-item 
                <?php
                if ($contSlide == 0) {
                    echo 'active';
                }
                ?>">
                    <img class="first-slide img-fluid" 
                         src="<?php echo URL . '/assets/images/carousel/'
                                 . $id . '/' . $imagem; ?>" 
                         alt="<?php echo $titulo; ?>">
                    <div class="container">
                        <div class="carousel-caption <?php echo $posicao_text; ?>">
                            <h1 class="d-none d-md-block"><?php echo $titulo; ?></h1>
                            <p class="d-none d-md-block"><?php echo $descricao; ?></p>
                            <p class="d-none d-md-block">
                                <a class="btn btn-lg btn-<?php echo $cor; ?>"
                                   href="<?php echo $link ?>"
                                   role="button"><?php echo $titulo_botao; ?>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
                <?php
                $contSlide++;
            }
            ?>
        </div>
        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <?php extract($this->dados['stsServicos'][0]); ?>
    <div class="jumbotron servicos">
        <div class="container">
            <h2 class="display-4 text-center servicosh2"><?php echo $titulo; ?></h2>
            <div class="card-deck">
                <div class="card text-center add-shadow animation-left">
                    <div class="icon-row tamanh-icone">
                        <span class="step size-96 link-mouse">
                            <i class="icon <?php echo $icone_um; ?>"></i>
                        </span>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $nome_um; ?></h5>
                        <p class="card-text lead"><?php echo $descricao_um; ?></p>      
                    </div>
                </div>
                <div class="card text-center add-shadow animation-bottom">
                    <div class="icon-row tamanh-icone">
                        <span class="step size-96 link-mouse">
                            <i class="icon <?php echo $icone_dois; ?>"></i>
                        </span>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $nome_dois; ?></h5>
                        <p class="card-text lead"><?php echo $descricao_dois; ?></p>
                    </div>
                </div>
                <div class="card text-center add-shadow animation-right">
                    <div class="icon-row tamanh-icone ">
                        <span class="step size-96 link-mouse">
                            <i class="icon <?php echo $icone_tres; ?>"></i>
                        </span>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $nome_tres; ?></h5>
                        <p class="card-text lead"><?php echo $descricao_tres; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php extract($this->dados['stsVideos'][0]); ?>
    <div class="jumbotron bg-dark text-light video">
        <div class="container">
            <h2 class="display-4 text-center video-titulo servicosh2"><?php echo $titulo; ?></h2>
            <p class="lead text-center animation-right"><?php echo $descricao; ?></p>
            <div class="row justify-content-md-center animation-bottom">
                <div class="col-12 col-md-8">
                    <div class="embed-responsive add-shadow embed-responsive-16by9">
                        <?php echo $video; ?>                       
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="jumbotron blog-home">
        <div class="container">
            <h2 class="display-4 text-center servicosh2">Últimos Artigos</h2>
            <div class="card-deck blog-text">
                <?php
                foreach ($this->dados['stsArtigos'] as $artigo) {
                    extract($artigo);
                    ?>
                    <div class="card add-shadow animation-bottom">
                        <a href="<?php echo URL . 'artigo/' . $slug; ?>">
                            <img class="card-img-top"
                                 src="<?php echo URL . 'assets/images/article/'
                                         . $id . '/' . $imagem; ?>"
                                 alt="<?php echo $titulo; ?>">
                        </a>
                        <div class="card-body">
                            <a href="<?php echo URL . 'artigo/' . $slug; ?>">
                                <h5 class="card-title text-center text-dark link-mouse">
                                        <?php echo $titulo; ?>
                                </h5>
                            </a>
                            <p class="card-text"><?php echo $descricao; ?></p>
                            <p class="text-center">
                                <a href="<?php echo URL . 'artigo/' . $slug; ?>" 
                                   class="btn btn-primary">Mais detalhes
                                </a>
                            </p>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</main>
