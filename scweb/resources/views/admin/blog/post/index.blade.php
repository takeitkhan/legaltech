@extends('admin.layout.master')

@section('title','Blog Post | Sadik & Counsel')

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
                <li class="breadcrumb-item active">Blog Posts</li>
                </ol>
            </div>
            <!--col -->
        </div>

        <div class="row my-2">
            <div class="col-md-12 d-flex justify-content-end">
                <a class="btn btn-info" href="{{ route('admin.blog.posts.create') }}">Add Blog</a>
            </div>
        </div><!--row --> 


        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <span><b>Blog List</b></span>
                    </div>
                    <div class="card-body">

                        <!-- Main content --> 
                        <section class="content">
                            <div class="container-fluid">       
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

                                <div class="row">
                                    <table class="table table-bordered w-100">
                                        <thead>
                                            <tr>
                                                <th width="5%">No.</th>
                                                <th width="10%">Category</th>
                                                <th width="10%">Title</th>
                                                <th width="30%">Body</th>
                                                <th width="5%">Excerpt</th>                                                
                                                <th width="5%">Published</th>
                                                <th width="10%">Featured Image</th>
                                                <th width="10%">Publish Date</th>
                                                <th width="10%">Created</th>
                                                <th width="5%">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($blogPosts as $key => $post)
                                                <tr>
                                                    <th scope="row">{{ $key + 1 }}</th>
                                                    <td>{{ $post->category->title ?? "" }}</td>
                                                    <td>{!! Str::words($post->body, 15) !!}</td>
                                                    <td>{{ $post->title }}</td>
                                                    <td>{{ Str::words($post->excerpt, 5) }}</td>
                                                    <td class="text-center">
                                                        @if($post->published)
                                                            <div class="badge badge-success">Yes</div>
                                                        @else 
                                                            <div class="badge badge-secondary">No</div>
                                                        @endif
                                                    </td>
                                                   
                                                    <td>
                                                        <img src="{{ asset('storage/'.$post->featured_image) }}" width="60" alt="{{ $post->slug }}">
                                                    </td>
                                                    <td>{{ $post->publish_date }}</td>
                                                    <td>{{ $post->created_at }}</td>
                                                    <td>
                                                        <div class="btn-action d-flex justify-content-center align-items-center">
                                                            <a class="btn btn-sm btn-info mx-2"
                                                            href="{{ route('admin.blog.posts.edit', $post->id) }}">
                                                                <i class="fas fa-edit nav-icon"></i>
                                                            </a>
                                                            <form id="delete-post-{{ $post->id }}"
                                                                action="{{ route('admin.blog.posts.delete', $post->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                
                                                                <button type="submit"
                                                                    class="btn btn-sm btn-danger mx-2" >
                                                                <i class="fas fa-trash nav-icon"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                        
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </section>

                    </div><!--End Card Body -->
                </div><!--End Card -->
            </div><!--End Col-->
        </div><!--End Row-->

      </div> <!--container-fluid --> 
    </div><!--content-header --> 

@endsection


@push('js_script')
 <script type="text/javascript">
    function deletePost(categoryId){
        if(confirm('Are you sure you want to delete this service?')){
            event.preventDefault();
            document.getElementById('delete-category-'+categoryId).submit();
        }
    }

    function getCategoryViaId(categoryId){
        $.ajax({
            url: "/admin/blog/categories/"+categoryId,
            type: "GET",
            dataType: "json",
            success: function(data){
               console.log(data,'data')
               const category = data.category;
               $('#edit_title').val(category.title);
               $("input[name='category_id']").val(category.id)
               $("#parent_category").val(category.parent_id)
               $("#editCategoryModal").modal('show')
            },
            error: function(error){
                console.log(error);
            }
        })
    }

    $(document).ready(function(){

        $('#addCategoryForm').on('submit',function(e){
            e.preventDefault();
            $.ajax({
                url: "{{ route('admin.blog.categories.store') }}",
                type: "POST",
                data: $(this).serialize(),
                dataType: "json",
                success: function(data){
                    console.log(data);
                    alert(data.message)
                    window.location.reload();
                },
                error: function(error){
                    console.log(error);
                }
            })
        })

        $('#editCategoryForm').on('submit',function(e){
            e.preventDefault();
            $.ajax({
                url: "/admin/blog/categories/"+$("input[name='category_id']").val(),
                type: "PUT",
                data: $(this).serialize(),
                dataType: "json",
                success: function(data){
                    console.log(data);
                    alert(data.message)
                    window.location.reload();
                },
                error: function(error){
                    console.log(error);
                }
            })
        })


    })
 </script>
@endpush
