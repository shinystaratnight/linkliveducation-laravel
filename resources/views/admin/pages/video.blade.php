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
                <li><a href="{{ URL::to('admin/pages/allvideos') }}">All Videos</a></li>
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
                <h3 align="center" >Add Video</h3>
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
                    {!! Form::open(array('url' => array('admin/pages/addvideo'),'class'=>'form-horizontal padding-15','role'=>'form','enctype' => 'multipart/form-data')) !!} 
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id" value="{{ isset($video->id) ? $video->id : null }}">
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">Select Category &AMP; SubCategory</label>
                        <div class="col-sm-9">
                            <select name="videocategory" onchange="loadCategory(this.value)" required>
                                <option value="" >Select Category</option>
                                @if(isset($category))
                                @foreach($category as $cat)
                                <option value="{{$cat->id}}"<?php if(isset($video)){if($video->cat==$cat->id){echo 'selected';}} ?>>{{$cat->name}}</option>
                                @endforeach
                                @endif
                            </select>
                            <select name="videosubcategory" id="subcategory" required>
                                @if(isset($subcategory))
                                @foreach($subcategory as $subcat)
                                <option value="{{$subcat->id}}"<?php if(isset($video)){if($video->subcat==$subcat->id){echo 'selected';}} ?>>{{$subcat->name}}</option>
                                @endforeach
                                @else
                                <option value="">Select Category First</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">Position</label>
                        <div class="col-sm-9">
                            <input type="text" name="position" value="{{isset($video->position) ? $video->position : null}}" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="first" class="col-sm-3 control-label">Add Course Image :-</label>
                        <div class="col-md-9">
                            <div class="form-control">
                                <input type="file" name="featured_image" id="input-file" class="input-md" <?php if(empty($video->image)){echo 'required';} ?>>
                            </div>
                            <br>
                            @if(isset($video->image))
                            <img src="{{ URL::asset('upload/course/images/'.$video->image) }}" width="80" alt="featured">
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">Description</label>
                        <div class="col-sm-9">
                            <textarea type="text" name="description" class="form-control" required>{{isset($video->description) ? $video->description : null}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">Table of Content</label>
                        <div class="col-sm-9">
                            <textarea type="text" name="content" class="form-control" required>{{isset($video->content) ? $video->content : null}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">Course Benefit</label>
                        <div class="col-sm-9">
                            <textarea type="text" name="benifit" class="form-control" required>{{isset($video->benifit) ? $video->benifit : null}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">Price</label>
                        <div class="col-sm-9">
                            <input type="text" name="price" value="{{isset($video->price) ? $video->price : null}}" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">Video</label>
                        <div class="col-sm-9">
                            <div class="form-control">
                                <input type="file" accept="video/*" name="videos[]" multiple <?php if(empty($video->videos)){echo 'required';} ?>>
                            </div>
                            <br>
                            @if(!empty($video->videos))
                            <?php $allvideos=json_decode($video->videos); ?>
                            @foreach($allvideos as $allvideo)
                            <video width="320" height="240" controls>
                                <source src="{{ URL::asset('upload/course/videos/'.$allvideo) }}">
                            </video>
                            <a href="{{ URL::to('admin/pages/deletevideo/'.$allvideo.'/'.$video->id) }}"><i class="fa fa-close"></i></a>
                            @endforeach
                            @endif
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
<script>
    function loadCategory(key) {
        $.get('../pages/videow', {cat_id: key}, function (data) {
            if (data) {
                $('#subcategory').html('');
                $('#subcategory').append(data);
            }
        });
    }
</script>
<script>
function ReAssign(key,name) {
    alert(key);
//    $.post('deletevideo', {id: key, vid:name}, function (data) {
//        if (data) {
//            $('#subcategory').html('');
//            $('#subcategory').append(data);
//        }
//    });
}
</script>
@endsection