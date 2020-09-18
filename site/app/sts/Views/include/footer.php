<footer class="footer">
    <div class="container text-muted">
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                <h4 class="text-white">Santos Developer</h4>
                <ul class="list-unstyled">
                    <?php
                    foreach ($this->dados['menu'] as $menu) {
                        extract($menu);
                        ?>
                        <li class="menu-footer">
                            <a class="text-muted font-weight-bold link-mouse"
                               href="<?php echo URL . $endereco; ?>">
                                   <?php echo $nome_pagina; ?>
                            </a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
            <?php extract($this->dados['stsFooter'][0]); ?>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                <h4 class="text-white">Contato</h4>
                <div class="company-contact">
                    <ul class="list-unstyled">
                        <li>
                            <i class="fas fa-envelope"></i>
                            <a class="text-muted link-mouse" href="mailto:">
                                <?php echo $email ?>
                            </a>
                        </li>
                        <li>
                            <i class="fa fa-phone"></i><a><?php echo $telefone1 ?></a><br>
                            <i class="fa fa-phone"></i><a><?php echo $telefone2 ?></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                <h4 class="text-white">Rede Sociais</h4>
                <div class="company-social">
                    <ul class="list-unstyled">
                        <li>
                            <span class="step size-48">
                                <a href="<?php echo $facebook_url; ?>" class="link-mouse text-muted" target="_blank">
                                    <i class="icon ion-social-facebook"></i>
                                </a>
                            </span>
                        </li>
                        <li>
                            <span class="step size-48">
                                <a href="<?php echo $twitter_url; ?>" class="link-mouse text-muted" target="_blank">
                                    <i class="icon icon ion-social-twitter"></i>
                                </a>
                            </span>
                        </li>
                        <li>
                            <span class="step size-48">
                                <a href="<?php echo $instagram_url; ?>" class="link-mouse text-muted" target="_blank">
                                    <i class="icon ion-social-instagram"></i>
                                </a>
                            </span>
                        </li>
                        <li>
                            <span class="step size-48">
                                <a href="<?php echo $whatsapp_url; ?>" class="link-mouse text-muted" target="_blank">
                                    <i class="icon ion-social-whatsapp"></i>
                                </a>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                <h4 class="text-white">Endereço</h4>
                <ul class="list-unstyled">
                    <li>
                        <i class="fas fa-map-marker-alt"></i>
                        <strong><?php echo $nome_empresa ?></strong><br>
                        <span><?php echo $rua ?></span>, <span><?php echo $numero ?></span><br>
                        <span><?php echo $bairro ?></span>, <span><?php echo $cep ?></span><br>
                        <span><?php echo $cidade ?></span> - <span><?php echo $uf ?></span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-xl-12 col-lg-12 sub-footer">
        <p class="company-copyright text-white"><?php echo $copyright ?></p>
    </div
</footer>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="<?php echo URL; ?>assets/js/scrollreveal.js"></script>
<script src="<?php echo URL; ?>assets/js/animationHome.js"></script>
</body>
</html>
