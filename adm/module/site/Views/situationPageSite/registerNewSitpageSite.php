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
                <h2 class="display-4 titulo">Cadastrar Situação de Página do Site</h2>
            </div>
            <div class="p-2">
                <?php
                if ($this->dados['buttonsSitPage']['listSitPage']) {
                    echo "<a href='" . URLADM . "list-sitpage-site/list-info-sitpage-site'
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
                    <label>Nome<span class="text-danger">*</span></label>
                    <input name="nome"
                           type="text"
                           class="form-control"
                           placeholder="Informe nome da situção de página do site"
                           value="<?php if (isset($valueForm['nome'])) {
                                echo $valueForm['nome'];
                            } ?>">
                </div>
                <div class="form-group col-md-6">
                    <label>Cor<span class="text-danger">*</span></label>
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
            </div>
            <p>
                <span class="text-danger">*</span> Campos Obrigatórios
            </p>
            <input name="registerSitPageSite"
                   type="submit"
                   class="btn btn-success"
                   value="Salvar">
        </form>
    </div>
</div>