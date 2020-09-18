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
                <h2 class="display-4 titulo">Editar Informações de Login do Usuário</h2>
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
                    <label >Enviar E-mail de Confirmação<span class="text-danger">*</span></label>
                    <select name="envio_email_config" id="envio_email_config" class="form-control">
                        <?php
                        if ($valueForm['envio_email_config'] == 1) {
                            echo "<option value=''>Selecione...</option>";
                            echo "<option value='1' selected>Sim</option>";
                            echo "<option value='2'>Não</option>";
                        } elseif ($valueForm['envio_email_config'] == 2){
                            echo "<option value=''>Selecione...</option>";
                            echo "<option value='1'>Sim</option>";
                            echo "<option value='2' selected>Não</option>";
                        } else {
                            echo "<option value='' selected>Selecione...</option>";
                            echo "<option value='1'>Sim</option>";
                            echo "<option value='2'>Não</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label >Nível de acesso<span class="text-danger">*</span></label>
                    <select name="adms_niveis_acesso_id" id="adms_niveis_acesso_id" class="form-control">
                        <option value="">Selecione...</option>
                        <?php
                         foreach ($this->dados['select']['levAccs'] as $nivac) {
                             extract($nivac);
                             if ($valueForm['adms_niveis_acesso_id'] == $idNivac) {
                                 echo "<option value='$idNivac' selected>$nomeNivac</option>";
                             } else {
                                 echo "<option value='$idNivac'>$nomeNivac</option>";
                             }
                         }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Situação<span class="text-danger">*</span></label>
                    <select name="adms_situacao_user_id" id="adms_situacao_user_id" class="form-control">
                        <option value="">Selecione...</option>
                        <?php
                         foreach ($this->dados['select']['sitUser'] as $siti) {
                             extract($siti);
                             if ($valueForm['adms_situacao_user_id'] == $idSitUser) {
                                 echo "<option value='$idSitUser' selected>$nomeSitUser</option>";
                             } else {
                                 echo "<option value='$idSitUser'>$nomeSitUser</option>";
                             }
                         }
                        ?>
                    </select>
                </div>
            </div>
            <p>
                <span class="text-danger">*</span> Campos Obrigatórios
            </p>
            <input name="editNewInfoUser"
                   type="submit"
                   class="btn btn-success"
                   value="Salvar">
        </form>
    </div>
</div>