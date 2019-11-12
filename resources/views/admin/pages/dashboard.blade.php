@extends("admin.admin_app")
@section("content")
 <!-- Page Header -->
 
                <div class="content bg-image overflow-hidden" style="background-image: url('{{ URL::asset('admin_assets/img/photos/bg.jpg') }}');">
                    <div class="push-50-t push-15">
                        <h1 class="h2 text-white animated zoomIn">Dashboard</h1>
                        <h2 class="h5 text-white-op animated zoomIn">Welcome Administrator</h2>
                    </div>
                </div>
                <!-- END Page Header -->

                <!-- Stats -->
                <div class="content content-narrow" >
                   <div class="row">

                       
                        <div class="col-sm-3 col-lg-6 detail-view-part">
                            <a class="block block-link-hover1 text-center fur-cls" href="{{ URL::to('admin/users') }}">
                                <div class="col-md-3 col-xs-3 block-content block-content-full bg-amethyst clas-di">
                                    <i class="fa fa-users fa-5x text-white"></i>
                                </div>
                                <div class="col-md-3 col-xs-6 block-content block-content-full block-content-mini clas-di2">
                                    <strong>{{$users}}</strong> Users
                                </div>
                            </a>
                        </div>
                       
                        <div class="col-sm-3 col-lg-6 detail-view-part">
                            <a class="block block-link-hover1 text-center fur-cls" href="{{ URL::to('admin/settings') }}">
                                <div class="col-md-3 col-xs-3 block-content block-content-full bg-city clas-di">
                                    <i class="fa fa-cog fa-5x text-white"></i>
                                </div>
                                <div class="col-md-3 col-xs-6 block-content block-content-full block-content-mini clas-di2">
                                    Settings
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- END Stats -->

                <!-- Page Content -->
                <div class="content">
                    <div class="row">
                       
                    </div>
                     
                </div>
                <!-- END Page Content -->

@endsection