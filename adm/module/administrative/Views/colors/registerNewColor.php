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
                <h2 class="display-4 titulo">Cadastrar Cor</h2>
            </div>
            <div class="p-2">
                <?php
                if ($this->dados['buttonsColor']['listColor']) {
                    echo "<a href='" . URLADM . "list-color/list-colors'
                             class='btn btn-outline-primary btn-sm'>
                            Listar Cores
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
                           placeholder="Informe da cor"
                           value="<?php if (isset($valueForm['nome'])) {
                                echo $valueForm['nome'];
                            } ?>">
                </div>
                <div class="form-group col-md-6">
                    <label>Cor<span class="text-danger">*</span></label>
                    <input name="cor"
                           type="text"
                           class="form-control"
                           placeholder="Informe nome do seletor da cor no Bootstrap4"
                           value="<?php if (isset($valueForm['cor'])) {
                                echo $valueForm['cor'];
                            } ?>">
                </div>
            </div>
            <p>
                <span class="text-danger">*</span> Campos Obrigatórios
            </p>
            <input name="registerNewColor"
                   type="submit"
                   class="btn btn-success"
                   value="Salvar">
        </form>
    </div>
</div>