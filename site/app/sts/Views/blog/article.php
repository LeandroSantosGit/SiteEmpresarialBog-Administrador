<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}
?>
<main role="main">

    <div class="jumbotron blog">
        <div class="container">
            <h2 class="display-4 text-center servicosh2"></h2>
            <div class="row">
                <div class="col-md-8 blog-main">
                    <?php
                    if (!empty($this->dados['visualizarArtigo'][0])) {
                        extract($this->dados['visualizarArtigo'][0]);
                        ?>
                        <div class="blog-post">
                            <h2 class="blog-post-title"><?php echo $titulo; ?></h2>
                            <img src="<?php echo URL . 'assets/images/article/'
                                    . $id . '/' . $imagem; ?>"
                                 class="img-fluid artimg add-shadow"
                                 alt="<?php echo $titulo; ?>">
                            <?php echo $conteudo; ?>
                        </div>
                        <nav class="blog-pagination">
                            <?php
                            if (!empty($this->dados['artigoAnterior'][0])) {
                                extract($this->dados['artigoAnterior'][0]);
                                echo "<a class='btn btn-outline-primary' href='" . URL . "artigo/$slug'>Anterior</a>";
                            } else {
                                echo "<a class='btn btn-outline-secondary disabled' href='#'>Anterior</a>";
                            }
                            if (!empty($this->dados['artigoProximo'][0])) {
                                extract($this->dados['artigoProximo'][0]);
                                echo "<a class='btn btn-outline-primary' href='" . URL . "artigo/$slug'>Próximo</a>";
                            } else {
                                echo "<a class='btn btn-outline-secondary disabled' href='#'>Próximo</a>";
                            }
                            ?>
                        </nav>
                        <?php
                    } else {
                        echo "<div class='alert alert-danger'>Artigo não encontrado!</div>";
                    }
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
                <div class="col-md-8 blog-main">
                    <span id="msg_comentario"></span>
                    <?php
                    if (isset($_SESSION['msg'])) {
                        echo $_SESSION['msg'];
                        unset($_SESSION['msg']);
                    }
                    if (!empty($this->dados['visualizarArtigo'][0])) {
                    ?>
                        <h3>Comentários</h3>
                        <form method="POST" action="<?php echo URL; ?>comentarios-artigo/index">
                            <input type="hidden"
                                   name="sts_artigo_id"
                                   value="<?php echo $this->dados['visualizarArtigo'][0]['id']; ?>">
                            <input type="hidden"
                                   name="slug"
                                   value="<?php echo $this->dados['visualizarArtigo'][0]['slug']; ?>">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Nome
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-10">
                                    <input type="text"
                                           name="nome"
                                           class="form-control"
                                           id="nome"
                                           placeholder="Informe seu nome"
                                           value="<?php if (isset($_SESSION['form']['nome'])) {
                                                    echo $_SESSION['form']['nome'];
                                                  }?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Apelido
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-10">
                                    <input type="text"
                                           name="apelido"
                                           class="form-control"
                                           id="apelido"
                                           placeholder="Informe seu apelido"
                                           value="<?php if (isset($_SESSION['form']['apelido'])) {
                                                    echo $_SESSION['form']['apelido'];
                                                  }?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Email
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-10">
                                    <input type="email"
                                           name="email"
                                           class="form-control"
                                           id="email"
                                           placeholder="Informe seu email"
                                           value="<?php if (isset($_SESSION['form']['email'])) {
                                                    echo $_SESSION['form']['email'];
                                                  }?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Conteúdo
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-10">
                                    <textarea class="form-control"
                                              name="conteudo"
                                              id="conteudo"
                                              rows="3"
                                              placeholder="Digite seu comentário"
                                              ><?php 
                                              if (isset($_SESSION['form']['conteudo'])) {
                                                echo $_SESSION['form']['conteudo'];
                                              }
                                    ?></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <p>
                                    <span class="text-danger">* Campos Obrigatórios</span>
                                </p>
                            </div>
                            <div class="form-group row">
                                <input name="registerNewCommentaryUser"
                                       type="submit"
                                       class="btn btn-success"
                                       value="Enviar">
                            </div>
                        </form>
                        <hr>
                    <?php
                    }
                    if (!empty($this->dados['artigoComentarios']['0'])) {
                        foreach ($this->dados['artigoComentarios'] as $comentario) {
                            extract($comentario);
                            echo "<div class='media'>";
                            if (!empty($imageUser)) {
                                echo "<img class='mr-3' "
                                        . "src='" . URLADM  . "../../adm/assets/image/user/$idUser/$imageUser'"
                                        . "alt='$apelidoUser'"
                                        . "width='50' height='50'>";
                            } else {
                                echo "<img class='mr-3' "
                                        . "src='" . URLADM . "../../adm/assets/image/user/icone_usuario.png'"
                                        . "alt='$apelidoUser'"
                                        . "width='50' height='50'>";
                            }
                            echo "<div class='media-body'>
                                    <h6 class='mt-0'>" . $apelidoUser . "</h6>
                                    $conteudo
                                </div>
                                <label>" . date('d/m/Y H:i', strtotime($created)) . "</label>
                            </div><br>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

</main>
