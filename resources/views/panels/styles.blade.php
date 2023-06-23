<link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/img/apple-icon.png') }}">
<link href="{{ asset('images/img/blue.png') }}" rel="icon" type="image/png">

<title>
  CAS
</title>
<!--     Fonts and icons     -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
<!-- Nucleo Icons -->
<!-- <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
<link href="./assets/css/nucleo-svg.css" rel="stylesheet" /> -->
<link href="{{ asset('css/cssTemplate/nucleo-icons.css') }}" rel="stylesheet" />
<link href="{{ asset('css/cssTemplate/nucleo-svg.css') }}" rel="stylesheet" />
<!-- Font Awesome Icons -->
<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
<!-- <link href="./assets/css/nucleo-svg.css" rel="stylesheet" /> -->
<link href="{{ asset('css/cssTemplate/nucleo-svg.css') }}" rel="stylesheet" />
<!-- CSS Files -->
<!-- <link id="pagestyle" href="./assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" /> -->
<link id="pagestyle" href="{{ asset('css/cssTemplate/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" />

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

  .lineaHr{ 
    border-top: 1px solid #8392ab !important; 
    opacity: 0.7 !important;
    height: 2px ;
    padding: 0;
    margin: 20px auto 0 auto;
  }

  .btnEliminar{
    background-color: transparent !important;
    order: none !important;
    color: #ab0033 !important;
    border:none;
  }

</style>