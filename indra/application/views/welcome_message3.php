<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!doctype html>
<html lang="en">
  	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Bootstrap demo</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
		<link rel="stylesheet" href="<?php echo base_url()?>assets/fontawesome-free/css/all.min.css">
		<link rel="stylesheet" href="<?php echo base_url()?>assets/DataTables/datatables.min.css" type="text/css"/>
		<link rel="stylesheet" href="<?php echo base_url()?>assets/sweetalert2/sweetalert2.min.css">
		<style>
			#tabla tfoot input{
				width: 100% !important;
			}
			#tabla tfoot {
				display: table-header-group !important;
			}
		</style>
	</head>
	<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
		<div class="container-fluid">
			<a class="navbar-brand" href="#">Menu</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" aria-current="page" href="<?php echo site_url()?>/Welcome">problema 1</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo site_url()?>/Welcome2">problema 2</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="<?php echo site_url()?>/Welcome3">problema 3</a>
				</li>
				
			</ul>
			</div>
		</div>
		</nav>
		<br><br>
		<div class="container">
			<div class="row">
				<div class="col-md-12 bg-light">
					<pre>
						var exponente = 2;
						var base      = 5;
						var potencia  = 0;
						var sumas     = '';
						var i         = base;
						var resultado = 0;

						potencia =  Math.pow(base,exponente);
						
						while (i <= potencia) {
							sumas += base+' + ';
							i += base;
						}
						
						resultado =  sumas.substring(0, sumas.length - 2)+'= '+potencia;
						console.log(resultado);
					</pre>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4"></div>
				<div class="col-md-4">
					<form>
						<div class="row">
							<div class="col-4"></div>
							<div class="col-8"><input type="number" class="form-control" name="exponente" placeholder="Exponente"></div>
						</div>
						<div class="row">
							<div class="col-12"><input type="number" class="form-control" name="base" placeholder="Base"> </div>
						</div>
						<br>
						<button type="button" id="btnCalcular" class="btn btn-primary"><i class="fas fa-cloud"></i> Calcular</button>
						<hr>
						<div class="mb-3">
							<label for="exampleInputEmail1" class="form-label">Resultado</label>
							<textarea class="form-control"  rows="10" name="resultado" readonly></textarea>
						</div>
					</form>
				</div>
				<div class="col-md-4"></div>
			</div>
		 
			
		</div>
	
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
		<script src="<?php echo base_url()?>assets/jquery/jquery.min.js"></script>
		<script src="<?php echo base_url()?>assets/DataTables/datatables.min.js"></script>
		<script src="<?php echo base_url()?>assets/sweetalert2/sweetalert2.all.min.js"></script>
		<script src="<?php echo base_url();?>assets/moments/moments.js"></script>	
		<script src="<?php echo base_url();?>assets/moments/moment-with-locales.js"></script>
		<script>

			$('#btnCalcular').on('click',function(){
				var exponente = eval($('[name="exponente"]').val());
				var base      = eval($('[name="base"]').val());
				var resul     = 0;
				var potencia  = 0;
				var sumas     = '';
				var i = base;
			
				if(exponente == '' || base == '' || exponente == undefined || base == undefined ){
					Swal.fire({
                                title:'',
                                text:'Digite los campos obligatorios * ',
                                icon:'error',
                                confirmButtonColor: '#343A40',
                                confirmButtonText: 'ACEPTAR',
                            });
					return false;
				}

				

				potencia =  Math.pow(base,exponente);
				
				if(potencia > 5000000){
					Swal.fire({
                                title:'',
                                text: 'potencia: '+potencia+' Este valor es muy largo para generarlo en una cadena de texto',
                                icon:'error',
                                confirmButtonColor: '#343A40',
                                confirmButtonText: 'ACEPTAR',
                            });
							$('[name="resultado"]').val('potencia: '+potencia+' Este valor es muy largo para generarlo en una cadena de texto');
					return false;
				}else{
					while (i <= potencia) {
					
						sumas += base+' + ';
						i += base;
					}
					
					resul=  sumas.substring(0, sumas.length - 2)+'= '+potencia;
					
					$('[name="resultado"]').val(resul);
				}

			});

		</script>
	</body>
</html>