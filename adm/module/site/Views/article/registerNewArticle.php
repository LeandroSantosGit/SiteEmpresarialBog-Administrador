<?php
if (isset($this->dados['form'])) {
    $valueForm = $this->dados['form'];
}
if (isset($this->dados['form'][0])) {
    $valueForm = $this->dados['form'][0];
}
?>
<div class="content p-1">
    <div class="list-group-item">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 titulo">Cadastrar Artigo</h2>
            </div>
            <?php
            if ($this->dados['buttonsArticle']['listArticle']) { 
                echo "<div class='p-2'>
                        <a href='" . URLADM . "list-article/list-info-article'
                           class='btn btn-outline-info btn-sm'>
                            Listar
                        </a>
                    </div>";
            }?>
        </div>
        <hr>
        <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>
        <form method="POST" action="" enctype="multipart/form-data">
            <h2 class="display-4 titulo text-center font-weight-bold mb-3">Conteúdo</h2>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label>Titulo<span class="text-danger">*</span></label>
                    <input name="titulo"
                           type="text"
                           class="form-control"
                           placeholder="Informe titulo do artigo"
                           value="<?php if (isset($valueForm['titulo'])) {
                                echo $valueForm['titulo'];
                            } ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label>Prévia do Artigo<span class="text-danger">*</span></label>
                    <textarea name="descricao"
                              id="editorArticlePrevia"
                              rows="3"
                              class="form-control"
                              placeholder="Informe a descrição do artigo com tags HTML"
                              ><?php if (isset($valueForm['descricao'])) {
                                echo $valueForm['descricao'];
                                }
                    ?></textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label>Conteúdo do Artigo<span class="text-danger">*</span></label>
                    <textarea name="conteudo"
                              id="editorArticleConteudo"
                              rows="3"
                              class="form-control"
                              placeholder="Informe o conteudo do artigo com tags HTML"
                              ><?php if (isset($valueForm['conteudo'])) {
                                echo $valueForm['conteudo'];
                                }
                    ?></textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label>Resumo Público<span class="text-danger">*</span></label>
                    <textarea name="resumo_publico"
                              id="editorArticleResumo"
                              rows="3"
                              class="form-control"
                              placeholder="Informe o resumo público do artigo com tags HTML"><?php
                              if (isset($valueForm['resumo_publico'])) {
                                echo $valueForm['resumo_publico'];
                              }
                              ?>
                    </textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>Situação<span class="text-danger">*</span></label>
                    <select name="adms_sit_id" id="adms_sit_id" class="form-control">
                        <option value="">Selecione...</option>
                        <?php
                         foreach ($this->dados['select']['sit'] as $sit) {
                             extract($sit);
                             if ($valueForm['adms_sit_id'] == $idSit) {
                                 echo "<option value='$idSit' selected>$nomeSit</option>";
                             } else {
                                 echo "<option value='$idSit'>$nomeSit</option>";
                             }
                         }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label >Tipo de Artigo<span class="text-danger">*</span></label>
                    <select name="sts_tps_artigo_id" id="sts_tps_artigo_id" class="form-control">
                        <option value="">Selecione...</option>
                        <?php
                         foreach ($this->dados['select']['typeArticle'] as $typeArticle) {
                             extract($typeArticle);
                             if ($valueForm['sts_tps_artigo_id'] == $idTypeArt) {
                                 echo "<option value='$idTypeArt' selected>$nomeTypeArt</option>";
                             } else {
                                 echo "<option value='$idTypeArt'>$nomeTypeArt</option>";
                             }
                         }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label >Categoria do Artigo<span class="text-danger">*</span></label>
                    <select name="sts_cats_artigo_id" id="sts_cats_artigo_id" class="form-control">
                        <option value="">Selecione...</option>
                        <?php
                         foreach ($this->dados['select']['catArticle'] as $catArticle) {
                             extract($catArticle);
                             if ($valueForm['sts_cats_artigo_id'] == $idCatArt) {
                                 echo "<option value='$idCatArt' selected>$nomeCatArt</option>";
                             } else {
                                 echo "<option value='$idCatArt'>$nomeCatArt</option>";
                             }
                         }
                        ?>
                    </select>
                </div>
            </div>
            <?php
            if ($this->dados['buttonsArticle']['editAuthorArticle']) {
                ?>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label >Autor do Artigo<span class="text-danger">*</span></label>
                        <select name="adms_usuario_id" id="adms_usuario_id" class="form-control">
                            <option value="">Selecione...</option>
                            <?php
                            $cont = 1;
                            foreach ($this->dados['select']['user'] as $user) {
                                extract($user);
                                if (isset($valueForm['adms_usuario_id']) && $valueForm['adms_usuario_id'] == $idUser) {
                                    echo "<option value='$idUser' selected>$nomeUser</option>";
                                    $cont = 2;
                                } elseif (($_SESSION['userId'] == $idUser) && ($cont == 1)) {
                                    echo "<option value='$idUser' selected>$nomeUser</option>";
                                } else {
                                    echo "<option value='$idUser'>$nomeUser</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <?php
            } else {
                ?>
                <input name="adms_usuario_id" type="hidden" value="<?php echo $_SESSION['userId']; ?>">
                <?php
            }
            ?>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Foto (150x150)<span class="text-danger">*</span></label>
                    <input name="imageNew"
                           type="file"
                           onchange="previewImage();">
                </div>
                <?php
                    $imgActual = URL . 'site/assets/images/article/preview_img.jpg';
                ?>
                <div class="form-group col-md-6">
                    <img src="<?php echo $imgActual; ?>"
                         class="img-thumbmail"
                         alt="Imagem do artigo"
                         id="previewImgUser"
                         style="width: 300px; height: 150px;">
                </div>
            </div>
                
            <hr>
            <h2 class="display-4 titulo text-center font-weight-bold mb-3">SEO</h2>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Slug<span class="text-danger">*</span></label>
                    <input name="slug"
                           type="text"
                           class="form-control"
                           placeholder="Informe slug do artigo"
                           value="<?php if (isset($valueForm['slug'])) {
                                echo $valueForm['slug'];
                            } ?>">
                </div>
                <div class="form-group col-md-6">
                    <label>Palavra Chave<span class="text-danger">*</span></label>
                    <input name="keywords"
                           type="text"
                           class="form-control"
                           placeholder="Informe palavra chave do artigo"
                           value="<?php if (isset($valueForm['keywords'])) {
                                echo $valueForm['keywords'];
                            } ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Descrição<span class="text-danger">*</span></label>
                    <input name="description"
                           type="text"
                           class="form-control"
                           placeholder="Informe descrição do artigo. Máximo 180 letras"
                           value="<?php if (isset($valueForm['description'])) {
                                echo $valueForm['description'];
                            } ?>">
                </div>
                <div class="form-group col-md-6">
                    <label>Autor do Artigo<span class="text-danger">*</span></label>
                    <input name="author"
                           type="text"
                           class="form-control"
                           placeholder="Informe autor do artigo"
                           value="<?php if (isset($valueForm['author'])) {
                                echo $valueForm['author'];
                            } ?>">
                </div>
            </div>
            <div class="form-row">
                <label >Situação dos Buscadores<span class="text-danger">*</span></label>
                    <select name="sts_robot_id" id="sts_robot_id" class="form-control">
                        <option value="">Selecione...</option>
                        <?php
                         foreach ($this->dados['select']['robot'] as $robot) {
                             extract($robot);
                             if ($valueForm['sts_robot_id'] == $idRobot) {
                                 echo "<option value='$idRobot' selected>$tipoRobot - $nomeRobot</option>";
                             } else {
                                 echo "<option value='$idRobot'>$nomeRobot</option>";
                             }
                         }
                        ?>
                    </select>
            </div>
            <p>
                <span class="text-danger">*</span> Campos Obrigatórios
            </p>
            <input name="registerArticle"
                   type="submit"
                   class="btn btn-success"
                   value="Salvar">
        </form>
    </div>
</div>