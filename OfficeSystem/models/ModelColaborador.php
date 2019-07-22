<?php 
	class ModelColaborador extends model { 


		public function GetMatricula() {

			$array = array();
			$sql = $this->db->prepare("SELECT MAX(id) as id FROM usuario LIMIT 1");
			$sql->execute();
			
			if($sql->rowCount() > 0) {
				$array = $sql->fetch();
				}

			return $array;
		}

		public function ExistDados1 ($email, $matricula ,$situacao) {

			$sql = $this->db->prepare("SELECT * FROM usuario WHERE  email = ? AND situacao = ?");
			$sql->bindParam(1, $email);
			$sql->bindParam(2, $situacao);
			$sql->execute();

			if($sql->rowCount() > 0) {
				return true;
				exit;

			} else {
					$sql = $this->db->prepare("SELECT * FROM usuario WHERE  matricula  = ? AND situacao = ?");
					$sql->bindParam(1, $matricula);
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
		}

		public function ExistDados2 ($id, $email, $situacao) {

			$dados = array();
	
			$sql =$this->db->prepare("SELECT * FROM usuario WHERE email = ? AND situacao = ? LIMIT 1");
			$sql->bindParam(1, $email);
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

		
		public function Adicionar ($nome, $email, $telefone, $celular, $matricula, $senha, $cargo, $ativo, $situacao) {

			$this->db->beginTransaction();

			$sql = $this->db->prepare("INSERT INTO usuario (id, matricula, senha, email, cargo, ativo, situacao) VALUES (NULL, ?, ?, ?, ?, ?, ?)");
				
			$sql->bindParam(1, $matricula);
			$sql->bindParam(2, $senha);
			$sql->bindParam(3, $email);
			$sql->bindParam(4, $cargo);
			$sql->bindParam(5, $ativo);
			$sql->bindParam(6, $situacao);

			if ($sql->execute()) {

					 $id_usuario = $this->db->lastInsertId();

					$sql = $this->db->prepare("INSERT INTO colaborador (id, id_usuario, nome, telefone, celular, ativo , situacao) VALUES (NULL, ?, ?, ?, ?, ?, ?)");
				
					$sql->bindParam(1, $id_usuario);
					$sql->bindParam(2, $nome);
					$sql->bindParam(3, $telefone);
					$sql->bindParam(4, $celular);
					$sql->bindParam(5, $ativo);
					$sql->bindParam(6, $situacao);

					if ($sql->execute()) {

						$this->db->commit();
						return true;
						exit;

					} else {

						$this->db->rollBack();
						return false;
						exit;
						
					}
	
			} else {
						$this->db->rollBack();
						return false;
						exit;
					
				}
		
		}

		public function GetLista($situacao) {
			$array = array();

			$sql =$this->db->prepare("SELECT * FROM colaborador a INNER JOIN usuario b  ON  a.id_usuario = b.id WHERE a.situacao = ? AND b.situacao = ? ORDER BY nome");
			$sql->bindParam(1, $situacao);
			$sql->bindParam(2, $situacao);

			if ($sql->execute()) {

				$dados = $sql->fetchAll(PDO::FETCH_ASSOC);
				return $dados;

			}else {

				return false;

			}
			
		}	
			
		public function GetCol($id,$situacao) {

			$array = array();
			$sql =$this->db->prepare("SELECT * FROM colaborador a INNER JOIN usuario b  ON  a.id_usuario = b.id WHERE id_usuario = ? AND a.situacao = ? LIMIT 1");
			$sql->bindParam(1, $id);
			$sql->bindParam(2, $situacao);
			$sql->execute();
		
			if($sql->rowCount() > 0) {
				$array = $sql->fetch();
				}

			return $array;
			
			}	
		

		public function EditarDados($nome, $email, $telefone, $celular, $matricula, $senha, $cargo, $ativo, $id , $id_usuario) {
			
			$this->db->beginTransaction();

			if ( empty($senha)) {

					$sql = $this->db->prepare("UPDATE usuario SET  matricula = ?, email = ?, cargo = ?, ativo = ? WHERE id = ? LIMIT 1");
					$sql->bindParam(1, $matricula);
					$sql->bindParam(2, $email);
					$sql->bindParam(3, $cargo);
					$sql->bindParam(4, $ativo);
					$sql->bindParam(5, $id_usuario);
				 
				if ($sql->execute()){
					
					$sql = $this->db->prepare("UPDATE colaborador SET  id_usuario = ?, nome = ?, telefone = ?, celular = ?, ativo = ? WHERE id = ? LIMIT 1");
					
					$sql->bindParam(1, $id_usuario);
					$sql->bindParam(2, $nome);
					$sql->bindParam(3, $telefone);
					$sql->bindParam(4, $celular);
					$sql->bindParam(5, $ativo);
					$sql->bindParam(6, $id);
					
					if ( $sql->execute()) {
						$this->db->commit();
						return true;
						exit;
					}else {
						$this->db->rollBack();
						return false;
						exit;
					}

				}

			}else {

				$senha = password_hash($senha, PASSWORD_ARGON2I);

				$sql = $this->db->prepare("UPDATE usuario SET matricula = ?, senha = ?, email = ?, cargo = ?, ativo = ? WHERE id = ? LIMIT 1");
	
				$sql->bindParam(1, $matricula);
				$sql->bindParam(2, $senha);
				$sql->bindParam(3, $email);
				$sql->bindParam(4, $cargo);
				$sql->bindParam(5, $ativo);
				$sql->bindParam(6, $id_usuario);

				if ($sql->execute()){
					
					$sql = $this->db->prepare("UPDATE colaborador SET  nome = ?, telefone = ?, celular = ?, ativo = ? WHERE id = ? LIMIT 1");
					
					$sql->bindParam(1, $nome);
					$sql->bindParam(2, $telefone);
					$sql->bindParam(3, $celular);
					$sql->bindParam(4, $ativo);
					$sql->bindParam(5, $id);
					
					if ( $sql->execute()) {
						$this->db->commit();
						return true;
						exit;
					}else {
						$this->db->rollBack();
						return false;
						exit;
					}

				}
			}

		}

		public function EditarUsuario($nome, $email, $telefone, $celular, $senha, $id, $id_usuario) {
			
			$this->db->beginTransaction();

			if ( empty($senha)) {

					$sql = $this->db->prepare("UPDATE usuario SET email = ? WHERE id = ? LIMIT 1");
					$sql->bindParam(1, $email);
					$sql->bindParam(2, $id);
				 
				if ($sql->execute()){
					
					$sql = $this->db->prepare("UPDATE colaborador SET  id_usuario = ?, nome = ?, telefone = ?, celular = ? WHERE id = ? LIMIT 1");
					
					$sql->bindParam(1, $id_usuario);
					$sql->bindParam(2, $nome);
					$sql->bindParam(3, $telefone);
					$sql->bindParam(4, $celular);
					$sql->bindParam(5, $id);
					
					if ( $sql->execute()) {
						$this->db->commit();
						return true;
						exit;
					}else {
						$this->db->rollBack();
						return false;
						exit;
					}

				}

			}else {

				$senha = password_hash($senha, PASSWORD_ARGON2I);

				$sql = $this->db->prepare("UPDATE usuario SET senha = ?, email = ? WHERE id = ? LIMIT 1");
	
				$sql->bindParam(1, $senha);
				$sql->bindParam(2, $email);
				$sql->bindParam(3, $id_usuario);

				if ($sql->execute()){
					
					$sql = $this->db->prepare("UPDATE colaborador SET  nome = ?, telefone = ?, celular = ? WHERE id = ? LIMIT 1");
					
					$sql->bindParam(1, $nome);
					$sql->bindParam(2, $telefone);
					$sql->bindParam(3, $celular);
					$sql->bindParam(4, $id);
					
					if ( $sql->execute()) {
						$this->db->commit();
						return true;
						exit;
					}else {
						$this->db->rollBack();
						return false;
						exit;
					}

				}
			}

		}

		public function Verificar($id) {

				$sql = $this->db->prepare("SELECT * FROM servico WHERE id_col = ? LIMIT 1");
				$sql->bindParam(1, $id);
				$sql->execute();
			
				if($sql->rowCount() > 0) {
					return true;

				} else {
					$sql = $this->db->prepare("SELECT * FROM ordem_de_servico  WHERE id_col = ? LIMIT 1");
					$sql->bindParam(1, $id);
					$sql->execute();
					if($sql->rowCount() > 0) {
						return true;
						exit;
	
					} else { 
						return false;
						exit;
					}
				}

		}

		public function Excluir($id,$Ativo,$situacao) {
			
			$this->db->beginTransaction();

				$sql = $this->db->prepare("UPDATE colaborador SET  ativo = ?, situacao = ? WHERE id = ? LIMIT 1");
				$sql->bindParam(1, $Ativo);
				$sql->bindParam(2, $situacao);
				$sql->bindParam(3, $id);
				 
				if ($sql->execute()){
					
					$sql = $this->db->prepare("UPDATE usuario SET  ativo = ?, situacao = ? WHERE id = ? LIMIT 1");
					$sql->bindParam(1, $Ativo);
					$sql->bindParam(2, $situacao);
					$sql->bindParam(3, $id);
					
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
