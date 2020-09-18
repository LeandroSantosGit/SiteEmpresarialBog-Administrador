<div class="content p-1">
    <div class="list-group-item">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 titulo">Editar Senha</h2>
            </div>
            <div class="p-2">
                <?php
                $valorFormulario = $this->dados['form'];
                if ($this->dados['buttonAcesso']['viewUser']) {
                    echo "<a href='" . URLADM . "view-info-user/detail-info-user/$valorFormulario'
                             class='btn btn-outline-primary btn-sm'>
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
        <form method="POST" action="">
            <div class="form-group">
                <input name="id"
                       type="hidden"
                       value="<?php echo $this->dados['form']; ?>">
                <label>Senha</label>
                <input name="senha"
                       type="password"
                       class="form-control"
                       id="infComple"
                       placeholder="Informe sua nova senha, no mínimo 8 caracteres">
            </div>
            <p>
                <span class="text-danger">*</span> Campo Obrigatório
            </p>
            <input name="editPassUser" type="submit" class="btn btn-success" value="Salvar">
        </form>
    </div>
</div>
</div>