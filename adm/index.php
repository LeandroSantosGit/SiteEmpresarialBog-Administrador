<!DOCTYPE html>
<html lang="pt-br">
<?php

require './config/Config.php';
require './vendor/autoload.php';
        
use Config\ConfigController as Home;
$Url = new Home();
$Url->classLoadPage();
?>
</html>