<?php
class ModelDashboard extends model {

	public function Status($status_Normal,$status_ProximoVen,$status,$situacao) {
		$dados = array();
		$sql = $this->db->prepare("SELECT * FROM ordem_de_servico WHERE status_prazo = ? || status_prazo = ? AND status = ? AND situacao = ?");
		$sql->bindParam(1, $status_Normal);
		$sql->bindParam(2, $status_ProximoVen);
		$sql->bindParam(3, $status);
		$sql->bindParam(4, $situacao);

		if ($sql->execute()){
		 $dados = $sql->fetchAll();
		 return $dados;
		}else{
			return false;
		}

	}

	public function EditarStatusPrazo($id,$status_prazo) {
			
		$sql = $this->db->prepare("UPDATE ordem_de_servico SET status_prazo = ? WHERE id = ? LIMIT 1");
		
			$sql->bindParam(1, $status_prazo);
			$sql->bindParam(2, $id);
			$sql->execute();
		
	}

	public function CountStatusNotmal($status_Normal,$status,$situacao) {
			
		$sql = $this->db->prepare("SELECT COUNT(*) total FROM ordem_de_servico WHERE status_prazo = ?  AND status = ? AND situacao = ? ");
		
			$sql->bindParam(1, $status_Normal);
			$sql->bindParam(2, $status);
			$sql->bindParam(3, $situacao);
			$sql->execute();

			$dados = $sql->fetch(PDO::FETCH_OBJ);
			return $dados;
		
	}

	public function CountStatusProximoVen($status_ProximoVen,$status,$situacao) {
			
		$sql = $this->db->prepare("SELECT COUNT(*) total FROM ordem_de_servico WHERE status_prazo = ?  AND status = ? AND situacao = ? ");
		
			$sql->bindParam(1, $status_ProximoVen);
			$sql->bindParam(2, $status);
			$sql->bindParam(3, $situacao);
			$sql->execute();

			$dados = $sql->fetch(PDO::FETCH_OBJ);
			return $dados;
		
	}

	public function CountStatusVencido($status_Vencido,$status,$situacao) {
			
		$sql = $this->db->prepare("SELECT COUNT(*) total FROM ordem_de_servico WHERE status_prazo = ?  AND status = ? AND situacao = ? ");
		
			$sql->bindParam(1, $status_Vencido);
			$sql->bindParam(2, $status);
			$sql->bindParam(3, $situacao);
			$sql->execute();

			$dados = $sql->fetch(PDO::FETCH_OBJ);
			return $dados;
		
	}

}
