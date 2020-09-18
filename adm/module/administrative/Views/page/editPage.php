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
                <h2 class="display-4 titulo">Editar Página</h2>
            </div>
            <div class="p-2">
                <?php
                $valorFormulario = $valueForm['id'];
                if ($this->dados['buttonAcesso']['viewPage']) {
                    echo "<a href='" . URLADM . "view-info-page/detail-info-page/$valorFormulario'
                             class='btn btn-outline-primary btn-sm'>
                            Visualizar
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
                <div class="form-group col-md-4">
                    <input name="id"
                           type="hidden"
                           value="<?php if (isset($valueForm['id'])) {
                                echo $valueForm['id'];
                            } ?>">
                    <label>Nome da página<span class="text-danger">*</span></label>
                    <input name="nome_pagina"
                           type="text"
                           class="form-control"
                           placeholder="Informe nome que aparecerá no menu"
                           value="<?php if (isset($valueForm['nome_pagina'])) {
                                echo $valueForm['nome_pagina'];
                            } ?>">
                </div>
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
                    <label>Método<span class="text-danger">*</span></label>
                    <input name="metodo"
                           type="text"
                           class="form-control"
                           placeholder="Informe nome do método"
                           value="<?php if (isset($valueForm['metodo'])) {
                                echo $valueForm['metodo'];
                            } ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>Classe no menu<span class="text-danger">*</span></label>
                    <input name="menu_controller"
                           type="text"
                           class="form-control"
                           placeholder="Informe nome da classe no menu"
                           value="<?php if (isset($valueForm['menu_controller'])) {
                                echo $valueForm['menu_controller'];
                            } ?>">
                </div>
                <div class="form-group col-md-4">
                    <label>Método no menu<span class="text-danger">*</span></label>
                    <input name="menu_metodo"
                           type="text"
                           class="form-control"
                           placeholder="Informe nome do método no menu"
                           value="<?php if (isset($valueForm['menu_metodo'])) {
                                echo $valueForm['menu_metodo'];
                            } ?>">
                </div>
                <div class="form-group col-md-4">
                    <label>Ícone
                        <span tabindex="0"
                              data-toggle="tooltip"
                              data-placement="top"
                              data-html="true"
                              title="Página de icone: <a href='https://fontawesome.com/icons?d=gallery' 
                                                         target='_blank'>fontawesome</a>. 
                                                         Somente inserir o nome, Ex: fas fa-volume-up">
                            <i class="fas fa-question-circle"></i>
                        </span>
                    </label>
                    <input name="icone"
                           type="text"
                           class="form-control"
                           placeholder="Informe ícone que aparecerá no menu"
                           value="<?php if (isset($valueForm['icone'])) {
                                echo $valueForm['icone'];
                            } ?>">
                </div>
            </div>
            <div class="form-group">
                <label>Observação<span class="text-danger">*</span></label>
                <textarea name="observacao" class="form-control" rows="3"><?php
                    if (isset($valueForm['observacao'])) {
                    echo $valueForm['observacao'];
                    }
                ?></textarea>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label >Página pública<span class="text-danger">*</span></label>
                    <select name="lib_publica" id="lib_publica" class="form-control">
                        <?php
                        if ($valueForm['lib_publica'] == 1) {
                            echo "<option value=''>Selecione...</option>";
                            echo "<option value='1' selected>Sim</option>";
                            echo "<option value='2'>Não</option>";
                        } elseif ($valueForm['lib_publica'] == 2){
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
                <div class="form-group col-md-6">
                    <label>Situação da página<span class="text-danger">*</span></label>
                    <select name="adms_situacao_pagina_id" id="adms_situacao_pagina_id" class="form-control">
                        <option value="">Selecione...</option>
                        <?php
                         foreach ($this->dados['select']['sitPg'] as $sitPg) {
                             extract($sitPg);
                             if ($valueForm['adms_situacao_pagina_id'] == $idSitPg) {
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
                    <label>Grupo da página<span class="text-danger">*</span></label>
                    <select name="adms_grupo_pagina_id" id="adms_grupo_pagina_id" class="form-control">
                        <option value="">Selecione...</option>
                        <?php
                         foreach ($this->dados['select']['grPg'] as $grPg) {
                             extract($grPg);
                             if ($valueForm['adms_grupo_pagina_id'] == $idGrPg) {
                                 echo "<option value='$idGrPg' selected>$nomeGrPg</option>";
                             } else {
                                 echo "<option value='$idGrPg'>$nomeGrPg</option>";
                             }
                         }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label>Tipo da página<span class="text-danger">*</span></label>
                    <select name="adms_tipos_pagina_id" id="adms_tipos_pagina_id" class="form-control">
                        <option value="">Selecione...</option>
                        <?php
                         foreach ($this->dados['select']['tpPg'] as $tpPg) {
                             extract($tpPg);
                             if ($valueForm['adms_tipos_pagina_id'] == $idTpPg) {
                                 echo "<option value='$idTpPg' selected>$tipoTpPg - $nomeTpPg</option>";
                             } else {
                                 echo "<option value='$idTpPg'>$tipoTpPg - $nomeTpPg</option>";
                             }
                         }
                        ?>
                    </select>
                </div>
            </div>
            <p>
                <span class="text-danger">*</span> Campos Obrigatórios
            </p>
            <input name="editInfoPage"
                   type="submit"
                   class="btn btn-success"
                   value="Salvar">
        </form>
    </div>
</div>