@extends("admin.admin_app")

@section("content")

            <div class="content">
                       <h1 class="user-head">
                               News
                            </h1>
                <a class="pull-right btn btn-primary push-5-r push-10" href="{{ URL::to('admin/addnews') }}"><i class="fa fa-plus"></i> Add News</a>
		<table class="table table-bordered table-striped ">
                <thead>
                    <tr>
                        <th class="text-left">Title</th>
                        <th class="text-left">Status</th>
                        <th class="text-center" style="width: 10%;">Actions</th>
                    </tr>
                </thead>
	        <tbody>
			<?php
                        $news_posts = DB::table('news_posts')->where('author_id', Auth::user()->id)->orderBy('id')->get();
                        ?>
                        @foreach($news_posts as $news)
			<tr>
		
				<td>{{ $news->title }}</td>
                                @if($news->status=='Live')
				<td><a href="{{ URL::to('admin/news/status/'.$news->id.'/Draft') }}" data-toggle="tooltip"  class="text-success">Live</a></td>
				@else
                                <td><a href="{{ URL::to('admin/news/status/'.$news->id.'/Live') }}" data-toggle="tooltip"  class="text-danger">Draft</a></td>
                                @endif
				<td>                    
				<a href="{{ url('admin/news/delete/'.$news->id) }}" class="btn" style="float: right" onclick="return confirm('Are you sure? You will not be able to recover this.')"><i class="fa fa-times"></i></a>
				<a href="{{ url('admin/addnews/'.$news->id) }}" class="btn" style="float: right"><i class="fa fa-pencil"></i></a>
				</td>	
		
			</tr>
			@endforeach
			
         </tbody></table>
                
            </div>
@endsection