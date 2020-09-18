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
                <h2 class="display-4 titulo">Pesquisar Usuário</h2>
            </div>
            <div class="p-2">
                <span class="d-none d-md-block">
                    <?php
                    if ($this->dados['buttonAcesso']['listUser']) {
                        echo "<a href='" . URLADM . "users/list-users'
                                class='btn btn-outline-info btn-sm mr-2'>
                                 Listar
                             </a>";
                    }
                    if ($this->dados['buttonAcesso']['cadUser']) {
                        echo "<a href='" . URLADM . "register-new-user/register-info-user'
                                class='btn btn-outline-success btn-sm mr-2'>
                                 Cadastrar
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
                                     Listar
                                 </a>";
                        }
                        if ($this->dados['buttonAcesso']['cadUser']) {
                            echo "<a href='" . URLADM . "register-new-user/register-info-user'
                                    class='dropdown-item'>
                                     Cadastrar
                                 </a>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <form class="form-inline"
              method="POST"
              action="">
            <div class="form-group">
                <label>Nome</label>
                <input type="text"
                       name="nome"
                       id="nome"
                       class="form-control mx-sm-3"
                       placeholder="Nome do usuário"
                       value="<?php
                       if (isset($_SESSION['searchUserName'])){
                           echo $_SESSION['searchUserName'];
                       }
                       ?>">
            </div>
            <div class="form-group ml-3">
                <label>Email</label>
                <input type="text"
                       name="email"
                       id="nome"
                       class="form-control mx-sm-3"
                       placeholder="Email do usuário"
                       value="<?php
                       if (isset($_SESSION['searchUserEmail'])){
                           echo $_SESSION['searchUserEmail'];
                       }
                       ?>">
            </div>
            <input name="searchUserRegistration"
                   type="submit"
                   class="btn btn-outline-primary my-2"
                   value="Pesquisar">
        </form>
        <hr>
        <?php
        if (empty($this->dados['listUser'])) {
            ?>
            <div class="alert alert-danger" role="alert">
                Nenhum usuário encontrado!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
        }
        ?>
        <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th class="d-none d-sm-table-cell">Email</th>
                        <th class="d-none d-lg-table-cell text-center">Situação</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (empty(!$this->dados['listUser'])) {
                        foreach ($this->dados['listUser'] as $users) {
                            extract($users);
                            ?>
                            <tr>
                                <th><?php echo $id; ?></th>
                                <td><?php echo $nome; ?></td>
                                <td class="d-none d-sm-table-cell"><?php echo $email ?></td>
                                <td class="d-none d-lg-table-cell text-center">
                                    <span class="badge badge-<?php echo $cor; ?>">
                                        <?php echo $situacaoUser; ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span class="d-none d-md-block">
                                        <?php
                                        if ($this->dados['buttonAcesso']['viewUser']) {
                                            echo "<a href='" . URLADM . "view-info-user/detail-info-user/$id'
                                                class='btn btn-outline-success btn-sm mr-2'>Visualizar
                                             </a>";
                                        }
                                        if ($this->dados['buttonAcesso']['editUser']) {
                                            echo "<a href='" . URLADM . "edit-user/edit-info-user/$id' 
                                                class='btn btn-outline-warning btn-sm mr-2'>Editar
                                             </a>";
                                        }
                                        if ($this->dados['buttonAcesso']['deleteUser']) {
                                            echo "<a href='" . URLADM . "delete-user/remove-user/$id'
                                                class='btn btn-outline-danger btn-sm mr-2'
                                                data-confirm='Tem certeza que deseja apagar usuário ?'>
                                                 Apagar
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
                                            if ($this->dados['buttonAcesso']['viewUser']) {
                                                echo "<a href='" . URLADM . "view-info-user/detail-info-user/$id'
                                                    class='dropdown-item'>Visualizar
                                                 </a>";
                                            }
                                            if ($this->dados['buttonAcesso']['editUser']) {
                                                echo "<a href='" . URLADM . "edit-user/edit-info-user/$id' 
                                                    class='dropdown-item'>Editar
                                                 </a>";
                                            }
                                            if ($this->dados['buttonAcesso']['deleteUser']) {
                                                echo "<a href='" . URLADM . "delete-user/remove-user/$id'
                                                    class='dropdown-item'
                                                    data-confirm='Tem certeza que deseja apagar usuário ?'>
                                                     Apagar
                                                 </a>";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
            <?php
            echo $this->dados['pagination'];
            ?>
        </div>
    </div>
</div>
</div>