@php 

    $services = \Cache::remember('services', 200, function(){
        return \App\Models\Service::get();
    });

@endphp 

@extends('frontend.master')

@section('title', 'Services')

@section('content')
    <!-- Hero going here-->
    <section id="service-hero-area" class="margin-top-bottom">
        <div class="container-fluid">
            <div class="hero-img d-flex justify-content-center align-items-center">    
                <img src="{{ asset('frontend/assets/img/service.svg')}}" class="img-fluid" width="60%" alt="sadik-counsel-services">
            </div>
        </div>
    </section>
    <!--End Hero going here-->

    <!--About going here-->
    <section id="service-content-area" class="margin-top-bottom">
        <div class="container">
            <div class="service-content row gx-5">                   
                  
                    @forelse($services as $key => $service)                      
                        <div class="col-md-6">
                            <div class="single-service">
                                <h5>{{ $service->title }}</h5>
                                <p>{!!  $service->content !!}</p>
                            </div>
                        </div><!--End Col-->
                    @empty 
                        <div class="col-md-6">
                            <div class="single-service">
                                <h5>No services found!</h5>
                                <p>Please add service from admin panel.</p>
                            </div>
                        </div>
                    @endforelse

                </div>

            </div>
        </div>
    </section>
    <!--End About going here-->

@endsection

