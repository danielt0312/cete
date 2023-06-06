<html lang="es" data-uw-w-loader="" class="">
	<head>
		<meta charset="UTF-8">
		
		<title>Secretaría de Educación | Gobierno del Estado de Tamaulipas</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
		
		<link href="https://www.tamaulipas.gob.mx/educacion/wp-content/themes/secretarias-2022/css/owl.carousel.css" rel="stylesheet">
		<link href="https://www.tamaulipas.gob.mx/educacion/wp-content/themes/secretarias-2022/css/owl.theme.default.css" rel="stylesheet">
		<link href="https://www.tamaulipas.gob.mx/educacion/wp-content/themes/secretarias-2022/style.css" rel="stylesheet">
		<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
		
		<style type="text/css">
			.msj_aviso{
				/* width:300px !important; */
				font-size: 0.5rem !important;
				/* height:200px !important; */
			}
			.msj_solicitud{
				/* width:300px !important; */
				font-size: 0.7rem !important;
				/* height:200px !important; */
			}
		</style>
		

  
	</head> 
	<body>
			
		<!-- Logo y menus -->

		<div class="container">
			<div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
				<div class="btn-group" role="group" aria-label="First group">
					<a href="" class="logo-a">
						<img  style="widht:345; height:112px;" src="https://www.tamaulipas.gob.mx/educacion/wp-content/themes/secretarias-2022/img/logo/tam.png" alt="Secretaría de Educación - Gobierno del Estado de Tamaulipas">
					</a>
				</div>
				<div class="input-group">
					<a class="logo-a" href="https://www.tamaulipas.gob.mx/educacion">
						<img style="widht:200; height:54;" class="logotam img-responsive" src="https://www.tamaulipas.gob.mx/educacion/wp-content/uploads/sites/3/2016/10/educacion2.png" alt="Secretaría de Educación - Gobierno del Estado de Tamaulipas">
					</a>
				</div>
			</div>
		</div>
		<!-- /Logo y menus --><!-- Menú -->
		<div id="menu-secretarias">
			<input type="checkbox" name="menu-toggle" id="menu-open">
			<div class="container">
			
				<div id="row-cabecera" class="row">
				
					<!-- Menú para escritorio -->
					<div class="menu-escritorio col-xs-12 hidden-xs hidden-sm">
						<div id="menu-container" class="menu-menu-principal-container">
							<ul id="menu-menu-principal" class="clean-list menu pull-right">

							</ul>
						</div>  		
					</div>
					<!-- Menú para escritorio -->
				
					<div id="barras-boton" class="col-xs-offset-6 col-xs-6 visible-xs-block visible-sm-block">
						<div class="menu-btn">
						</div>
					</div>
				</div>
			</div>
			
		</div>		

			
		<div class="container">
			@yield('content')
		</div>
		<div id="informacion-contacto" class="bloque-index"></div>
		<div style="height:150px;"></div>
		<!-- /Footer --><!-- Liston inferior -->
		<div id="liston-inferior">
			Todos los derechos reservados © 2023 <span id="to-break">/</span> Gobierno del Estado de Tamaulipas 2022 - 2028
		</div>
		


	</body>
</html>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script src="//code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
@yield('page-scripts')
