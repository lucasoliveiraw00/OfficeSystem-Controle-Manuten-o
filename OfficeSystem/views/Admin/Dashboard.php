<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Office System</title>

  <link rel="shortcut icon" href="<?= BASE; ?>assets/img/icone.jpg" />
  <link rel="stylesheet" href="<?= BASE; ?>assets/plugins/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?= BASE; ?>assets/css/style.css">
  <link rel="stylesheet" href="<?= BASE; ?>assets/css/adminlte.css">
 
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="<?= BASE; ?>assets/plugins/datatables/dataTables.bootstrap4.css">
  
  <script src="<?= BASE; ?>assets/js/jquery.min.js"></script>
  <script src="<?= BASE; ?>assets/plugins/inputmask/dist/jquery.inputmask.bundle.js"></script>
  <script src="<?= BASE; ?>assets/js/OfficeSystem.js"></script>
  <script src="<?= BASE; ?>assets/js/Seleciona.js"></script>
  <script src="<?= BASE; ?>assets/js/Alert.js"></script>
  <script src="<?= BASE; ?>assets/plugins/jQuery-Mask/jquery.mask.js"></script>
  <script src="<?= BASE; ?>assets/js/OfficeSystem_List_Ordem.js"></script>
  <script src="<?= BASE; ?>assets/js/OfficeSystem_Maks.js"></script>

  <script src="<?= BASE; ?>assets/plugins/datepicker/js/bootstrap-datepicker.js"></script>
  <script src="<?= BASE; ?>assets/plugins/datepicker/locales/bootstrap-datepicker.pt-BR.min.js"></script>
  <link rel="stylesheet" href="<?= BASE; ?>assets/plugins/datepicker/css/bootstrap-datepicker3.css">  

</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link home" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="<?= BASE; ?>Dashboard" class="nav-link home"><i class="fas fa-home" title="Inicio"></i></a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link home" data-toggle="dropdown" href="#">
            <i class="fas fa-cog"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">Opções</span>
            <div class="dropdown-divider"></div>
            <a href="<?php echo BASE; ?>Colaborador/Alterar" class="dropdown-item">
            <i style="color: #43a0cc" class="fas fa-user-cog"></i> 
              <span style="margin-left: 5px" class="text-muted text-sm"> Alterar dados</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="<?php echo BASE; ?>Login/Sair" class="dropdown-item">
            <i style="color: #dc3545" class="fas fa-times"></i>
              <span style="margin-left: 11px" class="text-muted text-sm"> Sair</span>
            </a>
          </div>
        </li>
      </ul>
    </nav>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <a href="<?= BASE; ?>Dashboard" class="brand-link">
        <img src="<?= BASE; ?>assets/img/icone.jpg" alt="Office System Logo" title="Logo Office System" class="brand-image"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Office System</span>
      </a>
        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                  <img src="<?= BASE; ?>assets/img/user.png" class="img-circle elevation-2 color-user"  title="Imagem do Usuário" alt="User Image">
              </div>
              <div class="info">
                <a class="d-block" title="Nome do Usuário">Usuário: <?php  echo $_SESSION["sistema"]["nome"]; ?></a>
                <a class="d-block" title="Acesso do Usuário">Acesso: <?php  echo $_SESSION["sistema"]["cargo"]; ?></a>
              </div>
            </div>  
            <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">  
                <li class="nav-item">
                  <a href="<?= BASE;?>OrdemDeServico" class="nav-link">
                    <i class="fas fa-folder"> </i>
                    <p id="menu">
                      Ordem de Serviço
                    </p>
                  </a>
                </li>
                <li class="nav-item has-treeview">
                  <a  class="nav-link">
                    <i class="fas fa-folder-open"> </i>
                    <p id="menu">
                      Manutenção
                      <i class="right fa fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="<?= BASE;?>Procedimento" class="nav-link">
                        <p>Procedimento</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="<?= BASE;?>Componente" class="nav-link">
                        <p>Componente</p>
                      </a>
                    </li>
                  </ul>
                </li>
                <li class="nav-item has-treeview">
                  <a class="nav-link">
                    <i class="fas fa-folder"></i>
                    <p id="menu">
                      Cadastro
                      <i class="right fa fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="<?= BASE;?>Cliente" class="nav-link">
                        <p>Cliente</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="<?= BASE;?>Colaborador" class="nav-link">
                        <p>Colaborador</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="<?= BASE;?>Veiculo" class="nav-link">
                        <p>Veiculo</p>
                      </a>
                    </li>
                  </ul>
                </li>
                <li class="nav-item has-treeview">
                  <a  class="nav-link">
                    <i class="fas fa-folder-open"> </i>
                    <p id="menu">
                      Relatorios
                      <i class="right fa fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="<?= BASE;?>Relatorio/Producao" class="nav-link">
                        <p>Produção</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="<?= BASE;?>Relatorio/Colaborador" class="nav-link">
                        <p>Colaborador</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="<?= BASE;?>Relatorio/Veiculo" class="nav-link">
                        <p>Veiculo</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="<?= BASE;?>Relatorio/Manutencao" class="nav-link">
                        <p>Manutenção</p>
                      </a>
                    </li>
                  </ul>
                </li>
                <li class="nav-item">
                  <a href="<?php echo BASE; ?>Login/Sair" class="nav-link">
                    <i class="fas fa-times"> </i>
                      <p id="menu-sair"> Sair </p>
                  </a>
                </li>
              </ul>
            </nav>
        </div>
    </aside>
    <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <!-- carregar o conteudo views -->
          <?php $this->loadView($viewName, $viewData); ?>
        </div>
      </section>
    </div>

</body>
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
  <script src="<?= BASE; ?>assets/js/demo.js"></script>