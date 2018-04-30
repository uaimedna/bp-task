<?php
use Cake\Utility\Inflector;

$fields = collection($fields)
    ->filter(function($field) use ($schema) {
        return $schema->columnType($field) !== 'binary';
    });
?>
<div class="row wrapper border-bottom white-bg page-heading">
<?php if (strpos($action, 'add') === false): ?>
    <div class="col-sm-5">
        <h2><CakePHPBakeOpenTag= __('Edit <?= $singularHumanName ?>') CakePHPBakeCloseTag></h2>
        <ol class="breadcrumb">
            <li><CakePHPBakeOpenTag= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller'])) CakePHPBakeCloseTag></li>
            <li class="active"><strong><CakePHPBakeOpenTag= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) CakePHPBakeCloseTag></strong></li>
        </ol>
    </div>
    <div class="col-sm-7">
        <div class="title-action">
            <div class="btn-group btn-group-justified btn-actions">
                <div class="btn-group">
                    <CakePHPBakeOpenTag= $this->Html->link('<i class="fa fa-list"></i>' . ' ' . __('List of <?= $pluralHumanName ?>'), ['action' => 'index'], ['class' => 'btn btn-sm btn-primary', 'escape' => false]) CakePHPBakeCloseTag>
                </div>
                <div class="btn-group">
                    <CakePHPBakeOpenTag=
                    $this->Form->postLink(
                        __('Delete'),
                        ['action' => 'delete', $<?= $singularVar ?>-><?= $primaryKey[0] ?>],
                        ['class' => 'btn btn-sm btn-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $<?= $singularVar ?>-><?= $primaryKey[0] ?>)]
                    )
                    CakePHPBakeCloseTag>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="col-sm-8">
        <h2><CakePHPBakeOpenTag= __('Add New <?= $singularHumanName ?>') CakePHPBakeCloseTag></h2>
        <ol class="breadcrumb">
            <li><CakePHPBakeOpenTag= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller'])) CakePHPBakeCloseTag></li>
            <li class="active"><strong><CakePHPBakeOpenTag= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) CakePHPBakeCloseTag></strong></li>
        </ol>
    </div>
    <div class="col-sm-4">
        <div class="title-action">
            <div class="btn-group btn-group-justified btn-actions">
                <div class="btn-group">
                    <CakePHPBakeOpenTag= $this->Html->link('<i class="fa fa-list"></i>' . ' ' . __('List of <?= $pluralHumanName ?>'), ['action' => 'index'], ['class' => 'btn btn-sm btn-primary', 'escape' => false]) CakePHPBakeCloseTag>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox">
        <div class="ibox-content">
            <div class="row">
                <div class="col-lg-12">
                    <CakePHPBakeOpenTag= $this->Form->create($<?= $singularVar ?>, ['class' => 'form-horizontal style-form']); CakePHPBakeCloseTag>
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
                        <label class="col-sm-2 control-label"><CakePHPBakeOpenTag= $this->Form->label(__('<?= $field ?>')); CakePHPBakeCloseTag></label>
                        <div class="col-sm-10">
                            <CakePHPBakeOpenTag= $this->Form->input('<?= $field ?>', ['label' => false, 'class' => 'form-control', 'options' => $<?= $keyFields[$field] ?>, 'empty' => true]) CakePHPBakeCloseTag>
                        </div>
                    </div>
<?php
            } else {
?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><CakePHPBakeOpenTag= $this->Form->label(__('<?= $field ?>')); CakePHPBakeCloseTag></label>
                        <div class="col-sm-10">
                            <CakePHPBakeOpenTag= $this->Form->input('<?= $field ?>', ['label' => false, 'class' => 'form-control', 'options' => $<?= $keyFields[$field] ?>]) CakePHPBakeCloseTag>
                        </div>
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
                        <label class="col-sm-2 control-label"><CakePHPBakeOpenTag= $this->Form->label(__('<?= $field ?>')); CakePHPBakeCloseTag></label>
                        <div class="col-sm-10">
                            <CakePHPBakeOpenTag= $this->Form->input('<?= $field ?>', ['label' => false, 'class' => 'form-control', 'empty' => true, 'default' => '']) CakePHPBakeCloseTag>
                        </div>
                    </div>
<?php
            } else {
?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><CakePHPBakeOpenTag= $this->Form->label(__('<?= $field ?>')); CakePHPBakeCloseTag></label>
                        <div class="col-sm-10">
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
                    </div>
<?php
            }
        }
    }

    if (!empty($associations['BelongsToMany'])) {
        foreach ($associations['BelongsToMany'] as $assocName => $assocData) {
?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><CakePHPBakeOpenTag= $this->Form->label(__('<?= $assocData['property'] ?>._ids')); CakePHPBakeCloseTag></label>
                        <div class="col-sm-10">
                            <CakePHPBakeOpenTag= $this->Form->input('<?= $assocData['property'] ?>._ids', ['options' => $<?= $assocData['variable'] ?>, 'empty' => true, 'label' => false, 'class' => 'form-control']) CakePHPBakeCloseTag>
                        </div>
                    </div>
<?php
        }
    }
?>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <CakePHPBakeOpenTag= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-sm btn-danger']) CakePHPBakeCloseTag>
                            <CakePHPBakeOpenTag= $this->Form->button(__('Submit'), ['class' => 'btn btn-sm btn-primary']) CakePHPBakeCloseTag>
                        </div>
                    </div>
                    <CakePHPBakeOpenTag= $this->Form->end() CakePHPBakeCloseTag>
                </div>
            </div>
        </div>
    </div>
</div>

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
