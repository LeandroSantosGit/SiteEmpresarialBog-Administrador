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
                <h2 class="display-4 titulo">Editar Usuário</h2>
            </div>
            <div class="p-2">
                <?php
                $valorFormulario = $valueForm['id'];
                if ($this->dados['buttonAcesso']['viewUser']) {
                    echo "<a href='" . URLADM . "view-info-user/detail-info-user/$valorFormulario'
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
                <div class="form-group col-md-6">
                    <input name="id"
                           type="hidden"
                           value="<?php if (isset($valueForm['id'])) {
                                echo $valueForm['id'];
                            } ?>">
                    <label>Nome<span class="text-danger">*</span></label>
                    <input name="nome"
                           type="text"
                           class="form-control"
                           placeholder="Informe seu nome"
                           value="<?php if (isset($valueForm['nome'])) {
                                echo $valueForm['nome'];
                            } ?>">
                </div>
                <div class="form-group col-md-6">
                    <label>Apelido<span class="text-danger">*</span></label>
                    <input name="apelido"
                           type="text"
                           class="form-control"
                           placeholder="Informe como gostaria de ser chamado"
                           value="<?php if (isset($valueForm['apelido'])) {
                                echo $valueForm['apelido'];
                            } ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Email<span class="text-danger">*</span></label>
                    <input name="email"
                           type="email"
                           class="form-control"
                           placeholder="Informe seu Email"
                           value="<?php if (isset($valueForm['email'])) {
                                echo $valueForm['email'];
                            } ?>">
                </div>
                <div class="form-group col-md-6">
                    <label>Usuário<span class="text-danger">*</span></label>
                    <input name="usuario"
                           type="text"
                           class="form-control"
                           placeholder="Informe o usuário"
                           value="<?php if (isset($valueForm['usuario'])) {
                                echo $valueForm['usuario'];
                            } ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label >Nível de acesso<span class="text-danger">*</span></label>
                    <select name="adms_niveis_acesso_id" id="adms_niveis_acesso_id" class="form-control">
                        <option value="">Selecione...</option>
                        <?php
                         foreach ($this->dados['select']['nivac'] as $nivac) {
                             extract($nivac);
                             if ($valueForm['adms_niveis_acesso_id'] == $idNivac) {
                                 echo "<option value='$idNivac' selected>$nomeNivac</option>";
                             } else {
                                 echo "<option value='$idNivac'>$nomeNivac</option>";
                             }
                         }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label>Situação<span class="text-danger">*</span></label>
                    <select name="adms_situacao_user_id" id="adms_situacao_user_id" class="form-control">
                        <option value="">Selecione...</option>
                        <?php
                         foreach ($this->dados['select']['siti'] as $siti) {
                             extract($siti);
                             if ($valueForm['adms_situacao_user_id'] == $idSiti) {
                                 echo "<option value='$idSiti' selected>$nomeSiti</option>";
                             } else {
                                 echo "<option value='$idSiti'>$nomeSiti</option>";
                             }
                         }
                        ?>
                    </select>
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
                <?php
                if (isset($valueForm['imagem']) && !empty($valueForm['imagem'])) {
                    $imgActual = URLADM . 'assets/image/user/' . $valueForm['id'] . '/' . $valueForm['imagem']; 
                } elseif (isset($valueForm['imageOld']) && !empty($valueForm['imageOld'])) {
                    $imgActual = URLADM . 'assets/image/user/' . $valueForm['id'] . '/' . $valueForm['imageOld']; 
                } else {
                    $imgActual = URLADM . 'assets/image/user/preview_img.png';
                }
                ?>
                <div class="form-group col-md-6">
                    <img src="<?php echo $imgActual; ?>"
                         class="img-thumbmail"
                         alt="Imagem do usuário"
                         id="previewImgUser"
                         style="width: 150px; height: 150px;">
                </div>
            </div>
            <p>
                <span class="text-danger">*</span> Campos Obrigatórios
            </p>
            <input name="editInfoUser"
                   type="submit"
                   class="btn btn-success"
                   value="Salvar">
        </form>
    </div>
</div>