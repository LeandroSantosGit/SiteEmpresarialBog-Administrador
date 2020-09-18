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
                <h2 class="display-4 titulo">Editar SEO</h2>
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
                    <label>og_site_name Facebook<span class="text-danger">*</span></label>
                    <span tabindex="0"
                          data-toggle="tooltip"
                          data-placement="top"
                          data-html="true"
                          title="Nome da página no Facebook">
                            <i class="fas fa-question-circle"></i>
                    <input name="og_site_name"
                           type="text"
                           class="form-control"
                           placeholder="Informe nome da página no Facebook"
                           value="<?php if (isset($valueForm['og_site_name'])) {
                                echo $valueForm['og_site_name'];
                            } ?>">
                </div>
                <div class="form-group col-md-6">
                    <label>og_locale Facebook<span class="text-danger">*</span></label>
                    <span tabindex="0"
                          data-toggle="tooltip"
                          data-placement="top"
                          data-html="true"
                          title="Local ou idioma da página no Facebook. Ex: pt_BR">
                            <i class="fas fa-question-circle"></i>
                    <input name="og_locale"
                           type="text"
                           class="form-control"
                           placeholder="Informe o local ou idioma da página no Facebook. Ex: pt_BR"
                           value="<?php if (isset($valueForm['og_locale'])) {
                                echo $valueForm['og_locale'];
                            } ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>FB:admins<span class="text-danger">*</span></label>
                    <span tabindex="0"
                          data-toggle="tooltip"
                          data-placement="top"
                          data-html="true"
                          title="ID da página no Facebook">
                            <i class="fas fa-question-circle"></i>
                    <input name="fb_admins"
                           type="text"
                           class="form-control"
                           placeholder="Informe o ID da página no Facebook"
                           value="<?php if (isset($valueForm['fb_admins'])) {
                                echo $valueForm['fb_admins'];
                            } ?>">
                </div>
                <div class="form-group col-md-6">
                    <label>Nome do Twiter<span class="text-danger">*</span></label>
                    <span tabindex="0"
                          data-toggle="tooltip"
                          data-placement="top"
                          data-html="true"
                          title="Nome de usuário no twiter. Ex: @nome_usuário">
                            <i class="fas fa-question-circle"></i>
                    <input name="twitter_site"
                           type="text"
                           class="form-control"
                           placeholder="Informe o nome de usuário no twiter. Ex: @nome_usuário"
                           value="<?php if (isset($valueForm['twitter_site'])) {
                                echo $valueForm['twitter_site'];
                            } ?>">
                </div>
            </div>
            <p>
                <span class="text-danger">*</span> Campos Obrigatórios
            </p>
            <input name="editInfoSeo"
                   type="submit"
                   class="btn btn-success"
                   value="Salvar">
        </form>
    </div>
</div>