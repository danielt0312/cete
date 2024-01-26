@extends('layouts.contentIncludes')
@section('title','CAS CETE')

<meta name="csrf-token" content="{{ csrf_token() }}" />
<style>
.tableFixHead          { overflow: auto; height: 100px; }
.tableFixHead thead th { position: sticky; top: 0; z-index: 1; }
.table-wrapper {
  width: 100%;
  height: 200px; /* Altura de ejemplo */
  overflow: auto;
}
.table-responsive{
    -sm|-md|-lg|-xl|-xxl
  }
.table-wrapper table {
  border-collapse: separate;
  border-spacing: 0;
}

.table-wrapper table thead {
  position: -webkit-sticky; /* Safari... */
  position: sticky;
  top: 0;
  left: 0;
}

.table-wrapper table thead th,
.table-wrapper table tbody td {
  /* border: 1px solid #000; */
  background-color: #FFF;
}
table td {
    word-wrap: break-word;
    max-width: 400px;
  }
  #tabla_solicitudes td {
    white-space:inherit;
  }



.highlight { background-color: red; }
</style>
@section('content')

<div class="container-fluid py-4 mt-3">
  <!-- <input type="hidden" id="hiddenIdUser" name="hiddenIdUser" class="form-control"  value="{{auth()->id()}}" > -->

    <div class="row mt-4">

        <div class="d-flex justify-content-between ">
            <h1 class="mb-2 colorTitle">Administración de Solicitudes de Servicio</h1>
        </div>
    </div>



</div>


@endsection

@section('page-scripts')
<script src="{{ asset('js/scripts/modal/components-modal.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="//code.jquery.com/jquery-3.5.1.js"></script>
<!-- <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script> -->
<!-- <script src="//cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script> -->

<!-- <script src="//cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script> -->
<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script> -->
<!-- <script src="//cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script> -->

<!-- <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css"> -->
<link rel="stylesheet" href="{{asset('css/dataTables.bootstrap5.min.css')}}">
<script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('js/dataTables.bootstrap5.min.js')}}"></script>





<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous"> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css" integrity="sha512-mR/b5Y7FRsKqrYZou7uysnOdCIJib/7r5QeJMFvLNHNhtye3xJp1TdJVPLtetkukFn227nKpXD9OjUc09lx97Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js" integrity="sha512-FHZVRMUW9FsXobt+ONiix6Z0tIkxvQfxtCSirkKc5Sb4TKHmqq1dZa8DphF0XqKb3ldLu/wgMa8mT6uXiLlRlw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script>

</script>



@endsection
