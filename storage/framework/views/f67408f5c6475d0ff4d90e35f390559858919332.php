<style>
    .profile-section-new .profile-menu .active{
        background-color: #eee;
        color: #ff5e3a;
    }
    .profile-section-new .profile-menu .active  a{
        color:#ff5e3a;
    }
</style>
<div class="container">
    <div class="row text-center cover-container flex-container">
        <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 ">
            <div class="top-header-author flex-container  top-background-image-sec">
                <input type="hidden" id="src1" value="<?php if (Auth::user()->fileUpload1) { ?><?php echo e(URL::asset('/'.Auth::user()->fileUpload1)); ?> <?php } else { ?> <?php echo e(URL::asset('upload/dummy.png')); ?> <?php } ?>">
                <a href="<?php echo e(URL::to('/profile/')); ?>" class="author-thumb">
                    <img id='img-upload2' src="<?php if (Auth::user()->fileUpload1) { ?><?php echo e(URL::asset('/'.Auth::user()->fileUpload1)); ?> <?php } else { ?> <?php echo e(URL::asset('upload/dummy.png')); ?> <?php } ?>" />
                </a>
                <?php echo Form::open(array('url'=>'/profile_pic','id'=>'profile_pic','role'=>'form','enctype'=>'multipart/form-data')); ?>

                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <div class="form-group">
                    <div>
                        <span class="custom_img">
                            <span class="btn btn-default btn-file">
                                <span><i class="fa fa-camera" aria-hidden="true"></i></span> <input type="file" name="profile_pic" accept="image/png, image/jpg, image/jpeg, image/gif" id="imgInp1">
                            </span>
                        </span>
                    </div>
                    <div class="aftr-click-shbtn" style="display:none" id="upload_file">
                        <button type="submit" name="submit" class="btn btn-default">Upload</button>
                        <button id="clear" type="button" class="btn btn-default">Cancel</button> 
                    </div>

                </div>
                <?php echo Form::close(); ?>

                <?php
                $countries = DB::table('countries')->get();
                $states = DB::table('states')->get();
                if(!empty(Auth::user()->country)){
                    $ucountry = DB::table('countries')->where('id',Auth::user()->country)->value('name');
                }
                if(!empty(Auth::user()->state)){
                    $ustate = DB::table('states')->where('id',Auth::user()->state)->value('name');
                }
                ?>
                <div class="author-content">
                    <h5>
                        <a href="<?php echo e(URL::to('/profile')); ?>" class=" author-name">
                            <?php echo e(Auth::user()->first_name); ?> <?php echo e(Auth::user()->last_name); ?>

                        </a>
                    </h5>
                    <p class="user_info_headline"><?php echo e(Auth::user()->heading); ?></p>
                    <p class="country"><?php echo e(!empty(Auth::user()->city) ? Auth::user()->city : null); ?><?php if(!empty(Auth::user()->city) && !empty(Auth::user()->state)): ?> / <?php endif; ?><?php echo e(!empty(Auth::user()->state) ? $ustate : null); ?><?php if(!empty(Auth::user()->state) && !empty(Auth::user()->country)): ?> / <?php endif; ?><?php echo e(!empty(Auth::user()->country) ? $ucountry : null); ?></p>
                </div>
                <div class="top-profile-button-option">
                    <a href="#edit_user_info_modal" class="profile-option-select-btn2" data-toggle="modal" data-target="#edit_user_info_modal">
                        <i class="fa  fa-pencil" aria-hidden="true"></i>
                    </a>
                </div>
            </div> 
            <!-- Modal -->
            <div id="edit_user_info_modal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <?php echo Form::open(array('url'=>'edit_user_info','id'=>'edit_user_info','role'=>'form','enctype'=>'multipart/form-data')); ?>

                        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Edit User info</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row form-group">
                                <div class="col-sm-4 col-xs-12">
                                    <label>First Name</label>
                                    <input type="text" class="form-control" name="first_name" value="<?php echo e(Auth::user()->first_name); ?>" required/>
                                </div>
                                <div class="col-sm-4 col-xs-12">
                                    <label>Last Name</label>
                                    <input type="text" class="form-control" name="last_name" value="<?php echo e(Auth::user()->last_name); ?>" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" placeholder="Write Something That You Are Doing Or Looking For" name="heading" maxlength="38" value="<?php echo e(Auth::user()->heading); ?>" required/>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-4 col-xs-12">
                                    <label>Country</label>
                                    <select class="form-control" name="country" onchange="loadCountry(this.value)" required>
                                        <?php if(!empty($countries)): ?>
                                        <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $countri): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($countri->id); ?>" <?php
                                        if (isset(Auth::user()->country)) {
                                            if (Auth::user()->country == $countri->id) {
                                                echo 'selected';
                                            }
                                        }
                                        ?>><?php echo e($countri->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div class="col-sm-4 col-xs-12">
                                    <label>State/UT</label>
                                    <select class="form-control sel_state" name="state" id="states" required>
                                        <?php $__currentLoopData = DB::table('states')->where('country_id',Auth::user()->country)->orderBy("name")->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $states): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($states->id); ?>" <?php
                                        if (isset(Auth::user()->state)) {
                                            if (Auth::user()->state == $states->id) {
                                                echo 'selected';
                                            }
                                        }
                                        ?>><?php echo e($states->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="col-sm-4 col-xs-12">
                                    <label>City/Area</label>
                                    <input type="text" class="form-control" name="city" value="<?php echo e(Auth::user()->city); ?>" required>
                                </div>
                            </div>
                        </div> 
                        <div class="modal-footer">
                            <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Change</button>
                        </div>
                        <?php echo Form::close(); ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12 top-background-image-sec" style="position:relative;">
            <?php if(!empty(Auth::user()->cover_pic)): ?>
            <img src="<?php echo e(URL::asset('/'.Auth::user()->cover_pic)); ?>" class="backup_picture img-responsive"/>
            <?php else: ?>
            <img src="<?php echo e(URL::asset('site_assets/images/no_cover_picture.jpg')); ?>" class="backup_picture img-responsive" />
            <?php endif; ?>
            <div class="top-profile-button-option">
                <a href="javascript:void(0);" class="profile-option-select-btn" data-toggle="modal" data-target="#edit-cover-pic-modal" title="Edit Cover Pic" >
                    <i class="fa fa-picture-o" aria-hidden="true" ></i>
                </a>
            </div>
            <div class=" profile-section-new">
                <div class="clearfix">
                    <ul class="profile-menu">
                        <li class="active">
                            <a href="<?php echo e(URL::to('/videos')); ?>" >Videos</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function loadCountry(key) {
    $.get('states', {country_id: key}, function (data) {
        if (data) {
            $('#states').html('');
            $('#states').append(data);
        }
    });
}
</script><?php /**PATH E:\xampp\htdocs\linkliveducation\resources\views/includes/user_profile_nav.blade.php ENDPATH**/ ?>