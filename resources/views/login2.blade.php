<!DOCTYPE html>
<html lang="es" class="light-style customizer-hide layout-menu-fixed layout-navbar-fixed" dir="ltr" data-theme="theme-semi-dark">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

        <title>Login</title>

        @include('panels.stylesLogin')
    </head>

    <body>
    <!-- Content -->
        <div class="authentication-wrapper authentication-cover">
            <div class="authentication-inner row m-0">
                <!-- /Left Text -->
                <div class="d-none d-lg-flex col-lg-7 col-xl-8 align-items-center colorGuindo">


                <img src="{{ asset('images/logo/logoSet.png') }}"
                    alt="Auth Cover Bg color" width="520"
                    class=" logoSet" data-app-light-img="pages/login-light.png"
                    data-app-dark-img="pages/login-dark.png">
                    
                    <div class="flex-row text-center mx-auto">

                        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                            <img src="{{ asset('images/slider/imagen-prueba.png') }}"
                                class="img-fluid authentication-cover-img d-block" width="730" >
                            </div>
                            <div class="carousel-item">
                            <img src="{{ asset('images/slider/imagen-prueba2.png') }}"
                            class="img-fluid authentication-cover-img d-block" width="730" >
                            
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                        </div>

                        
                            
                            
                            
                        
                        <div class="mx-auto">
                        <!-- <h3>Discover the powerful admin template 🥳</h3> -->
                        <p class="colorText">
                            Lorem ipsum dolor sit amet. Et fuga mollitia qui tempora incidunt non esse amet.
                            <br> Aut quia maiores quo quisquam fugiat aut atque autem ad Quis amet est vero voluptate.
                        </p>
                        </div>
                    </div>
                </div>
                <!-- /Left Text -->

                <!-- Login -->
                <div class="d-flex col-12 col-lg-5 col-xl-4 pr-4 borderrr ">
                    <!-- <div class="d-flex col-12 col-lg-5 col-xl-4 authentication-bg p-sm-5 p-4 borderrr"> -->
                    <div class="mx-auto otro col-12 col-lg-5 col-xl-4 pr-4">

                        <center>
                        <img src="{{ asset('images/logo/tam.png') }}"
                        alt="Auth Cover Bg color" width="200"
                        class=" img-fluid authentication-cover-img">
                        </center>

                        <!-- /Logo -->
                        <center>
                        <h4 class="mb-2">Bienvenido</h4>
                        <p class="mb-4">Ingresa tus datos para acceder</p>
                        </center>

                        <form id="formAuthentication" class="mb-3 fv-plugins-bootstrap5 fv-plugins-framework" action="{{ route('iniciarSesion') }}" method="POST" novalidate="novalidate">
                        @csrf
                        <div class="mb-3 fv-plugins-icon-container">
                            
                            <div class="input-group">
                            <div class="input-group-prepend ">
                                <span class="input-group-text" >
                                <i class="bx bxs-user-circle mb-1 mt-1"></i>
                                <!-- <i class="bx bxs-user-circle bx-sm"></i> -->
                                </span>
                            </div>

                            <input type="text" class="form-control" name="Correo" maxlength="900" placeholder="Correo">

                            </div>

                        </div>

                        <div class="mb-3 fv-plugins-icon-container">
                            <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" >
                                <i class="bx bxs-lock  mb-1 mt-1"></i>
                                <!-- <i class="bx bxs-lock bx-sm"></i> -->
                                </span>
                            </div>
                            <input type="password" name="Contraseña" class="form-control" placeholder="Contraseña" aria-label="Contraseña" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember-me" name="remember-me">
                            <label class="form-check-label" for="remember-me">
                                Recuerdame
                            </label>
                            </div>
                        </div>

                        <center>
                            <button class="btn btn-primary">
                            Ingresar
                            </button>
                        </center>

                        </form>

                        <!-- <p class="text-center">
                        <span>New on our platform?</span>
                        <a href="https://pixinvent.com/demo/frest-clean-bootstrap-admin-dashboard-template/html/vertical-menu-template-semi-dark/auth-register-cover.html">
                            <span>Create an account</span>
                        </a>
                        </p> -->

                        <div class="divider my-4">
                        <!-- <div class="divider-text">or</div> -->
                        </div>

                        <!-- <div class="d-flex justify-content-center">
                        <a href="javascript:;" class="btn btn-icon btn-label-facebook me-3">
                            <i class="tf-icons bx bxl-facebook"></i>
                        </a>

                        <a href="javascript:;" class="btn btn-icon btn-label-google-plus me-3">
                            <i class="tf-icons bx bxl-google-plus"></i>
                        </a>

                        <a href="javascript:;" class="btn btn-icon btn-label-twitter">
                            <i class="tf-icons bx bxl-twitter"></i>
                        </a>
                        </div> -->
                    </div>
                </div>
                <!-- /Login -->
            </div>
        </div>

        <!-- / Content -->

        @include('panels.scriptsLogin')

    </body>
</html>