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
                <h2 class="display-4 titulo">Editar Vídeo</h2>
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
                    <label>Titulo<span class="text-danger">*</span></label>
                    <input name="titulo"
                           type="text"
                           class="form-control"
                           placeholder="Informe o titulo do vídeo"
                           value="<?php if (isset($valueForm['titulo'])) {
                                echo $valueForm['titulo'];
                            } ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label>Descrição<span class="text-danger">*</span></label>
                    <input name="descricao"
                           type="text"
                           class="form-control"
                           placeholder="Informe a descrição do vídeo"
                           value="<?php if (isset($valueForm['descricao'])) {
                                echo $valueForm['descricao'];
                            } ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label>Embed do vídeo<span class="text-danger">*</span></label>
                    <textarea name="video" class="form-control" rows="3"><?php
                    if (isset($valueForm['video'])) {
                        echo $valueForm['video'];
                    }?>
                </textarea>
                </div>
            </div>
            <p>
                <span class="text-danger">*</span> Campos Obrigatórios
            </p>
            <input name="editVideo"
                   type="submit"
                   class="btn btn-success"
                   value="Salvar">
        </form>
    </div>
</div>