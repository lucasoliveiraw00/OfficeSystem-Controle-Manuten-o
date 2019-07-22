<?php 
	class ModelProcedimento extends model { 

		public function GetCodigo() {

			$array = array();
			$sql = $this->db->prepare("SELECT MAX(codigo) as codigo FROM procedimento LIMIT 1");
			$sql->execute();
			
			if($sql->rowCount() > 0) {
				$array = $sql->fetch();
				}

			return $array;
		}

		public function ExistDados1 ($descricao,$situacao) {

			$sql = $this->db->prepare("SELECT * FROM procedimento WHERE descricao = ? AND situacao = ? LIMIT 1");
			$sql->bindParam(1, $descricao);
			$sql->bindParam(2, $situacao);
			$sql->execute();

			if($sql->rowCount() > 0) {
				return true;

			} else {
				return false;
			}
		}

		public function ExistDados2 ($id,$descricao,$situacao) {

			$dados = array();
	
			$sql =$this->db->prepare("SELECT * FROM procedimento WHERE descricao = ? AND situacao = ? LIMIT 1");
			$sql->bindParam(1, $descricao);
			$sql->bindParam(2, $situacao);
			$sql->execute();

			if($sql->rowCount() > 0) {
				$dados = $sql->fetch(PDO::FETCH_OBJ);
							
					if ($id != $dados->id) {
						return true;
						exit;
					} else {
						return false;
						exit;
					}
	
			} else {
				return false;
				exit;
			}
	
		} 

		public function Cadastrar ($codigo,$descricao,$situacao) {		

				$sql = $this->db->prepare("INSERT INTO procedimento (id, codigo, descricao, situacao) VALUES (NULL, ?, ?, ?)");
				
				$sql->bindParam(1, $codigo);
				$sql->bindParam(2, $descricao);
				$sql->bindParam(3, $situacao);

				if($sql->execute()) {
					return true;
				} else {
					return false;
				}
		
		}

		public function GetLista($situacao) {
			$array = array();
			$sql =$this->db->prepare("SELECT * FROM procedimento WHERE situacao = ?  ORDER BY codigo ASC ");
			$sql->bindParam(1, $situacao);

			if ($sql->execute()) {
				$dados = $sql->fetchAll(PDO::FETCH_ASSOC);
				return $dados;
			}else {
				return false;
			}
			
		}	

		public function GetProcedimento($id,$situacao) {

			$array = array();
			$sql =$this->db->prepare("SELECT * FROM procedimento WHERE id = ? AND situacao = ? LIMIT 1");
			$sql->bindParam(1, $id);
			$sql->bindParam(2, $situacao);
			$sql->execute();
			
			if($sql->rowCount() > 0) {
				$array = $sql->fetch();
				}

			return $array;
			
		}

		public function EditProcedimento($codigo,$descricao,$id) {
				
					$sql = $this->db->prepare("UPDATE procedimento SET codigo = ?, descricao = ? WHERE id = ? LIMIT 1");
					$sql->bindParam(1, $codigo);
					$sql->bindParam(2, $descricao);
					$sql->bindParam(3, $id);

					if($sql->execute()) {
						return true;
					} else {
						return false;
					}
				 
			}

		public function Verificar($id,$situacao) {
		
				$sql = $this->db->prepare("SELECT * FROM servico WHERE id_proc = ? AND situacao = ?");
				$sql->bindParam(1, $id);
				$sql->bindParam(2, $situacao);
				$sql->execute();
			
				if($sql->rowCount() > 0) {
					return true;

				} else {
					return false;
				}

		}

		public function Excluir($id,$situacao) {
			
			$sql = $this->db->prepare("UPDATE procedimento SET situacao = ? WHERE id = ? LIMIT 1");
			$sql->bindParam(1, $situacao);
			$sql->bindParam(2, $id);
			 
			if ($sql->execute()){
				return true;
				exit;
			}else {
				return false;
				exit;
			}
		}


	}
