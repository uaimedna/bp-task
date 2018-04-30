<?php
use Cake\Utility\Inflector;

$fields = collection($fields)
    ->filter(function($field) use ($schema) {
        return !in_array($schema->columnType($field), ['binary', 'text']);
    })
    ->take(15);
?>

<section class="content-header">
    <h1>
        <CakePHPBakeOpenTag= __('List of <?= $pluralHumanName ?>') CakePHPBakeCloseTag>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<CakePHPBakeOpenTag= $this->Url->build([
                "controller" => "Pages",
                "action" => "dashboard",
            ]); CakePHPBakeCloseTag>"><i class="fa fa-dashboard"></i> <CakePHPBakeOpenTag= __('Home') CakePHPBakeCloseTag></a></li>
        <li><a href="#"><CakePHPBakeOpenTag= __(\Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller']))) CakePHPBakeCloseTag></a></li>
        <li class="active"><CakePHPBakeOpenTag= __(\Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action']))) CakePHPBakeCloseTag></li>
    </ol>
    <div class="row">
        <div class="col-md-3">
            <CakePHPBakeOpenTag= $this->Html->link('<i class="fa fa-plus" aria-hidden="true"></i> '.__('Add New <?= $singularHumanName ?>'), ['action' => 'add'], ['class' => "btn btn-block btn-success", 'escape' => false]) CakePHPBakeCloseTag>
        </div>
    </div>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><CakePHPBakeOpenTag= __('List of <?= $pluralHumanName ?>') CakePHPBakeCloseTag></h3>

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
                    <?php foreach ($fields as $field): ?>
                    <th><CakePHPBakeOpenTag= $this->Paginator->sort('<?= $field ?>') CakePHPBakeCloseTag></th>
                    <?php endforeach; ?>
                    <th class="actions centered"></th>
                </tr>
                </thead>
                <tbody>
                <CakePHPBakeOpenTagphp foreach ($<?= $pluralVar ?> as $<?= $singularVar ?>): CakePHPBakeCloseTag>
                <tr>
                    <?php        foreach ($fields as $field) {
                    $isKey = false;
                    if (!empty($associations['BelongsTo'])) {
                    foreach ($associations['BelongsTo'] as $alias => $details) {
                    if ($field === $details['foreignKey']) {
                    $isKey = true;
                    ?>
                    <td>
                        <CakePHPBakeOpenTag= $<?= $singularVar ?>->has('<?= $details['property'] ?>') ? $this->Html->link($<?= $singularVar ?>-><?= $details['property'] ?>-><?= $details['displayField'] ?>, ['controller' => '<?= $details['controller'] ?>', 'action' => 'view', $<?= $singularVar ?>-><?= $details['property'] ?>-><?= $details['primaryKey'][0] ?>]) : '' CakePHPBakeCloseTag>
                    </td>
                    <?php
                    break;
                    }
                    }
                    }
                    if ($isKey !== true) {
                    if (!in_array($schema->columnType($field), ['integer', 'biginteger', 'decimal', 'float'])) {
                    ?>
                    <td><CakePHPBakeOpenTag= h($<?= $singularVar ?>-><?= $field ?>) CakePHPBakeCloseTag></td>
                    <?php
                    } else {
                    ?>
                    <td><CakePHPBakeOpenTag= $this->Number->format($<?= $singularVar ?>-><?= $field ?>) CakePHPBakeCloseTag></td>
                    <?php
                    }
                    }
                    }

                    $pk = '$' . $singularVar . '->' . $primaryKey[0];
                    ?>
                    <td class="actions">
                        <div class="btn-group">
                            <CakePHPBakeOpenTag= $this->Html->link(__('View'), ['action' => 'view', <?= $pk ?>],['class' => 'btn btn-success btn-sm']) CakePHPBakeCloseTag>
                            <CakePHPBakeOpenTag= $this->Html->link(__('Edit'), ['action' => 'edit', <?= $pk ?>],['class' => 'btn btn-warning btn-sm']) CakePHPBakeCloseTag>
                            <CakePHPBakeOpenTag= $this->Form->postLink(__('Delete'), ['action' => 'delete', <?= $pk ?>], ['class' => 'btn btn-danger btn-sm', 'confirm' => __("Are you sure you want to delete")." #".<?= $pk ?>."?"]) CakePHPBakeCloseTag>
                        </div>
                    </td>

                </tr>
                <CakePHPBakeOpenTagphp endforeach; CakePHPBakeCloseTag>
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <div class="box-tools">
                <ul class="pagination pagination-sm no-margin pull-right">
                    <CakePHPBakeOpenTag= $this->Paginator->prev('&laquo',['escape' => false]) CakePHPBakeCloseTag>
                    <CakePHPBakeOpenTag= $this->Paginator->numbers() CakePHPBakeCloseTag>
                    <CakePHPBakeOpenTag= $this->Paginator->next('&raquo',['escape' => false]) CakePHPBakeCloseTag>
                </ul>
            </div>
        </div>
        <!-- /.box-footer-->
    </div>
</section>