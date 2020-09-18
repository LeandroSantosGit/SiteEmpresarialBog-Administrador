<body class="text-center">
    <form class="form-signin" method="POST" action="">
        <img class="mb-4"
             src="<?php echo URLADM . 'assets/image/logoLogin/logo.png'; ?>"
             alt="Imagem Login"
             width="72"
             height="72">
        <h1 class="h3 mb-3 font-weight-normal">Área restrita</h1>

        <?php
            //echo password_hash("12345678", PASSWORD_DEFAULT);
            if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
            if (isset($this->dados['form'])) {
                $valueForm = $this->dados['form'];
            }            
        ?>
        <div class="form-group">
            <label>Usuário</label>
            <input type="text" 
                   name="user" 
                   class="form-control" 
                   placeholder="Informe seu usuário:"
                   value="<?php if (isset($valueForm['user'])) {
                       echo $valueForm['user'];
                   } ?>">
        </div>
        <div class="form-group">
            <label>Senha</label>
            <input type="password"
                   name="password"
                   class="form-control"
                   placeholder="Informe sua senha:">
        </div>
        <div class="form-group">
            <input type="submit" name="sendLogin"
                   class="btn btn-lg btn-success btn-block"
                   value="Acessar">
        </div>
        <div class="form-group">
            <a class="text-secondary resetPass"
               href="<?php echo URLADM . 'resetpasssword/resetpass'; ?>"
               title="Recuperar Senha">Recuperar Senha
            </a>
        </div>
        <div class="form-group">
            <a href="<?php echo URLADM . 'newuser/registerNewUser'; ?>"
               class="btn btn-lg btn-primary btn-block">
                Cadastrar-se Aqui
        </a>
        </div>
    </form>
</body>
