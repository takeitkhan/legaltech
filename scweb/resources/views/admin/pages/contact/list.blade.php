@extends('admin.layout.master')

@section('title','Contact | Sadik & Counsel')

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
               <li class="breadcrumb-item active">Contact</li>
            </ol>
          </div>
          <!-- col -->
        </div>
 
      </div> <!--container-fluid -->  
    </div><!--content-header --> 

     <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
         <div class="row">
          <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">            
            <div class="card">

              <div class="card-header">
                  <span><b>Contacts</b></span>
              </div>

              <div class="card-body">

                <table class="table table-bordered w-100">
                    <thead>
                      <tr>
                        <th class="text-center"  width="5%">#</th>
                        <th class="text-center" width="10%">Name</th>
                        <th width="10%">Email</th>
                        <th width="10%">Phone</th>
                        <th width="55%">Details</th>
                        <th width="55%">Replied</th>
                      </tr>
                    </thead>

                    <tbody>
                      @forelse($contacts as $key => $contact)
                        <tr>
                          <td class="text-center" >{{ $key + 1 }}</td>                                   
                          <td>{{ $contact->name }}</td>                    
                          <td>{{ $contact->email }}</td>                    
                          <td>{{ $contact->phone }}</td>                    
                          <td>{{ $contact->details }}</td>
                          <td>
                            <div class="action text-center d-flex flex-column justify-content-center">
                              @if($contact->is_replied == 1)
                                  <span class="badge badge-success">Yes</span>
                              @else 
                                  <span class="badge badge-danger">No</span>
                              @endif

                              <div class="form-group my-3">
                                <div class="custom-control custom-switch">
                                  <input type="checkbox" class="custom-control-input" id="replied_switch{{$contact->id}}" @if($contact->is_replied) checked @endif onchange="isReplied({{ $contact->id }},  {{ $contact->is_replied }})">
                                  <label class="custom-control-label" for="replied_switch{{$contact->id}}"></label>
                                </div>
                              </div>

                            </div><!--End Action-->

                          </td>
                        </tr>

                        @empty
                          <tr>
                            <td class="text-center" colspan="6">No contact found!</td>
                          </tr>
                      @endforelse
                    </tbody>
                </table>

                <div class="custom-paginate">
                  {{ $contacts->links() }}
                </div>

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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script>

    function isReplied(id, value){
      $.ajax({
        url: "{{ route('contact.isReplied') }}",
        data : {
          id: id,
          value: value
        },
        success: function(){
          location.reload();
        },
        error: function(){
          console.log('error');
        }
      });
      
    }
  </script>
@endpush
