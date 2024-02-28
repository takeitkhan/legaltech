@php 
    $meta_array = json_decode($blog->meta, true);
@endphp

@extends('frontend.master')

@section('title', $blog->title)

@section('meta')
    <meta name="description" content="{{ $meta_array['meta_description'] }}">
    <meta name="keywords" content="{{ $meta_array['meta_keywords'] }}">

    <meta property="og:title" content="{{ $blog->title }}" />
    <meta property="og:description" content="{{ $meta_array['meta_description'] }}">
    <meta property="og:type" content="blog" />
    <meta property="og:url" content="{{ request()->url() }}" />
    <meta property="og:image" content="{{ asset('storage/'.$blog->featured_image) }}" />
@endsection

@section('content')

     <!-- Hero going here-->
     <section id="" class="margin-top-bottom">
        <div class="container-fluid">
            <div class="row bg-light">
                <div class="col col-md-12">
                    <div class="blog-header">
                        <h1>Blog view</h1>      
                        <p>All new blogs</p>                  
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End Hero going here-->

    <!--Blog going here-->
    <section id="blogs-section" class="margin-top-bottom">
        <div class="container-fluid">

            <div class="blog-area d-flex gap-5 justify-content-start">
                <div class="blogs d-flex flex-column gap-5">

                    <div class="single-blog d-flex flex-column gap-4">
                        <div class="img-area">
                            <a href="#" class="text-decoration-none text-center">
                                <figure>
                                    <img @if($blog->featured_image != null) src="{{ asset('storage/'.$blog->featured_image) }}" @else src="{{ asset('placeholder.jpg') }}" @endif class="img-fluid rounded img-thumbnail" width="100%" alt="Trulli">
                                    <figcaption>{{ $blog->featured_image_caption }}</figcaption>
                                </figure>
                            </a>
                        </div>

                        <div class="single-blog-content-area">
                            <div class="date text-muted">Category - {{ $blog->category->title }} | Published - {{date('F d, Y h:i A', strtotime($blog->publish_date))}}</div>
                            <div class="title my-4">
                                <h2>{{ $blog->title }}</h2>
                                <hr />
                            </div>
                            <div class="blog-short mb-3">
                                <p>{!! $blog->body !!}</p>
                            </div>

                            <div class="link">
                                <a href="{{ route('blogs') }}" class="btn btn-sm ">Back</a>
                            </div>
                        </div>

                    </div><!--End Single blog-->
          

                </div><!--End Col-->

                <div class="category-list border-left">
                    @include('frontend.components._category')
                </div><!--End Col-->
            </div><!--End Row-->
        </div>
    </section>
    <!--End Blog going here-->
@endsection

