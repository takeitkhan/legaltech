@extends('admin.layout.master')

@section('title','About | Sadik & Counsel')

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
                    <li class="breadcrumb-item ">About page</li>
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
                    <span><b>About Content</b></span>
                </div>
                <div class="card-body">
                    <form action="{{ route('pages.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf 
                        @method('PUT')

                        <input type="hidden" name="page_name" value="about">

                       <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" name="description" id="description" rows="20" @if($about_page == null)  placeholder="About Us" @endif>{{ $about_page != null ? $about_page->description : null}}</textarea>
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

<script src="{{ asset('js/ckeditor.js') }}"></script>
<script>
    const editor = ClassicEditor
        .create( document.querySelector( '#description' ), {
              heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                        { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                        { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                        { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                        { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                    ]
                },
        })
        .catch( error => {
            console.error( error );
        } );
</script>
@endpush
