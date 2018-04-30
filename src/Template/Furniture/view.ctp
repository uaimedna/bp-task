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
            <h2 style="margin:0;"><?= h($furniture->name) ?></h2>
        </div>
        <div class="col-md-4">
        </div>
        <div class="col-md-4">
            <?php if($furniture->status == 0):?>
                <?= $this->Html->link('<i class="fa fa-search"></i> '.__('Set Visible'), ['action' => 'visibility', '?' => ['id' => $furniture->id, 'visible' => true]], ['class' => 'btn btn-block btn-success', 'escape' => false]) ?>
            <?php else: ?>
                <?= $this->Html->link('<i class="fa fa-times-circle-o"></i> '.__('Set Invisible'), ['action' => 'visibility',  '?' => ['id' => $furniture->id, 'visible' => false]], ['class' => 'btn btn-block btn-warning', 'escape' => false]) ?>
            <?php endif; ?>
            <?= $this->Html->link('<i class="fa fa-align-center"></i> '.__('List Furniture'), ['action' => 'index'], ['class' => 'btn btn-block btn-primary', 'escape' => false]) ?>
            <?= $this->Html->link('<i class="fa fa-pencil"></i> '.__('Edit Furniture'), ['action' => 'edit', $furniture->id], ['class' => 'btn btn-block btn-warning', 'escape' => false]) ?>
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
        <div class="box-body">
            <div class="form-group">
                <label><?= __('Pictures') ?></label>
                <div class = "row">
                    <?php foreach ($furniture->files as $file): ?>
                        <div class="col-md-3 col-sm-6">
                            <img class="img-responsive" src="<?= $this->Url->build([
                                "controller" => "Files",
                                "action" => "view",
                                $file->id
                            ]); ?>" alt="Photo" style="margin-top:5px; margin-bottom:5px;">
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="form-group">
                <label><?= __('Name') ?></label>
                <p class="help-block"><?= h($furniture->name) ?></p>
            </div>
            <div class="form-group">
                <label><?= __('Price') ?></label>
                <p class="help-block"><?= h($furniture->price) ?> EUR</p>
            </div>
            <div class="form-group">
                <label><?= __('Discount') ?></label>
                <p class="help-block"><?= h($furniture->discount) ?> %</p>
            </div>
            <div class="form-group">
                <label><?= __('Status') ?></label>
                <p class="help-block">
                    <?php switch($furniture->status):
                        case 0: ?>
                            <span class="label label-warning"><?= __('Not visible') ?></span>
                            <?php break;?>
                        <?php case 1: ?>
                            <span class="label label-success"><?= __('Visible') ?></span>
                            <?php break;?>
                    <?php endswitch;?>
                </p>
            </div>
            <div class="form-group">
                <label><?= __('Priority') ?></label>
                <p class="help-block"><?= h($furniture->priority) ?></p>
            </div>
            <div class="form-group">
                <label><?= __('Description') ?></label>
                <div class="help-block">
                    <?= $this->Text->autoParagraph(h($furniture->description)); ?>
                </div>
            </div>
            <div class="form-group">
                <label><?= __('Created') ?></label>
                <p class="help-block"><?= h($furniture->created) ?></p>
            </div>
            <div class="form-group">
                <label><?= __('Modified') ?></label>
                <p class="help-block"><?= h($furniture->modified) ?></p>
            </div>
        </div>
    </div>
</section>
