<div class="content p-1">
    <div class="list-group-item">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 titulo">Editar Perfil</h2>
            </div>
            <div class="p-2">
                <a href="<?php echo URLADM . 'profile/profile-user'; ?>" 
                   class="btn btn-outline-primary btn-sm">Visualizar</a>
            </div>
        </div>
        <hr>
        <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        if (isset($this->dados['form'])) {
            $valueForm = $this->dados['form'];
        }
        if (isset($this->dados['form'][0])) {
            $valueForm = $this->dados['form'][0];
        }
        ?>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group col-md-6">
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
                    <input name="imageOld"
                           type="hidden"
                           value="<?php if (isset($valueForm['imageOld'])) {
                               echo $valueForm['imageOld'];
                            } elseif (isset ($valueForm['imagem'])) {
                                echo $valueForm['imagem'];
                            }
                            ?>">
                    <label><span class="text-danger">*</span> Foto (150x150)</label>
                    <input name="imageNew"
                           type="file"
                           onchange="previewImage();">
                </div>
                <?php
                $imgUser = $_SESSION['userImage'];
                $idUser = $_SESSION['userId'];
                if (isset($valueForm['imagem']) && !empty($valueForm['imagem'])) {
                    $imgActual = URLADM . 'assets/image/user/' . $idUser . '/' . $imgUser; 
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
            <input name="editProfileUser"
                   type="submit"
                   class="btn btn-success"
                   value="Salvar">
        </form>
    </div>
</div>
</div>