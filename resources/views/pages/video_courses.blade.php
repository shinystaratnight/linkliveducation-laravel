@extends("app")
@section("content")

    <!-- Services Section Start -->
    <section id="services" class="section">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="features-text section-header text-center">  
              <div>   
                <h2 class="section-title">Course Sub-Categories</h2>
              </div> 
            </div>
          </div>

        </div>
        <div class="row">
          <!-- Start Col -->
          @if(!empty($coursesubcat))
            @foreach($coursesubcat as $coursesub)
             <div class="col-lg-4 col-md-6 col-xs-12">
                <div class="services-item text-center">
                  <div class="icon">
                     <i class="lni-cog"></i> 
                  </div>
                  <h4><a href="{{ URL::to('view-course/'.$coursesub->id.'/'.$coursesub->name) }}" >{{$coursesub->name}}</a></h4>
                  <p>Share processes and data secure lona need to know basis Our team assured your web site is always safe.</p>
                  <a href="{{ URL::to('view-course/'.$coursesub->id.'/'.$coursesub->name) }}" >View Course</a>
                </div>
              </div>
            @endforeach
            @endif

        </div>
      </div>
    </section>
    <!-- Services Section End -->
@endsection