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
                <h2 class="display-4 titulo">Cadastrar Gupo de Páginas</h2>
            </div>
            <div class="p-2">
                <?php
                if ($this->dados['buttonsGrupPg']['listGrupPg']) {
                    echo "<a href='" . URLADM . "list-group-page/list-groups-pages'
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
                <label>Nome <span class="text-danger">*</span></label>
                <input name="nome"
                       type="text"
                       class="form-control"
                       id="infComple"
                       placeholder="Informe novo grupo de páginas"
                       value="<?php
                       if (isset($valueForm['nome'])) {
                           echo $valueForm['nome'];
                       }
                       ?>">
            </div>
            <p>
                <span class="text-danger">*</span> Campo Obrigatório
            </p>
            <input name="registerGroupPg" type="submit" class="btn btn-success" value="Salvar">
        </form>
    </div>
</div>
