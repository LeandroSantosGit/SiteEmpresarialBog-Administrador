<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}
?>
<main role="main">

    <div class="jumbotron contato">
        <div class="container">
            <h2 class="display-4 text-center servicosh2">Contato</h2>
            <?php
            if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
            if (isset($this->dados['form'])) {
                $valueForm = $this->dados['form'];
            }
            ?>
            <form method="POST" action="">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Nome</label>
                        <input name="nome"
                               type="text"
                               class="form-control"
                               placeholder="Digite seu nome"
                               value="<?php
                                      if (isset($valueForm['nome'])) {
                                          echo $valueForm['nome'];
                                      }                                      
                                      ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Email</label>
                        <input name="email"
                               type="email"
                               class="form-control"
                               placeholder="Digite seu email"
                               value="<?php
                                      if (isset($valueForm['email'])) {
                                          echo $valueForm['email'];
                                      }                                      
                                      ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputAddress">Assunto</label>
                    <input name="assunto"
                           type="text"
                           class="form-control"
                           placeholder="Digite o assunto da mensagem"
                           value="<?php
                                  if (isset($valueForm['assunto'])) {
                                      echo $valueForm['assunto'];
                                  }                                      
                                  ?>">
                </div>
                <div class="form-group">
                    <label>Mensagem</label>
                    <textarea class="form-control"
                              name="mensagem"
                              rows="6"
                              placeholder="Digite sua mensagem"
                              ><?php 
                              if (isset($valueForm['mensagem'])) {
                                  echo $valueForm['mensagem'];
                              } ?></textarea>
                </div>
                <input name="created"
                       type="hidden"
                       value="<?php echo date("Y-m-d H:i:s"); ?>">
                <input name="registerMsgContact"
                       type="submit"
                       class="btn btn-primary button-submit"
                       value="Enviar">
            </form>
        </div>
    </div>			

</main>
