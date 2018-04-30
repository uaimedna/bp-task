<%
use Cake\Utility\Inflector;

$fields = collection($fields)
->filter(function($field) use ($schema) {
return $schema->columnType($field) !== 'binary';
});
%>
<section class="content-header">
    <h1>
        <?= __('Edit <%= $singularHumanName %>') ?>
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
            <?= $this->Html->link('<i class="fa fa-list" aria-hidden="true"></i> '.__('List of <%= $pluralHumanName %>'), ['action' => 'index'], ['class' => "btn btn-block btn-primary", 'escape' => false]) ?>
        </div>
    </div>
</section>

<section class="content">
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title"><?= __('Edit <%= $singularHumanName %>') ?></h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fa fa-times"></i></button>
            </div>
        </div>

        <?= $this->Form->create($<%= $singularVar %>); ?>
        <div class="box-body">
            <%
            foreach ($fields as $field) {
            if (in_array($field, $primaryKey)) {
            continue;
            }

            if (isset($keyFields[$field])) {
            $fieldData = $schema->column($field);
            if (!empty($fieldData['null'])) {
            %>
            <div class="form-group">
                <label><?= $this->Form->label(__('<%= $field %>')); ?></label>
                <?= $this->Form->input('<%= $field %>', ['label' => false, 'class' => 'form-control', 'options' => $<%= $keyFields[$field] %>, 'empty' => true]) ?>
            </div>
            <%
            } else {
            %>
            <div class="form-group">
                <label><?= $this->Form->label(__('<%= $field %>')); ?></label>
                <?= $this->Form->input('<%= $field %>', ['label' => false, 'class' => 'form-control', 'options' => $<%= $keyFields[$field] %>]) ?>
            </div>
            <%
            }
            continue;
            }
            if (!in_array($field, ['created', 'modified', 'updated'])) {
            $fieldData = $schema->column($field);
            if (($fieldData['type'] === 'date') && (!empty($fieldData['null']))) {
            %>
            <div class="form-group">
                <label><?= $this->Form->label(__('<%= $field %>')); ?></label>
                <?= $this->Form->input('<%= $field %>', ['label' => false, 'class' => 'form-control', 'empty' => true, 'default' => '']) ?>
            </div>
            <%
            } else {
            %>
            <div class="form-group">
                <label><?= $this->Form->label(__('<%= $field %>')); ?></label>
                <%
                $class = "form-control";
                if ($fieldData['type'] === 'boolean') {
                $class = "custom-checkbox";

                %>
                <div class="i-checks">
                    <%
                    }
                    %>
                    <?= $this->Form->input('<%= $field %>', ['label' => false, 'class' => '<%= $class %>']) ?>
                    <%
                    if ($fieldData['type'] === 'boolean') {
                    %>
                </div>
                <%
                }
                %>
            </div>
            <%
            }
            }
            }

            if (!empty($associations['BelongsToMany'])) {
            foreach ($associations['BelongsToMany'] as $assocName => $assocData) {
            %>
            <div class="form-group">
                <label><?= $this->Form->label(__('<%= $assocData['property'] %>._ids')); ?></label>
                <?= $this->Form->input('<%= $assocData['property'] %>._ids', ['options' => $<%= $assocData['variable'] %>, 'empty' => true, 'label' => false, 'class' => 'form-control']) ?>
            </div>
            <%
            }
            }
            %>

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

