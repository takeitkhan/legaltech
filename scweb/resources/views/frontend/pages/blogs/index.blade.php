@extends('frontend.master')

@section('title', 'Blogs')

@section('content')

     <!-- Hero going here-->
     <section id="" class="margin-top-bottom">
        <div class="container-fluid">

            <div class="row bg-light">
                <div class="col col-md-12">
                    <div class="blog-header">
                        <h1>Blogs</h1>      
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

            <div class="blog-area d-flex gap-5 justify-content-between">
                <div class="blogs d-flex flex-column gap-5">

                    @forelse($blogs as $key => $blog)
                        <div class="single-blog d-flex flex-xxl-row flex-xl-row flex-lg-row flex-md-column flex-sm-column gap-4">
                            <div class="img-area">
                                <a href="{{ route('blog.view', $blog->slug) }}" class="text-decoration-none text-center">
                                    <figure>
                                        <img @if($blog->featured_image != null) src="{{ asset('storage/'.$blog->featured_image) }}" @else src="{{ asset('placeholder.jpg') }}" @endif class="img-fluid rounded img-thumbnail" width="400" alt="Trulli">
                                        <figcaption>{{ $blog->featured_image_caption }}</figcaption>
                                    </figure>
                                </a>
                            </div>

                            <div class="content-area">
                                <div class="date text-muted">Category - {{ $blog->category->title }} | Published - {{date('F d, Y h:i A', strtotime($blog->publish_date))}}</div>
                                <div class="title mt-3">
                                    <a href="{{ route('blog.view', $blog->slug) }}" class="text-decoration-none"><h2>{{ $blog->title }}</h2></a>
                                </div>

                                <div class="blog-short mb-3">
                                    <p>{!! Str::words($blog->body, 20) !!}</p>
                                </div>

                                <div class="link">
                                    <a href="{{ route('blog.view', $blog->slug) }}" class="btn btn-sm ">Read more</a>
                                </div>
                            </div>

                        </div><!--End Single blog-->
                    @empty
                        <div class="single-blog my-4">
                            <p>No published blogs found!</p>
                        </div>
                    @endforelse

                    <div class="custom-paginate">
                        {{ $blogs->links() }}
                    </div>

                </div><!--End Col-->

                <div class="category-list border-left">
                    @include('frontend.components._category')
                </div><!--End Col-->
            </div><!--End Row-->
        </div>
    </section>
    <!--End Blog going here-->
@endsection

