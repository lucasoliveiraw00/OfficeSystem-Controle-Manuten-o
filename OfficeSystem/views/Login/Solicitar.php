
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <title>Office System</title>

  	<link rel="shortcut icon" href="<?= BASE; ?>assets/img/icone.jpg" />

		<link rel="stylesheet" href="<?= BASE; ?>assets/css/style.css">
  	<link rel="stylesheet" href="<?= BASE; ?>assets/css/adminlte.css">
  	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
  	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  
 
</head>

<body class="hold-transition login-page">
	<div class="login-box">
		<div class="user-panel ">
			<div class="login-logo">
				<a>
					<div><img src="<?= BASE; ?>assets/img/icone.jpg">
					<b> Office</b>System
				</a>
			</div>	
		</div>
	</div>
	<div class="login-box-body">
		<p class="login-box-msg">Solicitar Nova Senha</p>
		<form class="needs-validation" novalidate method="POST" action="<?= BASE; ?>Login/VerificarDados"  enctype="multipart/form-data" >
			<div class="form-group ">
        <label for="email">E-mail:</label>
				<input type="email" class="form-control" name="email" id="email" placeholder="Digite" required>
				<div class="invalid-feedback">Preencher o Campo E-mail.</div>
			</div>  
			<div class="col-12">
				<button type="submit" class="btn btn-primary btn-block ">Solicitar</button>
			</div>
		</form>
  </div>
</body>
<script>
(function() {
  'use strict';
  window.addEventListener('load', function() {
    var forms = document.getElementsByClassName('needs-validation');
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>