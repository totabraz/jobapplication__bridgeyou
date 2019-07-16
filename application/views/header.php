<!DOCTYPE html>
<html lang="pt_br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test-BridgeYou</title>

    <link href="<?php echo base_url('dist/vendors-external/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">

    <script src="<?php echo base_url('dist/vendors/jquery/js/jquery.js') ?>"></script>
    <link href="<?php echo base_url('dist/css/style.css'); ?>" rel="stylesheet">
    <script src="https://kit.fontawesome.com/e17768bfd2.js"></script>
</head>

<body>
    <header class="main-header">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 flex-row -space-between">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <div class="brand-header flex-row -center">
                            <div class="huge-icon">
                                <i class="fas fa-question-circle"></i>
                            </div>
                            <h1 class="title">
                                <?php
                                if (isset($page_title)) echo $page_title;
                                else "Venturus Sports"; ?>
                            </h1>
                        </div>
                    </div>
                    <nav class="navbar navbar-right">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="avatar">
                                <p id="initials" class="-initials"></p>
                            </li>
                            <li class="">
                                <a href="#" class="" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span id="name-nav-dropdown">Perfil</span> <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Friends List</a></li>
                                    <li><a href="#">Saved Items</a></li>
                                    <li><a href="#">Notifications</a></li>
                                    <li><a href="#">User Preferences</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>



    <div class="breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <a class="breadcrumb-item" href="<?php echo base_url() ?>">
                        <i class="fas fa-home"></i>
                    </a>
                    <?php if (isset($breadcrumb)) {
                        for ($i = 0; $i < sizeof($breadcrumb); $i++) {
                            $title = (isset($breadcrumb['titles'][$i])) ? $breadcrumb['titles'][$i] : '';
                            $link = (isset($breadcrumb['links'][$i])) ? 'href="' . base_url($breadcrumb['links'][$i]) . '"' : '';
                            ?>
                            <a class="breadcrumb-item" <?php echo $link ?>>
                                <?php echo $title ?>
                            </a>
                        <?php   }
                    } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="linearcards">
        <div class="container">
            <div class="row">
                <div class="-card col-xs-12 col-sm-6 col-md-3">
                    <div class="huge-icon">
                        <i class="fas fa-puzzle-piece"></i>
                    </div>
                    <div class="-vertival-info">
                        <p class="-subtitle">Sport type</p>
                        <p class="-title"><strong>Cycling</strong></p>
                    </div>
                </div>
                <div class="-card col-xs-12 col-sm-6 col-md-3">
                    <div class="huge-icon">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <div class="-vertival-info">
                        <p class="-subtitle">Mode</p>
                        <p class="-title"><strong>Advanced</strong></p>
                    </div>
                </div>
                <div class="-card col-xs-12 col-sm-6 col-md-3">
                    <div class="huge-icon">
                        <i class="fas fa-map-signs"></i>
                    </div>
                    <div class="-vertival-info">
                        <p class="-subtitle">Route</p>
                        <p class="-title"><strong>30 miles</strong></p>
                    </div>
                </div>
                </section>
            </div>
        </div>
    </div>