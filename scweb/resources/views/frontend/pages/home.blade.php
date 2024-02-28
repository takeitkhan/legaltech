@php 

    $home_page = \Cache::remember('home_page', 200, function(){
        return \App\Models\Page::where('page_name', 'home')->first();
    });

@endphp 

@extends('frontend.master')

 @section('title', 'Home')

 @section('content')

    <!-- Hero going here-->
    <section id="hero-area" class="margin-top-bottom">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center">
                <div class="">
                    <div class="hero-left d-inline-flex gap-3 flex-column">
                        <div class="hero-tag px-5 py-3">
                            @if(isset($home_page->hero_title))
                                <h1>{{ $home_page->hero_title }}</h1>
                            @else 
                                <h1>Over 30 years experience we <br/> know how difficult this is on your <br/> family.</h1>
                            @endif
                        </div>

                        <div class="hero-description px-5 py-3">
                            @if(isset($home_page->hero_subtitle))
                                <p class="m-0">{{ $home_page->hero_subtitle }}</p>
                            @else
                                <p class="m-0">Best consultant TAX, VAT, Family service in Bangldesh.</p>
                            @endif
                        </div>

                        <a href="#contact-area" class="btn request-consultation text-white mt-4 w-50 text-decoration-none">Request a free consultation</a>
                    </div>
                </div>

                <div class="">
                    <div class="hero-right">
                        <div class="hero">
                            <img @if(isset($home_page->hero_image)) src="{{ asset('storage/'.$home_page->hero_image) }}" @else src="{{ asset('frontend/assets/img/handshake-sadik.png') }}" @endif alt="sadik-counsel-handshake">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

     <!-- statistics percentage going here-->
     <section id="statistics-percentage-area" class="pb-4">
        <div class="container">
            <div class="statistics-percentage p-5 mb-5">
                <div class="percentage d-flex flex-wrap justify-content-between align-items-center">

                    <div class="single-progress d-flex flex-column gap-1 justify-content-center align-items-center">                    
                        <div class="progress bar">
                            <span class="progress-left">
                                <span class="progress-bar"></span>
                            </span>
                            <span class="progress-right">
                                <span class="progress-bar"></span>
                            </span>
                            <div class="progress-value d-flex flex-column">     
                                <span>{{ isset($home_page->statistic_one_number) ? $home_page->statistic_one_number : '90%'}}</span>
                            </div>
                        </div>
                    
                        <div class="title">{{ isset($home_page->statistic_one_title) ? $home_page->statistic_one_title : 'Charges Dropped'}}</div>
                       
                    </div>

                    <div class="single-progress d-flex flex-column gap-1 justify-content-center align-items-center">   
                        <div class="progress bar">
                            <span class="progress-left">
                                <span class="progress-bar"></span>
                            </span>
                            <span class="progress-right">
                                <span class="progress-bar"></span>
                            </span>
                            <div class="progress-value">
                                <span>{{ isset($home_page->statistic_two_number) ? $home_page->statistic_two_number : '90%'}}</span>                                    
                            </div>
                        </div>  

                        <div class="title">{{ isset($home_page->statistic_two_title) ? $home_page->statistic_two_title : 'Happy Clients'}}</div>
                    </div>

                    <div class="single-progress d-flex flex-column gap-1 justify-content-center align-items-center">  
                        <div class="progress bar" title="Trusting clinets">
                            <span class="progress-left">
                                <span class="progress-bar"></span>
                            </span>
                            <span class="progress-right">
                                <span class="progress-bar"></span>
                            </span>
                            <div class="progress-value d-flex flex-column">
                                <span>{{ isset($home_page->statistic_three_number) ? $home_page->statistic_three_number : '900+'}}</span>
                            </div>
                        </div> 
                        <div class="title">{{ isset($home_page->statistic_three_title) ? $home_page->statistic_three_title : 'Trusting Clients'}}</div>
                    </div>

                    <div class="single-progress d-flex flex-column gap-1 justify-content-center align-items-center"> 
                        <div class="progress bar" title="Trusting clinets">
                            <span class="progress-left">
                                <span class="progress-bar"></span>
                            </span>
                            <span class="progress-right">
                                <span class="progress-bar"></span>
                            </span>
                            <div class="progress-value d-flex flex-column">
                                <span>{{ isset($home_page->statistic_four_number) ? $home_page->statistic_four_number : '20'}}</span>
                            </div>
                        </div> 
                        <div class="title">{{ isset($home_page->statistic_four_title) ? $home_page->statistic_four_title : 'Award Won'}}</div>
                    </div>

                    <!-- <div class="single-percentage d-flex align-items-center justify-content-center">
                        <div class="middle-circle d-flex flex-column justify-content-center align-items-center">
                            <span>23</span>
                            <span>Award won</span>
                        </div>
                    </div> -->

                </div>
                
            </div>
        </div>
        

         <!-- Contact going here-->
        <section id="contact-area">
            <div class="container-fluid">
                <div class="contact-box p-4">
                    <form action="{{ route('contact.submit') }}" method="POST">
                        @csrf 

                        <div class="row">
                            <div class="col-md-12">
                                @include('layouts.flash-message')
                            </div>

                            <div class="col-md-12">                                
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12">
                                <div class="">
                                    <input type="text" class="form-control" name="name" placeholder="What is your name?*">
                                </div>
                            </div>

                            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12">
                                <div class="">
                                    <input type="email" class="form-control" name="email" placeholder="What is your email?*">
                                </div>
                            </div>

                            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12">
                                <div class="">
                                    <input type="text" class="form-control" name="phone" id="phone" placeholder="What is your phone number?*">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col col-sm-12">
                                <div class="mt-3">
                                    <textarea class="form-control" name="details" rows="3" placeholder="Case Details"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-2">                         
                            <div class="contact_accept">
                               <input type="checkbox" name="accept" id="accept">
                               <label for="accept">I have read and accept the <a href="#" class="text-decoration-none">Terms of Service & Privacy Policy</a></label>
                            </div> 
                            
                            <div class="button">
                                <button class="btn btn-light" id="submit_btn" disabled>Send message</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </section>
        <!--End Contact here-->
    </section>
     <!-- End statistics percentage here-->
@endsection

@push('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>

        $('#phone').on('change', function() {
            var phoneNumber = $('#phone').val();
            var regex = /^(\+?880|0)1[3456789]\d{8}$/;

            if (!regex.test(phoneNumber)) {
                alert('Invalid Bangladeshi phone number');
            } 
        });


        $(document).ready(function(){
            $('#accept').on('change', function(){
                let accept = $(this).val();
                accept = this.checked ? 1 : 0;

                if(accept == 1){  
                    $('#submit_btn').removeAttr('disabled');
                }else{
                    $('#submit_btn').attr('disabled', '');
                }
            })
            
            
        });
    </script>

@endpush

