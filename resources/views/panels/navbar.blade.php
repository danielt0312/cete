<div class="min-height-300 bg-gris position-absolute w-100"></div>

<nav class="navbar navbar-main navbar-expand-lg px-0 border-radius-xl2 claseTop z-index-sticky bg-white left-auto position-sticky">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb" class="row">
        <img src="{{ asset('images/logo/blue.png') }}" class="navbar-brand-img mr-3 pr-3 col-md-8" alt="main_logo"
            height="60">
        <h6 class="font-weight-bolder text-white mb-0 col-md-4 mt-3">
            Bienvenido 
        </h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
        <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            
        </div>
        <ul class="navbar-nav justify-content-end">
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
            <a href="javascript:;" class="nav-link text-dark p-0 mr-3" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner mr-3">
                <i class="sidenav-toggler-line bg-dark"></i>
                <i class="sidenav-toggler-line bg-dark"></i>
                <i class="sidenav-toggler-line bg-dark"></i>
                </div>
            </a>
            </li>

            <li class="ml-3 nav-item dropdown d-flex align-items-center mr-5 pr-5 marginraigt">
            <!-- <a href="javascript:;" class="ml-3 nav-link text-white font-weight-bold px-0">
                <i class="fa fa-user me-sm-1 ml-3"></i>
                <span class="d-sm-inline d-none">{{-- Auth()->user()->name --}}{{-- $getUsername[0]->nameuser--}} </span>
            </a> -->
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-user me-sm-1 ml-3"></i>{{ $getUsername[0]->nameuser}}
                </a>
                <ul class="dropdown-menu navbar-user" aria-labelledby="navbarDropdown">
                    <li>
                        <i class="fa fa-user me-sm-1 ml-3 p-2" ></i><span class="text-xs">{{ $getUsername[0]->roluser}}</span>
                    </li>
                    <li>
                        <i class="fa fa-envelope me-sm-1 ml-3 p-2"></i><span class="text-xs">{{ $getUsername[0]->correouser}}</span>
                    </li>
                </ul>
            </li>
            <li class="nav-item d-flex align-items-center ml-3 pl-3 ">
            <a href="{{-- route('logout') --}}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();" class=" ml-3 pl-3 nav-link text-dark font-weight-bold px-0">
                <i class="fa fa-sign-out me-sm-1  ml-3 pl-3" aria-hidden="true"></i>
                <span class="d-sm-inline d-none  ml-3 pl-3">Salir </span>
            </a>
            @auth()
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

    @endauth
            </li>

            
            <li class="nav-item d-flex align-items-center">
            <a href="javascript:;" class="nav-link text-white font-weight-bold px-0">
                <span class="d-sm-inline d-none">
                <img src="{{ asset('images/logo/logo_SET2.png') }}"
                class="navbar-brand-img mr-3 pr-3" alt="main_logo" height="70" >
                </span>
            </a>
            </li>

        </ul>
        </div>
    </div>
</nav>

<div style="background-color: #4a4c51 !important;"  class="min-height-300 bg-primary position-absolute w-100"></div>