<body class="text-center">
    <form class="form-signin" method="POST" action="">
        <img class="mb-4"
             src="<?php echo URLADM . 'assets/image/logoLogin/logo.png'; ?>"
             alt="Imagem Login"
             width="72"
             height="72">
        <h1 class="h3 mb-3 font-weight-normal">Recuperar Senha</h1>

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
            <label>Email</label>
            <input type="email" 
                   name="email" 
                   class="form-control" 
                   placeholder="Informe seu email:"
                   value="<?php if (isset($valueForm['email'])) {
                       echo $valueForm['email'];
                   } ?>">
        </div>
        <input type="submit" name="resetLogin"
               class="btn btn-lg btn-success btn-block"
               value="Recuperar Minha Senha">
        <a href="<?php echo URLADM . 'login/access'; ?>" 
           class="btn btn-lg btn-primary btn-block">
            Voltar ao Login
        </a>
    </form>
</body>
