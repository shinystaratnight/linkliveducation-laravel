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
                                <li><a href="{{ URL::to('admin/categories') }}">Categories</a></li>
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
							<h3 align="center" >Add category</h3>
                               <div class="block-content block-content-narrow"> 
							   
                                
												@if(session()->has('message'))
                                
                                                <div class="alert alert-success">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                                                    {{ session()->get('message') }}
                                                </div>
												@endif
                                
                                {!! Form::open(array('url' => array('admin/pages/category'),'class'=>'form-horizontal padding-15','name'=>'category_form','id'=>'category_form','role'=>'form','enctype' => 'multipart/form-data')) !!} 
                                    
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="id" value="{{ isset($cat->id) ? $cat->id : null }}">
                                    
                                   

                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Category Name</label>
                                          <div class="col-sm-9">
                                            <input type="text" name="category_name" value="{{old('category_name')}}" class="form-control">
											<span class="fill_cat"  >{{ $errors->first('category_name') }}</span>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Category Slug</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="category_slug" value="{{old('category_slug')}}" class="form-control">
                                        </div>
                                    </div>
									
                                    
									<!-- <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">sub-Category </label>
                                        <div class="col-sm-9">
                                            <input type="text" name="" value="{{ isset($cat->category_slug) ? $cat->category_slug : null }}" class="form-control">
                                        </div>
                                    </div>  --->
									

																		
                                           
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
                                            <button type="submit" class="btn btn-primary">Add category</button>
                                             
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