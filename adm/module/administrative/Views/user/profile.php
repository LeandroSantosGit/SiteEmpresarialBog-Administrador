<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}
?>
<div class="content p-1">
    <div class="list-group-item">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 titulo">Perfil</h2>
            </div>
            <div class="p-2">
                <span class="d-none d-md-block">
                    <a href="<?php echo URLADM . 'edit-profile/edit-profile-user'; ?>"
                       class="btn btn-outline-warning btn-sm">
                        Editar Perfil
                    </a>
                    <a href="<?php echo URLADM . 'modify-password/modify-pass'; ?>"
                       class="btn btn-outline-danger btn-sm">
                        Alterar Senha
                    </a>
                </span>
                <div class="dropdown d-block d-md-none">
                    <button class="btn btn-primary dropdown-toggle btn-sm"
                            type="button"
                            id="acoeslistar"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false">
                        Ações
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoeslistar">
                        <a class="dropdown-item" 
                           href="<?php echo URLADM . 'edit-profile/edit-profile-user'; ?>">
                            Alterar Perfil
                        </a>
                        <a class="dropdown-item"
                           href="<?php echo URLADM . 'modify-password/modify-pass'; ?>">
                            Editar Senha
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>
        <dl class="row">
            <?php
            if (!empty($this->dados['dadosProfile'][0])) {
                extract($this->dados['dadosProfile'][0]);
                ?>
                <dt class='col-sm-3'>Foto </dt>
                <dd class='col-sm-9'>
                    <?php
                    if (!empty($_SESSION['userImage'])) {
                        echo "<img src='" . URLADM . "assets/image/user/" 
                        . $_SESSION['userId'] . "/" . $_SESSION['userImage'] . "'
                        witdh='150' height='150'>";
                    } else {
                        echo "<img src='" . URLADM . "assets/image/user/icone_usuario.png'
                                witdh='150' height='150'>";
                    }
                    ?>
                </dd>
                <dt class='col-sm-3'>Id: </dt>
                <dd class='col-sm-9'><?php echo $id; ?></dd>
                <dt class='col-sm-3'>Nome: </dt>
                <dd class='col-sm-9'><?php echo $nome; ?></dd>
                <dt class='col-sm-3'>Apelido: </dt>
                <dd class='col-sm-9'><?php echo $apelido; ?></dd>
                <dt class='col-sm-3'>Email: </dt>
                <dd class='col-sm-9'><?php echo $email; ?></dd>
                <dt class='col-sm-3 text-truncate'>Usuário:</dt>
                <dd class='col-sm-9'><?php echo $usuario; ?></dd>
                <?php
            }
            ?>
        </dl>
    </div>
</div>