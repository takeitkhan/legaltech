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
                <li class="breadcrumb-item active">Blog Category</li>
                </ol>
            </div>
           <!-- col -->
        </div>

        <div class="row">
            <div class="col-md-12 d-flex justify-content-end">
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addCategoryModal">
                    Add Category
                </button>
            </div>
        </div>
       <!-- row -->
      </div>
      <!-- container-fluid -->
    </div>
   <!-- content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        <span><b>Category List</b></span>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered w-100">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="40%">Category</th>
                                    <th width="40%">Parent Category <small>(Subcategory have parent category)</small></th>
                                    <th width="15%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($blogCategories as $category)
                                    <tr>
                                        <th scope="row">{{ $category->id }}</th>
                                        <td>{{ $category->title }}</td>
                                        <td>{{ $category->parentCategory->title ?? "N/A" }}</td>
                                        </td>
                                        <td class="">
                                           <div class="btn-action d-flex justify-content-center">
                                            <button class="btn btn-info editCategoryForm mr-2" onclick="getCategoryViaId({{ $category->id }})">
                                                    <i class="fas fa-edit nav-icon"></i>
                                                </button>
                                                <form id="delete-category-{{ $category->id }}"
                                                    action="{{ route('admin.blog.categories.delete',$category->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="deleteCategory({{ $category->id }})"
                                                        class="btn btn-danger" >
                                                    <i class="fas fa-trash nav-icon"></i>
                                                    </button>
                                                </form>
                                           </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">No category found!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div><!--End Card Body-->
                </div><!--End Card-->

            </div><!--End Col-->
          </div><!--End Row-->
      </div><!--End Container-fluid-->
    </section>

    <!-- Button trigger modal -->


   <!-- Modal -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="addCategoryForm" method="post">
                    @csrf

                    <div class="form-group">
                        <label for="category">Category</label>
                        <input type="text" name="title" class="form-control" id="category" placeholder="Category">
                    </div>

                    <div class="form-group">
                        <label for="parent_category">Parent Category (if you want to add sub-category then select one)</label>
                        <select class="form-control" name="parent_category" id="parent_category">
                            <option value="">Select Parent Category</option>
                            @foreach($blogCategories as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-info">Save</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>


    {{--  <!-- Modal -->  --}}
    <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="editCategoryForm" method="post">
                    @csrf
                    <input type="hidden" name="category_id">
                    <div class="form-group">
                        <label for="category">Category</label>
                        <input type="text" name="title" class="form-control" id="edit_title">
                    </div>
                    <div class="form-group">
                        <label for="parent_category">Parent Category</label>
                            <select class="form-control" name="parent_category" id="parent_category">
                                <option value=""> Select Parent Category</option>
                                @foreach($blogCategories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>

@endsection


@push('js_script')
 <script type="text/javascript">
    function deleteCategory(categoryId){
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
