<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}
?>
<main role="main">

    <div class="jumbotron sobre-empresa">
        <div class="container">
            <h2 class="display-4 text-center servicosh2">Sobre Empresa Santos Developer</h2>
            <?php
            $contSobEmpresa = 1;
            foreach ($this->dados['stsSobEmpresa'] as $sobEmpresa) {
                extract($sobEmpresa);
                if ($contSobEmpresa == 1) {
                    ?>
                    <div class="row featurette">
                        <div class="col-md-7 animation-right">
                            <h2 class="featurette-heading"><?php echo $titulo; ?></h2>
                            <p class="lead"><?php echo $descricao; ?></p>
                        </div>
                        <div class="col-md-5 animation-left">
                            <img class="featurette-image add-shadow img-fluid mx-auto"
                                 src="<?php echo URL . '/assets/images/imgsInfoCompany/'
                                        . $id . '/' . $imagem; ?>"
                                 alt="<?php echo $titulo; ?>">
                        </div>
                    </div>
                    <hr class="featurette-divider">
                    <?php
                    $contSobEmpresa = 2;
                } else {
                    ?>
                    <div class="row featurette">
                        <div class="col-md-7 order-md-2 animation-left">
                            <h2 class="featurette-heading"><?php echo $titulo; ?></h2>
                            <p class="lead"><?php echo $descricao; ?></p>
                        </div>
                        <div class="col-md-5 order-md-1 animation-right">
                            <img class="featurette-image add-shadow img-fluid mx-auto"
                                 src="<?php echo URL . '/assets/images/imgsInfoCompany/'
                                        . $id . '/' . $imagem; ?>"
                                 alt="<?php echo $titulo; ?>">
                        </div>
                    </div>
                    <hr class="featurette-divider">
                    <?php
                    $contSobEmpresa = 1;
                }
            }
            ?>
        </div>
    </div>
    
</main>
