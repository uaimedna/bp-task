
<section class="content-header">
    <h1>
        <?= __('List of Videos') ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $this->Url->build([
                "controller" => "Pages",
                "action" => "dashboard",
            ]); ?>"><i class="fa fa-dashboard"></i> <?= __('Home') ?></a></li>
        <li><a href="#"><?= __(\Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller']))) ?></a></li>
        <li class="active"><?= __(\Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action']))) ?></li>
    </ol>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?= __('List of Videos') ?></h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th><?= $this->Paginator->sort('video_id') ?></th>
                    <th><?= $this->Paginator->sort('tags') ?></th>
                    <th><?= $this->Paginator->sort('performanse_rating') ?></th>
                    <th class="actions centered"></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($videos as $video): ?>
                <tr>
                    <td><?= h($video->video_id) ?></td>
                    <td><?= h($video->tags) ?></td>
                    <td><?= $this->Number->format($video->performanse_rating) ?></td>

                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <div class="box-tools">
                <ul class="pagination pagination-sm no-margin pull-right">
                    <?= $this->Paginator->prev('&laquo',['escape' => false]) ?>
                    <?= $this->Paginator->numbers() ?>
                    <?= $this->Paginator->next('&raquo',['escape' => false]) ?>
                </ul>
            </div>
        </div>
        <!-- /.box-footer-->
    </div>
</section>