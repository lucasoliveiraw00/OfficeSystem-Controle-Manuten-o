<?php
class DashboardController extends controller {

	public function index() {
		$this->VerificarLogin();
		$this->VerificarNivel(2);
		$dados = array();

		$ModelDashboard = new ModelDashboard();
		$status_Normal = 'Normal';
		$status_ProximoVen = 'ProximoVen';
		$status_Vencido = 'Vencido';
		$situacao = "Ativo";
		$status = "Aberto";

		date_default_timezone_set('America/Sao_Paulo');
		$dataAtual = date('Y-m-d H:i:s');
		$dataAtual = new DateTime($dataAtual);

		$result = $ModelDashboard->Status($status_Normal,$status_ProximoVen,$status,$situacao);
			for ($i=0; $i < count($result); $i++) { 
				foreach ($result as $list) {
					
					$dataPrazo = $list['prazo'];
                    $dataPrazo = new DateTime($dataPrazo);
					
					$resultdados = $dataPrazo->diff($dataAtual)->format("%d-%h-%i-%s");
					
					$resultdados = explode("-",$resultdados);
					
					$dias = $resultdados[0];
					$hora = $resultdados[1];
					$minuto = $resultdados[2];
					$segundo = $resultdados[3];					
					
					if ($dias <= 2 && $status_Normal == $list['status_prazo']) {
				
						$id = $list['id'];
						$ModelDashboard->EditarStatusPrazo($id,$status_ProximoVen);
					
					}
					if ($dataPrazo <= $dataAtual && $status_ProximoVen == $list['status_prazo']) {
	
						$id = $list['id'];
						$ModelDashboard->EditarStatusPrazo($id,$status_Vencido);

					}


				}
				break;
			}

			$CountStatusNotmal = $ModelDashboard->CountStatusNotmal($status_Normal,$status,$situacao);
			$CountStatusNotmal->total;
			$dados['CountStatusNotmal']= $CountStatusNotmal;

			$CountStatusProximoVen = $ModelDashboard->CountStatusProximoVen($status_ProximoVen,$status,$situacao);
			$CountStatusProximoVen->total;
			$dados['CountStatusProximoVen']= $CountStatusProximoVen;

			$CountStatusVencido = $ModelDashboard->CountStatusVencido($status_Vencido,$status,$situacao);
			$CountStatusVencido->total;
			$dados['CountStatusVencido']= $CountStatusVencido;

			$this->loadTemplateAdmin('Admin/Home', $dados);	

	}

}