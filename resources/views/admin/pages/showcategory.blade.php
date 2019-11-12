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
                                                    <th>Menu Order</th>
                                                    <th>Action</th>
                                                    <th>Action</th>

                                            </tr>
                                    </thead>
                                    <?php $count=1; ?>
                                    @foreach($value as $row)
                                    <tr>
                                    <td>{{  $count++ }}</td>
                                    <td>{{$row->category_name}}</td>
                                     <td>{{$row->cat_order}}</td>
                                    <td><a href="#" data-toggle="modal" data-target="#edit_cat_modal{{$row->cat_id}}">Edit</a></td>
                                    <td><a href="{{Url::to('admin/delete_cat/'.$row->cat_id)}}" onclick="return confirm('Are you sure? You will not be able to recover this.')">Delete</a></td>
                                    </tr>

                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                
                <!-- END Edit Category Modal -->
                <?php $count=1; ?>
                @foreach($value as $row)
<div class="modal fade" id="edit_cat_modal{{$row->cat_id}}" role="dialog">

    <div class="modal-dialog">
	<div class="modal-content">
            
            {!! Form::open(array('url' => 'admin/edit_cat','id' => 'edit_cat','role'=>'form','enctype' => 'multipart/form-data')) !!}

            <input type="hidden" name="_token" value="{{ csrf_token() }}">    
            <input type="hidden" name="edit_cat_id" value="{{$row->cat_id}}">
                

		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><i class="fa fa-times" ></i><span class="sr-only">Close</span></button>
			<h3 class="modal-title">Update Category Name</h3>
		</div>
		<div class="modal-body">
			
            <!-- content goes here -->
		
              <div class="form-group">
                <label class="exampleInputtext" >Category name</label>
                <input type="text" class="form-control in-put-bl" name="category_name" placeholder="Title" value="{{$row->category_name}}" required>
                <input type="number" class="form-control in-put-bl" name="cat_order" placeholder="Menu Order" value="{{$row->cat_order}}" required>
              </div>
           
			  
<!--              <div class="form-group">
                <label class="exampleInputtext">Description</label>
                <textarea class="form-control in-put-bl we8" name="description" rows="5" required></textarea>
              </div>-->
            
	
		</div>
		<div class="modal-footer">
			<div class="btn-group btn-group-justified" role="group" aria-label="group button">
				<div class="btn-group btn-save-close" role="group ">
					<button type="button" class="btn btn-default btn-default-green" data-dismiss="modal"  role="button">Cancel</button>
				</div>
				
                            
				<div class="btn-group btn-save-close" role="group">
                                    <button type="submit" class="btn btn-default btn-hover-green" data-action="save" role="button">Update</button>
                                    
							<!--		 <input class="button-add" type="button" value="Clone box"> -->
							
							
                                   
				</div>
			</div>
		</div>
           {!! Form::close() !!}
	</div>
    </div>
  
  
</div>
                @endforeach
                <!-- END Edit Category Modal -->
                <!-- END Page Content -->
@endsection