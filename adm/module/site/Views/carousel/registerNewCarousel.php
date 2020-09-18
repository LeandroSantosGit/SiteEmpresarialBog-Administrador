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
                <h2 class="display-4 titulo">Cadastrar Carousel</h2>
            </div>
            <?php
            if ($this->dados['buttonsCarousel']['listCarousel']) { 
                echo "<div class='p-2'>
                        <a href='" . URLADM . "list-carousel/list-carousels'
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
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Nome<span class="text-danger">*</span></label>
                    <input name="nome"
                           type="text"
                           class="form-control"
                           placeholder="Informe nome do slide"
                           value="<?php if (isset($valueForm['nome'])) {
                                echo $valueForm['nome'];
                            } ?>">
                </div>
                <div class="form-group col-md-6">
                    <label>Titulo<span class="text-danger">*</span></label>
                    <input name="titulo"
                           type="text"
                           class="form-control"
                           placeholder="Informe o titulo do slide"
                           value="<?php if (isset($valueForm['titulo'])) {
                                echo $valueForm['titulo'];
                            } ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-8">
                    <label>Descrição<span class="text-danger">*</span></label>
                    <input name="descricao"
                           type="text"
                           class="form-control"
                           placeholder="Informe a descrição ao menu"
                           value="<?php if (isset($valueForm['descricao'])) {
                                echo $valueForm['descricao'];
                            } ?>">
                </div>
                <div class="form-group col-md-4">
                    <label >Posição do texto<span class="text-danger">*</span></label>
                    <select name="posicao_text" id="posicao_text" class="form-control">
                        <?php
                        if ($valueForm['posicao_text'] == "text-left") {
                            echo "<option value=''>Selecione...</option>";
                            echo "<option value='text-left' selected>Esquerdo</option>";
                            echo "<option value='text-center'>Center</option>";
                            echo "<option value='text-right'>Direito</option>";
                        } elseif ($valueForm['posicao_text'] == "text-center"){
                            echo "<option value=''>Selecione...</option>";
                            echo "<option value='text-left'>Esquerdo</option>";
                            echo "<option value='text-center' selected>Center</option>";
                            echo "<option value='text-right'>Direito</option>";
                        } elseif ($valueForm['posicao_text'] == "text-right"){
                            echo "<option value=''>Selecione...</option>";
                            echo "<option value='text-left'>Esquerdo</option>";
                            echo "<option value='text-center'>Center</option>";
                            echo "<option value='text-right' selected>Direito</option>";
                        } else {
                            echo "<option value='' selected>Selecione...</option>";
                            echo "<option value='text-left'>Esquerdo</option>";
                            echo "<option value='text-center'>Center</option>";
                            echo "<option value='text-right'>Direito</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Titulo do Botão<span class="text-danger">*</span></label>
                    <input name="titulo_botao"
                           type="text"
                           class="form-control"
                           placeholder="Informe o titulo do botão"
                           value="<?php if (isset($valueForm['titulo_botao'])) {
                                echo $valueForm['titulo_botao'];
                            } ?>">
                </div>
                <div class="form-group col-md-6">
                    <label>Link<span class="text-danger">*</span></label>
                    <input name="link"
                           type="text"
                           class="form-control"
                           placeholder="Informe o link do botão"
                           value="<?php if (isset($valueForm['link'])) {
                                echo $valueForm['link'];
                            } ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label >Cor do Botão<span class="text-danger">*</span></label>
                    <select name="adms_cor_id" id="adms_cor_id" class="form-control">
                        <option value="">Selecione...</option>
                        <?php
                         foreach ($this->dados['select']['color'] as $color) {
                             extract($color);
                             if ($valueForm['adms_cor_id'] == $idColor) {
                                 echo "<option value='$idColor' selected>$nomeColor</option>";
                             } else {
                                 echo "<option value='$idColor'>$nomeColor</option>";
                             }
                         }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label>Situação<span class="text-danger">*</span></label>
                    <select name="adms_situacoes_id" id="adms_situacoes_id" class="form-control">
                        <option value="">Selecione...</option>
                        <?php
                         foreach ($this->dados['select']['sit'] as $sit) {
                             extract($sit);
                             if ($valueForm['adms_situacoes_id'] == $idSit) {
                                 echo "<option value='$idSit' selected>$nomeSit</option>";
                             } else {
                                 echo "<option value='$idSit'>$nomeSit</option>";
                             }
                         }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Foto (1920x846)<span class="text-danger">*</span></label>
                    <input name="imageNew"
                           type="file"
                           onchange="previewImage();">
                </div>
                <?php
                    $imgActual = URL . 'site/assets/images/carousel/preview_img.jpg';
                ?>
                <div class="form-group col-md-6">
                    <img src="<?php echo $imgActual; ?>"
                         class="img-thumbmail"
                         alt="Imagem do slide carousel"
                         id="previewImgUser"
                         style="width: 300px; height: 150px;">
                </div>
            </div>
            <p>
                <span class="text-danger">*</span> Campos Obrigatórios
            </p>
            <input name="registerCarousel"
                   type="submit"
                   class="btn btn-success"
                   value="Salvar">
        </form>
    </div>
</div>