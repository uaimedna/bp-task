<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        SlickBOARD | <?= __('Log in') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->Html->css('animate.css') ?>
    <?= $this->Html->meta(
        'icon.png',
        '/img/icon.png',
        ['type' => 'icon']
    );
    ?>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <?= $this->Html->css('AdminLTE.min.css') ?>
    <!-- iCheck -->
    <?= $this->Html->css('plugins/iCheck/square/blue.css') ?>
    <style>
        .hold-transition.login-page{
            background-image:url("<?= $this->Url->image('bg.jpg') ?>");

        }
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo  animated fadeInDown">
        <b>Slick</b>BOARD
    </div>
    <?= $this->fetch('content') ?>
    <?= $this->Flash->render() ?>
    <?= $this->Flash->render('auth') ?>
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<?= $this->Html->script('jquery-2.2.3.min.js') ?>
<!-- Bootstrap 3.3.6 -->
<?= $this->Html->script('bootstrap.min.js') ?>
<!-- iCheck -->
<?= $this->Html->script('icheck.min.js') ?>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
</body>
</html>
