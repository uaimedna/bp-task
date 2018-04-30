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
            <h2 style="margin:0;"><?= __('Add Furniture') ?></h2>
        </div>
        <div class="col-md-4">
        </div>
        <div class="col-md-4">
            <?= $this->Html->link('<i class="fa fa-align-center"></i> '.__('List Furniture'), ['action' => 'index'], ['class' => 'btn btn-block btn-primary', 'escape' => false]) ?>
        </div>
    </div>

</section>

<section class="content">
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title"><?= __('Furniture') ?></h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fa fa-times"></i></button>
            </div>
        </div>
        <?= $this->Form->create($furniture, ['type' => 'file']) ?>
            <div class="box-body">
                <div class="form-group">
                    <label><?= __('Name') ?></label>
                    <?= $this->Form->input('name',['label' => false, 'class' => 'form-control']); ?>
                </div>
                <div class="form-group">
                    <label><?= __('Price') ?> (EUR)</label>
                    <?= $this->Form->input('price',['label' => false, 'class' => 'form-control']); ?>
                </div>
                <div class="form-group">
                    <label><?= __('Description') ?></label>
                    <?= $this->Form->input('description',['label' => false, 'class' => 'form-control']); ?>
                </div>
                <div class="form-group">
                    <label><?= __('Discount') ?> (%)</label>
                    <?= $this->Form->input('discount',['label' => false, 'class' => 'form-control', 'value' => 0]); ?>
                </div>
                <div class="form-group">
                    <label><?= __('Priority') ?></label>
                    <?= $this->Form->input('priority',['label' => false, 'class' => 'form-control', 'value' => 0]); ?>
                </div>
                <div class="form-group">
                    <label><?= __('Pictures') ?></label>
                    <?php echo $this->Form->input('furniture_images[]', ['type' => 'file', 'multiple' => true,'label' => false]); ?>

                    <p class="help-block"><?= __('Choose one or more pictures. Supported formats: .png, .jpg') ?></p>
                </div>
            </div>
            <div class="box-footer">
                <?= $this->Form->button(__('Create'),['class' => 'btn btn-success']) ?>
            </div>
        <?= $this->Form->end() ?>
    </div>
</section>
