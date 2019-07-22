<?php 
	class ModelComponente extends model { 

		public function GetCodigo() {

			$array = array();
			$sql = $this->db->prepare("SELECT MAX(codigo) as codigo FROM componente LIMIT 1");
			$sql->execute();
			
			if($sql->rowCount() > 0) {
				$array = $sql->fetch();
				}

			return $array;
			exit;
		}

		public function ExistDados1 ($descricao,$situacao) {

			$sql = $this->db->prepare("SELECT * FROM componente WHERE descricao = ? AND situacao = ? LIMIT 1");
			$sql->bindParam(1, $descricao);
			$sql->bindParam(2, $situacao);
			$sql->execute();

			if($sql->rowCount() > 0) {
				return true;
				exit;

			} else {
				return false;
				exit;
			}
		}

		public function ExistDados2 ($id, $descricao, $situacao) {

			$dados = array();
	
			$sql =$this->db->prepare("SELECT * FROM componente WHERE descricao = ? AND situacao = ? LIMIT 1");
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

				$sql = $this->db->prepare("INSERT INTO componente (id, codigo, descricao, situacao) VALUES (NULL, ?, ?, ?)");
				
				$sql->bindParam(1, $codigo);
				$sql->bindParam(2, $descricao);
				$sql->bindParam(3, $situacao);
				
				if ($sql->execute()) {
					return true;
					exit;
				} else {
					return false;
					exit;
				}
		
		}

		
		public function GetLista($situacao) {
				$array = array();
				$sql =$this->db->prepare("SELECT * FROM componente WHERE situacao = ?");
				$sql->bindParam(1, $situacao);

				if ($sql->execute()) {
					
					$dados = $sql->fetchAll(PDO::FETCH_ASSOC);
					return $dados;
					exit;

				}else {

					return false;
					exit;

				}
			
		}	

		public function GetComponente($id_comp,$situacao) {

				$array = array();
				$sql =$this->db->prepare("SELECT * FROM componente WHERE id = ? AND situacao = ? LIMIT 1");
				$sql->bindParam(1, $id_comp);
				$sql->bindParam(2, $situacao);
				$sql->execute();
				
				if($sql->rowCount() > 0) {
					$array = $sql->fetch();
					return $array;
					exit;
				}else {
					return false;
				}
					/////
					
		}	
		
		public function DadosComponente($id_comp,$situacao) {

				$array = array();
				$sql =$this->db->prepare("SELECT * FROM componente WHERE id = ? AND situacao = ? LIMIT 1");
				$sql->bindParam(1, $id_comp);
				$sql->bindParam(2, $situacao);
				$sql->execute();
					
					if($sql->rowCount() > 0) {
							$array = $sql->fetchAll();
						}else {
							return false;
						}
						return $array;
			}	
		

		public function EditarComponente($codigo,$descricao,$id) {
				
				$sql = $this->db->prepare("UPDATE componente SET codigo = ?, descricao = ? WHERE id = ? LIMIT 1");
					$sql->bindParam(1, $codigo);
					$sql->bindParam(2, $descricao);
					$sql->bindParam(3, $id);

					if($sql->execute()) {
						return true;
						exit;
					} else {
						return false;
						exit;
					}
				 
		}

	
		public function Verificar($id,$situacao) {
		
				$sql = $this->db->prepare("SELECT * FROM item WHERE id_comp = ? AND situacao = ? LIMIT 1");
				$sql->bindParam(1, $id);
				$sql->bindParam(2, $situacao);
				$sql->execute();
			
				if($sql->rowCount() > 0) {
					return true;
					exit;
				}	else { 
						return false;
						exit;
					}

		}

		public function Excluir($id,$situacao) {
			
			$this->db->beginTransaction();

					$sql = $this->db->prepare("UPDATE componente SET  situacao = ? WHERE id = ? LIMIT 1");
					$sql->bindParam(1, $situacao);
					$sql->bindParam(2, $id);
			
					if ( $sql->execute()) {

						$sql = $this->db->prepare("UPDATE item SET  situacao = ? WHERE id_comp = ? ");
						$sql->bindParam(1, $situacao);
						$sql->bindParam(2, $id);
			
							if ( $sql->execute()) {
								$this->db->commit();
								return true;
								exit;

							}else {
								$this->db->rollBack();
								return false;
								exit;
							}
				
					}else {
						$this->db->rollBack();
						return false;
						exit;
					}

		}

		
	}
