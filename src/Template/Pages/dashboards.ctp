<?php $this->layout = 'main'; ?>
<!-- Content Header (Page header) -->
<style>
    .col-md-4{
        margin-top:10px;
        margin-bottom:10px;
    }
</style>
<section class="content-header">
    <div class="row">
        <div class="col-md-4">
            <h2 style="margin:0;">Furniture</h2>
        </div>
        <div class="col-md-4">
        </div>
        <div class="col-md-4">
            <button type="button" class="btn btn-block btn-success"><i class="fa fa-plus" aria-hidden="true"></i> New furniture</button>
        </div>
    </div>


</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Furniture list</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body table-responsive">
            <table class="table table-hover">
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th style="width:167px;">Action</th>
                </tr>
                <tr>
                    <td>183</td>
                    <td>John Doe</td>
                    <td>11-7-2014</td>
                    <td><span class="label label-success">Approved</span></td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#"><i class="fa fa fa-search"></i>View</a></li>
                                <li><a href="#"><i class="fa fa-pencil"></i>Edit</a></li>
                                <li class="divider"></li>
                                <li><a href="#"><i class="fa fa-trash-o"></i> Delete</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>219</td>
                    <td>Alexander Pierce</td>
                    <td>11-7-2014</td>
                    <td><span class="label label-warning">Pending</span></td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#"><i class="fa fa fa-search"></i>View</a></li>
                                <li><a href="#"><i class="fa fa-pencil"></i>Edit</a></li>
                                <li class="divider"></li>
                                <li><a href="#"><i class="fa fa-trash-o"></i> Delete</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>657</td>
                    <td>Bob Doe</td>
                    <td>11-7-2014</td>
                    <td><span class="label label-primary">Approved</span></td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#"><i class="fa fa fa-search"></i>View</a></li>
                                <li><a href="#"><i class="fa fa-pencil"></i>Edit</a></li>
                                <li class="divider"></li>
                                <li><a href="#"><i class="fa fa-trash-o"></i> Delete</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>175</td>
                    <td>Mike Doe</td>
                    <td>11-7-2014</td>
                    <td><span class="label label-danger">Denied</span></td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#"><i class="fa fa fa-search"></i>View</a></li>
                                <li><a href="#"><i class="fa fa-pencil"></i>Edit</a></li>
                                <li class="divider"></li>
                                <li><a href="#"><i class="fa fa-trash-o"></i> Delete</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>

            </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <div class="box-tools">
                <ul class="pagination pagination-sm no-margin pull-right">
                    <li><a href="#">&laquo;</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">&raquo;</a></li>
                </ul>
            </div>
        </div>
        <!-- /.box-footer-->
    </div>
    <!-- /.box -->

</section>
<!-- /.content -->