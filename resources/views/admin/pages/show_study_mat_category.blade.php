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
                <li><a href="{{ URL::to('admin/pages/add_course_category') }}">Add Course Categories</a></li>
                <li><a class="link-effect" href=""></a></li>
            </ol>
        </div>
    </div>
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
</div>
<!-- END Page Header -->
<!-- Page Content -->
<div class="content content-boxed">
    <div class="row">
        <div class="col-sm-12 col-lg-12">
            <div class="block">
                <div class="block-content block-content-narrow"> 
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>sn</th>
                                <th>Category name</th>
                                <th>Action</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <?php $count = 1; ?>
                        @foreach($value as $row)
                        <tr>
                            <td>{{  $count++ }}</td>
                            <td>{{$row->name}}</td>
                            <td><a href="#" data-toggle="modal" data-target="#edit_cat_modal{{$row->id}}">Edit</a></td>
                            <td><a href="{{Url::to('admin/delete_course_category/'.$row->id)}}" onclick="return confirm('Are you sure? You will not be able to recover this.')">Delete</a></td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Edit Category Modal -->
@foreach($value as $row)
<div class="modal fade" id="edit_cat_modal{{$row->id}}" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            {!! Form::open(array('url' => 'admin/edit_course_category','role'=>'form','enctype' => 'multipart/form-data')) !!}
            <input type="hidden" name="_token" value="{{ csrf_token() }}">    
            <input type="hidden" name="cat_id" value="{{$row->id}}">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times" ></i><span class="sr-only">Close</span></button>
                <h3 class="modal-title">Update Category Name</h3>
            </div>
            <div class="modal-body">
                <!-- content goes here -->
                <div class="form-group">
                    <label class="exampleInputtext" >Category name</label>
                    <input type="text" class="form-control in-put-bl" name="category_name" placeholder="Title" value="{{$row->name}}" required>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                    <div class="btn-group btn-save-close" role="group ">
                        <button type="button" class="btn btn-default btn-default-green" data-dismiss="modal"  role="button">Cancel</button>
                    </div>
                    <div class="btn-group btn-save-close" role="group">
                        <button type="submit" class="btn btn-default btn-hover-green" data-action="save" role="button">Update</button>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endforeach
@endsection