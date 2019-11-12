@extends("admin.admin_app")
@section("content")

		 
				 <!-- Page Content -->
                <div class="content">
                    <h1 class="user-head">Max Post Likes</h1>
                        <ul class="dash-btn">
                            <li class="active"><a  href="{{ URL::to('admin/maxpostlikes') }}" >Max Post Likes</a></li> 
                        </ul>
                <div style="display: inline-block;">
                {!! Form::open(array('url' => array('admin/select_maxpost_cat'),'method'=>'get','role'=>'form','enctype' => 'multipart/form-data')) !!}
                        <select name="cat" required>  
                            <option value="">Select Category</option>
                            <option value="post" <?php if(isset($category)){if($category == 'post'){echo 'selected';}} ?>>Posts</option>
                            <option value="image" <?php if(isset($category)){if($category == 'image'){echo 'selected';}} ?>>Images</option>
                        </select>
                </div>
                <div style="display: inline-block;padding-left: 40%;margin-bottom: 1%;">
                    From Date: <input type="date" name="from_date" value="{{isset($from) ? $from : null}}" required>
                    To Date: <input type="date" name="to_date" value="{{isset($to) ? $to : null}}" required>
                                <input type="submit" name="submit" value="Submit">
                {!! Form::close() !!}
                </div>
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
                                        <th>Post Link</th>
                                        <th class="hidden">Likes</th>
                                        <th class="hidden">Likes</th>
                                        <th>Likes</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($maxpost))
                                    @foreach($maxpost as $users)
                                    <tr>
                                        <td>{{ $users->id}}</td>
                                        <?php $name = App\User::where('id',$users->user_id)->get(); ?>
                                        <td>{{ @$name[0]->first_name }} {{ @$name[0]->last_name }}</td>
                                        <td>
                                            <a href="{{url('single-post/'.$users->id.'/'.@$name[0]->first_name.'-'.@$name[0]->last_name)}}" target="_blank">{{ url('single-post/'.$users->id.'/'.@$name[0]->first_name.'-'.@$name[0]->last_name) }}</a>
                                        </td>
                                        <td class="hidden">{{ $users->total_likes }}</td>
                                        <td class="hidden">{{ $users->total_likes }}</td>
                                        @if($users->total_likes>0)
                                        <td>{{ $users->total_likes }}</td>
                                        @else
                                        <td>0</td>
                                        @endif
                                        
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