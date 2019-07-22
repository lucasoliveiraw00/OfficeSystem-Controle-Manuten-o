<?php 
	class ModelCliente extends model { 


		public function ExistDados1 ($cpfcnpj,$situacao) {

			$sql = $this->db->prepare("SELECT * FROM cliente WHERE cpfcnpj = ? AND situacao = ? LIMIT 1");
			$sql->bindParam(1, $cpfcnpj);
			$sql->bindParam(2, $situacao);
			$sql->execute();

			if($sql->rowCount() > 0) {
				return true;

			} else {
				return false;
			}
		}

		public function ExistDados2 ($id,$cpfcnpj,$situacao) {

			$dados = array();
	
			$sql =$this->db->prepare("SELECT * FROM cliente WHERE cpfcnpj = ? AND situacao = ? LIMIT 1");
			$sql->bindParam(1, $cpfcnpj);
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

		public function Cadastrar($nome,$cpfcnpj,$dataNasc,$email,$telefone,$celular,$cep,$cidade,$estado,$bairro,$rua,$numEnd,$situacao) {


				$sql = $this->db->prepare("INSERT INTO cliente (id, nome, cpfcnpj, dataNasc, email, telefone, celular, cep, cidade, uf, bairro, rua, numEnd, situacao) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
				
				$sql->bindParam(1, $nome);
				$sql->bindParam(2, $cpfcnpj);
				$sql->bindParam(3, $dataNasc);
				$sql->bindParam(4, $email);
				$sql->bindParam(5, $telefone);
				$sql->bindParam(6, $celular);
				$sql->bindParam(7, $cep);
				$sql->bindParam(8, $cidade);
				$sql->bindParam(9, $estado);
				$sql->bindParam(10, $bairro);
				$sql->bindParam(11, $rua);
				$sql->bindParam(12, $numEnd);
				$sql->bindParam(13, $situacao);
				
				if ($sql->execute()) {
				
					return true;
				} else {
					return false;
				}
		
		}
	

		public function Editar($nome,$cpfcnpj,$dataNasc,$email,$telefone,$celular,$cep,$cidade,$estado,$bairro,$rua,$numEnd,$situacao,$id) {
	
			$sql = $this->db->prepare("UPDATE cliente SET nome = ?, cpfcnpj = ?, dataNasc = ?, email = ?, telefone = ?, celular = ?, cep = ?, cidade = ?, uf = ?, bairro = ?, rua = ?, numEnd = ?, situacao = ? WHERE id = ? LIMIT 1");
			
				$sql->bindParam(1, $nome);
				$sql->bindParam(2, $cpfcnpj);
				$sql->bindParam(3, $dataNasc);
				$sql->bindParam(4, $email);
				$sql->bindParam(5, $telefone);
				$sql->bindParam(6, $celular);
				$sql->bindParam(7, $cep);
				$sql->bindParam(8, $cidade);
				$sql->bindParam(9, $estado);
				$sql->bindParam(10, $bairro);
				$sql->bindParam(11, $rua);
				$sql->bindParam(12, $numEnd);
				$sql->bindParam(13, $situacao);
				$sql->bindParam(14, $id);
				
			if($sql->execute()) {
				return true;
				exit;
			} else {
				return false;
				exit;
			}
			 
		}

		public function GetCliente($id,$situacao) {

				$array = array();
				$sql =$this->db->prepare("SELECT *, date_format(dataNasc,'%d/%m/%Y') dataNasc FROM cliente WHERE id = ? AND situacao = ? LIMIT 1");
				$sql->bindParam(1, $id);
				$sql->bindParam(2, $situacao);
				$sql->execute();
				
				if($sql->rowCount() > 0) {
					$array = $sql->fetch();
				}else {
					return false;
				}
	
				return $array;
				
		}	

		public function GetLista($situacao) {
			$array = array();

			$sql =$this->db->prepare("SELECT * FROM cliente WHERE situacao = ?");

			$sql->bindParam(1, $situacao);

			if ($sql->execute()) {
				$dados = $sql->fetchAll(PDO::FETCH_ASSOC);
				return $dados;
			}else {
				return false;
			}
			
		}	

			public function Verificar($id,$situacao) {
				
				$sql = $this->db->prepare("SELECT * FROM veiculo WHERE id_cliente = ? LIMIT 1");
				//$sql = $this->db->prepare("SELECT * FROM veiculo WHERE id_cliente = ? AND situacao = ? LIMIT 1");
				$sql->bindParam(1, $id);
				//$sql->bindParam(2, $situacao);
				$sql->execute();
				
				if($sql->rowCount() > 0) {
					return true;

				} else {
					return false;
				}

		}

		public function Excluir($id, $situacao) {

				$sql = $this->db->prepare("UPDATE cliente SET  situacao = ? WHERE id = ? LIMIT 1");
				$sql->bindParam(1, $situacao);
				$sql->bindParam(2, $id);
			
					if ( $sql->execute()) {
						return true;
						exit;
					}else {
						return false;
						exit;
					}


		}

	}

 ?>