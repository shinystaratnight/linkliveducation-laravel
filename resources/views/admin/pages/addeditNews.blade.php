@extends("admin.admin_app")

@section("content")

<div class="content content-boxed">
                      <h1 class="user-head">
                               {{ isset($news->id) ? 'Edit News' : 'Add News' }}
                            </h1>
                       
                    <div class="row">
                        <div class="col-sm-12 col-lg-12">

                             <!-- Block Tabs Alternative Style -->
                            <div class="block">
                                <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs">
                                </ul>
                                <div class="block-content tab-content">
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
 

                                    <div class="col-lg-8 tab-pane active" id="general_settings">
                                    @if(Session::has('flash_message'))
                                    <div class="alert alert-success">
                                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                       <span aria-hidden="true">&times;</span></button>
                                     {{ Session::get('flash_message') }}
                                    </div>
                                    @endif

                                        {!! Form::open(array('url' => 'admin/addnews','class'=>'form-horizontal padding-15','name'=>'news_form','id'=>'news_form','role'=>'form','enctype' => 'multipart/form-data')) !!}
                                        
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="id" value="{{ isset($news->id) ? $news->id : null }}">
                
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">Title</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="news_title" value="{{ isset($news->title) ? $news->title : null }}" class="form-control" placeholder="Enter News Title" required>
                                            </div>
                                        </div>
                                        
                                        @if(isset($news->id))
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">Slug</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="news_slug" value="{{ $news->slug }}" class="form-control" placeholder="News Slug">
                                            </div>
                                        </div>
                                        @endif
                                        
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">Link</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="news_link" value="{{ isset($news->link) ? $news->link : null }}" class="form-control" placeholder="Enter Link">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">Body</label>
                                            <div class="col-sm-9">
                                                <textarea type="text" name="news_body" class="form-control" rows="5" placeholder="Enter News Body">{{ isset($news->body) ? $news->body : null }}</textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">News Category</label>
                                            <div class="col-sm-9">
                                        <select name="news_cat">
                                            <option value="">Select Category</option>
                                            <option value="Science & Technology" <?php if($news->news_cat=="Science & Technology") echo 'selected="selected"'; ?>>Science & Technology</option>
                                            <option value="Business" <?php if($news->news_cat=="Business") echo 'selected="selected"'; ?>>Business</option>
                                            <option value="Politics" <?php if($news->news_cat=="Politics") echo 'selected="selected"'; ?>>Politics</option>
                                            <option value="Sports" <?php if($news->news_cat=="Sports") echo 'selected="selected"'; ?>>Sports</option>
                                            <option value="Music/Movie" <?php if($news->news_cat=="Music/Movie") echo 'selected="selected"'; ?>>Music/Movie</option>
                                            <option value="Self-development" <?php if($news->news_cat=="Self-development") echo 'selected="selected"'; ?>>Self-development</option>
                                        </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="avatar" class="col-sm-3 control-label">Image</label>
                                            <div class="col-sm-9">
                                                <div class="media">
                                                    <div class="media-left">
                                                    @if(isset($news->image))
                                                       <img src="{{URL::asset('upload/news/'.$news->image)}}" width="150" alt="person">
                                                    @endif    
                                                    </div>
                                                    <div class="media-body media-middle">
                                                        <input type="file" name="news_img" class="filestyle">
                                                   <!--     <small class="text-muted bold">Size 190x23px</small>  -->
                                                    </div>
                                                </div>
                            
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="col-md-offset-3 col-sm-9 ">
                                                <button type="submit" class="btn btn-primary">Submit<i class="md md-lock-open"></i></button>
                                                 
                                            </div>
                                        </div>

                                    {!! Form::close() !!} 
                                    </div>
									
							
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                </div>

@endsection