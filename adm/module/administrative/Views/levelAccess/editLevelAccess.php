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
                <h2 class="display-4 titulo">Editar Nível de Acesso</h2>
            </div>
            <?php
            if ($this->dados['buttonAcesso']['viewAcess']) {
                ?>
                <div class="p-2">
                    <a href="<?php echo URLADM . 'view-level-access/detail-access/' . $valueForm['id']; ?>" 
                       class="btn btn-outline-primary btn-sm">Visualizar</a>
                </div>
                <?php
            }
            ?>
        </div>
        <hr>
        <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-group">
                <input name="id"
                       type="hidden"
                       value="<?php
                       if (isset($valueForm['id'])) {
                           echo $valueForm['id'];
                       }?>">
                <label>Nome <span class="text-danger">*</label>
                <input name="nome"
                       type="text"
                       class="form-control"
                       placeholder="Informe nome do nível de acesso"
                       value="<?php
                       if (isset($valueForm['nome'])) {
                           echo $valueForm['nome'];
                       }
                       ?>">
            </div>
            <p>
                <span class="text-danger">*</span> Campo Obrigatório
            </p>
            <input name="editAccess" type="submit" class="btn btn-success" value="Salvar">
        </form>
    </div>
</div>