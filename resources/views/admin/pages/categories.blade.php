@extends("admin.admin_app")

@section("content")

                            

 
  
  <!-- Page Header -->
                <div class="content bg-gray-lighter">
                    <div class="row items-push">
                        <div class="col-sm-7">
                            <h1 class="page-heading">
                               {{ isset($cat->id) ? 'Edit Category ' : 'Add Category' }}
                            </h1>
                        </div>
                        <div class="col-sm-5 text-right hidden-xs">
                            <ol class="breadcrumb push-10-t">
                                <li><a href="{{ URL::to('admin/categories') }}">Categories</a></li>
                                <li><a class="link-effect" href="">{{ isset($cat->id) ? 'Edit Category ' : 'Add Category' }}</a></li>
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
                               <div class="block-content block-content-narrow"> 
                                @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                     <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                 @if(Session::has('flash_message'))
                                                <div class="alert alert-success">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                                                    {{ Session::get('flash_message') }}
                                                </div>
                                @endif
                                {!! Form::open(array('url' => array('admin/categories/addcategory'),'class'=>'form-horizontal padding-15','name'=>'category_form','id'=>'category_form','role'=>'form','enctype' => 'multipart/form-data')) !!} 
                                    
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="id" value="{{ isset($cat->id) ? $cat->id : null }}">
                                    
                                   

                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Category Name</label>
                                          <div class="col-sm-9">
                                            <input type="text" name="category_name" value="{{ isset($cat->category_name) ? $cat->category_name : null }}" class="form-control">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Category Slug</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="category_slug" value="{{ isset($cat->category_slug) ? $cat->category_slug : null }}" class="form-control">
                                        </div>
                                    </div>
									<!-- <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">sub-Category </label>
                                        <div class="col-sm-9">
                                            <input type="text" name="" value="{{ isset($cat->category_slug) ? $cat->category_slug : null }}" class="form-control">
                                        </div>
                                    </div>  --->
									
								<div class="form-group"> 
										<label for="" class="col-sm-3 control-label">Category parent</label> 
										
								<div class="col-sm-9">
									 <select name="cat_parent"> 
									 <option value="">Select Parent</option> 
									 <?php if(isset($cat->cat_id)){ ?> @foreach(\App\Categories::where('cat_id','!=',$cat->cat_id)->get() as $aes) <option value="{{$aes->cat_id}}" <?php if($cat->cat_parent==$aes->cat_id){ echo 'selected'; } ?> >{{$aes->category_name}}</option> @endforeach <?php }else{ ?> @foreach(\App\Categories::orderby('cat_id')->get() as $aes) <option value="{{$aes->cat_id}}">{{$aes->category_name}}</option> @endforeach <?php } ?> </select> </div> </div>
																		
                                           
                           <!--  <div class="form-group">
<label for="first" class="col-sm-3 control-label">Featured Image :-</label>
<div class="col-md-6">
                                    
                                    @if(isset($cat->image))
                                    <input type="file" name="featured_image" id="input-file" class="form-control input-md" >

 @else
                   <input type="file" name="featured_image" id="input-file" class="form-control input-md">
 @endif    
                                </div>
                                <div class="col-md-3">
                                    @if(isset($cat->image))
                                        
                                    <img src="{{ URL::asset('upload/listings/'.$cat->image.'-s.jpg') }}" width="80" alt="featured">
                                    @endif
                                        
                                </div>
</div>-->
                                    <hr>
                                    <div class="form-group">
                                        <div class="col-md-offset-3 col-sm-9 ">
                                            <button type="submit" class="btn btn-primary">{{ isset($cat->id) ? 'Edit Category ' : 'Add Category' }}</button>
                                             
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