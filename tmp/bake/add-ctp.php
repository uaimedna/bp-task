<?php
use Cake\Utility\Inflector;

$fields = collection($fields)
->filter(function($field) use ($schema) {
return $schema->columnType($field) !== 'binary';
});
?>
<section class="content-header">
    <h1>
        <CakePHPBakeOpenTag= __('Add New <?= $singularHumanName ?>') CakePHPBakeCloseTag>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<CakePHPBakeOpenTag= $this->Url->build([
                "controller" => "Pages",
                "action" => "dashboard",
            ]); CakePHPBakeCloseTag>"><i class="fa fa-dashboard"></i> <CakePHPBakeOpenTag= __('Home') CakePHPBakeCloseTag></a></li>
        <li><a href="<CakePHPBakeOpenTag= $this->Url->build([
                "action" => "index",
            ]); CakePHPBakeCloseTag>"><CakePHPBakeOpenTag= __(\Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller']))) CakePHPBakeCloseTag></a></li>
        <li class="active"><CakePHPBakeOpenTag= __(\Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action']))) CakePHPBakeCloseTag></li>
    </ol>
    <div class="row">
        <div class="col-md-3">
            <CakePHPBakeOpenTag= $this->Html->link('<i class="fa fa-list" aria-hidden="true"></i> '.__('List of <?= $pluralHumanName ?>'), ['action' => 'index'], ['class' => "btn btn-block btn-primary", 'escape' => false]) CakePHPBakeCloseTag>
        </div>
    </div>
</section>

<section class="content">
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title"><CakePHPBakeOpenTag= __('New <?= $singularHumanName ?>') CakePHPBakeCloseTag></h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fa fa-times"></i></button>
            </div>
        </div>

        <CakePHPBakeOpenTag= $this->Form->create($<?= $singularVar ?>); CakePHPBakeCloseTag>
            <div class="box-body">
                <?php
                foreach ($fields as $field) {
                if (in_array($field, $primaryKey)) {
                continue;
                }

                if (isset($keyFields[$field])) {
                $fieldData = $schema->column($field);
                if (!empty($fieldData['null'])) {
                ?>
                <div class="form-group">
                    <label><CakePHPBakeOpenTag= $this->Form->label(__('<?= $field ?>')); CakePHPBakeCloseTag></label>
                    <CakePHPBakeOpenTag= $this->Form->input('<?= $field ?>', ['label' => false, 'class' => 'form-control', 'options' => $<?= $keyFields[$field] ?>, 'empty' => true]) CakePHPBakeCloseTag>
                </div>
                <?php
                } else {
                ?>
                <div class="form-group">
                    <label><CakePHPBakeOpenTag= $this->Form->label(__('<?= $field ?>')); CakePHPBakeCloseTag></label>
                    <CakePHPBakeOpenTag= $this->Form->input('<?= $field ?>', ['label' => false, 'class' => 'form-control', 'options' => $<?= $keyFields[$field] ?>]) CakePHPBakeCloseTag>
                </div>
                <?php
                }
                continue;
                }
                if (!in_array($field, ['created', 'modified', 'updated'])) {
                $fieldData = $schema->column($field);
                if (($fieldData['type'] === 'date') && (!empty($fieldData['null']))) {
                ?>
                <div class="form-group">
                    <label><CakePHPBakeOpenTag= $this->Form->label(__('<?= $field ?>')); CakePHPBakeCloseTag></label>
                    <CakePHPBakeOpenTag= $this->Form->input('<?= $field ?>', ['label' => false, 'class' => 'form-control', 'empty' => true, 'default' => '']) CakePHPBakeCloseTag>
                </div>
                <?php
                } else {
                ?>
                <div class="form-group">
                    <label><CakePHPBakeOpenTag= $this->Form->label(__('<?= $field ?>')); CakePHPBakeCloseTag></label>
                    <?php
                    $class = "form-control";
                    if ($fieldData['type'] === 'boolean') {
                    $class = "custom-checkbox";

                    ?>
                    <div class="i-checks">
                        <?php
                        }
                        ?>
                        <CakePHPBakeOpenTag= $this->Form->input('<?= $field ?>', ['label' => false, 'class' => '<?= $class ?>']) CakePHPBakeCloseTag>
                        <?php
                        if ($fieldData['type'] === 'boolean') {
                        ?>
                    </div>
                    <?php
                    }
                    ?>
                </div>
                <?php
                }
                }
                }

                if (!empty($associations['BelongsToMany'])) {
                foreach ($associations['BelongsToMany'] as $assocName => $assocData) {
                ?>
                <div class="form-group">
                    <label><CakePHPBakeOpenTag= $this->Form->label(__('<?= $assocData['property'] ?>._ids')); CakePHPBakeCloseTag></label>
                    <CakePHPBakeOpenTag= $this->Form->input('<?= $assocData['property'] ?>._ids', ['options' => $<?= $assocData['variable'] ?>, 'empty' => true, 'label' => false, 'class' => 'form-control']) CakePHPBakeCloseTag>
                </div>
                <?php
                }
                }
                ?>

            </div>

            <div class="box-footer">
                <CakePHPBakeOpenTag= $this->Form->button(__('Create'),['class' => 'btn btn-success']) CakePHPBakeCloseTag>
                <CakePHPBakeOpenTag= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-warning']) CakePHPBakeCloseTag>
            </div>
        <CakePHPBakeOpenTag= $this->Form->end() CakePHPBakeCloseTag>
    </div>
</section>

<CakePHPBakeOpenTagphp $this->start('script') CakePHPBakeCloseTag>
    <script>
        $(document).ready(function () {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>
<CakePHPBakeOpenTagphp $this->end() CakePHPBakeCloseTag>

