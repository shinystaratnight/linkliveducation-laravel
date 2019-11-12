<?php $__env->startSection('content'); ?>

    <?php echo $__env->make("includes.user_profile_nav", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="row text-center cover-container-inner-sec">
        <h1 class="text-center">
            <?php echo e(Auth::user()->first_name); ?>'s Tests
        </h1>
    </div>

        <div class="container" style="margin-bottom: 5rem; margin-top: 5rem;">
            <?php if(count($tests)>0): ?>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">Description</th>
                <th scope="col">Image</th>
                <th scope="col">Price</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $tests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($test->subCategory->name); ?></td>
                <td><img height="50" width="100" alt="" src="<?php echo e(asset('/site_assets/images/'.$test->image)); ?>"></td>
                <td><?php echo e($test->price); ?></td>
                <?php if(Auth::user()->checkQuizTaken($test->id)==0): ?>
                <td><a href="#" onclick="initialize(<?php echo e($test->id); ?>)" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary btn-sm">Take Test</a></td>
                    <?php else: ?>
                        <?php if(((Auth::user()->checkMarks($test->id)/count($test->questions))*100)<70): ?>
                    <td><a href="" data-toggle="modal" data-target="#exampleModal1" class="btn btn-primary btn-sm">Retake Test</a></td>
                        <?php endif; ?>
                    <?php endif; ?>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
                <?php else: ?>
                <h3>No Tests Found</h3>
                <?php endif; ?>
        </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo Form::open(['method'=> 'POST', 'action'=> 'CertificationController@store', 'files' => true]); ?>

                        <div class="form-row container" style="margin-top: 2rem;">
                            <div class="col-sm-12">
                                <?php echo Form::text('Name', null, ['class'=>'form-control', 'placeholder'=>'Name']); ?>

                            </div>
                        </div>
                        <div class="form-row container" style="margin-top: 2rem;">
                            <div class="col-sm-12">
                                <?php echo Form::text('Email', null, ['class'=>'form-control', 'placeholder'=>'Email']); ?>

                            </div>
                        </div>
                        <div class="form-row container" style="margin-top: 2rem;">
                            <div class="col-sm-12">
                                <?php echo Form::text('Phone', null, ['class'=>'form-control', 'placeholder'=>'Phone']); ?>

                            </div>
                        </div>
                        <div class="form-row container" style="margin-top: 2rem;">
                            <div class="col-sm-12">
                                <?php echo Form::text('PAN', null, ['class'=>'form-control', 'placeholder'=>'PAN Number']); ?>

                            </div>
                        </div>
                        <div class="form-row container" style="margin-top: 2rem;">
                            <div class="col-sm-6">
                                <select class="form-control" name="country_id" id="countries">
                                    <option value="0" disabled selected>Choose Country</option>
                                    <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($country->id); ?>"><?php echo e($country->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <select class="form-control" name="states[]" id="statesHere" multiple>
                                    <option value="0" disabled selected>Choose States</option>
                                </select>
                            </div>
                        </div>
                    <input type="hidden" value="" id="hiddenId" name="hiddenId">
                        <div class="form-row container" style="margin-top: 2rem;">
                            <div class="col-sm-6">
                                <?php echo Form::submit('Proceed', ['class'=> 'btn btn-primary']); ?>

                            </div>
                        </div>
                    <?php echo Form::close(); ?>

                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        You can Retake this test after Three months.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('extra-js'); ?>

<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>

    <script>

        function initialize(e)
        {
            document.getElementById("hiddenId").value = e;
        }

        $('#countries').on('change', function(e){
            let country_id = e.target.value;
            $.get('/getStates/' + country_id, function(data){
                 console.log(data);
                $('#statesHere').empty();
                $('#statesHere').append('<option value="0" disabled selected>Choose States</option>');

                $.each(data, function(index, stateObj){
                    $('#statesHere').append('<option value="'+ stateObj.id +'">'+ stateObj.name +'</option>');
                })
            });
        });

$(document).ready(function() {
            var last_valid_selection = null;
            $('#statesHere').change(function(event) {
                if ($(this).val().length > 5) {
                    alert('You can only choose 5 States!');
                    $(this).val(last_valid_selection);
                } else {
                    last_valid_selection = $(this).val();
                }
            });
        });

    </script>

    <?php $__env->stopSection(); ?>
<?php echo $__env->make('app1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/scholer1/public_html/resources/views/pages/user_tests.blade.php ENDPATH**/ ?>