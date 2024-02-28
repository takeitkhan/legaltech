@php 
    $members = \Cache::remember('members', 200, function(){
        return \App\Models\Member::get();
    });
@endphp 

@extends('frontend.master')

@section('title', 'Team')

@section('content')

    
    <!-- Hero going here-->
    <section id="team-hero-area" class="margin-top-bottom">
        <div class="container-fluid">
            <div class="hero-img d-flex justify-content-center align-items-center">    
                <img src="{{ asset('frontend/assets/img/team-sadik-counsel.svg') }}" class="img-fluid" width="60%" alt="sadik-counsel-services">
            </div>
        </div>
    </section>
    <!--End Hero going here-->

    <!--About going here-->
    <section id="team-content-area" class="margin-top-bottom">
        <div class="container">
            <div class="team-content row gx-5">
                
                    @forelse($members as $key => $member)
                        <div class="col-md-6">
                        
                            <!-- Single Member -->
                            <div class="single-member d-flex gap-4 justify-content-start">   
                                <div class="member-img flex-grow-1">
                                    <img @if($member->image != null) src="{{ asset('storage/'.$member->image) }}" @else src="{{ asset('frontend/assets/img/team/1.png') }}" @endif class="img-fluid rounded team-member-shadow" alt="Member name">
                                </div> 

                                <div class="member-content">
                                    <h4>{{ $member->name }}</h4>
                                    <p>{!! $member->content !!} </p>
                                </div>     
                            
                            </div><!--End Single Member -->
                        </div><!--End Col-->
                    @empty 
                        <div class="col-md-6">
                            <div class="single-member d-flex gap-4 justify-content-start">   
                                <div class="member-img flex-grow-1">
                                    <img src="{{ asset('frontend/assets/img/team/1.png') }}" class="img-fluid rounded team-member-shadow" alt="Member name">
                                </div>

                                <div class="member-content">
                                <small class="text-danger">(This is dummy Data. Please add member from admin panel.)</small>
                                    <h4>Mr. Sadik</h4>
                                    <p>Founder & Senior Partner Tax & Vat Consultant. BBA, MBA, Faculty of Business Studies, Dhaka University. </p>
                                </div>
                            
                            </div><!--End Single Member -->
                        </div><!--End Col-->

                    @endforelse 
            </div>
        </div>
    </section>
    <!--End About going here-->
@endsection

