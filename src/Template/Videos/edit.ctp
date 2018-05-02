<section class="content-header">
    <h1>
        <?= __('Edit Video') ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $this->Url->build([
                "controller" => "Pages",
                "action" => "dashboard",
            ]); ?>"><i class="fa fa-dashboard"></i> <?= __('Home') ?></a></li>
        <li><a href="<?= $this->Url->build([
                "action" => "index",
            ]); ?>"><?= __(\Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller']))) ?></a></li>
        <li class="active"><?= __(\Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action']))) ?></li>
    </ol>
    <div class="row">
        <div class="col-md-3">
            <?= $this->Html->link('<i class="fa fa-list" aria-hidden="true"></i> '.__('List of Videos'), ['action' => 'index'], ['class' => "btn btn-block btn-primary", 'escape' => false]) ?>
        </div>
    </div>
</section>

<section class="content">
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title"><?= __('Edit Video') ?></h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fa fa-times"></i></button>
            </div>
        </div>

        <?= $this->Form->create($video); ?>
        <div class="box-body">
                        <div class="form-group">
                <label><?= $this->Form->label(__('video_id')); ?></label>
                                    <?= $this->Form->input('video_id', ['label' => false, 'class' => 'form-control']) ?>
                                </div>
                        <div class="form-group">
                <label><?= $this->Form->label(__('channel_id')); ?></label>
                                    <?= $this->Form->input('channel_id', ['label' => false, 'class' => 'form-control']) ?>
                                </div>
                        <div class="form-group">
                <label><?= $this->Form->label(__('tags')); ?></label>
                                    <?= $this->Form->input('tags', ['label' => false, 'class' => 'form-control']) ?>
                                </div>
                        <div class="form-group">
                <label><?= $this->Form->label(__('performanse_rating')); ?></label>
                                    <?= $this->Form->input('performanse_rating', ['label' => false, 'class' => 'form-control']) ?>
                                </div>
            
        </div>

        <div class="box-footer">
            <?= $this->Form->button(__('Save'),['class' => 'btn btn-success']) ?>
                <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-warning']) ?>
        </div>
        <?= $this->Form->end() ?>
    </div>
</section>

<?php $this->start('script') ?>
    <script>
        $(document).ready(function () {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>
<?php $this->end() ?>

