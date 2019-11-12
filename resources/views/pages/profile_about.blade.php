@extends('app1')
@section('content')
<div class="row text-center cover-container" >
    <div class="container" style="margin-top:0px;">
        <div class="row ">
            <div class="col-md-12 no-paddin-xs cus-pad-topinc">
                <div class="col-md-12 no-paddin-xs">
                    <div class="profile-nav col-lg-3 col-md-4">
                        @include("includes.profile_about_sidebar") 
                    </div>
                    <div class="profile-info col-lg-9 col-md-8">
                        <div class="panel animated fadeInUp">
                            <div class="panel-body bio-graph-info about-us-block">
                                <h1 class="basic-info-text-top-head">Basic Information</h1>
                                @if(!isset($user))
                                <div class="plus-edit-icons-on pull-right">
                                    <span><a href="{{URL::to('/edit-profile')}}" data-toggle="tooltip" data-placement="top" title="Edit Profile"><i class="fa fa-edit"></i></a></span>
                                </div>
                                @endif 
                                <div class="row">
                                    <div class="col-sm-6 col-xs-12 bio-row">
                                        <h4>First Name</h4>
                                        <p>{{isset($user->first_name) ? $user->first_name : Auth::user()->first_name }}</p>
                                    </div>
                                    <div class="col-sm-6 col-xs-12 bio-row">
                                        <h4>Last Name</h4>
                                        <p>{{isset($user->last_name) ? $user->last_name : Auth::user()->last_name }}</p>
                                    </div>
                                    <div class="col-sm-6 col-xs-12 bio-row">
                                        <h4>Mobile</h4>
                                        <p>{{isset($user->mobile) ? $user->mobile : Auth::user()->mobile }}</p>
                                    </div>
                                    <div class="col-sm-6 col-xs-12 bio-row">
                                        <h4>Gmail</h4>
                                        <p>{{isset($user->email) ? $user->email : Auth::user()->email }}    </p>
                                    </div>
                                    <div class="col-sm-6 col-xs-12 bio-row">
                                        <h4>Gender</h4>
                                        <p>  {{isset($user->gender) ? $user->gender : Auth::user()->gender }}</p>
                                    </div>
                                    <div class="col-sm-6 col-xs-12 bio-row">
                                        <h4>Nationality</h4>
                                        <p>{{isset($user->nationality) ? $user->nationality : Auth::user()->nationality}}</p>                           
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection