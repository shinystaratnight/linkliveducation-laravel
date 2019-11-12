@extends("admin.admin_app")
    
@section("content")
    
<!-- Page Header -->
<div class="content bg-gray-lighter">
    <div class="row items-push">
        <div class="col-sm-7">
            <h1 class="page-heading">
                Newsletter
            </h1>
        </div>
        <div class="col-sm-5 text-right hidden-xs">
            <ol class="breadcrumb push-10-t">
                <li><a href="{{ URL::to('admin/dashboard') }}">Dashboard</a></li>
                
            </ol>
        </div>
    </div>
</div>
<!-- END Page Header --> 
<!-- Page Content -->
<div class="content">
    <!-- Dynamic Table Full -->
    <div class="block">
        <div class="block-header">                            
     <button type="button" class="pull-right btn btn-primary push-5-r push-10" data-toggle="modal" data-target="#myModal">Compose Message</button>
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
                        <th>User ID</th>
                        <th>Username</th>						                
                        <th>Name</th>						                
                        <th>Email</th>
                        <th>Link</th>
<!--                        <th class="text-center" style="width: 10%;">Actions</th>-->
                    </tr>
                </thead>
                <tbody>
                    @foreach(\App\User::where('usertype','User')->where('status','approved')->orderBy('id')->get()  as $perk)
                    <tr>
                        <td>{{$perk->id}}</td> 
                        <td>{{$perk->username}}</td>
                        <td>{{$perk->first_name}} {{$perk->last_name}}</td>
                        <td>{{$perk->email}}</td>
                        <td>
                            <a href="{{url('profile/'.$perk->id.'/'.$perk->first_name.'-'.$perk->last_name)}}" target="_blank">
                            {{url('profile/'.$perk->id.'/'.$perk->first_name.'-'.$perk->last_name)}}
                            </a>
                        </td>
<!--                        <td>
                            <a href="{{ url('admin/subscribers/delete/'.$perk->id) }}" class="btn btn-xs btn-danger"  data-toggle="tooltip" title="Remove" onclick="return confirm('Are you sure? You will not be able to recover this.')"><i class="fa fa-times"></i></a>
                        </td>-->
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- END Dynamic Table Full -->
    
    
</div>
<!-- END Page Content -->
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
 {!! Form::open(array('url' => array('admin/newsletter_send'),'role'=>'form')) !!}  
    <!-- Modal content-->
    <div class="row modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Newsletter User Email</h4>
      </div>
      <div class="modal-body">
		<label for="" class="col-sm-4 control-label">Select All:</label>
        <div class="form-group col-sm-8">
            <input type="checkbox" name="all" style="margin-left: -39%;">
        </div>
		<label for="" class="col-sm-1 control-label">To:</label>
        <div class="form-group col-sm-11">
            <select id="basic" name="to[]" class="js-select2 form-control" multiple>
                <option value="" disabled>Select Subscriber Email</option>
                @foreach(\App\User::where('usertype','User')->where('status','approved')->orderBy('id')->get() as $i => $emails)    
                <option value="{{$emails->email}}">{{$emails->email}}</option>
                @endforeach
            </select>
        </div>
		<label for="" class="col-sm-1 control-label">Subject:</label>
        <div class="form-group col-sm-11">
			<input type="text" name="subject" class="form-control">
		</div>
		<label for="" class="col-sm-1 control-label">Message:</label>
        <div class="form-group col-sm-11">
			<textarea id="summernote" class="form-control js-summernote" name="message"></textarea>
		</div>
		<div class="form-group col-sm-11">
			<button type="submit" class="btn btn-primary">Send</button>
		</div>
		
		<div class="clearfix"></div>
      </div>
     
    </div>
	 {!! Form::close() !!} 
<style>
.select2 {
  width: 100% !important;
}
.modal-dialog {
  width: 60%;
}
</style>
  </div>
</div>
@endsection