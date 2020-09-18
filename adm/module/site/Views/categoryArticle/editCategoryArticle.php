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
                <h2 class="display-4 titulo">Cadastrar Categoria de Artigo</h2>
            </div>
            <div class="p-2">
                <?php
                $valorFormulario = $valueForm['id'];
                if ($this->dados['buttonsCatArticle']['viewCatArticle']) {
                    echo "<a href='" 
                            . URLADM 
                            . "view-info-category-article/detail-info-category-article/$valorFormulario'
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
                           placeholder="Informe nome da categoria de artigo"
                           value="<?php if (isset($valueForm['nome'])) {
                                echo $valueForm['nome'];
                            } ?>">
                </div>
                <div class="form-group col-md-6">
                    <label>Situação<span class="text-danger">*</span></label>
                    <select name="sts_situacoe_id" id="sts_situacoe_id" class="form-control">
                        <option value="">Selecione...</option>
                        <?php
                         foreach ($this->dados['select']['sit'] as $sit) {
                             extract($sit);
                             if ($valueForm['sts_situacoe_id'] == $idSit) {
                                 echo "<option value='$idSit' selected>$nomeSit</option>";
                             } else {
                                 echo "<option value='$idSit'>$nomeSit</option>";
                             }
                         }
                        ?>
                    </select>
                </div>
            </div>
            <p>
                <span class="text-danger">*</span> Campos Obrigatórios
            </p>
            <input name="editCatArticle"
                   type="submit"
                   class="btn btn-success"
                   value="Salvar">
        </form>
    </div>
</div>