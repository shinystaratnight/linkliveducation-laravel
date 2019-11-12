@extends("admin.admin_app")
@section("content")

		 
				 <!-- Page Content -->
                <div class="content">
                       <h1 class="user-head">
                               Influencer Categories
                            </h1>
                       <ul class="dash-btn">
                           
                            <li><a class="{{classActivePath('add_edit_influencer')}}" href="{{ URL::to('admin/addinfluencercat') }}" >Add Category</a></li>
                            <li class="active"><a  href="{{ URL::to('admin/influencerscat') }}" >All Categories</a></li>
                            </ul>
                    <!-- Dynamic Table Full -->
                    <div class="block">
                        <div class="block-header">                            
                        </div>
                        <div class="block-content">
                            @if(Session::has('flash_message'))
                                <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    {{ Session::get('flash_message') }}
                                </div>
                            @endif
                            <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/base_tables_datatables.js -->
                            <table class="table table-bordered table-striped users-dataTable-full">
                                <thead>
                                    <tr>
                                        <th>Cat ID</th>
                                        <th>Name</th>
                                        <th class="hidden"></th>
                                        <th class="hidden"></th>
                                        
                                        <th class="text-center" style="width: 10%;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     @foreach($categories as $users)
                                    <tr>
                                        <td>{{ $users->id}}</td>
                                        <td>{{ $users->name }}</td>
                                        <td class="hidden"></td>
                                        <td class="hidden"></td>
                                        
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="{{ url('admin/influencer_cat_edit/'.$users->id) }}" class="btn btn-xs btn-default"  data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></a>

                                                 <a href="{{ url('admin/influencer_cat_delete/'.$users->id) }}" class="btn btn-xs btn-default"  data-toggle="tooltip" title="Remove" onclick="return confirm('Are you sure? You will not be able to recover this.')"><i class="fa fa-times"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                   @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END Dynamic Table Full -->

                    
                </div>
                <!-- END Page Content -->

@endsection