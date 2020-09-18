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
                <h2 class="display-4 titulo">Configurações para Enviar de Email</h2>
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
                    <label>Nome da página<span class="text-danger">*</span></label>
                    <input name="nome"
                           type="text"
                           class="form-control"
                           placeholder="Informe nome do remetente"
                           value="<?php if (isset($valueForm['nome'])) {
                                echo $valueForm['nome'];
                            } ?>">
                </div>
                <div class="form-group col-md-6">
                    <label>Email<span class="text-danger">*</span></label>
                    <input name="email"
                           type="email"
                           class="form-control"
                           placeholder="Informe email do remetente"
                           value="<?php if (isset($valueForm['email'])) {
                                echo $valueForm['email'];
                            } ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>Host<span class="text-danger">*</span></label>
                    <input name="host"
                           type="text"
                           class="form-control"
                           placeholder="Informe o servidor de envio de email"
                           value="<?php if (isset($valueForm['host'])) {
                                echo $valueForm['host'];
                            } ?>">
                </div>
                <div class="form-group col-md-4">
                    <label>Usuário do email<span class="text-danger">*</span></label>
                    <input name="username"
                           type="text"
                           class="form-control"
                           placeholder="Informe usuário do email remetente"
                           value="<?php if (isset($valueForm['username'])) {
                                echo $valueForm['username'];
                            } ?>">
                </div>
                <div class="form-group col-md-4">
                    <label>Senha do email<span class="text-danger">*</span></label>
                    <input name="password"
                           type="text"
                           class="form-control"
                           placeholder="Informe senha do email remetente"
                           value="<?php if (isset($valueForm['password'])) {
                                echo $valueForm['password'];
                            } ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Criptografia<span class="text-danger">*</span></label>
                    <input name="smtpsecure"
                           type="text"
                           class="form-control"
                           placeholder="Informe o tipo de encriptação SSL/TLS"
                           value="<?php if (isset($valueForm['smtpsecure'])) {
                                echo $valueForm['smtpsecure'];
                            } ?>">
                </div>
                <div class="form-group col-md-6">
                    <label>Porta<span class="text-danger">*</span></label>
                    <input name="port"
                           type="text"
                           class="form-control"
                           placeholder="Informe a porta de envio de email"
                           value="<?php if (isset($valueForm['port'])) {
                                echo $valueForm['port'];
                            } ?>">
                </div>
            </div>
            <p>
                <span class="text-danger">*</span> Campos Obrigatórios
            </p>
            <input name="editConfiEmail"
                   type="submit"
                   class="btn btn-success"
                   value="Salvar">
        </form>
    </div>
</div>