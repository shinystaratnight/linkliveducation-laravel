@extends("admin.admin_app")
@section("content")
<!-- Page Header -->
<div class="content bg-gray-lighter">
    <div class="row items-push">
        <div class="col-sm-7">
            <h1 class="page-heading">
            </h1>
        </div>
        <div class="col-sm-5 text-right hidden-xs">
            <ol class="breadcrumb push-10-t">
                <li><a href="{{ URL::to('admin/pages/course_subcategory') }}">Course SubCategories</a></li>
                <li><a class="link-effect" href=""></a></li>
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
                <h3 align="center" >Add SubCategory</h3>
                <div class="block-content block-content-narrow"> 
                    @if (Session::has('message'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <ul>
                            <li>{{ Session::get('message') }}</li>
                        </ul>
                    </div>
                    @endif
                    {!! Form::open(array('url' => array('admin/pages/add_course_subcategory'),'class'=>'form-horizontal padding-15','role'=>'form','enctype' => 'multipart/form-data')) !!} 
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label"></label>
                        <div class="col-sm-9">
                            <select name="cat_id">
                                <option value="0" >select category</option>
                                @foreach($categories as $row)
                                <option value="{{ $row->id}}" >{{ $row->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">SubCategory Name</label>
                        <div class="col-sm-9">
                            <input type="text" name="subcategory_name" value="" class="form-control">
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <div class="col-md-offset-3 col-sm-9 ">
                            <button type="submit" class="btn btn-primary">Subcategory</button>
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