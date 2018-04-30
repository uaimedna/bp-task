<?php $this->layout = 'main'; ?>
<style>
    .col-md-4{
        margin-top:10px;
        margin-bottom:10px;
    }
</style>
<section class="content-header">
    <div class="row">
        <div class="col-md-4">
            <h2 style="margin:0;">
                <?= __('Change password') ?>
            </h2>
        </div>
        <div class="col-md-8">
        </div>
    </div>

</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">
                <?= __('Change password') ?>
            </h3>
        </div>
        <?= $this->Form->create(null) ?>
            <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputEmail1"><?= __('Current password') ?></label>
                    <?= $this->Form->input('current_pass',['label' => false, 'class' => 'form-control', 'id' => 'exampleInputPassword0' , 'placeholder' => __('Current password'), 'type' => 'password']); ?>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1"><?= __('New password') ?></label>
                    <?= $this->Form->input('new_pass',['label' => false, 'class' => 'form-control', 'id' => 'exampleInputPassword1' , 'placeholder' => __('New password'), 'type' => 'password']); ?>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword2"><?= __('Confirm new password') ?></label>
                    <?= $this->Form->input('new_pass_confirm',['label' => false, 'class' => 'form-control', 'id' => 'exampleInputPassword2' , 'placeholder' => __('Confirm new password'), 'type' => 'password']); ?>
                </div>
            </div>
            <div class="box-footer">
                <?= $this->Form->button(__('Save'),['class' => 'btn btn-primary']) ?>
            </div>
        <?= $this->Form->end(); ?>
    </div>
</section>