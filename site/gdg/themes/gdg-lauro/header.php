<?php defined( 'ABSPATH' ) or die; ?><!DOCTYPE html>
<html lang="pt-BR" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo gdg_get_page_title(); ?></title>
    <!-- The compiled CSS file -->
    <link rel="stylesheet" href="<?php echo THEME_PATH; ?>css/production.css">
    <!-- Web fonts -->
    <link href="https://fonts.googleapis.com/css?family=Space+Mono:400,700" rel="stylesheet">
    <?php wp_head(); ?>
    <style type="text/css">
        .alert {
            margin-top: 20px;
        }
        .alert-danger {
            color: red;
        }
        .alert-success {
            color: green;
        }
        .alert-warning {
            color: orange;
        }
    </style>
</head>
<body <?php body_class(); ?>>
<!-- Create outer border -->
<div class="page-border"><div class="bg--white">

<!-- Header -->
<header class="align--center pt3 pb2">
    <div class="container">
        <h1 class="mb3" title="Huddle" id="event-logo"><img src="<?php echo get_theme_mod( 'logo' ); ?>" alt="Huddle" style="max-width: 400px;"></h1>
        <h2 class="mb3" id="titulo-evento"><?php echo get_theme_mod( 'titulo_evento' ); ?></h2>
        <p class="mb1" id="data-evento"><?php echo get_theme_mod( 'data_evento' ); ?></p>
        <p id="local-evento"><?php echo get_theme_mod( 'local_evento' ); ?></p>
    </div>
</header>
