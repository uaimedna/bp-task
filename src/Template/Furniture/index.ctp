<style>
    .col-md-4{
        margin-top:10px;
        margin-bottom:10px;
    }
</style>
<section class="content-header">
    <div class="row">
        <div class="col-md-4">
            <h2 style="margin:0;"><?= __('Furniture') ?></h2>
        </div>
        <div class="col-md-4">
        </div>
        <div class="col-md-4">
            <?= $this->Html->link('<i class="fa fa-plus" aria-hidden="true"></i> '.__('New Furniture'), ['action' => 'add'], ['class' => "btn btn-block btn-success", 'escape' => false]) ?>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"><?= __('Furniture list') ?></h3>

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
                        <th><?= $this->Paginator->sort('name', __('Name') ) ?></th>
                        <th><?= $this->Paginator->sort('price', __('Price') ) ?></th>
                        <th><?= $this->Paginator->sort('discount', __('Discount')) ?></th>
                        <th><?= $this->Paginator->sort('status', __('Status')) ?></th>
                        <th><?= $this->Paginator->sort('priority', __('Priority')) ?></th>
                        <th><?= $this->Paginator->sort('created', __('Created')) ?></th>
                        <th><?= $this->Paginator->sort('modified', __('Modified')) ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($furniture as $furniture): ?>
                    <tr>
                        <td><?= h($furniture->name) ?></td>
                        <td><?= $this->Number->format($furniture->price) ?> EUR</td>
                        <td><?= $this->Number->format($furniture->discount) ?> %</td>
                        <td>
                            <?php switch($furniture->status):
                                case 0: ?>
                                    <span class="label label-warning"><?= __('Not visible') ?></span>
                                <?php break;?>
                                <?php case 1: ?>
                                    <span class="label label-success"><?= __('Visible') ?></span>
                                <?php break;?>
                            <?php endswitch;?>
                        </td>
                        <td><?= h($furniture->priority) ?></td>
                        <td><?= h($furniture->created) ?></td>
                        <td><?= h($furniture->modified) ?></td>
                        <td class="actions">
                            <div class="btn-group">
                                <?= $this->Html->link(__('View'), ['action' => 'view', $furniture->id],['class' => 'btn btn-success btn-sm']) ?>
                                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $furniture->id],['class' => 'btn btn-warning btn-sm']) ?>
                                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $furniture->id], ['class' => 'btn btn-danger btn-sm', 'confirm' => __("Are you sure you want to delete")." '".$furniture->name."'?"]) ?>

                            </div>
                        </td>
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
    <!-- /.box -->
</section>
