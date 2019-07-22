 <?php 

	 class ModelVeiculo extends model{
		
		public function ExistDados1 ($placa,$situacao) {

			$sql = $this->db->prepare("SELECT * FROM veiculo WHERE placa = ? AND situacao = ? LIMIT 1 ");
			$sql->bindParam(1, $placa);
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

		public function ExistDados2 ($id,$placa,$situacao) {

			$dados = array();
	
			$sql =$this->db->prepare("SELECT id FROM veiculo WHERE placa = ? AND situacao = ? LIMIT 1");
			$sql->bindParam(1, $placa);
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

		public function Cadastrar($modelo,$marca,$ano,$cor,$placa,$id_cliente,$situacao) {

				$sql = $this->db->prepare("INSERT INTO veiculo (id, id_cliente, placa, marca, modelo, cor, ano, situacao) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?)");

				$sql->bindParam(1, $id_cliente);
				$sql->bindParam(2, $placa);
				$sql->bindParam(3, $marca);
				$sql->bindParam(4, $modelo);
				$sql->bindParam(5, $cor);
				$sql->bindParam(6, $ano);
				$sql->bindParam(7, $situacao);
				
				if ($sql->execute()) {
					return true;
					exit;
				}else {
					return false;
					exit;
				}
			
		 }
		 
		public function GetVeiculo($id,$situacao) {

			$array = array();
			$sql =$this->db->prepare("SELECT vcl.id as id_veiculo, vcl.id_cliente, vcl.placa, vcl.marca, vcl.modelo, vcl.cor, vcl.ano, cli.id, cli.nome, cli.cpfcnpj FROM veiculo AS vcl INNER JOIN cliente AS cli ON vcl.id_cliente = cli.id WHERE vcl.id = ? AND vcl.situacao = ? LIMIT 1");
			$sql->bindParam(1, $id);
			$sql->bindParam(2, $situacao);
			$sql->execute();
			
			if($sql->rowCount() > 0) {
				$array = $sql->fetch();
				}

			return $array;
			
			}	
		

		public function GetListaVeiculo( $situacao) {
			$array = array();
			$sql =$this->db->prepare("SELECT * FROM veiculo WHERE situacao = ?");
			$sql->bindParam(1, $situacao);

			if ($sql->execute()) {
				$dados = $sql->fetchAll(PDO::FETCH_ASSOC);
				return $dados;
			}else {
				return false;
			}
			
		}	

		public function EditVeiculo($modelo,$marca,$ano,$cor,$placa,$id_cliente,$id) {

			$sql = $this->db->prepare("UPDATE veiculo SET  id_cliente = ?, placa = ?, marca = ?, modelo = ?, cor = ?, ano = ? WHERE id = ? LIMIT 1");
			$sql->bindParam(1, $id_cliente);
			$sql->bindParam(2, $placa);
			$sql->bindParam(3, $marca);
			$sql->bindParam(4, $modelo);
			$sql->bindParam(5, $cor);
			$sql->bindParam(6, $ano);
			$sql->bindParam(7, $id);
			
			if ($sql->execute()) {
				return true;
			}else {
				return false;
			} 
		}
		
		
		public function Verificar($id,$situacao) {
		
			$sql = $this->db->prepare("SELECT * FROM ordem_de_servico  WHERE id_veiculo = ? AND situacao = ?");
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
			
				$sql = $this->db->prepare("UPDATE veiculo SET  situacao = ? WHERE id = ? LIMIT 1");
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
 