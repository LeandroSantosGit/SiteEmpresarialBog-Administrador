<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php
        if (!empty($this->dados['seo'][0])) {
            extract($this->dados['seo'][0]);
            echo "<title>$titulo</title>
                <meta name='tobots' content='$tipo_rob'>
                <meta name='description' content='$description'>
                <meta name='author' content='$author'>
                <link rel='canonical' href='" . URL . "$endereco'>
                <meta name='keywords' content='$keywords'>
                <meta property='og:site_name' content='$og_site_name'>
                <meta property='og:locale' content='$og_locale'>
                <meta property='fb:admins' content='$fb_admins'>
                <meta property='og:url' content='" . URL . "$endereco'>
                <meta property='og:title' content='$titulo'>
                <meta property='og:description' content='$description'>
                <meta property='og:image' content='" . URL . "assets/images/$dirImage/$id/$imagem'>
                <meta name='twitter:site' content='$twitter_site'>
                <meta name='twitter:card' content='summary_large_image'>
                <meta name='twitter:title' content='$titulo'>
                <meta name='twitter:description' content='$description'>
                <meta name='twitter:image:src' content='" . URL . "assets/images/$dirImage/$id/$imagem'>";
        }
        ?>
        <link rel="icon" href="<?php echo URL; ?>assets/images/icon/favicon.ico">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo URL; ?>assets/css/ionicons.min.css">
	<link rel="stylesheet" href="<?php echo URL; ?>assets/css/style.css">
    <body>
