<?php $this->layout = 'main'; ?>
<style>
    .col-md-4{
        margin-top:10px;
        margin-bottom:10px;
    }
</style>
<section class="content-header">
    <div class="row">
        <div class="col-md-4">
            <h2 style="margin:0;"><?= __('Edit furniture') ?></h2>
        </div>
        <div class="col-md-4">
        </div>
        <div class="col-md-4">
            <button type="button" class="btn btn-block btn-primary"><i class="fa fa-align-center"></i><?= __('List of furniture') ?></button>
            <button type="button" class="btn btn-block btn-warning"><i class="fa fa-pencil"></i><?= __('Edit furniture') ?> </button>
        </div>
    </div>
</section>

<section class="content">
    <div class="box box-warning">
        <div class="box-header with-border">
            <h3 class="box-title"><?= __('Furniture') ?></h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fa fa-times"></i></button>
            </div>
        </div>
        <form role="form">
            <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <input type="file" id="exampleInputFile">

                    <p class="help-block">Example block-level help text here.</p>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox"> Check me out
                    </label>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-warning">Save</button>
            </div>
        </form>
    </div>
</section>