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
                <h2 class="display-4 titulo">Editar Robots</h2>
            </div>
            <div class="p-2">
                <?php
                $valorFormulario = $valueForm['id'];
                if ($this->dados['buttonsRobots']['viewRobots']) {
                    echo "<a href='" . URLADM . "view-info-robots/detail-info-robots/$valorFormulario'
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
                           placeholder="Informe nome do robots"
                           value="<?php if (isset($valueForm['nome'])) {
                                echo $valueForm['nome'];
                            } ?>">
                </div>
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
            </div>
            <p>
                <span class="text-danger">*</span> Campos Obrigatórios
            </p>
            <input name="editInfoRobots"
                   type="submit"
                   class="btn btn-success"
                   value="Salvar">
        </form>
    </div>
</div>