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
                <h2 class="display-4 titulo">Editar Artigo</h2>
            </div>
            <div class="p-2">
                <?php
                $valorFormulario = $valueForm['id'];
                if ($this->dados['buttonsArticle']['viewArticle']) {
                    echo "<a href='" 
                            . URLADM 
                            . "view-info-article/detail-info-article/$valorFormulario'
                             class='btn btn-outline-success btn-sm'>
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
                <div class="form-group col-md-12">
                    <input name="id"
                           type="hidden"
                           value="<?php if (isset($valueForm['id'])) {
                                echo $valueForm['id'];
                            } ?>">
                    <label>Autor do Artigo<span class="text-danger">*</span></label>
                    <select name="adms_usuario_id" id="adms_usuario_id" class="form-control">
                        <option value="">Selecione...</option>
                        <?php
                        $cont = 1;
                        foreach ($this->dados['select']['user'] as $user) {
                            extract($user);
                            if ($valueForm['adms_usuario_id'] == $idUser) {
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
            <p>
                <span class="text-danger">*</span> Campos Obrigatórios
            </p>
            <input name="editAuthorArticle"
                   type="submit"
                   class="btn btn-success"
                   value="Salvar">
        </form>
    </div>
</div>