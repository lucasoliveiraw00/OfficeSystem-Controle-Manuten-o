<?php 
	class ModelItem extends model { 

			
			public function BuscaGodigo($id_comp) {

				$dados2 = array();
				$sql = $this->db->prepare("SELECT id, Max(codigo) as codigo_MaxItem FROM item WHERE id_comp = ? LIMIT 1");
				$sql->bindParam(1, $id_comp);
				$sql->execute();
				
					if ($sql->rowCount() > 0) {
						
						$dados = $sql->fetch();

						if (array_filter($dados)) {
							return $dados;

						} else {
							$sql = $this->db->prepare("SELECT id, MAX(codigo) as codigo_MaxComp FROM componente WHERE id = ? LIMIT 1");
							$sql->bindParam(1, $id_comp);
							$sql->execute();
	
								if($sql->rowCount() > 0) {
									$dados = $sql->fetch();
									return $dados;
								} else {
									return false;
									}
							}

					
					}	
						
			}

			public function ExistDados1 ($descricao,$situacao) {

				$sql = $this->db->prepare("SELECT * FROM item WHERE descricao = ? AND situacao = ? LIMIT 1");
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
	
			$sql =$this->db->prepare("SELECT id, descricao FROM item WHERE descricao = ? AND situacao = ? LIMIT 1");
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

			public function Cadastrar ($id_comp,$codigo,$descricao,$situacao) {
	
				$sql = $this->db->prepare("INSERT INTO item (id, id_comp, codigo, descricao, situacao) VALUES (NULL, ?, ?, ?, ?)");

				$sql->bindParam(1, $id_comp);	
				$sql->bindParam(2, $codigo);
				$sql->bindParam(3, $descricao);
				$sql->bindParam(4, $situacao);

				if ($sql->execute()) {
						 return true;
						 exit;
				} else {
						return false;
						exit;
				}
			
			}

			public function DadosItem($id_comp,$situacao) {

				$array = array();
				$sql =$this->db->prepare("SELECT * FROM item WHERE id_comp = ? AND situacao = ? ");
				$sql->bindParam(1, $id_comp);
				$sql->bindParam(2, $situacao);
				$sql->execute();
					
					if($sql->rowCount() > 0) {
						$array = $sql->fetchAll();
						return $array;
						exit;
					}		
					
			}	

			public function DadosItemComp($id,$situacao) {
				
				$array = array();
				$sql =$this->db->prepare(" SELECT item.id AS id_item, item.codigo AS codigo_item, item.descricao AS descricao_item, comp.id AS id_comp, comp.codigo AS codigo_comp, comp.descricao AS descricao_comp FROM item INNER JOIN componente AS comp ON item.id_comp = comp.id WHERE item.id = ? AND item.situacao = ?");
				$sql->bindParam(1, $id);
				$sql->bindParam(2, $situacao);
				$sql->execute();
				
				if($sql->rowCount() > 0) {
					$array = $sql->fetch();
					}
	
				return $array;
				
			}

			public function VerificarGodigo($id) {
				
				$array = array();
				$sql =$this->db->prepare("SELECT * FROM item WHERE id = ? ");
				$sql->bindParam(1, $id);
				$sql->execute();
				
				if($sql->rowCount() > 0) {
					$array = $sql->fetch();
					}
	
				return $array;
				
			}		
				
			
			public function EditarItem($id_comp,$codigo,$descricao,$id) {
				
					$sql = $this->db->prepare("UPDATE item SET id_comp = ?, codigo = ?, descricao = ?  WHERE id = ? LIMIT 1");
					$sql->bindParam(1, $id_comp);
					$sql->bindParam(2, $codigo);
					$sql->bindParam(3, $descricao);
					$sql->bindParam(4, $id);
						
					if ($sql->execute()) {
						return true;
					} else {
						return false;
					}
						
			}

	
		public function Verificar($id,$situacao) {
			
			$sql = $this->db->prepare("SELECT * FROM servico  WHERE id_item = ? AND situacao = ? LIMIT 1");
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
			
			$sql = $this->db->prepare("UPDATE item SET situacao = ? WHERE id = ? LIMIT 1");
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
		
		public function GetDadosItens($id_comp,$situacao) {		
			$array = array();

			$sql =$this->db->prepare("SELECT * FROM item WHERE id_comp = ? AND situacao = ?");
			$sql->bindParam(1, $id_comp);
			$sql->bindParam(2, $situacao);
			$sql->execute();
			
			if($sql->rowCount() > 0) {
				$array = $sql->fetchAll();
				}

			return $array;
			
		}			

	}
