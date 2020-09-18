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
                <h2 class="display-4 titulo">Editar Serviço</h2>
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
                           placeholder="Informe titulo da área de serviço"
                           value="<?php if (isset($valueForm['titulo'])) {
                                echo $valueForm['titulo'];
                            } ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>Ícone 1
                        <span tabindex="0"
                              data-toggle="tooltip"
                              data-placement="top"
                              data-html="true"
                              title="Página de icone: <a href='https://fontawesome.com/icons?d=gallery' 
                                                         target='_blank'>fontawesome</a>. 
                                                         Somente inserir o nome, Ex: fas fa-volume-up">
                            <i class="fas fa-question-circle"></i>
                        </span>
                    </label>
                    <input name="icone_um"
                           type="text"
                           class="form-control"
                           value="<?php if (isset($valueForm['icone_um'])) {
                                echo $valueForm['icone_um'];
                            } ?>">
                </div>
                <div class="form-group col-md-4">
                    <label>Nome 1<span class="text-danger">*</span></label>
                    <input name="nome_um"
                           type="text"
                           class="form-control"
                           placeholder="Informe nome do serviço um"
                           value="<?php if (isset($valueForm['nome_um'])) {
                                echo $valueForm['nome_um'];
                            } ?>">
                </div>
                <div class="form-group col-md-4">
                    <label>Descrição 1<span class="text-danger">*</span></label>
                    <input name="descricao_um"
                           type="text"
                           class="form-control"
                           placeholder="Informe descrição do serviço um"
                           value="<?php if (isset($valueForm['descricao_um'])) {
                                echo $valueForm['descricao_um'];
                            } ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>Ícone 2
                        <span tabindex="0"
                              data-toggle="tooltip"
                              data-placement="top"
                              data-html="true"
                              title="Página de icone: <a href='https://fontawesome.com/icons?d=gallery' 
                                                         target='_blank'>fontawesome</a>. 
                                                         Somente inserir o nome, Ex: fas fa-volume-up">
                            <i class="fas fa-question-circle"></i>
                        </span>
                    </label>
                    <input name="icone_dois"
                           type="text"
                           class="form-control"
                           value="<?php if (isset($valueForm['icone_dois'])) {
                                echo $valueForm['icone_dois'];
                            } ?>">
                </div>
                <div class="form-group col-md-4">
                    <label>Nome 2<span class="text-danger">*</span></label>
                    <input name="nome_dois"
                           type="text"
                           class="form-control"
                           placeholder="Informe nome do serviço dois"
                           value="<?php if (isset($valueForm['nome_dois'])) {
                                echo $valueForm['nome_dois'];
                            } ?>">
                </div>
                <div class="form-group col-md-4">
                    <label>Descrição 2<span class="text-danger">*</span></label>
                    <input name="descricao_dois"
                           type="text"
                           class="form-control"
                           placeholder="Informe descrição do serviço dois"
                           value="<?php if (isset($valueForm['descricao_dois'])) {
                                echo $valueForm['descricao_dois'];
                            } ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>Ícone 3
                        <span tabindex="0"
                              data-toggle="tooltip"
                              data-placement="top"
                              data-html="true"
                              title="Página de icone: <a href='https://fontawesome.com/icons?d=gallery' 
                                                         target='_blank'>fontawesome</a>. 
                                                         Somente inserir o nome, Ex: fas fa-volume-up">
                            <i class="fas fa-question-circle"></i>
                        </span>
                    </label>
                    <input name="icone_tres"
                           type="text"
                           class="form-control"
                           value="<?php if (isset($valueForm['icone_tres'])) {
                                echo $valueForm['icone_tres'];
                            } ?>">
                </div>
                <div class="form-group col-md-4">
                    <label>Nome 3<span class="text-danger">*</span></label>
                    <input name="nome_tres"
                           type="text"
                           class="form-control"
                           placeholder="Informe nome do serviço tres"
                           value="<?php if (isset($valueForm['nome_tres'])) {
                                echo $valueForm['nome_tres'];
                            } ?>">
                </div>
                <div class="form-group col-md-4">
                    <label>Descrição 3<span class="text-danger">*</span></label>
                    <input name="descricao_tres"
                           type="text"
                           class="form-control"
                           placeholder="Informe descrição do serviço tres"
                           value="<?php if (isset($valueForm['descricao_tres'])) {
                                echo $valueForm['descricao_tres'];
                            } ?>">
                </div>
            </div>
            <p>
                <span class="text-danger">*</span> Campos Obrigatórios
            </p>
            <input name="editServices"
                   type="submit"
                   class="btn btn-success"
                   value="Salvar">
        </form>
    </div>
</div>