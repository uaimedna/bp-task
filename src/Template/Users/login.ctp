<?php $this->layout = 'login'; ?>
<div class="login-box-body animated fadeIn">
    <p class="login-box-msg"><?= __('Sign in to start your session') ?></p>

    <form action="" method="post">
        <div class="form-group has-feedback">
            <?= $this->Form->input('email',['label' => false, 'class' => 'form-control', 'placeholder' => __("Email")]); ?>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            <?= $this->Form->input('password',['label' => false, 'class' => 'form-control', 'placeholder' => __("Password")]); ?>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
            <div class="col-xs-8">
               
            </div>
            <!-- /.col -->
            <div class="col-xs-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat"><?= __('Sign in') ?></button>
            </div>
            <!-- /.col -->
        </div>
    </form>

</div>