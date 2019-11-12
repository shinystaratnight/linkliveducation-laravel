<?php $__env->startSection('content'); ?>
<?php echo $__env->make("includes.user_profile_nav", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php
function convert_created_at_time($date) {
    $datetime1 = new DateTime();
    $datetime2 = new DateTime($date);
    $interval = $datetime1->diff($datetime2);
    if ($interval->i == 0 && $interval->h == 0 && $interval->d == 0 && $interval->m == 0 && $interval->y == 0) {
        $time = $interval->format(' %s seconds');
    } else if ($interval->i > 0 && $interval->h == 0 && $interval->d == 0 && $interval->m == 0 && $interval->y == 0) {
        $time = $interval->format(' %i minutes ');
    } else if ($interval->h > 0 && $interval->d == 0 && $interval->m == 0 && $interval->y == 0) {
        $time = $interval->format(' %h hours');
    } else if ($interval->d > 0 && $interval->m == 0 && $interval->y == 0) {
        $time = $interval->format(' %a days ');
    } else if ($interval->m > 0 && $interval->y == 0) {
        $time = $interval->format(' %m months  ');
    } else if ($interval->y > 0) {
        $time = $interval->format(' %y years   ');
    }
    return $time;
}
?>
<div class="row text-center cover-container-inner-sec">
    <h1 class="profile-name-gallery">
        <?php echo e(Auth::user()->first_name); ?>'s Video
    </h1>
</div>
<div class="container" style="margin-top:20px;">
    <div class="row">
        <div class="col-md-12">
            <div id="grid" class="row videos-panl">
                <?php if(!empty($videos)): ?>
                <video width="1000" controls>
                    <source src="<?php echo e(URL::asset('upload/course/videos/'.$video)); ?>">
                </video>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<div class="container" style="margin-top:20px;">
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <?php echo Form::open(array('url' =>'video_questions','role'=>'form','enctype' =>'multipart/form-data')); ?>

                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                <input type="hidden" name="subcat" value="<?php echo e(isset($videos->subcat) ? $videos->subcat : null); ?>">
                <input type="hidden" name="video" value="<?php echo e(isset($video) ? $video : null); ?>">
                <textarea placeholder="Put a Question Here..."  name="question" rows="2" class="form-control input-lg p-text-area textInput" id="tbName"></textarea>
                <div class="panel-footer post-rig-footer">
                    <div class="pull-right">
                        <button type="submit" class="btn btn-info enableOnInput" id="myButton" disabled="disabled" onclick="this.form.submit()">Post</button>
                    </div>
                </div>
                <?php echo Form::close(); ?>

            </div>
            <?php if(!empty($questions)): ?>
            <?php $__currentLoopData = $questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $quser = DB::table('users')->where('id',$question->user_id)->first(); ?>
            <div class="panel panel-white post panel-shadow">
                <div class="post-heading">
                    <div class="pull-left image"><img src="<?php if ($quser->fileUpload1) { ?><?php echo e(URL::asset('/'.$quser->fileUpload1)); ?><?php } else { ?> <?php echo e(URL::asset('upload/dummy.png')); ?> <?php } ?>" class="avatar" alt="user profile image"> </div>
                    <div class="pull-left meta">
                        <div class="title h5"> <a href="<?php if ($question->user_id == Auth::user()->id) { ?><?php echo e(URL::to('/profile/')); ?><?php } else { ?><?php echo e(URL::to('/profile/'.$quser->user_id.'/'.$quser->first_name.'-'.$quser->last_name)); ?> <?php } ?>" class="post-user-name"><?php echo e($quser->first_name); ?> <?php echo e($quser->last_name); ?>. </a>
                            <?php
                                echo convert_created_at_time($question->created_at);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="post-description clearfix">
                    <p class="editpost"><?php echo nl2br(preg_replace('!(((f|ht)tp(s)?://)[-a-zA-Z?-??-?()0-9@:%_+.~#?&;//=]+)!i', '<a href="$1" target="_blank"><b>$1</b></a>', $question->question)); ?></p>
                    <div class="stats"> 
                        <ul class="list-unstyled list-inline">
                            <li>
                                <script>
                                    $(document).ready(function(){
                                    $("#comment_list" +<?php echo $question->id; ?>).hide();
                                    $("#showhidecomments" +<?php echo $question->id; ?>).click(function(){

                                    $("#comment_list" +<?php echo $question->id; ?>).toggle();
                                    $(".showmore" +<?php echo $question->id; ?>).removeClass('hidden');
                                    });
                                    });
                                </script>
                                <a href="#" class="stat-item" id="showhidecomments<?php echo e($question->id); ?>" onclick="return false;"> <i class="fa fa-comments-o icon"></i><span id="commment_count<?php echo e($question->id); ?>">
<?php $answers = DB::table('video_answers')->where('question_id', $question->id)->get();
?> </span><?php if(count($answers) > 1): ?> Answers <?php else: ?> Answer <?php endif; ?> </a>
                            </li>
                        </ul>                                   
                    </div>
                </div>
                <div class="post-footer">
                    <input id="comment<?php echo e($question->id); ?>" name="def<?php echo e($question->id); ?>" class="form-control add-comment-input" placeholder="Add a comment..." type="text">
                    <button type="button" id="abcd<?php echo e($question->id); ?>" disabled="disabled" onclick="post_comments(<?php echo e($question->id); ?>); this.disabled = true" class="btn btn-info pull-right">comment</button>
                    <script>
                        //function checkComment(){
                        $(document).ready(function() {
                        $('#abcd<?php echo $question->id; ?>').prop('disabled', true);
                        $('input[name="def<?php echo $question->id; ?>"]').keyup(function() {
                        if ($(this).val() != '') {
                        $('#abcd<?php echo $question->id; ?>').prop('disabled', false);
                        }
                        });
                        });
                    </script>
                    <?php if(!empty($answers)): ?>
                    <?php $__currentLoopData = $answers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $answer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <ul class="comments-list ggg<?php echo e($post->id); ?>" id="comment_list<?php echo e($post->id); ?>">
                        <input type="hidden" value="<?php echo e($post->id); ?>" id="postid">
                        <?php
                        $post_comments = DB::table('post_comments')->join('users', 'post_comments.user_id', '=', 'users.id')
                                        ->select('post_comments.*', 'users.first_name', 'users.last_name', 'users.fileUpload1')
                                        ->where('post_comments.post_id', $post->id)->limit(4)->orderBy('post_comments.created_at', 'asc')->get();
                        foreach ($post_comments as $post_comment) {
                            ?>
                            <li class="comment commentdeleted<?php echo $post_comment->id; ?>"> <a class="pull-left" href="<?php if ($post_comment->user_id == Auth::user()->id) { ?><?php echo e(URL::to('/profile/')); ?><?php } else { ?><?php echo e(URL::to('/profile/'.$post_comment->user_id.'/'.$post_comment->first_name.'-'.$post_comment->last_name)); ?> <?php } ?>"> <img class="avatar" src="<?php if ($post_comment->fileUpload1) { ?><?php echo e(URL::asset('/'.$post_comment->fileUpload1)); ?><?php } else { ?> <?php echo e(URL::asset('upload/dummy.png')); ?> <?php } ?>" alt="avatar"> </a>
                                <div class="comment-body">
                                    <p class="editcomment"><?php echo e($post_comment->comment); ?></p>
                                </div>
                            </li>
                    <?php } ?>
                    </ul>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                    <input type="hidden" id="total_comments<?php echo e($question->id); ?>" value="<?php echo e(count($answers)); ?>">
                    <input type="hidden" id="last_comment<?php echo e($question->id); ?>" value="<?php echo e(count($answers)); ?>">
                    <?php if(count($answers)>4): ?>
                    <a href="javascript:void(0);" onclick="loadMoreComment<?php echo $post->id; ?>()" class='showmore<?php echo $post->id; ?> hidden'>Show More</a>
                    <?php endif; ?>
                </div>
                <script>
                    function loadMoreComment<?php echo $question->id; ?>(){
                    var last_comment = parseInt($("#last_comment" +<?php echo $question->id; ?>).val());
                    var total_comments = parseInt($("#total_comments" +<?php echo $question->id; ?>).val());
                    var postid =<?php echo $question->id; ?>;
                    $.get('/loadcomment', {last_comment:last_comment, postid:postid}, function (data){
                    if (data){
                    $(".ggg" +<?php echo $question->id; ?>).append(data);
                    $("#last_comment" +<?php echo $question->id; ?>).val('');
                    var a = last_comment + 4;
                    if (total_comments <= a){
                    $(".showmore" +<?php echo $question->id; ?>).hide();
                    }
                    $("#last_comment" +<?php echo $question->id; ?>).val(a);
                    }
                    });
                    }
                </script>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<script type='text/javascript'>
    $(function () {
    $('.textInput').keyup(function () {
    if ($(this).val() == '') {
    $('.enableOnInput').prop('disabled', true);
    } else {
    $('.enableOnInput').prop('disabled', false);
    }
    });
    });
    function checkFormfile() {
    $(document).ready(function () {
    $(':button[type="submit"]').prop('disabled', true);
    $('input[type="file').change(function () {
    if ($(this).val() != '') {
    $(':button[type="submit"]').prop('disabled', false);
    }
    });
    });
    }
    ;
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('app1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\linkliveducation\resources\views/pages/watch_video.blade.php ENDPATH**/ ?>