@extends('admin.layout.master')

@section('title','Add Service | Sadik & Counsel')

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
               <li class="breadcrumb-item ">
                <a href="{{ route('admin.services.index') }}">Services</a>
               </li>
              <li class="breadcrumb-item active">Add Service</li>
            </ol>
          </div><!-- col -->
        </div> <!-- row -->


        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <span><b>New Service</b></span>
                    </div>
                    <div class="card-body">

                        <!-- Main content -->
                        <section class="content">
                            <div class="container-fluid mx-auto">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form action="{{ route('admin.services.store') }}" method="POST">
                                    @csrf
                                    <div class="row mx-auto mb-4">

                                        <div class="col-md-12 mb-3" style="margin-left:2px">
                                            <label for="title" class="form-label">Title</label>
                                            <input type="text" name="title" class="form-control" id="title" placeholder="Enter Title">
                                        </div>

                                        <div class="col-md-12 mb-3" style="margin-left:2px">
                                            <label for="summary" class="form-label">Summary</label>
                                            <textarea class="form-control" id="summary" name="summary" placeholder="Summary"></textarea>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label for="content" class="form-label">Content</label>
                                            <textarea name="content" id="editor" placeholder="Details"></textarea>
                                        </div>
                                    </div>

                                    <hr />
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-info" >Save</button>
                                    </div>
                                </form>
                            </div>
                        <!-- /.container-fluid -->
                        </section>


                    </div> <!--End card-body -->
                </div><!--End card -->
                
            </div><!--End col -->
        </div><!--End Row -->

      </div><!--container-fluid -->
    </div><!-- content-header -->
@endsection


@push('js_script')

<script src="{{ asset('js/ckeditor.js') }}"></script>
<script>
    const editor = ClassicEditor
        .create( document.querySelector( '#editor' ), {
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
