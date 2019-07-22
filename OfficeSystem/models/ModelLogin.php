<?php
class ModelLogin extends model {

	public function Login($login, $situacao) {
		$sql = $this->db->prepare("SELECT * FROM usuario WHERE matricula = ? AND situacao = ? LIMIT 1");
		$sql->bindParam(1, $login);
		$sql->bindParam(2, $situacao);
		$sql->execute();
		
		 $dados = $sql->fetch(PDO::FETCH_OBJ);
		 return $dados;
		 $pdo = null;

	}

	public function BuscarUsuario($id, $situacao) {
		$sql = $this->db->prepare("SELECT nome FROM colaborador col INNER JOIN usuario usa ON col.id_usuario = usa.id WHERE col.id_usuario = ? AND  col.situacao = ? LIMIT 1");
		$sql->bindParam(1, $id);
		$sql->bindParam(2, $situacao);
		$sql->execute();
		
		$dados = $sql->fetch(PDO::FETCH_OBJ);
		return $dados;
		$pdo = null;
	}

	public function VerificarEmail($email) {
		$sql = $this->db->prepare("SELECT usua.id, usua.email, col.nome FROM usuario usua INNER JOIN colaborador col ON col.id_usuario = usua.id WHERE usua.email = ? AND usua.situacao = 'Ativo' LIMIT 1");
		$sql->bindParam(1, $email);
		$sql->execute();
		
		if($sql->rowCount() > 0) {
			$dados = $sql->fetch(PDO::FETCH_OBJ);
			return $dados;
			$pdo = null;
		}else {
			return false;
			$pdo = null;
		}

	}

	public function VerificarSolicitacao ($id) {		

		$sql = $this->db->prepare("SELECT * FROM solicitacao WHERE id_usuario = ?");
		$sql->bindParam(1, $id);
		$sql->execute();
		
		if($sql->rowCount() > 0) {

			$sql = $this->db->prepare("DELETE FROM solicitacao WHERE id_usuario = ?");
			$sql->bindParam(1, $id);

			if ($sql->execute()){
				return true;
				$pdo = null;
			}else {
				return false;
				$pdo = null;
			}

		}else {
			return true;
			$pdo = null;
		}

	}

	public function SalvarSolicitacao ($id, $token) {		

		$sql = $this->db->prepare("INSERT INTO solicitacao (id, id_usuario, token) VALUES (NULL, ?, ?)");
		
		$sql->bindParam(1, $id);
		$sql->bindParam(2, $token);

		if($sql->execute()) {
			return true;
			$pdo = null;
		} else {
			return false;
			$pdo = null;
		}

	}

	public function VerificarToken($token) {

		$sql = $this->db->prepare("SELECT * FROM solicitacao WHERE token = ? LIMIT 1");
		$sql->bindParam(1, $token);
		$sql->execute();
		
		if($sql->rowCount() > 0) {
			return true;
			$pdo = null;
		}else {
			return false;
			$pdo = null;
		}

	}

	public function BuscarDados($token) {

		$sql = $this->db->prepare("SELECT usua.id, usua.email FROM solicitacao sol INNER JOIN usuario usua ON usua.id = sol.id_usuario WHERE sol.token = ? LIMIT 1");
		$sql->bindParam(1, $token);
		$sql->execute();
		
		if($sql->rowCount() > 0) {
			$dados = $sql->fetch(PDO::FETCH_OBJ);
			 return $dados;
			 $pdo = null;
		}else {
			return false;
			$pdo = null;
		}
		
	}

	public function AlterarPassword($id, $senha) {

		$sql = $this->db->prepare("UPDATE usuario SET senha = ? WHERE id = ? LIMIT 1");
		$sql->bindParam(1, $senha);
		$sql->bindParam(2, $id);
		
		if($sql->execute()) {

			$sql = $this->db->prepare("DELETE FROM solicitacao WHERE id_usuario = ?");
			$sql->bindParam(1, $id);

			if ($sql->execute()){
				return true;
				$pdo = null;
			}else {
				return false;
				$pdo = null;
			}
			
		}else {
			return false;
			$pdo = null;
		}

	}
	
}
