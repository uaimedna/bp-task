<%
use Cake\Utility\Inflector;

$associations += ['BelongsTo' => [], 'HasOne' => [], 'HasMany' => [], 'BelongsToMany' => []];
$immediateAssociations = $associations['BelongsTo'] + $associations['HasOne'];
$associationFields = collection($fields)
    ->map(function($field) use ($immediateAssociations) {
        foreach ($immediateAssociations as $alias => $details) {
            if ($field === $details['foreignKey']) {
                return [$field => $details];
            }
        }
    })
    ->filter()
    ->reduce(function($fields, $value) {
        return $fields + $value;
    }, []);

$groupedFields = collection($fields)
    ->filter(function($field) use ($schema) {
        return $schema->columnType($field) !== 'binary';
    })
    ->groupBy(function($field) use ($schema, $associationFields) {
        $type = $schema->columnType($field);
        if (isset($associationFields[$field])) {
            return 'string';
        }
        if (in_array($type, ['integer', 'float', 'decimal', 'biginteger'])) {
            return 'number';
        }
        if (in_array($type, ['date', 'time', 'datetime', 'timestamp'])) {
            return 'date';
        }
        return in_array($type, ['text', 'boolean']) ? $type : 'string';
    })
    ->toArray();

$groupedFields += ['number' => [], 'string' => [], 'boolean' => [], 'date' => [], 'text' => []];
$pk = "\$$singularVar->{$primaryKey[0]}";
%>

<section class="content-header">
    <h1>
        <?= __('View <%= $pluralHumanName %>') ?>
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
            <h3 class="box-title"><?= __('<%= $singularHumanName %>') ?></h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body">
            <% if ($groupedFields['string']) : %>
            <% foreach ($groupedFields['string'] as $field) : %>
            <div class="form-group">
                <% if (isset($associationFields[$field])) :
                $details = $associationFields[$field];
                %>
                <label><?= __('<%= Inflector::humanize($details['property']) %>') ?>:</label>
                <p><?= $<%= $singularVar %>->has('<%= $details['property'] %>') ? $this->Html->link($<%= $singularVar %>-><%= $details['property'] %>-><%= $details['displayField'] %>, ['controller' => '<%= $details['controller'] %>', 'action' => 'view', $<%= $singularVar %>-><%= $details['property'] %>-><%= $details['primaryKey'][0] %>]) : '' ?></p>
                <% else : %>
                <label><?= __('<%= Inflector::humanize($field) %>') ?>:</label>
                <p><?= h($<%= $singularVar %>-><%= $field %>) ?></p>
                <% endif; %>
            </div>
            <% endforeach; %>
            <% endif; %>
            <% if ($groupedFields['number']) : %>
            <% foreach ($groupedFields['number'] as $field) : %>
            <div class="form-group">
                <label><?= __('<%= Inflector::humanize($field) %>') ?>:</label>
                <p><?= $this->Number->format($<%= $singularVar %>-><%= $field %>) ?></p>
            </div>
            <% endforeach; %>
            <% endif; %>
            <% if ($groupedFields['date']) : %>
            <% foreach ($groupedFields['date'] as $field) : %>
            <div class="form-group">
                <label><?= __('<%= Inflector::humanize($field) %>') ?>:</label>
                <p><?= h($<%= $singularVar %>-><%= $field %>) ?></p>
            </div>
            <% endforeach; %>
            <% endif; %>
            <% if ($groupedFields['boolean']) : %>
            <% foreach ($groupedFields['boolean'] as $field) : %>
            <div class="form-group">
                <label><?= __('<%= Inflector::humanize($field) %>') ?>:</label>
                <p><?= $<%= $singularVar %>-><%= $field %> ? __('Yes') : __('No'); ?></p>
            </div>
            <% endforeach; %>
            <% endif; %>
            <% if ($groupedFields['text']) : %>
            <% foreach ($groupedFields['text'] as $field) : %>
            <div class="form-group">
                <label><?= __('<%= Inflector::humanize($field) %>') ?>:</label>
                <p><?= $this->Text->autoParagraph(h($<%= $singularVar %>-><%= $field %>)); ?></p>
            </div>
            <% endforeach; %>
            <% endif; %>
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