@extends("admin.admin_app")
@section("content")
<style>
    .fill_cat
    {
        color:red;
    }
</style>
<!-- Page Header -->
<div class="content bg-gray-lighter">
    <div class="row items-push">
        <div class="col-sm-7">
            <h1 class="page-heading">
            </h1>
        </div>
        <div class="col-sm-5 text-right hidden-xs">
            <ol class="breadcrumb push-10-t">
                <li><a href="{{ URL::to('admin/allvlog') }}">All VLog</a></li>
            </ol>
        </div>
    </div>
</div>
<!-- END Page Header -->
<!-- Page Content -->
<div class="content content-boxed">
    <div class="row">
        <div class="col-sm-12 col-lg-12">
            <div class="block">
                <h3 align="center" >Add VLog</h3>
                <div class="block-content block-content-narrow"> 
                    @if(session()->has('message'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        {{ session()->get('message') }}
                    </div>
                    @elseif(session()->has('title_message'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        {{ session()->get('title_message') }}
                    </div>
                    @endif
                    {!! Form::open(array('url' => array('admin/vlog'),'class'=>'form-horizontal padding-15','role'=>'form','enctype' => 'multipart/form-data')) !!} 
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id" value="{{ isset($vlog->id) ? $vlog->id : null }}">
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">Title</label>
                        <div class="col-sm-9">
                            <input type="text" name="title" value="{{isset($vlog->title) ? $vlog->title : null}}" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">Youtube Link</label>
                        <div class="col-sm-9">
                            <input type="text" name="name" value="{{isset($vlog->name) ? $vlog->name : null}}" class="form-control" required>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <div class="col-md-offset-3 col-sm-9 ">
                            <button type="submit" class="btn btn-primary">submit</button>
                        </div>
                    </div>
                    {!! Form::close() !!} 
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Page Content -->
@endsection