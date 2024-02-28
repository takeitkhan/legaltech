@extends('admin.layout.master')

@section('title','Edit Post | Sadik & Counsel')

@push('css')
       <link rel="stylesheet"
          href=
"https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css"
    />
@endpush

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
                <a href="{{ route('admin.blog.posts.index') }}">Posts</a>
               </li>
              <li class="breadcrumb-item active">Edit Post</li>
            </ol>
          </div><!--col -->
        </div><!--row --> 

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <span><b>Edit Post</b></span>
                    </div>

                    <div class="card-body">
                        <!-- Main content --> 
                        <section class="content">
                            <div class="container-fluid mx-auto">
                                <div class="row">
                                    <div class="col-md-12">
                                        @if(session()->has('error'))
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <strong>Error!</strong> {{ session()->get('error') }}
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            <form action="{{ route('admin.blog.posts.update',$post->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row mx-auto mb-4">
                                        <div class="col-md-6 col-12 mb-3">
                                            <label for="title" class="form-label">Title</label>
                                            <input type="text"

                                                name="title" class="form-control" value="{{ $post->title }}"
                                                id="title" placeholder="Enter Title"
                                            >
                                        </div>
                                        <div class="col-md-6 col-12  mb-3">
                                            <div class="form-group">
                                                <label for="category_id">Select Category</label>
                                                    <select class="form-control" name="category_id"
                                                    value="{{ $post->cateogory_id }}" id="category_id" >
                                                        <option value=""> select parent category</option>
                                                        @foreach($blogCategories as $category)
                                                            <option {{ $post->category_id == $category->id ? "selected" :" " }} value="{{ $category->id }}">{{ $category->title }}</option>
                                                        @endforeach
                                                    </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12 mb-3">
                                            <label for="excerpt" class="form-label">Excerpt</label>
                                            <input type="text" name="excerpt" class="form-control"
                                                id="excerpt" value="{{ $post->excerpt }}" placeholder="Enter Excerpt">
                                        </div>

                                        <div class="col-md-6 col-12 mb-3" >
                                            <label for="published_date" class="form-label">Published Date</label>
                                            <input type="text"  class="form-control datetimepicker"
                                            value="{{ date('Y/m/d H:i',strtotime($post->publish_date)) }}" name="publish_date" />
                                        </div>

                                        <div class="col-md-12 col-12 mb-3">
                                            <label for="body" class="form-label">Post Body</label>
                                            <textarea name="body" id="editor">
                                                {{ $post->body }}
                                            </textarea>
                                        </div>

                                        <div class="col-md-12 col-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <input type="checkbox" {{ $post->published ? 'checked' : '' }} name="published" >
                                                        <label for="published" class="form-label text-success">
                                                          &nbsp; Published?
                                                        </label>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="featured_image_caption" class="form-label">Image Caption</label>
                                                        <input type="text"
                                                            name="featured_image_caption" class="form-control"
                                                            id="featured_image_caption" value="{{ $post->featured_image_caption }}" placeholder="Enter caption"
                                                        >
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="meta_title" class="form-label">Meta Title</label>
                                                        <input type="text"
                                                            name="meta_title" class="form-control"
                                                            id="meta_title" value="{{ $post->meta_title() }}" placeholder="Enter Title"
                                                        >
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="meta_keywords"
                                                        class="form-label">Meta Keyword</label>
                                                        <input type="text"
                                                            name="meta_keywords" class="form-control"
                                                            id="meta_keywords"
                                                            value="{{ $post->meta_keywords() }}"  placeholder="Enter keyword"
                                                        >
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="meta_description" class="form-label">Meta Description</label>
                                                        <textarea
                                                            name="meta_description" class="form-control"
                                                            id="meta_description" placeholder="Enter Description"
                                                        >{{ $post->meta_description() }}</textarea>
                                                    </div>

                                                </div><!--End Col -->

                                                <div class="col-md-6">                                               
                                                    <div class="mb-3 text-center">
                                                        <div class="my-2"><b>Select Featured Image </b><small> (You should select 700px X 580px dimensions image)</small></div>
                                                        <label for="featured_image" class="form-label border p-3">
                                                            <input type="file" class="form-control d-none" name="featured_image" id="featured_image">
                                                            <img id="imagePreview" @if($post->featured_image != null) src="{{ asset('storage/'.$post->featured_image) }}" @else src="{{ asset('placeholder.jpg') }}" @endif width="300" alt="Image Preview">
                                                        </label>
                                                        
                                                    </div>           
                                                </div>
                                            </div>
                                        </div>      

                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-info">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        <!-- /.container-fluid -->
                        </section>

                    </div><!--End Card Body -->
                </div><!--End Card -->
            </div><!--col -->
        </div><!--row -->



      </div> <!--container-fluid --> 
    </div>
     <!--content-header --> 
@endsection


@push('js_script')
{{--  <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>  --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>

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
    });


    document.getElementById('featured_image').addEventListener('change', function(event) {
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
 <script type="text/javascript">
      $(".datetimepicker").each(function () {
        $(this).datetimepicker();
      });
    </script>
@endpush
