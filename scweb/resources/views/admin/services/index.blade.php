@extends('admin.layout.master')


@section('content')
  <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-4">
          <div class="col-12">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item">
                <a href="{{ route('admin.index') }}">Dashboard</a>
              </li>
              <li class="breadcrumb-item active">Services</li>
            </ol>
          </div>
         <!-- col -->
  
        </div>
        <div class="row my-2">
            <div class="col-md-12 d-flex justify-content-end">
                <a class="btn btn-info" href="{{ route('admin.services.create') }}">Add Service</a>
            </div>
        </div><!-- row -->


        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <span><b>Services</b></span>
              </div>
              <div class="card-body">                
                <!-- Main content -->
                <section class="content">
                  <div class="container-fluid">
                    <div class="row">
                        <!-- single-service  -->
                        @foreach($services as $service)
                            <div class="col-md-4 col-xxl-4 col-lg-3 col-12" >
                                <div class="card shadow">
                                    <div class="card-body">
                                        <h3 class="text-bold">{{ $service->title }}</h3>
                                        <p class="card-text">{{ $service->summary }}</p>
                                    </div>
                                    <div class="card-footer d-flex">
                                        <a href="{{ route('admin.services.edit',$service->id) }}"
                                class="btn btn-primary mr-2"  >Edit</a>
                                    <form id="delete-service-{{ $service->id }}" action="{{ route('admin.services.delete',$service->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="deleteService({{ $service->id }})" class="btn btn-danger " >
                                        Delete
                                        </button>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                  </div>
                  <!-- container-fluid -->
                </section>

              </div> <!--End card-body -->
            </div><!-- End card -->
          </div> <!--End  col-md-12 -->
        </div><!--End Row-->



      </div><!-- container-fluid -->
    </div><!-- content-header -->

@endsection


@push('js_script')
 <script type="text/javascript">
    function deleteService($serviceId){
        if(confirm('Are you sure you want to delete this service?')){
            event.preventDefault();
            document.getElementById('delete-service-'+$serviceId).submit();
        }
    }
 </script>
@endpush
