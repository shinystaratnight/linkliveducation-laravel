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
                <li><a href="{{ URL::to('admin/pages/add_course_subcategory') }}">Add Course SubCategories</a></li>
                <li><a class="link-effect" href=""></a></li>
            </ol>
        </div>
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
                                <th>Category</th>
                                <th>Sub Category</th>                                                    
                                <th>Action</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tr>
                            {!! Form::open(array('url' => 'admin/delete_course_subcategory','role'=>'form','enctype' => 'multipart/form-data')) !!}
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <td>
                            <select name="videocategory" id="category" onchange="loadstudymatCategory(this.value)">
                                <option value="0" >select category</option>
                                @if(!empty($categories))
                                @foreach($categories as $catval)
                                <option value="{{ $catval->id }}" >{{ $catval->name }}</option>
                                @endforeach
                                @endif
                            </select>
                        </td>
                        <td>
                            <select name="study_subcategory" id="studymat_subcategory" onchange="updateCate(this.value)">
                            </select>
                        </td>
                        <td><a href="#" data-toggle="modal" data-target="#edit_cat_modal">Edit</a></td>
                        <td><button type="submit" onclick="return confirm('Are you sure? You will not be able to recover this.')">Delete</button></td>
                        {!! Form::close() !!}
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Edit Category Modal -->
<div class="modal fade" id="edit_cat_modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            {!! Form::open(array('url' => 'admin/edit_course_subcategory','role'=>'form','enctype' => 'multipart/form-data')) !!}
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times" ></i><span class="sr-only">Close</span></button>
                <h3 class="modal-title">Update Category Name</h3>
            </div>
            <div class="modal-body">
                <!-- content goes here -->
                <div class="form-group">
                    <label class="exampleInputtext" >Sub Category name</label>
                    <input type="text" class="form-control in-put-bl" id="updateCate" name="subcategory_name" placeholder="Title" value="" required>
                </div>
                <input type="hidden" id="updateCateid" name="sub_category_id"><input type="hidden" id="updateCateid" name="cat_id">
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
<!-- END Edit Category Modal -->
<!-- END Page Content -->
@endsection
<script>
    function loadstudymatCategory(key) {
        $.get('../pages/studymatCategory', {cat_id: key}, function (data) {
            if (data) {
                $('#studymat_subcategory').html('');
                $('#studymat_subcategory').append(data);
            }
        });
    }
    function updateCate(key) {

        var tr = $("#studymat_subcategory option:selected").text();
        $('#updateCate').val('');
        $('#updateCate').val(tr);

        $('#updateCateid').val('');
        $('#updateCateid').val(key);

    }
</script>