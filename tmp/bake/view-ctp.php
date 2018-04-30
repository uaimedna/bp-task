<?php
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
?>

<section class="content-header">
    <h1>
        <CakePHPBakeOpenTag= __('View <?= $pluralHumanName ?>') CakePHPBakeCloseTag>
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
            <h3 class="box-title"><CakePHPBakeOpenTag= __('<?= $singularHumanName ?>') CakePHPBakeCloseTag></h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body">
            <?php if ($groupedFields['string']) : ?>
            <?php foreach ($groupedFields['string'] as $field) : ?>
            <div class="form-group">
                <?php if (isset($associationFields[$field])) :
                $details = $associationFields[$field];
                ?>
                <label><CakePHPBakeOpenTag= __('<?= Inflector::humanize($details['property']) ?>') CakePHPBakeCloseTag>:</label>
                <p><CakePHPBakeOpenTag= $<?= $singularVar ?>->has('<?= $details['property'] ?>') ? $this->Html->link($<?= $singularVar ?>-><?= $details['property'] ?>-><?= $details['displayField'] ?>, ['controller' => '<?= $details['controller'] ?>', 'action' => 'view', $<?= $singularVar ?>-><?= $details['property'] ?>-><?= $details['primaryKey'][0] ?>]) : '' CakePHPBakeCloseTag></p>
                <?php else : ?>
                <label><CakePHPBakeOpenTag= __('<?= Inflector::humanize($field) ?>') CakePHPBakeCloseTag>:</label>
                <p><CakePHPBakeOpenTag= h($<?= $singularVar ?>-><?= $field ?>) CakePHPBakeCloseTag></p>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
            <?php if ($groupedFields['number']) : ?>
            <?php foreach ($groupedFields['number'] as $field) : ?>
            <div class="form-group">
                <label><CakePHPBakeOpenTag= __('<?= Inflector::humanize($field) ?>') CakePHPBakeCloseTag>:</label>
                <p><CakePHPBakeOpenTag= $this->Number->format($<?= $singularVar ?>-><?= $field ?>) CakePHPBakeCloseTag></p>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
            <?php if ($groupedFields['date']) : ?>
            <?php foreach ($groupedFields['date'] as $field) : ?>
            <div class="form-group">
                <label><CakePHPBakeOpenTag= __('<?= Inflector::humanize($field) ?>') CakePHPBakeCloseTag>:</label>
                <p><CakePHPBakeOpenTag= h($<?= $singularVar ?>-><?= $field ?>) CakePHPBakeCloseTag></p>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
            <?php if ($groupedFields['boolean']) : ?>
            <?php foreach ($groupedFields['boolean'] as $field) : ?>
            <div class="form-group">
                <label><CakePHPBakeOpenTag= __('<?= Inflector::humanize($field) ?>') CakePHPBakeCloseTag>:</label>
                <p><CakePHPBakeOpenTag= $<?= $singularVar ?>-><?= $field ?> ? __('Yes') : __('No'); CakePHPBakeCloseTag></p>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
            <?php if ($groupedFields['text']) : ?>
            <?php foreach ($groupedFields['text'] as $field) : ?>
            <div class="form-group">
                <label><CakePHPBakeOpenTag= __('<?= Inflector::humanize($field) ?>') CakePHPBakeCloseTag>:</label>
                <p><CakePHPBakeOpenTag= $this->Text->autoParagraph(h($<?= $singularVar ?>-><?= $field ?>)); CakePHPBakeCloseTag></p>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>
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