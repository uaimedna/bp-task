
<section class="content-header">
    <h1>
        <?= __('View Videos') ?>
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
            <h3 class="box-title"><?= __('Video') ?></h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body">
                                    <div class="form-group">
                                <label><?= __('Video Id') ?>:</label>
                <p><?= h($video->video_id) ?></p>
                            </div>
                        <div class="form-group">
                                <label><?= __('Channel Id') ?>:</label>
                <p><?= h($video->channel_id) ?></p>
                            </div>
                        <div class="form-group">
                                <label><?= __('Tags') ?>:</label>
                <p><?= h($video->tags) ?></p>
                            </div>
                                                            <div class="form-group">
                <label><?= __('Id') ?>:</label>
                <p><?= $this->Number->format($video->id) ?></p>
            </div>
                        <div class="form-group">
                <label><?= __('Performanse Rating') ?>:</label>
                <p><?= $this->Number->format($video->performanse_rating) ?></p>
            </div>
                                                            <div class="form-group">
                <label><?= __('Created') ?>:</label>
                <p><?= h($video->created) ?></p>
            </div>
                        <div class="form-group">
                <label><?= __('Modified') ?>:</label>
                <p><?= h($video->modified) ?></p>
            </div>
                                                        </div>
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