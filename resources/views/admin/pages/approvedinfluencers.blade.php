@extends("admin.admin_app")
@section("content")

		 
				 <!-- Page Content -->
                <div class="content">
                    <h1 class="user-head">Approved Influencers</h1>
                        <ul class="dash-btn">
                            <li class="active"><a  href="{{ URL::to('admin/approvedinfluencers') }}" >All Influencers</a></li> 
                        </ul> 
                {!! Form::open(array('url' => array('admin/select_approvedinfluencer_cat'),'method'=>'get','role'=>'form','enctype' => 'multipart/form-data')) !!}
                                <select name="cat" onchange="this.form.submit();">  
                                    <option value="">Select Category</option>
                                    @foreach($categories as $cate)
                                    <option value="{{$cate->id}}" <?php if(isset($category)) { if($cate->id == $category) { echo 'selected'; } } ?>>{{$cate->name}}</option>
                                    @endforeach
                                </select>
                {!! Form::close() !!}
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
                                        <th>ID</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Achievement</th>
                                        <th>Social Link</th>
                                        <th>Followers</th>
                                        <th>Status</th>
                                        <th class="text-center" style="width: 10%;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($influencers))
                                    @foreach($influencers as $users)
                                    <tr>
                                        <td>{{ $users->id}}</td>
                                        <td>{{ $users->username }}</td>
                                        <td>{{ $users->email }}</td>
                                        <td>{{ $users->achievement }}</td>
                                        <td>{{ $users->social_link }}</td>
                                        <td>{{ $users->followers }}</td>
                                        
                                        <td class="font-w600">
                                            @if($users->status=='pending')
                                            <a href="javascript:void(0)" data-toggle="tooltip"  class="text-danger">Pending</a>
                                            @else
                                            <a href="{{URL::to('admin/influencer_pending/'.$users->id)}}" data-toggle="tooltip" title="pending" class="text-success">Approved</a>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                 <a href="{{ url('admin/influencer_delete/'.$users->id) }}" class="btn btn-xs btn-default"  data-toggle="tooltip" title="Remove" onclick="return confirm('Are you sure? You will not be able to recover this.')"><i class="fa fa-times"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                   @endforeach
                                   @endif
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END Dynamic Table Full -->

                    
                </div>
                <!-- END Page Content -->

@endsection