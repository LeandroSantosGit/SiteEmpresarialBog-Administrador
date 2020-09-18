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
                <h2 class="display-4 titulo">Editar Item de Menu da Página</h2>
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
            <div class="form-group">
                <input name="id"
                       type="hidden"
                       value="<?php
                       if (isset($valueForm['id'])) {
                           echo $valueForm['id'];
                       }?>">
                <label>Item do Menu <span class="text-danger">*</label>
                <select name="adms_menu_id" id="adms_menu_id" class="form-control">
                    <option value="">Selecione...</option>
                    <?php
                     foreach ($this->dados['select']['menu'] as $menu) {
                         extract($menu);
                         if ($valueForm['adms_menu_id'] == $idMenu) {
                             echo "<option value='$idMenu' selected>$nomeMenu</option>";
                         } else {
                             echo "<option value='$idMenu'>$nomeMenu</option>";
                         }
                     }
                    ?>
                </select>
            </div>
            <p>
                <span class="text-danger">*</span> Campo Obrigatório
            </p>
            <input name="editLevelAccePgMenu" type="submit" class="btn btn-success" value="Salvar">
        </form>
    </div>
</div>