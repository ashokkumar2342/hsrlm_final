   @extends('admin.layout.base')
 @push('links')
 <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
 @endpush
@section('body') 
     <!-- Main content -->
     <section class="content">
       <!-- Small boxes (Stat box) -->
     
 </section>
  
@endsection
@push('scripts')
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script> --}}
<script src="{{ asset('admin_asset/plugins/chartjs/Chart.js') }}"></script>
<script src="{{ asset('admin_asset/dist/js/adminlte.min.js') }}"></script>
{{-- <script src="../../dist/js/adminlte.min.js"></script> --}}

</body>


@endpush
