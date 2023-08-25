<aside style="background-color: #ab0033 !important;" class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start " id="sidenav-main">
    <hr class="horizontal dark mt-5">
  <div class="w-auto mt-5" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" href="{{ route ('inicio') }}"> 
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-tv-2 text-white text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1 text-white">Inicio</span>
          </a>
        </li>
        @can('168-menu-registros-ordenes')
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6 text-white">Ordenes</h6>
        </li>
        
        <li class="nav-item">
          <a class="nav-link " href="{{ route ('listadoOrdenes') }}"> 
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-single-02 text-white text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1 text-white">Registros</span>
          </a>
        </li>
        @endcan
        @can('193-menu-nueva-orden')
        <li class="nav-item">
          <a class="nav-link " href="{{ route ('crearOrden') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-file-invoice text-white text-sm opacity-10" aria-hidden="true"></i>
            </div>
            <span class="nav-link-text ms-1 text-white">Nueva Orden</span>
          </a>
        </li>
        @endcan

        @can('204-ver-registros-solicitudes')
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6 text-white">Solicitudes</h6>
        </li>


        <!-- {{ auth()->user()->getAllPermissions()[0]; }} -->
        
        <li class="nav-item">
          <a class="nav-link " href="{{ route ('solicitudes_registros') }}"> 
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-single-02 text-white text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1 text-white">Registros</span>
          </a>
        </li>
        @endcan

        <!-- <li class="nav-item mt-3"> 
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6 text-white">Multiorden</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="{{-- route ('listadoMultiorden') --}}"> 
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-single-02 text-white text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1 text-white">Registros</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="{{-- route ('cierreMultiorden') --}}"> 
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-single-02 text-white text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1 text-white">Cierre Multiorden</span>
          </a>
        </li> -->
        
        
      </ul>
    </div>
  </aside>