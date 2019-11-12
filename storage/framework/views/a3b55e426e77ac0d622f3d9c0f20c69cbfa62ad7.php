<?php $__env->startSection("content"); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<!--   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.css"> -->
<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active">
            <img src="./site_assets/images/1MarketingInternship.jpg" alt="Los Angeles">
        </div>
        <div class="item">
            <img src="./site_assets/images/2CampusAmbassador.jpg" alt="Chicago">
        </div>
        <div class="item">
            <img src="./site_assets/images/3CourseInstructor.jpg" alt="New York">
        </div>
        <div class="item">
            <img src="./site_assets/images/4Hiring.jpg" alt="New York">    
	</div>
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<section class="ftco-section contact-section bg-light">
    <div class="container">
        <div class="row d-flex mb-5 contact-info">
            <div class="col-md-12 mb-4">
                <h1 style="text-align: center;">Get In Touch</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 margin30" >
                <p><b>Phone:</b> <a style="color: #1a1a1a;" href="tel://+91 8929887709">+91 8929887709</a></p>
            </div>  
            <div class="col-md-3 margin5" >
                <p><b>Email:</b> <a style="color: #1a1a1a;" href="mailto:info@linkliveducation.com">info@linkliveducation.com</a></p>
            </div>
        </div>
        <div class="row d-flex align-items-stretch no-gutters">
            <div class="col-md-8 offset-md-2 p-5 order-md-last">
                <?php if(count($errors) > 0): ?>
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <ul style="list-style: none;padding-left: 0px;">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
                <?php endif; ?>
                <?php if(Session::has('flash_message')): ?>
                <div class="alert alert-success fade in">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <?php echo e(Session::get('flash_message')); ?>

                </div>  
                <?php endif; ?>
                <?php echo Form::open(array('url' => 'contact','role'=>'form','enctype' => 'multipart/form-data')); ?>

                <div class="form-group">
                    <input type="text" class="form-control" name="uname" placeholder="Your Name">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="uemail" placeholder="Your Email">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="usubject" placeholder="Subject">
                </div>
                <div class="form-group">
                    <textarea id="" cols="30" rows="7" name="umessage" class="form-control" placeholder="Message"></textarea>
                </div>
                <div class="form-group">
                    <!-- <input type="submit" value="Send Message" class="btn btn-primary py-3 px-5"> -->
                    <input type="submit" value="Send Message" class="btn btn-primary btn-block">
                </div>
                <?php echo Form::close(); ?>

            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("app", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/scholer1/public_html/resources/views/pages/contact.blade.php ENDPATH**/ ?>