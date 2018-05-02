<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        SlickBOARD
    </title>
    <?= $this->Html->meta(
        'icon.png',
        '/img/icon.png',
        ['type' => 'icon']
    );
    ?>

    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <?= $this->Html->css('AdminLTE.min.css') ?>
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <?= $this->Html->css('skins/_all-skins.min.css') ?>
    <!-- iCheck -->
    <?= $this->Html->css('plugins/iCheck/flat/blue.css') ?>
    <!-- Morris chart -->
    <?= $this->Html->css('plugins/morris/morris.css') ?>
    <!-- jvectormap -->
    <?= $this->Html->css('plugins/jvectormap/jquery-jvectormap-1.2.2.css') ?>
    <!-- Date Picker -->
    <?= $this->Html->css('plugins/datepicker/datepicker3.css') ?>
    <!-- Daterange picker -->
    <?= $this->Html->css('plugins/daterangepicker/daterangepicker.css') ?>
    <!-- bootstrap wysihtml5 - text editor -->
    <?= $this->Html->css('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') ?>

    <?= $this->Html->css('main_admin.css') ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="index2.html" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>S</b>BD</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Slick</b>BOARD</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav language">
                    <!-- User Account: style can be found in dropdown.less -->
                    <li>
                        <a href="<?= $this->Url->build([
                            "controller" => "Pages",
                            "action" => "locale",
                            'en'
                        ]); ?>" style="<?php if($locale != 'en'):?> color:#bfbfbf; <?php else: ?> background: #337ab7; <?php endif; ?>">
                            EN
                        </a>
                    </li>
                    <li>
                        <a href="<?= $this->Url->build([
                            "controller" => "Pages",
                            "action" => "locale",
                            'lt'
                        ]); ?>" style="<?php if($locale != 'lt'):?> color:#bfbfbf; <?php else: ?> background: #337ab7; <?php endif; ?> margin-right: 5px; ">
                            LT
                        </a>
                    </li>

                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-user"></i>
                            <span ><?= $this->request->session()->read('Auth.User')['name'] ?> <?= $this->request->session()->read('Auth.User')['last_name'] ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="user-footer">
                                <?= $this->Html->link(__('Change password'), ['controller' => 'Users', 'action' => 'changePassword'], ['class' => '']) ?>
                                <?= $this->Html->link(__('Sign out'), ['controller' => 'Users', 'action' => 'logout'], ['class' => '']) ?>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <ul class="sidebar-menu" id="sidebar-list">
                <li class="header"><?= __('NAVIGATION') ?></li>
                <li data-link-match="dashboard">
                    <a href="<?= $this->Url->build([
                        "controller" => "Videos",
                        "action" => "index"
                    ]); ?>">
                        <i class="fa fa-youtube"></i> <span><?= __('Videos') ?></span>
                    </a>
                </li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="content-header">
            <div class="row">
                <div class="col-md-12">
                    <?= $this->Flash->render() ?>
                </div>
            </div>
        </section>
        <?= $this->fetch('content') ?>
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b><?= __('Version') ?></b>: 1.0
        </div>
        <strong><?= __('Created and maintained by:') ?> <a href="https://www.linkedin.com/in/justas-sakalauskas-9bab32111">Justas Sakalauskas</a></strong>
    </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<?= $this->Html->script('jquery-2.2.3.min.js') ?>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<?= $this->Html->script('bootstrap.min.js') ?>
<!-- AdminLTE App -->
<?= $this->Html->script('app.min.js') ?>
<script>

    $(document).ready(function(){
        highlightMenuItem();
    });

    function highlightMenuItem(){
        var path = window.location.pathname.toLowerCase();
        $("#sidebar-list").find("li").each(function(idx, li) {
            var listItem = $(li);
            var itemLinkMatch = listItem.data("link-match");
            if(itemLinkMatch){
                itemLinkMatch = listItem.data("link-match").toLowerCase();
                if(path.indexOf(itemLinkMatch) != -1){
                    listItem.addClass("active");
                }
            }
        });
    }

</script>
</body>
</html>