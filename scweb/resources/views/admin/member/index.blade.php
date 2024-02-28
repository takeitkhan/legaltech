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
               <li class="breadcrumb-item active">Members</li>
            </ol>
          </div>
          <!-- col -->
        </div>
        <div class="row">
            <div class="col-md-12 d-flex justify-content-end">
                <a class="btn btn-info" href="{{ route('admin.members.create') }}">Add Member</a>
            </div>
        </div>
          <!-- /.row -->  
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
                  <span><b>Member List</b></span>
              </div>

              <div class="card-body">

                <table class="table table-bordered w-100">
                    <thead>
                      <tr>
                        <th class="text-center"  width="5%">#</th>
                        <th class="text-center" width="10%">Image</th>
                        <th width="20%">Name</th>
                        <th width="55%">Details</th>
                        <th width="10%">Action</th>
                      </tr>
                    </thead>

                    <tbody>
                      @forelse($members as $key => $member)
                        <tr>
                          <td class="text-center" >{{ $key + 1 }}</td>
                          <td class="text-center" >
                            <img src="{{ asset('storage/'.$member->image) }}" width="50" alt="">
                          </td>                    
                          <td>{{ $member->name }}</td>                    
                          <td>{!! \Str::words($member->content, 15) !!}</td>                    
                          <td>
                            <div class="btn-action d-flex justity-content-around align-items-center h-100">
                              <a href="{{ route('admin.members.edit',$member->id) }}" class="btn btn-info mr-2" >Edit</a>

                              <form 
                                id="delete-member-{{ $member->id }}"
                                action="{{ route('admin.members.delete',$member->id) }}" 
                                method="POST">

                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" onclick="deleteMember({{ $member->id }})" class="btn btn-danger " >
                                  Delete
                                  </button>
                              </form>
                            </div>
                            
                          </td>                    
                        </tr>

                        @empty
                          <tr>
                            <td class="text-center" colspan="5">No member found!</td>
                          </tr>
                      @endforelse
                    </tbody>
                </table>

              </div>
              <!-- /.card-body -->
            </div>
            <!--End Card -->
          </div>
          <!--End Col-->
        </div><!-- End row -->
      </div><!-- End container-fluid -->
    </section>
@endsection


@push('js_script')
 <script type="text/javascript">
    function deleteMember(memberId){
        if(confirm('Are you sure you want to delete this service?')){
            event.preventDefault();
            document.getElementById('delete-member-'+memberId).submit();
        }
    }
 </script>
@endpush
