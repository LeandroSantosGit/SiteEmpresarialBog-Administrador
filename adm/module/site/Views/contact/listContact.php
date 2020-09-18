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
                <h2 class="display-4 titulo">Listar Mensagem de Contato</h2>
            </div>
        </div>
        <?php
        if (empty($this->dados['listContact'])) {
            ?>
            <div class="alert alert-danger" role="alert">
                Nenhuma mensagem de contato encontrado!
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
                        <th class="d-none d-lg-table-cell">Email</th>
                        <th>Assunto</th>
                        <th class="d-none d-lg-table-cell">Data</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($this->dados['listContact'] as $contact) {
                        extract($contact);
                        ?>
                        <tr>
                            <th><?php echo $id; ?></th>
                            <td><?php echo $nome; ?></td>
                            <td class="d-none d-lg-table-cell"><?php echo $email; ?></td>
                            <td><?php echo $assunto; ?></td>
                            <td class="d-none d-lg-table-cell">
                                <?php echo date('d/m/Y H:i', strtotime($created)); ?>
                            </td>
                            <td class="text-center">
                                <span class="d-none d-md-block">
                                    <?php
                                    if ($this->dados['buttonsContact']['viewContact']) {
                                        echo "<a href='" . URLADM . "view-info-contact/detail-info-contact/$id'
                                            class='btn btn-outline-success btn-sm mr-2 mb-2'>Visualizar
                                         </a>";
                                    }
                                    if ($this->dados['buttonsContact']['deleteContact']) {
                                        echo "<a href='" . URLADM . "delete-contact/remove-contact/$id'
                                            class='btn btn-outline-danger btn-sm btn-sm mr-2 mb-2'
                                            data-confirm='Tem certeza que deseja apagar mensagem de contato ?'>
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
                                        if ($this->dados['buttonsContact']['viewContact']) {
                                            echo "<a href='" . URLADM . "view-info-contact/detail-info-contact/$id'
                                                class='dropdown-item'>Visualizar
                                             </a>";
                                        }
                                        if ($this->dados['buttonsContact']['deleteContact']) {
                                            echo "<a href='" . URLADM . "delete-contact/remove-contact/$id'
                                                class='dropdown-item'
                                                data-confirm='Tem certeza que deseja apagar mensagem de contato ?'>
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
                    ?>
                </tbody>
            </table>
            <?php
            echo $this->dados['pagination'];
            ?>
        </div>
    </div>
</div>
