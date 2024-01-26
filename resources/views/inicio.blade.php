@extends('layouts.contentIncludes')
@section('title','CAS CETE')
<meta name="csrf-token" content="{{ csrf_token() }}" />

@section('content')

<div class="container-fluid py-2 mt-2">
  
  <div class="row">
    <!-- <h5 style="color:white;">Solicitudes</h5> -->
    <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
      <div class="row">
        <h5 style="color:white;">Solicitudes</h5>
        <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">

          <div class="card">
            <div class="card-body p-2">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">SOLICITUDES</p>
                    <p class="text-xs xs-0 text-uppercase font-weight-bold">En espera</p>
                    <h5 class="font-weight-bolder">
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                    <i class="ni ni-watch-time text-lg opacity-10" aria-hidden="true"></i>
                  </div> 
                  <!-- <img src="{{asset('images/icon/icono1.png') }}" width="50px" height="50px"> -->
                </div>
              </div>
            </div>
          </div>

        </div>
        <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">

          <div class="card">
            <div class="card-body p-2">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                  <p class="text-sm mb-0 text-uppercase font-weight-bold">SOLICITUDES</p>
                    <p class="text-xs xs-0 text-uppercase font-weight-bold">Aprobadas</p>
                    <h5 class="font-weight-bolder">
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                    <i class="ni ni-check-bold text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                  <!-- <img src="{{asset('images/icon/icono2.png') }}" width="50px" height="50px"> -->
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
      <br>
      <!-- //////////////////// -->
      <div class="row">
        <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-2">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                  <p class="text-sm mb-0 text-uppercase font-weight-bold">SOLICITUDES</p>
                    <p class="text-xs xs-0 text-uppercase font-weight-bold">Rechazadas</p>
                    <h5 class="font-weight-bolder">
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                    <i class="ni ni-fat-remove text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                  <!-- <img src="{{asset('images/icon/icono3.png') }}" width="50px" height="50px"> -->
                </div>
              </div>
            </div>
          </div>

        </div>
        <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">

          <div class="card">
            <div class="card-body p-2">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                  <p class="text-sm mb-0 text-uppercase font-weight-bold">SOLICITUDES</p>
                    <p class="text-xs xs-0 text-uppercase font-weight-bold">Canceladas</p>
                    <h5 class="font-weight-bolder">
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-success shadow-success text-center rounded-circle">
                    <i class="ni ni-basket text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                  <!-- <img src="{{asset('images/icon/icono3.png') }}" width="50px" height="50px"> -->
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
      <!-- ///////////////////////// -->

    </div>

    <!-- //////////////////////////// -->
    <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
      <div class="row">
        <h5 style="color:white;">Órdenes</h5>
        <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">

          <div class="card">
            <div class="card-body p-2">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">ÓRDENES</p>
                    <p class="text-xs xs-0 text-uppercase font-weight-bold">En espera</p>
                    <h5 class="font-weight-bolder"> <!--h3-->
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                    <i class="ni ni-watch-time text-lg opacity-10" aria-hidden="true"></i>
                  </div> 
                </div>
              </div>
            </div>
          </div>

        </div>
        <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">

          <div class="card">
            <div class="card-body p-2">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                  <p class="text-sm mb-0 text-uppercase font-weight-bold">ÓRDENES</p>
                    <p class="text-xs xs-0 text-uppercase font-weight-bold">Asignadas</p>
                    <h5 class="font-weight-bolder">
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                    <i class="ni ni-single-02 text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>

      <br>
      <div class="row">
        <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">

          <div class="card">
            <div class="card-body p-2">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                  <p class="text-sm mb-0 text-uppercase font-weight-bold">ÓRDENES</p>
                    <p class="text-xs xs-0 text-uppercase font-weight-bold">Trabajando</p>
                    <h5 class="font-weight-bolder">
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-success shadow-success text-center rounded-circle">
                    <i class="ni ni-settings text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                  <!-- <img src="{{asset('images/icon/icono3.png') }}" width="50px" height="50px"> -->
                </div>
              </div>
            </div>
          </div>

        </div>
        <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">

          <div class="card">
            <div class="card-body p-2">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                  <p class="text-sm mb-0 text-uppercase font-weight-bold">ÓRDENES</p>
                    <p class="text-xs xs-0 text-uppercase font-weight-bold">Atendidas</p>
                    <h5 class="font-weight-bolder">  <!-- tenia h5 -->
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                    <i class="ni ni-check-bold text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                  <!-- <img src="{{asset('images/icon/icono4.png') }}" width="50px" height="50px"> -->
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>

    </div>
    <!-- //////////////////////// -->


  </div>
  
  <div class="row mt-4">
      <div class="d-flex justify-content-between ">
          <!-- <h1 class="mb-2 colorTitle">Registros</h1> -->
      </div>
  </div>
  
  <div class="row mt-4">
    <div class="col-lg-12 mb-lg-0 mb-4">
      <div class="card ">
      </div>
    </div>
  </div>
</div>

@endsection

@section('page-scripts')
<script src="{{ asset('js/scripts/modal/components-modal.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="//code.jquery.com/jquery-3.5.1.js"></script>
<script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<script src="//cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>

<link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">

<script>

 </script>

@endsection
