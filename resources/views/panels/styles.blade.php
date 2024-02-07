<link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/img/apple-icon.png') }}">
<link href="{{ asset('images/img/blue.png') }}" rel="icon" type="image/png">

<title>
  CAS
</title>
<!--     Fonts and icons     -->
<link href="{{ asset('css/fonts.googleapis.css') }}" rel="stylesheet" />
<!-- Nucleo Icons -->
<!-- <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
<link href="./assets/css/nucleo-svg.css" rel="stylesheet" /> -->
<link href="{{ asset('css/cssTemplate/nucleo-icons.css') }}" rel="stylesheet" />
<link href="{{ asset('css/cssTemplate/nucleo-svg.css') }}" rel="stylesheet" />
<!-- Font Awesome Icons -->
<script src="{{ asset('js/kit.fontawesome_42d5adcbca.js') }}" crossorigin="anonymous"></script>
<!-- <link href="./assets/css/nucleo-svg.css" rel="stylesheet" /> -->
<link href="{{ asset('css/cssTemplate/nucleo-svg.css') }}" rel="stylesheet" />
<!-- CSS Files -->
<!-- <link id="pagestyle" href="./assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" /> -->
<link id="pagestyle" href="{{ asset('css/cssTemplate/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" />

<link href="{{ asset('css/leaflet.css') }}" rel="stylesheet" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
   crossorigin=""/>

{{-- dataTables : Ciclo de vida de sistemas de información --}}
{{--<link href="{{ asset('css/jquery.dataTables.min.css') }}" rel="stylesheet /">--}}
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/css/bootstrap-tokenfield.min.css" integrity="sha512-YWDtZYKUekuPMIzojX205b/D7yCj/ZM82P4hkqc9ZctHtQjvq3ei11EvAmqxQoyrIFBd9Uhfn/X6nJ1Nnp+F7A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<!-- <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
   integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
   crossorigin=""/> -->
<!-- Incluya el archivo JavaScript del folleto después del CSS del folleto: -->

 <!-- Make sure you put this AFTER Leaflet's CSS
 <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
   integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
   crossorigin=""></script> -->

<style>
  .marginraigt{
    margin-right: 1em;
  }

  .colorTitle{
    color:white;
  }

  .SinNegrita{
    font-weight:normal;
  }

  .colorBtnPrincipal{ /*Estilo boton guindo*/
    background-color: #ab0033 !important;
    color:#FFFFFF !important;
  }

  .colorBtnPrincipal:hover{
    background-color: #ab0033 !important;
    color:#FFFFFF !important;
  }

  .colorBtnPrincipal:active {
    background-color: #ab0033 !important;
    color:#FFFFFF !important;
  }

  .colorBtnPrincipal:focus { outline: none; }

  .dt-button { /*Estilo boton excel de datatable*/
    padding: 0;
    border: none;
    color:#FFFFFF;
  }

  .dt-button:hover{ /*Estilo boton excel de datatable*/
    padding: 0;
    border: none;
    color:#FFFFFF;
  }

  .theadColor { /*Estilo boton excel de datatable*/
    background-color: #ab0033 !important;
    color:#FFFFFF;
  }

  .pestanias{ /*Estilo boton guindo*/
    border-radius:0.5rem;
    background-color: #ab0033 !important;
    color:#FFFFFF !important;
    text-align: center;
    vertical-align: middle;
    text-decoration: none !important;
  }

  .btnFiltros{
    border-top-right-radius:0.55em !important;
    border-bottom-right-radius:0.55em !important;
  }

  .scrollVertical {
    height: 20em;
    line-height: 1em;
    overflow-x: hidden;
    overflow-y: scroll;
    width: 100%;
    /* border: 1px solid; */
  }

  .scrollVerticalTareas {
    height: 15em;
    line-height: 1em;
    overflow-x: hidden;
    overflow-y: scroll;
    width: 100%;
    /* border: 1px solid; */
  }

  .scrollVerticalEdiE{
    height: 10em;
    line-height: 1em;
    overflow-x: hidden;
    overflow-y: scroll;
    width: 100%;
    /* border: 1px solid; */
  }

  .lineaHr{
    border-top: 1px solid #8392ab !important;
    opacity: 0.7 !important;
    height: 2px ;
    padding: 0;
    margin: 20px auto 0 auto;
  }

  .scrollHorizontal{
    overflow-x: scroll;
    overflow-y: scroll;
    height: 20em;
    width: 100%;
  }

  .btnEliminar{
    background-color: transparent !important;
    order: none !important;
    /* color: #ab0033 !important; */
    color: #a54565a !important;
    border:none;
  }

  #map {
    /* height: 400px; */
    width: 100%;
    height: 450px;
    box-shadow: 5px 5px 5px #888;
  }

  .replicar{
    background-color: #8392ab75 !important;
    border-radius: 10px;
    height: 90%;
    padding-left: 40px;
    padding-top: 10px;;
    padding-right: 140px;
  }

  .tituloTareas{
    color:#ab0033 !important;;
  }

  .trCentrar{
    text-align:center;
  }

  .theadCentrar{
    text-align:center;
  }

  .colorBtnCancelar{ /*Estilo boton guindo*/
    background-color: #ff0000 !important;
    color:#FFFFFF !important;
  }

  .colorBtnCancelar:hover{
    background-color: #ff0000 !important;
    color:#FFFFFF !important;
  }

  .colorBtnCancelar:active {
    background-color: #ff0000 !important;
    color:#FFFFFF !important;
  }

  .colorBtnCancelar:focus { outline: none; }

  div.dataTables_wrapper div.dataTables_length select {
    width: 6em !important;
  }

  table td {
    word-wrap: break-word;
    max-width: 400px;
  }
  #tablaPrueba2 td, #tabla_solicitudes td {
    white-space:inherit;
  }

  .navbar-user{
    width:17em !important;
  }

  {{-- dataTables : Ciclo de vida de sistemas de información --}}
  {{-- Acoplamiento de columnas a la tabla #proyectos --}}
  .descripcion, .documentacion {
      white-space: normal !important;
      word-wrap: break-word;;
  }
</style>
