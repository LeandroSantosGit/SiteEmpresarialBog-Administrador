<body class="text-center">
    <form class="form-signin" method="POST" action="">
        <img class="mb-4"
             src="<?php echo URLADM . 'assets/image/logoLogin/logo.png'; ?>"
             alt="Imagem Login"
             width="72"
             height="72">
        <h1 class="h3 mb-3 font-weight-normal">Atualizar Senha</h1>

        <?php
            if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
            if (isset($this->dados['form'])) {
                $valueForm = $this->dados['form'];
            }            
        ?>
        <div class="form-group">
            <label>Senha</label>
            <input type="password" name="senha"
                   class="form-control"
                   placeholder="Informe sua senha:">
        </div>
        <input type="submit" name="updatePassUser"
               class="btn btn-lg btn-success btn-block"
               value="Atualizar Senha">
        <a href="<?php echo URLADM . 'login/access'; ?>" 
           class="btn btn-lg btn-primary btn-block">
            Logar-se
        </a>
    </form>
</body>
