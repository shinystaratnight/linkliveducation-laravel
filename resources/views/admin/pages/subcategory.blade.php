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
							<h3 align="center" >Add subcategory</h3>
							
                               <div class="block-content block-content-narrow"> 
							   
							   @if (Session::has('msg'))
                                
                                <div class="alert alert-success">
                                     <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <ul>
                                        <li>{{ Session::get('msg') }}</li>
                                    </ul>
                                </div>
								@endif
                                

                                
                                {!! Form::open(array('url' => array('admin/pages/getsubcategory'),'class'=>'form-horizontal padding-15','name'=>'category_form','id'=>'category_form','role'=>'form','enctype' => 'multipart/form-data')) !!} 
                                    
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="id" value="{{ isset($cat->id) ? $cat->id : null }}">
											 
                                   	<div class="form-group">
                                        <label for="" class="col-sm-3 control-label"></label>
                                        <div class="col-sm-9">
                                            <select name="cat_id">
												<option value="0" >select category</option>
												@foreach($value as $row)
												<option value="{{ $row->cat_id}}" >{{ $row->category_name }}</option>
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
									 <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">SubCategory slug</label>
                                          <div class="col-sm-9">
                                            <input type="text" name="sub_slug" value="" class="form-control">
                                        </div>
                                    </div>
									
                                    
                                
									

																		
                                           
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