<?php 
	class ModelServico extends model	{
		
		public function VerificaServico ($id_col,$status,$situacao) {

			$sql = $this->db->prepare("SELECT servico.id , servico.status, aux.id_ordem_de_servico, os.numero_os FROM servico AS servico 
										INNER JOIN aux_os_servico AS aux ON aux.id_servico = servico.id
											INNER JOIN ordem_de_servico AS os ON os.id = aux.id_ordem_de_servico
												WHERE servico.id_col = ? AND servico.status = ? AND servico.situacao = ? ");
			$sql->bindParam(1, $id_col);
			$sql->bindParam(2, $status);
			$sql->bindParam(3, $situacao);
			$sql->execute();

			if($sql->rowCount() > 0) {
				$dados = $sql->fetch(PDO::FETCH_OBJ);
				return $dados;

			} else {
				return false;
			}
		}

		public function VerificaServico2 ($id,$id_col,$status,$situacao) {

			$sql = $this->db->prepare("SELECT servico.id, servico.id_col, servico.status, aux.id_ordem_de_servico, os.numero_os FROM servico AS servico 
										INNER JOIN aux_os_servico AS aux ON aux.id_servico = servico.id
											INNER JOIN ordem_de_servico AS os ON os.id = aux.id_ordem_de_servico
												WHERE servico.id_col = ? AND servico.status = ? AND servico.situacao = ? ");
			$sql->bindParam(1, $id_col);
			$sql->bindParam(2, $status);
			$sql->bindParam(3, $situacao);
			$sql->execute();

			if($sql->rowCount() > 0) {
				$dados = $sql->fetch(PDO::FETCH_OBJ);
				
				if ($id != $dados->id) {
					return $dados;
					exit;
				} else {
					return false;
					exit;
				}

			} else {
				return false;
			}
		}

		public function DisponibilidadeHorario ($id,$id_col,$situacao) {
			$dados = array();

			$sql = $this->db->prepare("SELECT * FROM servico WHERE id_col = ?  AND id >= ? AND situacao = ? ORDER BY dataAbertura ");
			$sql->bindParam(1, $id_col);
			$sql->bindParam(2, $id);
			$sql->bindParam(3, $situacao);
			$sql->execute();

			if($sql->rowCount() > 0) {
				$dados = $sql->fetchAll();
	
				return $dados;
			
			} 
					
		}
			

		public function VerificaExitOS ($id,$situacao) {

			$sql = $this->db->prepare("SELECT * FROM ordem_de_servico WHERE id = ? AND situacao = ?");
			$sql->bindParam(1, $id);
			$sql->bindParam(2, $situacao);
			$sql->execute();

			if($sql->rowCount() > 0) {

				return true;

			} else {
				return false;
			}
		}

		public function GetListaColaborador($situacao,$cargo,$ativo) {
			$array = array();

			$sql =$this->db->prepare("SELECT * FROM colaborador a INNER JOIN usuario b  ON  a.id_usuario = b.id WHERE a.situacao = ? AND b.situacao = ? AND a.ativo = ? AND b.cargo = ? ORDER BY matricula");
			$sql->bindParam(1, $situacao);
			$sql->bindParam(2, $situacao);
			$sql->bindParam(3, $ativo);
			$sql->bindParam(4, $cargo);

			if ($sql->execute()) {

				$dados = $sql->fetchAll(PDO::FETCH_ASSOC);
				return $dados;

			}else {

				return false;

			}
			
		}	

		public function Adicionar ($id_col,$id_proc,$id_item,$dataAbertura,$horaAbertura,$status,$id,$situacao) {

			$this->db->beginTransaction();

			$sql = $this->db->prepare("INSERT INTO servico (id, id_col, id_proc, id_item, dataAbertura, horaAbertura, status, situacao) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?)");
				
			$sql->bindParam(1, $id_col);
			$sql->bindParam(2, $id_proc);
			$sql->bindParam(3, $id_item);
			$sql->bindParam(4, $dataAbertura);
			$sql->bindParam(5, $horaAbertura);
			$sql->bindParam(6, $status);
			$sql->bindParam(7, $situacao);

			if ($sql->execute()) {

					 $id_servico = $this->db->lastInsertId();

					$sql = $this->db->prepare("INSERT INTO aux_os_servico (id, id_ordem_de_servico, id_servico, situacao) VALUES (NULL, ?, ?, ?)");
				
					$sql->bindParam(1, $id);
					$sql->bindParam(2, $id_servico);
					$sql->bindParam(3, $situacao);

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

		public function GetDadosServico($id,$situacao) {

			$array = array();
			$sql =$this->db->prepare("SELECT  servico.id , servico.id_col, servico.id_proc, servico.id_item,  proc.codigo AS codigo_proc, proc.descricao AS descricao_proc, item.codigo AS codigo_item, item.descricao AS descricao_item, item.id_comp, comp.codigo AS codigo_comp, comp.descricao AS descricao_comp, date_format(servico.dataAbertura,'%d/%m/%Y') AS dataAbertura, servico.horaAbertura, date_format(servico.dataFechamento, '%d/%m/%Y') AS dataFechamento, servico.horaFechamento, servico.status, col.nome, usua.matricula, os.status AS status_os  FROM servico AS servico
										INNER JOIN colaborador AS col ON servico.id_col = col.id
											INNER JOIN usuario AS usua ON col.id_usuario = usua.id
												INNER JOIN procedimento AS proc ON servico.id_proc = proc.id
													INNER JOIN item AS item ON servico.id_item = item.id
														INNER JOIN componente AS comp ON item.id_comp = comp.id
															INNER JOIN aux_os_servico AS aux ON aux.id_servico = servico.id
																INNER JOIN ordem_de_servico AS os ON os.id = aux.id_ordem_de_servico
																	WHERE servico.id = ? AND servico.situacao = ? AND os.situacao = ? AND aux.situacao = ? LIMIT 1");
			$sql->bindParam(1, $id);
			$sql->bindParam(2, $situacao);
			$sql->bindParam(3, $situacao);
			$sql->bindParam(4, $situacao);
			$sql->execute();
			
			if($sql->rowCount() > 0) {
				$array = $sql->fetch();
				return $array;
			
			}else {
				return false;
			}	
		}
		

		public function BuscarDadosOrdem($id,$situacao) {

			$sql = $this->db->prepare("SELECT os.id, os.dataAbertura, os.horaAbertura, os.dataFechamento, os.horaFechamento, os.status FROM aux_os_servico AS aux 
										INNER JOIN ordem_de_servico AS os ON aux.id_ordem_de_servico = os.id
											WHERE aux.id_servico = ? AND aux.situacao = ? AND os.situacao = ? LIMIT 1");
			$sql->bindParam(1, $id);
			$sql->bindParam(2, $situacao);
			$sql->bindParam(3, $situacao);
			$sql->execute();
			
			if($sql->rowCount() > 0) {
				$dados = $sql->fetch(PDO::FETCH_OBJ);
				return $dados;
			}
			else {
				return false;
			}
			 
			 
		}

		public function EditServico($id_col,$id_proc,$id_item,$dataFechamento,$horaFechamento,$status,$id) {
			
			if (!empty ($dataFechamento && $horaFechamento)) {
				$sql = $this->db->prepare("UPDATE servico SET  dataFechamento = ?, horaFechamento = ?, status = ? WHERE id = ? LIMIT 1");
			
				$sql->bindParam(1, $dataFechamento);
				$sql->bindParam(2, $horaFechamento);
				$sql->bindParam(3, $status);
				$sql->bindParam(4, $id);
				
				if($sql->execute()) {
					return true;
					exit;
				} else {
					return false;
					exit;
				}
			}else {

				$sql = $this->db->prepare("UPDATE servico SET id_col = ?, id_proc = ?, id_item = ?, status = ? WHERE id = ? LIMIT 1");
			
				$sql->bindParam(1, $id_col);
				$sql->bindParam(2, $id_proc);
				$sql->bindParam(3, $id_item);
				$sql->bindParam(4, $status);
				$sql->bindParam(5, $id);
				
				if($sql->execute()) {
					return true;
					exit;
				} else {
					return false;
					exit;
				}

			}
		}

		public function FecharApontamento($dataFechamento,$horaFechamento,$status,$id) {
			
			$sql = $this->db->prepare("UPDATE servico SET dataFechamento = ?, horaFechamento = ?, status = ? WHERE id = ? LIMIT 1");
			
				$sql->bindParam(1, $dataFechamento);
				$sql->bindParam(2, $horaFechamento);
				$sql->bindParam(3, $status);
				$sql->bindParam(4, $id);
				
			if($sql->execute()) {
				return true;
				exit;
			} else {
				return false;
				exit;
			}
		}

		public function VerificaApontamento($id) {
			$sql = $this->db->prepare("SELECT id, status FROM servico WHERE id = ? LIMIT 1");
			$sql->bindParam(1, $id);
			$sql->execute();
			
			if($sql->rowCount() > 0) {

				$dados = $sql->fetch(PDO::FETCH_OBJ);

					if ($dados->status == "Fechado") {
						return false;
					}else {
						return true;
					}
			}
			else {
				return true;
			}
			 
			 
		}

	
		public function InativarApontamento($id, $situacao_Inativo) {
			$this->db->beginTransaction();
			
					$sql = $this->db->prepare("UPDATE servico SET situacao = ? WHERE id = ? LIMIT 1");
					$sql->bindParam(1, $situacao_Inativo);
					$sql->bindParam(2, $id);

					if ($sql->execute()) {
						$this->db->commit();
						return true;
						exit;
					} else {
						$this->db->rollBack();
						return false;
						exit;
					}
		}
		
    }
