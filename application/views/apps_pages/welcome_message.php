<div class="page-title-box">
	<div class="row align-items-center">

		<div class="col-sm-6">
			<h4 class="page-title">Crear VPN </h4>
			<ol class="breadcrumb">
				<li class="breadcrumb-item active">Bienvenido al asistente de creacion de VPNS</li>
			</ol>

		</div>
		<div class="col-sm-6">

		</div>
	</div>
</div>
<!-- end row -->

<div class="row">
	<div class="col-5 mx-auto">
		<div class="card mini-stat shadow-lg">
			<div class="card-body">
				<form id="f-mk">
					<div class="form-group">
						<label for=" name">Usuario:</label>
						<input class="form-control" type="text" name="usuario" name="usuario" id="usuario">
					</div>
					<div class="form-group">
						<label for="email">Contraseña:</label>
						<input class="form-control" type="password" name="password" id="password">
					</div>
					<div class="form-group show-error">

					</div>
					<div class="form-group">
						<input class="btn btn-success" type="submit" name="b-create" value="Crear VPN">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>



<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

<script>
	$('#f-mk').submit(function(e) {
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: '<?= base_url('protected_servies/exec_function_vpn') ?>',
			data: $(this).serialize(),
			dataType: 'json',
			success: function(response) {

				$('#f-mk')[0].reset();
				Swal.fire(
					'Listo!',
					`${response.message}`,
					'success'
				);

			},
			error: function(jqXHR) {
				console.log(jqXHR);
				if (jqXHR.status == 500) {
					Swal.fire(
						'Ups!',
						`${jqXHR.responseJSON.message}`,
						'error'
					)
				}
				if (jqXHR.status == 400) {
					$('.show-error').html(jqXHR.responseJSON.html);
				}
			}
		});
	});
</script>