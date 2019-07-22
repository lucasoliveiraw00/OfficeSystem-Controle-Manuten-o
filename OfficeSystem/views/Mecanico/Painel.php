<?php
    if(!empty($msg)){
      echo $msg;
    }
  ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Office System</title>

  <link rel="shortcut icon" href="<?= BASE; ?>assets/img/icone.jpg" />
  <link rel="stylesheet" href="<?= BASE; ?>assets/plugins/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?= BASE; ?>assets/plugins/datatables/dataTables.bootstrap4.css">
	<link rel="stylesheet" href="<?= BASE; ?>assets/css/style.css">
  <link rel="stylesheet" href="<?= BASE; ?>assets/css/adminlte.css">
 
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  
  
  <script src="<?= BASE; ?>assets/js/jquery.min.js"></script>
  <script src="<?= BASE; ?>assets/js/Painel.js"></script>

  
  <script src="<?= BASE; ?>assets/plugins/inputmask/dist/jquery.inputmask.bundle.js"></script>
  <script src="<?= BASE; ?>assets/js/OfficeSystem.js"></script>
  <script src="<?= BASE; ?>assets/js/Seleciona.js"></script>
  <script src="<?= BASE; ?>assets/js/Alert.js"></script>
  <script src="<?= BASE; ?>assets/js/jQuery-Mask/jquery.mask.js"></script>
  <script src="<?= BASE; ?>assets/js/OfficeSystem_List_Ordem.js"></script>
  <script src="<?= BASE; ?>assets/js/OfficeSystem_Maks.js"></script>
</head>
<body class="fundo-painel">
      <div class="container">
        <div class="col-md-6 offset-md-3">
          <span  class="align-middle col-md-6 offset-md-3">
            <div class="card">
              <div class="card-header card-title">
                <input type="hidden" class="hidden" value="<?php echo $_SESSION['sistema']['nome'];?>" id="usuario">
                <div id="titulo">
                
                </div>
              </div>
              <div class="card-body" id="dados">
              

              </div>
              <div class="card-footer text-muted text-center">
              <p>Data: <span id="data"> </span> Horário: <span id="hora"></span></p>
              </div>
            </div>
          </span >
        </div>
      </div>
      
</body>

<div class="modal fade Modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="fundoTable">
        <section class="content">
          <div class="modal-header">
            <div id="model-titulo"></div>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="card-body">
              <div class="table-responsive " id="Dados-Modal">
            
              </div>
          </div>
        </section>
      </div>      
    </div>
  </div>
</div>

<div class="modal fade Modal-Servico" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="fundoTable">
        <section class="content">
          <div class="modal-header">
            <h3 class="modal-title"><b>Consultar </b> Serviço</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="col-12"  id="Dados-Modal-Servico">
                    
          </div>
        </section>
      </div>      
    </div>
  </div>
</div>
</html>
</html>

  <script src="<?= BASE; ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= BASE; ?>assets/plugins/datatables/jquery.dataTables.js"></script>
  <script src="<?= BASE; ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>
  <script src="<?= BASE; ?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
  <script src="<?= BASE; ?>assets/plugins/fastclick/fastclick.js"></script>
  <script src="<?= BASE; ?>assets/js/bootstrap-inputmask.min.js"></script>
  <script src="<?= BASE; ?>assets/plugins/parsley/parsley.min.js"></script>
  <script src="<?= BASE; ?>assets/plugins/Bootbox/bootbox.min.js"></script>
  <script src="<?= BASE; ?>assets/js/adminlte.min.js"></script>




