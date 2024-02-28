
@include('admin.layout.partials.header')


<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  @include('admin.layout.partials.TopNavbar')

  @include('admin.layout.partials.sidebar')

 

  {{--  <!-- Content Wrapper. Contains page content -->  --}}
  <div class="content-wrapper">

    <div class="messages m-3">
      @include('layouts.flash-message')
    </div>
  
  @yield('content')
  </div>
  {{--  <!-- /.content-wrapper -->  --}}
   @include('admin.layout.partials.footer')
  {{--  <!-- Control Sidebar -->  --}}
  {{--  <aside class="control-sidebar control-sidebar-dark">
  </aside>  --}}
  {{--  <!-- /.control-sidebar -->  --}}

</div>
{{--  <!-- ./wrapper -->  --}}

@include('admin.layout.partials.footerScript')


