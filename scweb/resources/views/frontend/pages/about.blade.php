@php 

    $about_page = \Cache::remember('about_page', 200, function(){
        return \App\Models\Page::where('page_name', 'about')->first();
    });

@endphp 

@extends('frontend.master')

@section('title', 'About Us')

@section('content')

    <!-- Hero going here-->
    <section id="" class="margin-top-bottom">
        <div class="container-fluid">
            <div class="hero-img d-flex justify-content-center align-items-center">    
                <img src="{{ asset('frontend/assets/img/about-us.svg') }}" class="img-fluid" width="60%" alt="sadik-counsel-about-us">
            </div>
        </div>
    </section>
    <!--End Hero going here-->

    <!--About going here-->
    <section id="" class="margin-top-bottom">
        <div class="container">
            <div class="row">
                <div class="col col-md-12">
                    <div class="about-content">
                        <h1>About Us</h1>
                        <p>{!! $about_page->description ?? NULL !!} </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End About going here-->
@endsection

