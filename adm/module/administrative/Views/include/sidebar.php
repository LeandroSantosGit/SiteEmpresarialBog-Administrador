<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}
?>
<div class="d-flex bd-highlight">
<nav class="sidebar">
    <ul class="list-unstyled">
        <?php
        $contDropdown = 0;
        $controDropFech = 0;
        foreach ($this->dados['menu'] as $menu) {
            extract($menu);
            if ($dropdown == 1) {
                if ($contDropdown != $id_menu) {
                    if (($controDropFech == 1) && ($contDropdown != 0)) {
                        echo "</ul></li>";
                        $controDropFech = 0;
                    }
                    echo "<li>
                        <a href='#submenu" . $id_menu . "' data-toggle='collapse'>
                            <i class='" . $icone_menu . "'></i> " . $nome_menu . "
                        </a>
                        <ul class='list-unstyled collapse' id='submenu" . $id_menu . "'>";
                    $contDropdown = $id_menu;
                }
                echo "<li>
                        <a href='" . URLADM . $pg_controller . "/" . $pg_metodo . "'>
                            <i class='" . $pg_icon . "'></i> " . $pg_nome . "
                        </a>
                    </li>";
                $controDropFech = 1;
            } else {
                if ($controDropFech == 1) {
                    echo "</ul></li>";
                    $controDropFech = 0;
                }
                echo "<li>
                        <a href='" . URLADM . $pg_controller . "/" . $pg_metodo . "'>
                        <i class='" . $icone_menu . "'></i> " . $nome_menu . "</a>
                    </li>";
            }
        }
        if ($controDropFech == 1) {
            echo "</ul></li>";
            $controDropFech = 0;
        }
        ?>
    </ul>
</nav>