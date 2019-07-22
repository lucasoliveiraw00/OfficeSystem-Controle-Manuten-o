
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
  
  	<script  src="<?= BASE; ?>assets/js/jquery.min.js"></script>
  	<script src="<?= BASE; ?>assets/js/adminlte.min.js"></script>
 
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
		<p class="login-box-msg">Login de Acesso ao Sistema</p>
		<?php
			if(!empty($msg)){
				echo $msg;
			}
		?>
		<form class="needs-validation" novalidate method="POST" action="<?= BASE; ?>Login/Verificar"  enctype="multipart/form-data" >
			<div class="form-group ">
				<input type="number" autofocus class="form-control" placeholder="Matricula" min="1" name="login" id="login" required>
				<div class="invalid-feedback">Preencher o Campo Matricula.</div>
			</div>
			<div class="form-group  ">
				<input type="password" class="form-control" placeholder="Senha" name="senha" id="senhal" required>
				<div class="invalid-feedback">Preencher o Campo Senha.</div>
			</div>
			<div class="col-12">
				<button type="submit" class="btn btn-primary btn-block ">Entrar</button>
			</div>
			<br>
			<p class="mb-1">
        <a href="<?=BASE?>Login/Solicitar/Senha">Esqueci a minha senha.</a>
      </p>
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