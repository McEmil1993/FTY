@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="container pt-2">
       <div class="card" style="background-color: cornflowerblue;">
           <div class="card-header">
                <div class="card-title">
                    <p>"<i>FLY ENGLISH STUDENTS' FEEDBACK (<b>FESF</b>) System</i> is a web-based system that helps ESL-Teachers to ease the work during making a feedback for their students."</p>
                </div>
           </div>
       </div>
       <div class="row">
           <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">FLY ENGLISH</h3>
                    </div>
                    <div class="card-body">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img class="d-block w-100" src="{{asset ('dist/img/Fly.png') }}" alt="Fly English">
                                </div>
                                <div class="carousel-item">
                                  <img class="d-block w-100" src="{{asset ('dist/img/Fly.png') }}" alt="Second slide">
                                </div>
                                <div class="carousel-item">
                                  <img class="d-block w-100" src="{{asset ('dist/img/Fly.png') }}" alt="Third slide">
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" 
                                role="button" data-slide="prev">
                                <span class="carousel-control-custom-icon" aria-hidden="true">
                                    <i class="fas fa-chevron-left"></i>
                                </span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" 
                                role="button" data-slide="next">
                                <span class="carousel-control-custom-icon" aria-hidden="true">
                                    <i class="fas fa-chevron-right"></i>
                                </span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
           </div>
           <div class="col-lg-6">
               <div class="card">
                   <div class="card-header">
                       <h3 class="card-title">ABOUT</h3>
                   </div>
                   <div class="card-body">
                       <div class="row">
                           <div class="col-lg-12">
                               <p>
                                   Want to learn English in a very fun and easy way? Enroll at Fly English Group!
                               </p>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
    </div>
</div>

<script type="text/javascript">
    $('#active_dashboard').addClass('new_active');
</script>
@endsection
