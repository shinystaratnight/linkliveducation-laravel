 <!-- Header Section Start -->
    <header id="home" class="hero-area">    
     
      <nav class="navbar navbar-expand-md bg-inverse fixed-top scrolling-navbar">
        <div class="container">
          <a href="{{URL::asset('/')}}" class="navbar-brand">LinkLiv Education</a>       
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <i class="lni-menu"></i>
          </button>
          <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto w-100 justify-content-end">
                <li class="nav-item <?php
                if ($_SERVER['REQUEST_URI'] == '/') {
                    echo 'active';
                }
                ?>"><a href="{{URL::asset('/')}}" class="nav-link page-scroll">Home</a></li>
                <li class="nav-item dropdown">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Video Courses</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?php $coursevideos = App\StudyMaterialCat::get(); ?>
                        @if(!empty($coursevideos))
                            @foreach($coursevideos as $coursevideo)
                            
                            <a href="{{ URL::to('video-courses/'.$coursevideo->id.'/'.$coursevideo->name) }}" class="dropdown-item"><?php echo $coursevideo->name; ?></a>
                           
                            @endforeach
                        @endif
                    </div>
                </li>
              <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Certifications
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php $categories = App\TestCat::get(); ?>
                        @if(!empty($categories))
                            @foreach($categories as $category)
                                    <a class="dropdown-item" href="{{URL::to('subCategories/'.$category->id)}}"><?php echo $category->name; ?></a>
                            @endforeach
                        @endif
                    </div>
              </li>
              <li class="nav-item <?php
                if ($_SERVER['REQUEST_URI'] == '/faq') {
                    echo 'active';
                }
                ?>"><a href="{{URL::asset('faq')}}" class="nav-link page-scroll">FAQ</a></li>
              <li class="nav-item">
                <a class="nav-link page-scroll" href="{{URL::asset('partner')}}">Partner</a>
              </li>     
              <li class="nav-item <?php
                if ($_SERVER['REQUEST_URI'] == '/vlog') {
                    echo 'active';
                }
                ?>"><a href="{{URL::asset('vlog')}}" class="nav-link">Team</a></li>
                <li class="nav-item <?php
                if ($_SERVER['REQUEST_URI'] == '/contact') {
                    echo 'active';
                }
                ?>"><a href="{{URL::asset('contact')}}" class="nav-link">Contact Us</a></li>
                <li class="nav-item">
                    @if(!Auth::check())
                    <a href="{{URL::asset('signin')}}" class="btn btn-singin">Sign In</a>
                    @else
                    <a href="{{URL::asset('profile')}}" class="btn btn-singin">Profile</a>
                    @endif
                </li>
            </ul>
          </div>
        </div>
      </nav>  
                 
    </header>
    <!-- Header Section End --> 
