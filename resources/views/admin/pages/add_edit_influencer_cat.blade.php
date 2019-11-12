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
                                <li><a href="{{ URL::to('admin/influencerscat') }}">Categories</a></li>
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
							   
                                
                                @if(session()->has('flash_message'))
                                
                                <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                                    {{ session()->get('flash_message') }}
                                </div>
                                @endif
                                
                                {!! Form::open(array('url' => array('admin/add_influencer_cat'),'class'=>'form-horizontal padding-15','name'=>'add_influencer_cat','id'=>'add_influencer_cat','role'=>'form','enctype' => 'multipart/form-data')) !!} 
                                    
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="cat_id" value="{{ isset($influencer_cat) ? $influencer_cat[0]->id : null }}">
                                    
                                   

                                    <div class="form-group">
                                        <label for="" class="col-sm-3 control-label">Category Name</label>
                                          <div class="col-sm-9">
                                            <input type="text" name="category_name" value="{{ isset($influencer_cat) ? $influencer_cat[0]->name : null }}" class="form-control">
                                                <span class="fill_cat"  >{{ $errors->first('category_name') }}</span>
                                        </div>
                                    </div>
                                    
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