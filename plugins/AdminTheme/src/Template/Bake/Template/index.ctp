<%
use Cake\Utility\Inflector;

$fields = collection($fields)
    ->filter(function($field) use ($schema) {
        return !in_array($schema->columnType($field), ['binary', 'text']);
    })
    ->take(15);
%>

<section class="content-header">
    <h1>
        <?= __('List of <%= $pluralHumanName %>') ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $this->Url->build([
                "controller" => "Pages",
                "action" => "dashboard",
            ]); ?>"><i class="fa fa-dashboard"></i> <?= __('Home') ?></a></li>
        <li><a href="#"><?= __(\Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller']))) ?></a></li>
        <li class="active"><?= __(\Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action']))) ?></li>
    </ol>
    <div class="row">
        <div class="col-md-3">
            <?= $this->Html->link('<i class="fa fa-plus" aria-hidden="true"></i> '.__('Add New <%= $singularHumanName %>'), ['action' => 'add'], ['class' => "btn btn-block btn-success", 'escape' => false]) ?>
        </div>
    </div>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?= __('List of <%= $pluralHumanName %>') ?></h3>

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
                    <% foreach ($fields as $field): %>
                    <th><?= $this->Paginator->sort('<%= $field %>') ?></th>
                    <% endforeach; %>
                    <th class="actions centered"></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($<%= $pluralVar %> as $<%= $singularVar %>): ?>
                <tr>
                    <%        foreach ($fields as $field) {
                    $isKey = false;
                    if (!empty($associations['BelongsTo'])) {
                    foreach ($associations['BelongsTo'] as $alias => $details) {
                    if ($field === $details['foreignKey']) {
                    $isKey = true;
                    %>
                    <td>
                        <?= $<%= $singularVar %>->has('<%= $details['property'] %>') ? $this->Html->link($<%= $singularVar %>-><%= $details['property'] %>-><%= $details['displayField'] %>, ['controller' => '<%= $details['controller'] %>', 'action' => 'view', $<%= $singularVar %>-><%= $details['property'] %>-><%= $details['primaryKey'][0] %>]) : '' ?>
                    </td>
                    <%
                    break;
                    }
                    }
                    }
                    if ($isKey !== true) {
                    if (!in_array($schema->columnType($field), ['integer', 'biginteger', 'decimal', 'float'])) {
                    %>
                    <td><?= h($<%= $singularVar %>-><%= $field %>) ?></td>
                    <%
                    } else {
                    %>
                    <td><?= $this->Number->format($<%= $singularVar %>-><%= $field %>) ?></td>
                    <%
                    }
                    }
                    }

                    $pk = '$' . $singularVar . '->' . $primaryKey[0];
                    %>
                    <td class="actions">
                        <div class="btn-group">
                            <?= $this->Html->link(__('View'), ['action' => 'view', <%= $pk %>],['class' => 'btn btn-success btn-sm']) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', <%= $pk %>],['class' => 'btn btn-warning btn-sm']) ?>
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', <%= $pk %>], ['class' => 'btn btn-danger btn-sm', 'confirm' => __("Are you sure you want to delete")." #".<%= $pk %>."?"]) ?>
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
</section>