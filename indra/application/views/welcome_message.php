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
					<a class="nav-link active" aria-current="page" href="<?php echo site_url()?>/Welcome">problema 1</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo site_url()?>/Welcome2">problema 2</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo site_url()?>/Welcome3">problema 3</a>
				</li>
				
			</ul>
			</div>
		</div>
		</nav>
		<br><br>
		<div class="container">
			<div class="row">
				<div class="col-md-4"></div>
				<div class="col-md-4">
					<form>
						<div class="mb-3">
							<label for="exampleInputEmail1" class="form-label">Numero 1 *</label>
							<input type="number" class="form-control" name="num1">
						</div>
						<div class="mb-3">
							<label for="exampleInputEmail1" class="form-label">Numero 2 *</label>
							<input type="number" class="form-control" name="num2">
						</div>
						
						<button type="button" id="btnCalcular" class="btn btn-primary"><i class="fas fa-cloud"></i> Calcular</button>
						<hr>
						<div class="mb-3">
							<label for="exampleInputEmail1" class="form-label">Resultado</label>
							<input type="number" class="form-control" name="resultado" readonly>
						</div>

						<br>
						<button type="button" id="btnLimpiar" class="btn btn-danger"><i class="fas fa-trash"></i> Limpiar tabla</button>
					</form>
				</div>
				<div class="col-md-4"></div>
			</div>
			<br> <br>

			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
                        <table class="table table-sm  table-bordered" id="tabla">
                            <thead>
                                <tr>
									<th>ID</th>
                                    <th>NUMERO 1</th>
                                    <th>NUMERO 2</th>
                                    <th>RESULTADO</th>
									<th>FECHA</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <th></th>
								<th></th>
                                <th></th>
                                <th></th>
								<th></th>
                            </tfoot>
                            <tbody>
                        	</tbody>
                        </table>
                    </div>            
				</div>
			</div>
		</div>
	
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
		<script src="<?php echo base_url()?>assets/jquery/jquery.min.js"></script>
		<script src="<?php echo base_url()?>assets/DataTables/datatables.min.js"></script>
		<script src="<?php echo base_url()?>assets/sweetalert2/sweetalert2.all.min.js"></script>
		<script src="<?php echo base_url();?>assets/moments/moments.js"></script>	
		<script src="<?php echo base_url();?>assets/moments/moment-with-locales.js"></script>
		<script>

			var baseUrl = "<?php echo base_url()?>";
     		var siteUrl = "<?php echo site_url()?>";

			

			$(document).ready(function(){
    			verTabla();
			});

			function verTabla(){

				$.ajax({
					type : "POST",
					url  : siteUrl+'/Welcome/ver',
					dataType : "JSON",
					data : {},
					success: function(data){
						table = $('#tabla').DataTable({
							"data": data,
							"bDestroy": true,
							"dom": 'B<"float-left"i><"float-right"f>t<"float-left"l><"float-right"p><"clearfix">',
							"order": [[ 0, "desc" ]],
							"lengthMenu": [ [-1,10, 25, 50], [ "Todo",10,25, 50] ],
							"searching": true,
							"autoWidth": false,

							"language": {
								"url": "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
							},
							"initComplete": function () {
								//Apply text search
								this.api().columns([0,1,2,3,4]).every(function () {
									var title = $(this.footer()).text();
								
									$(this.footer()).html('<input type="text" class="form-control"  placeholder="Buscar..." />');
									var that = this;
									$('input',this.footer()).on('keyup change', function () {
										if (that.search() !== this.value) {
											that
												.search(this.value)
												.draw();
										}
									});

								});

							}, 
							"columns": [
								{ "data": "pr_id"}, 
								{ "data": "pr_num1"}, 
								{ "data": "pr_num2"}, 
								{ "data": "pr_resultado"}, 
								{ "data": null,
									"mRender": function(data, type, full) {

										moment.locale('es');
										return moment( full.pr_fecha).format('DD [de] MMMM [del] YYYY')+' <br> '+ moment( full.pr_fecha).format('h:mm a');
									
									}
								},
							],
							buttons: [
								
							]
						});
					
					}
				});

			}

			$('#btnCalcular').on('click',function(){
				var num1 = $('[name="num1"]').val();
				var num2 = $('[name="num2"]').val();
				var resul = 0;



				if(num1 == '' || num2 == ''){
					Swal.fire({
                                title:'',
                                text:'Digite los campos obligatorios * ',
                                icon:'error',
                                confirmButtonColor: '#343A40',
                                confirmButtonText: 'ACEPTAR',
                            });
					return false;
				}


				/*				
				$('[name="resultado"]').val(resul); */

				var formData = new FormData();
				formData.append('num1',num1);
				formData.append('num2',num2);
				formData.append('resul',resul);

				$.ajax({
					type : "POST",
					url  : siteUrl+'/Welcome/guardar',
					dataType : "JSON",
					data : formData,
					contentType: false,
					processData: false,
					success: function(data){

						$('[name="num1"]').val('');
						$('[name="num2"]').val('');
						$('[name="resultado"]').val(data);
						verTabla();
					}
				});
			});

			$('#btnLimpiar').on('click',function(){

				Swal.fire({
					title: '',
					text: 'Deseas limpiar la tabla?',
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#69DBE3',
					cancelButtonColor: '#FF5B5C',
					confirmButtonText: 'SI',
					cancelButtonText: 'NO'
				}).then((result) => {
					if (result.isConfirmed) {
						var formData = new FormData();
						formData.append('id',0);

						$.ajax({
							type : "POST",
							url  : siteUrl+'/Welcome/limpiar',
							dataType : "JSON",
							data : formData,
							contentType: false,
							processData: false,
							success: function(data){

								$('[name="num1"]').val('');
								$('[name="num2"]').val('');
								$('[name="resultado"]').val('');
								
								verTabla();
							}
						});
					}
      			})
			});
		</script>
	</body>
</html>