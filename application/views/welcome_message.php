<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Crear VPN</title>
</head>

<body>
	<form id="f-mk">
		<label for=" name">Usuario:</label>
		<input type="text" name="usuario" name="usuario" id="usuario" required>

		<br>
		<br>
		<label for="email">Contraseña:</label>
		<input type="password" name="password" id="password" required>

		<br>
		<br>
		<input type="submit" name="b-create" value="Crear VPN">
	</form>

	<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

	<script>
		$("#f-mk").submit(function(e) {
			e.preventDefault();
			$.ajax({
				type: "POST",
				url: "<?= base_url(); ?>Vpn_controller/insert_vpn",
				data: $(this).serialize(),
				dataType: "json",
				success: function(response) {
					alert(response);
					$("#f-mk")[0].reset();
				},
				error: function(jqXHR) {
					console.log(jqXHR);
					if (jqXHR.status == 500) {
						alert(jqXHR.responseJSON);
					} else {
						alert('Campos requeridos');
					}
				}
			});
		});
	</script>
</body>

</html>