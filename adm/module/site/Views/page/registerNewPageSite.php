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
                <h2 class="display-4 titulo">Cadastrar Página</h2>
            </div>
            <?php
            if ($this->dados['buttonsPage']['listPage']) { 
                echo "<div class='p-2'>
                        <a href='" . URLADM 
                        . "list-page-site/list-info-page-site'
                           class='btn btn-outline-info btn-sm'>
                            Visualizar
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
                <div class="form-group col-md-4">
                    <label>Classe<span class="text-danger">*</span></label>
                    <input name="controller"
                           type="text"
                           class="form-control"
                           placeholder="Informe nome da classe"
                           value="<?php if (isset($valueForm['controller'])) {
                                echo $valueForm['controller'];
                            } ?>">
                </div>
                <div class="form-group col-md-4">
                    <label>Endereço<span class="text-danger">*</span></label>
                    <input name="endereco"
                           type="text"
                           class="form-control"
                           placeholder="Informe nome da classe minuscula e sem espaço"
                           value="<?php if (isset($valueForm['endereco'])) {
                                echo $valueForm['endereco'];
                            } ?>">
                </div>
                <div class="form-group col-md-4">
                    <label>Nome da Classe<span class="text-danger">*</span></label>
                    <input name="nome_pagina"
                           type="text"
                           class="form-control"
                           placeholder="Informe nome da Página a ser apresentado no menu"
                           value="<?php if (isset($valueForm['nome_pagina'])) {
                                echo $valueForm['nome_pagina'];
                            } ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label>Observação<span class="text-danger">*</span></label>
                    <textarea name="obs" class="form-control" rows="3"><?php
                        if (isset($valueForm['obs'])) {
                            echo $valueForm['obs'];
                        }
                    ?></textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>Titulo<span class="text-danger">*</span></label>
                    <input name="titulo"
                           type="text"
                           class="form-control"
                           placeholder="Informe titulo para os buscadores"
                           value="<?php if (isset($valueForm['titulo'])) {
                                echo $valueForm['titulo'];
                            } ?>">
                </div>
                <div class="form-group col-md-4">
                    <label>Palavra Chave<span class="text-danger">*</span></label>
                    <input name="keywords"
                           type="text"
                           class="form-control"
                           placeholder="Informe palavra chave da página"
                           value="<?php if (isset($valueForm['keywords'])) {
                                echo $valueForm['keywords'];
                            } ?>">
                </div>
                <div class="form-group col-md-4">
                    <label>Descrição<span class="text-danger">*</span></label>
                    <input name="description"
                           type="text"
                           class="form-control"
                           placeholder="Informe descrição para os buscadores"
                           value="<?php if (isset($valueForm['description'])) {
                                echo $valueForm['description'];
                            } ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>Empresa<span class="text-danger">*</span></label>
                    <input name="author"
                           type="text"
                           class="form-control"
                           placeholder="Informe nome empresa para os buscadores"
                           value="<?php if (isset($valueForm['author'])) {
                                echo $valueForm['author'];
                            } ?>">
                </div>
                <div class="form-group col-md-4">
                    <label >Liberado no Menu<span class="text-danger">*</span></label>
                    <select name="lib_bloqueado" id="lib_bloqueado" class="form-control">
                        <?php
                        if ($valueForm['lib_bloqueado'] == 1) {
                            echo "<option value=''>Selecione...</option>";
                            echo "<option value='1' selected>Sim</option>";
                            echo "<option value='2'>Não</option>";
                        } elseif ($valueForm['lib_bloqueado'] == 2){
                            echo "<option value=''>Selecione...</option>";
                            echo "<option value='1'>Sim</option>";
                            echo "<option value='2' selected>Não</option>";
                        } else {
                            echo "<option value='' selected>Selecione...</option>";
                            echo "<option value='1'>Sim</option>";
                            echo "<option value='2'>Não</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label >Buscadores<span class="text-danger">*</span></label>
                    <select name="sts_robot_id" id="sts_robot_id" class="form-control">
                        <option value="">Selecione...</option>
                        <?php
                         foreach ($this->dados['select']['robot'] as $robot) {
                             extract($robot);
                             if ($valueForm['sts_robot_id'] == $idRobot) {
                                 echo "<option value='$idRobot' selected>$nomeRobot</option>";
                             } else {
                                 echo "<option value='$idRobot'>$nomeRobot</option>";
                             }
                         }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label >Tipo de Página<span class="text-danger">*</span></label>
                    <select name="sts_tipos_pagina_id" id="sts_tipos_pagina_id" class="form-control">
                        <option value="">Selecione...</option>
                        <?php
                         foreach ($this->dados['select']['tipoPg'] as $tipoPg) {
                             extract($tipoPg);
                             if ($valueForm['sts_tipos_pagina_id'] == $idTpPg) {
                                 echo "<option value='$idTpPg' selected>$tipoTpPg - $nomeTpPg</option>";
                             } else {
                                 echo "<option value='$idTpPg'>$tipoTpPg - $nomeTpPg</option>";
                             }
                         }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label>Situação da Página<span class="text-danger">*</span></label>
                    <select name="sts_situacao_pagina_id" id="sts_situacao_pagina_id" class="form-control">
                        <option value="">Selecione...</option>
                        <?php
                         foreach ($this->dados['select']['sitPg'] as $sitPg) {
                             extract($sitPg);
                             if ($valueForm['sts_situacao_pagina_id'] == $idSitPg) {
                                 echo "<option value='$idSitPg' selected>$nomeSitPg</option>";
                             } else {
                                 echo "<option value='$idSitPg'>$nomeSitPg</option>";
                             }
                         }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Foto (1200x627)<span class="text-danger">*</span></label>
                    <input name="imageNew"
                           type="file"
                           onchange="previewImage();">
                </div>
                <?php
                    $imgActual = URL . 'site/assets/images/page/preview_img.jpg';
                ?>
                <div class="form-group col-md-6">
                    <img src="<?php echo $imgActual; ?>"
                         class="img-thumbmail"
                         alt="Imagem da página do site"
                         id="previewImgUser"
                         style="width: 300px; height: 150px;">
                </div>
            </div>
            <p>
                <span class="text-danger">*</span> Campos Obrigatórios
            </p>
            <input name="registerNewPageSite"
                   type="submit"
                   class="btn btn-success"
                   value="Salvar">
        </form>
    </div>
</div>