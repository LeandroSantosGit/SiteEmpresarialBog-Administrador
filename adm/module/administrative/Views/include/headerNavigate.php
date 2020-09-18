<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}
?>
<nav class="navbar navbar-expand navbar-dark bg-primary">
    <a class="sidebar-toggle text-light mr-3">
        <span class="navbar-toggler-icon"></span>
    </a>
    <a class="navbar-brand" href="index">Leandro</a>

    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle menu-header"
                   href="#" id="navbarDropdownMenuLink"
                   data-toggle="dropdown">
                    <?php
                    $image = $_SESSION['userImage'];
                    $userId = $_SESSION['userId'];
                    $name = $_SESSION['userName'];
                    if (isset($image) && (!empty($userId))) { ?>
                        <img class="rounded-circle"
                             src="<?php echo URLADM . 'assets/image/user/' . $userId .'/' . $image; ?>"
                             width="30"
                             height="30"
                             alt="Icone usuario">&nbsp;
                        <span class="d-none d-sm-inline">
                    <?php } else { ?>
                        <img class="rounded-circle"
                             src="<?php echo URLADM . 'assets/image/user/icone_usuario.png'; ?>"
                             width="30"
                             height="30"
                             alt="Icone usuario">&nbsp;
                        <span class="d-none d-sm-inline">
                    <?php }
                    $nomeUser = explode(" ", $name);
                    echo $nomeUser[0]; 
                    ?>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right"
                     aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="<?php echo URLADM . 'profile/profile-user'; ?>">
                        <i class="fas fa-user"></i> Perfil
                    </a>
                    <a class="dropdown-item"href="<?php echo URLADM . 'login/logout'; ?>">
                        <i class="fas fa-sign-out-alt"></i> Sair
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>