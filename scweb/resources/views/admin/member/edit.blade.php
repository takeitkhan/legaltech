@extends('admin.layout.master')

@section('title','Edit Member | Sadik & Counsel')

@section('content')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-4">

          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item">
                <a href="{{ route('admin.index') }}">Dashboard</a>
               </li>
               <li class="breadcrumb-item ">
                <a href="{{ route('admin.members.index') }}">Members</a>
               </li>
              <li class="breadcrumb-item active">Edit Member</li>
            </ol>
          </div><!-- col -->
        </div><!-- row -->

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <span><b>Edit Member</b></span>
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
                            <form action="{{ route('admin.members.update',$member->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row mx-auto mb-4">
                                        <div class="col-md-12 mb-3" style="margin-left:2px">
                                            <label for="name" class="form-label">Member Name</label>
                                            <input type="text" name="name" class="form-control" id="name" value="{{ $member->name }}" placeholder="Enter Name">
                                        </div>
                                      
                                        <div class="col-md-12 mb-3">
                                            <label for="content" class="form-label">Content</label>
                                            <textarea name="content" id="editor">
                                            {{ $member->content }}
                                            </textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3 text-center">
                                            <div class="my-2"><b>Select Member Image</b><small> (You should select 265px X 300px dimensions image)</small></div>
                                            <label for="image" class="form-label border p-3">
                                                <input type="file" class="form-control d-none" name="image" id="image">
                                                <img id="imagePreview" @if($member->image != null) src="{{ asset('storage/'.$member->image) }}" @else src="{{ asset('placeholder.jpg') }}" @endif width="300" alt="Image Preview">
                                            </label>
                                            
                                        </div>
                                    </div>
                                    <!--End Col-->

                                    <hr />
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-info" >Update</button>
                                    </div>
                                </form>
                            </div>
                        {{--  <!-- /.container-fluid -->  --}}
                        </section>

                    </div><!--End Card Body-->
                </div><!--End Card-->
            </div><!--End Col-->
        </div><!--End Row-->


      </div><!-- container-fluid -->
    </div><!-- content-header -->
@endsection


@push('js_script')
{{--  <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>  --}}
<script src="{{ asset('js/ckeditor.js') }}"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ),{
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
        } )
        .catch( error => {
            console.error( error );
        } );


        document.getElementById('image').addEventListener('change', function(event) {
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
