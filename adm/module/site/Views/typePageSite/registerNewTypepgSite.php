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
                <h2 class="display-4 titulo">Cadastrar Tipo de Página do Site</h2>
            </div>
            <div class="p-2">
                <?php
                if ($this->dados['buttonsTypePg']['listTypePg']) {
                    echo "<a href='" . URLADM . "list-typepg-site/list-info-typepg-site'
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
                    <label>Tipo<span class="text-danger">*</span></label>
                    <input name="tipo"
                           type="text"
                           class="form-control"
                           placeholder="Informe o tipo do robots"
                           value="<?php if (isset($valueForm['tipo'])) {
                                echo $valueForm['tipo'];
                            } ?>">
                </div>
                <div class="form-group col-md-6">
                    <label>Nome<span class="text-danger">*</span></label>
                    <input name="nome"
                           type="text"
                           class="form-control"
                           placeholder="Informe nome do robots"
                           value="<?php if (isset($valueForm['nome'])) {
                                echo $valueForm['nome'];
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
            <p>
                <span class="text-danger">*</span> Campos Obrigatórios
            </p>
            <input name="registerTypePage"
                   type="submit"
                   class="btn btn-success"
                   value="Salvar">
        </form>
    </div>
</div>