@extends('admin.layout.master')

@section('title','Settings | Sadik & Counsel')

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
                    <li class="breadcrumb-item ">Settings</li>
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
                    <span><b>Settings</b></span>
                </div>
                <div class="card-body">
                    <form action="{{ route('settings') }}" method="POST" enctype="multipart/form-data">
                        @csrf 
                        @method('PUT')

                       <div class="row">                          

                            <div class="col-md-6">
                                <div class="mb-3">
                                    @php 
                                        $site_name = \App\Models\Setting::where('key', 'site_name')->select('id', 'key', 'value')->first()->value;
                                    @endphp 
                                    <label for="site_name" class="form-label">Site Name</label>
                                    <input type="text" class="form-control" name="site_name" @if($site_name != null) value="{{ $site_name }}" @else placeholder="Site name" @endif>
                                </div>
                            </div>
                            <!--End Col-->

                            <div class="col-md-6">
                                @php 
                                    $copyright = \App\Models\Setting::where('key', 'copyright')->select('id', 'key', 'value')->first()->value;
                                @endphp 
                                <div class="mb-3">
                                    <label for="copyright" class="form-label">Copyright</label>
                                    <input type="text" class="form-control" name="copyright" @if($copyright != null) value="{{ $copyright }}" @else placeholder="Copyright" @endif>
                                </div>
                            </div>
                            <!--End Col-->

                            <div class="col-md-6">
                                @php 
                                    $footer_address = \App\Models\Setting::where('key', 'footer_address')->select('id', 'key', 'value')->first()->value;
                                @endphp
                                <div class="mb-3">
                                    <label for="footer_address" class="form-label">Footer Address</label>
                                    <input type="text" class="form-control" name="footer_address" @if($footer_address != null) value="{{ $footer_address }}" @else placeholder="Footer address" @endif>
                                </div>
                            </div>
                            <!--End Col-->

                            <div class="col-md-6">
                                @php 
                                    $facebook_link = \App\Models\Setting::where('key', 'facebook_link')->select('id', 'key', 'value')->first()->value;
                                @endphp
                                <div class="mb-3">
                                    <label for="facebook_link" class="form-label">Facebook Link</label>
                                    <input type="text" class="form-control" name="facebook_link" @if($facebook_link != null) value="{{ $facebook_link }}" @else placeholder="Facebook Link" @endif>
                                </div>
                            </div>
                            <!--End Col-->

                            <div class="col-md-6">
                                @php 
                                    $instagram_link = \App\Models\Setting::where('key', 'instagram_link')->select('id', 'key', 'value')->first()->value;
                                @endphp
                                <div class="mb-3">
                                    <label for="instagram_link" class="form-label">Instgram Link</label>
                                    <input type="text" class="form-control" name="instagram_link" @if($instagram_link != null) value="{{ $instagram_link }}" @else placeholder="Instagram Link" @endif>
                                </div>
                            </div>
                            <!--End Col-->

                            <div class="col-md-6">
                                @php 
                                    $linkedin_link = \App\Models\Setting::where('key', 'linkedin_link')->select('id', 'key', 'value')->first()->value;
                                @endphp
                                <div class="mb-3">
                                    <label for="linkedin_link" class="form-label">Linkedin Link</label>
                                    <input type="text" class="form-control" name="linkedin_link" @if($linkedin_link != null) value="{{ $linkedin_link }}" @else placeholder="Linkedin Link" @endif>
                                </div>
                            </div>
                            <!--End Col-->

                            <div class="col-md-6">
                                @php 
                                    $twitter_link = \App\Models\Setting::where('key', 'twitter_link')->select('id', 'key', 'value')->first()->value;
                                @endphp
                                <div class="mb-3">
                                    <label for="twitter_link" class="form-label">Twitter Link</label>
                                    <input type="text" class="form-control" name="twitter_link" @if($twitter_link != null) value="{{ $twitter_link }}" @else placeholder="Twitter Link" @endif>
                                </div>
                            </div>
                            <!--End Col-->

                       </div><!--End Row-->

                       <div class="row my-4">
                        <div class="col-md-12">
                            <h5><b>Global Meta Data</b></h5>
                            <hr />
                        </div><!--End Col-->

                        <div class="col-md-6">
                            @php 
                                $meta_keywords = \App\Models\Setting::where('key', 'meta_keywords')->select('id', 'key', 'value')->first()->value;
                            @endphp
                            <div class="mb-3">
                                <label for="meta_keywords" class="form-label">Meta Keywords</label>
                                <input type="text" class="form-control" name="meta_keywords" @if($meta_keywords != null) value="{{ $meta_keywords }}" @else placeholder="Meta Keywords" @endif>
                            </div>
                        </div><!--End Col-->

                        <div class="col-md-6">
                            @php 
                                $meta_description = \App\Models\Setting::where('key', 'meta_description')->select('id', 'key', 'value')->first()->value;
                            @endphp
                            <div class="mb-3">
                                <label for="meta_description" class="form-label">Meta Description</label>
                                <input type="text" class="form-control" name="meta_description" @if($meta_description != null) value="{{ $meta_description }}" @else placeholder="Meta Description" @endif>
                            </div>
                        </div><!--End Col--> 

                       </div><!--End Row-->

                       <div class="row">
                            <div class="col-md-6">
                                @php 
                                    $site_logo = \App\Models\Setting::where('key', 'site_logo')->select('id', 'key', 'value')->first()->value;
                                @endphp
                                <div class="mb-3 text-center">
                                    <div class="my-2"><b>Site Logo </b><small> (You should select 000px X 000px dimensions image)</small></div>
                                    <label for="site_logo" class="form-label border p-3">
                                        <input type="file" class="form-control d-none" name="site_logo" id="site_logo">
                                        <img id="imagePreviewLogo" @if($site_logo != null) src="{{ asset('storage/'.$site_logo) }}" @else src="{{ asset('placeholder.jpg') }}" @endif width="300" alt="Image Preview">
                                    </label>
                                    
                                </div>
                            </div>
                            <!--End Col-->

                            <div class="col-md-6">
                                @php 
                                    $favicon = \App\Models\Setting::where('key', 'favicon')->select('id', 'key', 'value')->first()->value;
                                @endphp
                                <div class="mb-3 text-center">
                                    <div class="my-2"><b>Favicon </b><small> (You should select 16px X 16px dimensions image)</small></div>
                                    <label for="favicon" class="form-label border p-3">
                                        <input type="file" class="form-control d-none" name="favicon" id="favicon">
                                        <img id="imagePreviewFav" @if($favicon != null) src="{{ asset('storage/'.$favicon) }}" @else src="{{ asset('placeholder.jpg') }}" @endif width="300" alt="Image Preview">
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
    document.getElementById('site_logo').addEventListener('change', function(event) {
    var input = event.target;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
            document.getElementById('imagePreviewLogo').setAttribute('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    });

    document.getElementById('favicon').addEventListener('change', function(event) {
    var input = event.target;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
            document.getElementById('imagePreviewFav').setAttribute('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    });
</script>
@endpush
