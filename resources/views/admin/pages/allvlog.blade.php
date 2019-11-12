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
                <li><a href="{{ URL::to('admin/vlog') }}">Add VLog</a></li>
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
                <h3 align="center" >All VLog</h3>
                <div class="block-content block-content-narrow"> 
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>SNo</th>
                                <th>Title</th>
                                <th>Youtube Link</th>
                                <th>Action</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <?php $i=1; ?>
                        @foreach($vlog as $row)
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$row->title}}</td>
                            <td>{{$row->name}}</td>
                            <td><a href="{{URL::to('admin/edit_vlog/'.$row->id)}}">Edit</a></td>
                            <td><a href="{{URL::to('admin/delete_vlog/'.$row->id)}}" onclick="return confirm('Are You Sure?')">Delete</a></td>
                        </tr>
                        <?php $i++ ?>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Page Content -->            
@endsection