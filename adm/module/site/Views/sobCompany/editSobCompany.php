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
                <h2 class="display-4 titulo">Editar Sobre Empresa</h2>
            </div>
            <div class="p-2">
                <?php
                $valorFormulario = $valueForm['id'];
                if ($this->dados['buttonsSobCompany']['viewSobCompany']) {
                    echo "<a href='" 
                        . URLADM 
                        . "view-info-sob-company/detail-info-sob-company/$valorFormulario'
                             class='btn btn-outline-primary btn-sm'>
                            Listar
                          </a>";
                }?>
            </div>
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
                    <input name="id"
                           type="hidden"
                           value="<?php if (isset($valueForm['id'])) {
                                echo $valueForm['id'];
                            } ?>">
                    <label>Titulo<span class="text-danger">*</span></label>
                    <input name="titulo"
                           type="text"
                           class="form-control"
                           placeholder="Informe titulo so sobre empresa"
                           value="<?php if (isset($valueForm['titulo'])) {
                                echo $valueForm['titulo'];
                            } ?>">
                </div>
                <div class="form-group col-md-6">
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
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label>Descrição<span class="text-danger">*</span></label>
                    <textarea name="descricao" class="form-control" rows="3"><?php
                    if (isset($valueForm['descricao'])) {
                        echo $valueForm['descricao'];
                    }?>
                </textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <input name="imageOld"
                           type="hidden"
                           value="<?php if (isset($valueForm['imageOld'])) {
                               echo $valueForm['imageOld'];
                            } elseif (isset ($valueForm['imagem'])) {
                                echo $valueForm['imagem'];
                            }
                            ?>">
                    <label>Foto (150x150)<span class="text-danger">*</span></label>
                    <input name="imageNew"
                           type="file"
                           onchange="previewImage();">
                </div>
                <div class="form-group col-md-6">
                    <?php
                    if (isset($valueForm['imagem']) && !empty($valueForm['imagem'])) {
                        $imgActual = URL
                                . 'site/assets/images/imgsInfoCompany/'
                                . $valueForm['id']
                                . '/' 
                                . $valueForm['imagem']; 
                    } elseif (isset($valueForm['imageOld']) && !empty($valueForm['imageOld'])) {
                        $imgActual = URL
                                . 'site/assets/images/imgsInfoCompany/'
                                . $valueForm['id']
                                . '/'
                                . $valueForm['imageOld']; 
                    } else {
                        $imgActual = URL
                                . 'site/assets/images/imgsInfoCompany/preview_img.jpg';
                    }
                    ?>
                    <img src="<?php echo $imgActual; ?>"
                         class="img-thumbmail"
                         alt="Imagem do sobre empresa"
                         id="previewImgUser"
                         style="width: 150px; height: 150px;">
                </div>
            </div>
            <p>
                <span class="text-danger">*</span> Campos Obrigatórios
            </p>
            <input name="editSobCompany"
                   type="submit"
                   class="btn btn-success"
                   value="Salvar">
        </form>
    </div>
</div>