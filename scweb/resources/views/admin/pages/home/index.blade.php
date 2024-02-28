@extends('admin.layout.master')

@section('title','Members | Sadik & Counsel')

@section('content')
  <!-- Content Header (Page header) --> 
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.index') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item ">Home page</li>
                </ol>
            </div><!-- col -->
        </div>
      </div>
     <!-- /.container-fluid -->  
    </div>
    <!-- /.content-header --> 

     <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
         <div class="row">
          <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">            
            <div class="card">
                <div class="card-header">
                    <span><b>Home page content</b></span>
                </div>
                <div class="card-body">
                    <form action="{{ route('pages.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf 
                        @method('PUT')

                        <input type="hidden" name="page_name" value="home">

                       <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="hero_title" class="form-label">Hero Title</label>
                                    <input type="text" class="form-control" name="hero_title" @if($home_page != null) value="{{ $home_page->hero_title }}" @else placeholder="Hero Title" @endif>
                                </div>
                            </div>
                            <!--End Col-->

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="hero_subtitle" class="form-label">Hero Sub-title</label>
                                    <input type="text" class="form-control" name="hero_subtitle" @if($home_page != null) value="{{ $home_page->hero_subtitle }}" @else placeholder="Hero Sub-title" @endif>
                                </div>
                            </div>
                            <!--End Col-->
                       </div><!--End Row-->


                       <div class="row">
                            <div class="col-md-3">
                               <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="statistic_one_number" class="form-label">Statistic 1 Number</label>
                                            <input type="text" class="form-control" name="statistic_one_number" @if($home_page != null) value="{{ $home_page->statistic_one_number }}" @else placeholder="Statistic 1 Number" @endif>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="statistic_one_title" class="form-label">Statistic 1 Title</label>
                                            <input type="text" class="form-control" name="statistic_one_title" @if($home_page != null) value="{{ $home_page->statistic_one_title }}" @else placeholder="Statistic 1 Title" @endif>
                                        </div>
                                    </div>
                               </div>
                            </div>
                            <!--End Col-->

                            <div class="col-md-3">
                               <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="statistic_two_number" class="form-label">Statistic 2 Number</label>
                                            <input type="text" class="form-control" name="statistic_two_number" @if($home_page != null) value="{{ $home_page->statistic_two_number }}" @else placeholder="Statistic 2 Number" @endif>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="statistic_two_title" class="form-label">Statistic 2 Title</label>
                                            <input type="text" class="form-control" name="statistic_two_title" @if($home_page != null) value="{{ $home_page->statistic_two_title }}" @else placeholder="Statistic 2 Title" @endif>
                                        </div>
                                    </div>
                               </div>
                            </div>
                            <!--End Col-->

                            <div class="col-md-3">
                               <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="statistic_three_number" class="form-label">Statistic 3 Number</label>
                                            <input type="text" class="form-control" name="statistic_three_number" @if($home_page != null) value="{{ $home_page->statistic_three_number }}" @else placeholder="Statistic 3 Number" @endif>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="statistic_three_title" class="form-label">Statistic 3 Title</label>
                                            <input type="text" class="form-control" name="statistic_three_title" @if($home_page != null) value="{{ $home_page->statistic_three_title }}" @else placeholder="Statistic 3 Title" @endif>
                                        </div>
                                    </div>
                               </div>
                            </div>
                            <!--End Col-->

                            <div class="col-md-3">
                               <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="statistic_four_number" class="form-label">Statistic 4 Number</label>
                                            <input type="text" class="form-control" name="statistic_four_number" @if($home_page != null) value="{{ $home_page->statistic_four_number }}" @else placeholder="Statistic 4 Number" @endif>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="statistic_four_title" class="form-label">Statistic 4 Title</label>
                                            <input type="text" class="form-control" name="statistic_four_title" @if($home_page != null) value="{{ $home_page->statistic_four_title }}" @else placeholder="Statistic 4 Title" @endif>
                                        </div>
                                    </div>
                               </div>
                            </div>
                            <!--End Col-->


                       </div><!--End Row-->
                       <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3 text-center">
                                    <div class="my-2"><b>Select Hero Image </b><small> (You should select 650px X 625px dimensions image)</small></div>
                                    <label for="hero_image" class="form-label border p-3">
                                        <input type="file" class="form-control d-none" name="hero_image" id="hero_image">
                                        <img id="imagePreview" @if($home_page != null) src="{{ asset('storage/'.$home_page->hero_image) }}" @else src="{{ asset('placeholder.jpg') }}" @endif width="300" alt="Image Preview">
                                    </label>
                                    
                                </div>
                            </div>
                            <!--End Col-->
                       </div><!--End Row-->

                       <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-info">Update</button>
                            </div>
                        </div>

                    </form>

                </div>
                <!-- /.card-body -->
            </div>
            <!--End Card -->
          </div>
          <!--End Col-->
         </div>
      </div>
     <!-- container-fluid -->
    </section>
@endsection


@push('js_script')
<script>
    document.getElementById('hero_image').addEventListener('change', function(event) {
    var input = event.target;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
            document.getElementById('imagePreview').setAttribute('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    });
</script>
@endpush
