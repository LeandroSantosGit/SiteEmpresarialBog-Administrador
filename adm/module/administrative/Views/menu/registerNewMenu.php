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
                <h2 class="display-4 titulo">Cadastrar Item do Menu</h2>
            </div>
            <?php
            if ($this->dados['buttonMenu']['listMenu']) { 
                echo "<div class='p-2'>
                        <a href='" . URLADM . "list-menu/list-itens-menu'
                           class='btn btn-outline-info btn-sm'>
                            Listar Itens Menu
                        </a>
                    </div>";
            }?>
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
                    <label><span class="text-danger">*</span> Nome</label>
                    <input name="nome"
                           type="text"
                           class="form-control"
                           placeholder="Informe nome item do menu"
                           value="<?php if (isset($valueForm['nome'])) {
                                echo $valueForm['nome'];
                            } ?>">
                </div>
                <div class="form-group col-md-6">
                    <label><span class="text-danger">*</span> 
                        <span tabindex="0"
                              data-toggle="tooltip"
                              data-placement="top"
                              data-html="true"
                              title="Página de icone: <a href='https://fontawesome.com/icons?d=gallery&v=5.9.0'
                                    target='_blank'>fontawesome</a>. Somente inserir o nome, Ex: fas fa-volume-up">
                            <i class="fas fa-question-circle"></i>
                        </span> Ícone
                    </label>
                    <input name="icone"
                           type="text"
                           class="form-control"
                           placeholder="Ícone a ser apresentado no menu"
                           value="<?php if (isset($valueForm['icone'])) {
                                echo $valueForm['icone'];
                            }
                            ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label><span class="text-danger">*</span> Situação</label>
                    <select name="adms_situacao_id" id="adms_situacao_id" class="form-control">
                        <option value="">Selecione</option>
                        <?php
                        foreach ($this->dados['select']['sit'] as $sit) {
                            extract($sit);
                            if ($valueForm['adms_situacao_id'] == $idSit) {
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
                <span class="text-danger">* </span>Campo obrigatório
            </p>
            <input name="registerMenu" type="submit" class="btn btn-success" value="Salvar">
        </form>
    </div>
</div>
