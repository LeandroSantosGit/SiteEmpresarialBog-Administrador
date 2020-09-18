<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}
if (!empty($this->dados['infoUser'][0])) {
    extract($this->dados['infoUser'][0]);
?>
<div class="content p-1">
    <div class="list-group-item">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 titulo">Visualizar Usuário</h2>
            </div>
            <div class="p-2">
                <span class="d-none d-md-block">
                    <?php
                    if ($this->dados['buttonAcesso']['listUser']) {
                        echo "<a href='" . URLADM . "users/list-users'
                                class='btn btn-outline-info btn-sm mr-2'>
                                 Listar Usuários
                             </a>";
                    }
                    if ($this->dados['buttonAcesso']['editUser']) {
                        echo "<a href='" . URLADM . "edit-user/edit-info-user/$id'
                                class='btn btn-outline-warning btn-sm mr-2'>
                                 Editar Perfil
                             </a>";
                    }
                    if ($this->dados['buttonAcesso']['editPass']) {
                        echo "<a href='" . URLADM . "edit-password/edit-pass/$id'
                                class='btn btn-outline-danger btn-sm mr-2'>
                                 Alterar Senha
                             </a>";
                    }
                    if ($this->dados['buttonAcesso']['deleteUser']) {
                        echo "<a href='" . URLADM . "delete-user/remove-user/$id'
                            class='btn btn-outline-danger btn-sm'
                            data-confirm='Tem certeza que deseja apagar usuário ?'>
                             Apagar Usuário
                         </a>";
                    }
                    ?>
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
                        <?php
                        if ($this->dados['buttonAcesso']['listUser']) {
                            echo "<a href='" . URLADM . "users/list-users'
                                    class='dropdown-item'>
                                     Listar Usuários
                                 </a>";
                        }
                        if ($this->dados['buttonAcesso']['editUser']) {
                            echo "<a href='" . URLADM . "edit-user/edit-info-user/$id'
                                    class='dropdown-item'>
                                     Editar Perfil
                                 </a>";
                        }
                        if ($this->dados['buttonAcesso']['editPass']) {
                            echo "<a href='" . URLADM . "edit-password/edit-pass/$id'
                                    class='dropdown-item'>
                                     Alterar Senha
                                 </a>";
                        }
                        if ($this->dados['buttonAcesso']['deleteUser']) {
                            echo "<a href='" . URLADM . "delete-user/remove-user/$id'
                                class='dropdown-item'
                                data-confirm='Tem certeza que deseja apagar usuário ?'>
                                 Apagar Usuário
                             </a>";
                        }
                        ?>
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
            <dt class='col-sm-3'>Foto </dt>
            <dd class='col-sm-9'>
                <?php
                if (!empty($imagem)) {
                    echo "<img src='" . URLADM . "assets/image/user/" 
                    . $id . "/" . $imagem . "'
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
            if (!empty($recuperar_senha)) {
                echo "<dt class='col-sm-3 text-truncate'>Recuperar Senha:</dt>
                <dd class='col-sm-9'>'"
                    . URLADM . 'update-password/restore-password?key=' . $recuperar_senha .
                "'</dd>";
            }
            ?>
            <dt class='col-sm-3 text-truncate'>Nível de acesso:</dt>
            <dd class='col-sm-9'><?php echo $nomeNivel; ?></dd>
            <dt class='col-sm-3 text-truncate'>Situação:</dt>
            <dd class='col-sm-9'>
                <span class="badge badge-<?php echo $cor ?>">
                    <?php echo $nomeSituacao; ?>
                </span>
            </dd>
            <dt class='col-sm-3 text-truncate'>Data de Cadastro:</dt>
            <dd class='col-sm-9'>
                <?php echo date('d/m/Y H:i', strtotime($created)); ?>
            </dd>
            <?php
            if (!empty($modified)) {
                echo "<dt class='col-sm-3 text-truncate'>Data Alteração de Cadastro:</dt>
                      <dd class='col-sm-9'>"
                        . date('d/m/Y H:i', strtotime($modified)) .
                      "</dd>";
            }
            ?>
        </dl>
    </div>
</div>
<?php
} else {
    $_SESSION['msg'] = "<div class='alert alert-danger'>Usuário não encontrado.</div>";
    $urlRedirect = URLADM . 'users/list-users';
    header("Location: $urlRedirect");
}