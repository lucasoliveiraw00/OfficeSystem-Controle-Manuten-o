<?php 
	class ModelPainel extends model	{

		public function VerificarServico ($id_usuario,$status_Aberto,$situacao_Ativo) {		
			$array = array();

			$sql =$this->db->prepare("SELECT id_col, status, situacao FROM servico WHERE id_col = ? AND status = ? AND situacao = ? ");
			
			$sql->bindParam(1, $id_usuario);
            $sql->bindParam(2, $status_Aberto);
			$sql->bindParam(3, $situacao_Ativo);
			$sql->execute();
					
            if($sql->rowCount() > 0) {

				return true;
				exit;
				
            } else {
                return false;
			}
				
        }

		public function VerificarOrdem ($numero_os, $situacao_Ativo, $status_Aberto) {		
			$array = array();
			$sql =$this->db->prepare("SELECT * FROM ordem_de_servico WHERE numero_os = ? AND status = ? AND situacao = ? LIMIT 1");
            $sql->bindParam(1, $numero_os);
            $sql->bindParam(2, $status_Aberto);
			$sql->bindParam(3, $situacao_Ativo);
			$sql->execute();
					
            if($sql->rowCount() > 0) {

				$array = $sql->fetch();
 
            } else {
                return false;
                exit;
            }
	
			return $array;
			exit;
				
		}
		
		public function FecharServico($id_usuario,$dataFechamento,$horaFechamento,$status_Fechado,$situacao_Ativo,$status_Aberto) {		
			$array = array();

			$sql = $this->db->prepare("UPDATE servico SET dataFechamento = ?, horaFechamento = ?, status = ? WHERE id_col = ? AND status = ? AND situacao = ? LIMIT 1");
			
				$sql->bindParam(1, $dataFechamento);
				$sql->bindParam(2, $horaFechamento);
				$sql->bindParam(3, $status_Fechado);
				$sql->bindParam(4, $id_usuario);
				$sql->bindParam(5, $status_Aberto);
				$sql->bindParam(6, $situacao_Ativo);
				
			if($sql->execute()) {
				return true;
				exit;
			} else {
				return false;
				exit;
			}
	
				
		}

		public function BuscarDadosPainelServico ($id_ordem,$status,$situacao) {		
			$array = array();
			$sql =$this->db->prepare("SELECT descricao FROM ordem_de_servico WHERE id = ? AND status = ? AND situacao = ? LIMIT 1");
            $sql->bindParam(1, $id_ordem);
            $sql->bindParam(2, $status);
			$sql->bindParam(3, $situacao);
			$sql->execute();
					
            if($sql->rowCount() > 0) {

				$array = $sql->fetch();
 
            } else {
                return false;
                exit;
            }
	
			return $array;
			exit;
				
		}
		
		public function ConsultarServico($id_usuario,$status_Aberto,$situacao_Ativo) {		
			$array = array();
	
			$sql =$this->db->prepare("SELECT  aux.id AS id_aux, aux.id_ordem_de_servico AS id_ordem, aux.id_servico AS id_servico, os.numero_os AS numero_os, servico.id_proc,  proc.codigo AS codigo_proc, proc.descricao AS descricao_proc, servico.id AS id_item, item.codigo AS codigo_item, item.descricao AS descricao_item, item.id_comp, comp.codigo AS codigo_comp, comp.descricao AS descricao_comp, date_format(servico.dataAbertura,'%d/%m/%Y') AS dataAbertura, servico.horaAbertura, date_format(servico.dataFechamento, '%d/%m/%Y') AS dataFechamento, servico.horaFechamento, servico.status, col.nome, usua.matricula, vl.modelo, vl.placa FROM servico AS servico
										INNER JOIN procedimento as proc ON proc.id = servico.id_proc
											INNER JOIN item as item ON item.id = servico.id_item
												INNER JOIN componente as comp ON comp.id = item.id_comp
													INNER JOIN aux_os_servico as aux ON aux.id_servico = servico.id
														INNER JOIN ordem_de_servico as os ON os.id = aux.id_ordem_de_servico
															INNER JOIN colaborador AS col ON servico.id_col = col.id
																INNER JOIN usuario AS usua ON col.id_usuario = usua.id
																	INNER JOIN veiculo vl ON os.id_veiculo = vl.id
															WHERE servico.id_col = ? AND servico.status = ? AND servico.situacao = ? LIMIT 1");
	
			$sql->bindParam(1, $id_usuario);
			$sql->bindParam(2, $status_Aberto);
			$sql->bindParam(3, $situacao_Ativo);

			$sql->execute();
				
			if($sql->rowCount() > 0) {
					$array = $sql->fetch();
			}else {
				return false;
			}
	
			return $array;
				
		}
        
		public function ListOrdemAberta($status,$situacao) {
			$array = array();
			$sql =$this->db->prepare("SELECT os.numero_os, vl.modelo, vl.placa FROM ordem_de_servico os
										INNER JOIN veiculo vl ON os.id_veiculo = vl.id
											WHERE os.status = ? AND os.situacao = ? ");
			$sql->bindParam(1, $status);
			$sql->bindParam(2, $situacao);
			
			if ($sql->execute()) {
                $array = $sql->fetchAll();
            }else {
				return false;
            }
            
            return $array;
			
		}
		
		public function ListProcedimento() {
			$array = array();
			$sql =$this->db->prepare("SELECT * FROM procedimento ORDER BY codigo ASC ");
			
			if ($sql->execute()) {
                $array = $sql->fetchAll();
            }else {
				return false;
            }
            
            return $array;
			
        }

		public function ListComponente() {
			$array = array();
			$sql =$this->db->prepare("SELECT * FROM componente ORDER BY codigo ASC ");
			
			if ($sql->execute()) {
                $array = $sql->fetchAll();
            }else {
				return false;
            }
            
            return $array;
			
		}
		
		public function VerificarComponente($id_comp) {
			$array = array();
			$sql =$this->db->prepare("SELECT * FROM item WHERE id_comp = ? LIMIT 1");
			$sql->bindParam(1,$id_comp);
			$sql->execute();
			
			if ($sql->rowCount() > 0) {
                $array = $sql->fetchAll();
            }else {
				return false;
            }
            
            return $array;
			
        }

		public function ListItem($id_comp) {
			$array = array();
			$sql =$this->db->prepare("SELECT * FROM item WHERE id_comp = ? ORDER BY codigo ASC ");
            $sql->bindParam(1,$id_comp);
			if ($sql->execute()) {
                $array = $sql->fetchAll();
            }else {
				return false;
            }
            
            return $array;
			
        }
        
		public function BuscarProcDescricao($proc_cod) {
			$array = array();
			$sql =$this->db->prepare("SELECT id, descricao FROM procedimento WHERE codigo = ? LIMIT 1 ");
            $sql->bindParam(1,$proc_cod);
            
			if ($sql->execute()) {
                $array = $sql->fetch();
            }else {
				return false;
            }
            
            return $array;
			
		}
		 
		public function BuscarCompDescricao($comp_cod) {
			$array = array();
			$sql =$this->db->prepare("SELECT id, descricao FROM componente WHERE codigo = ? LIMIT 1 ");
            $sql->bindParam(1,$comp_cod);
            $sql->execute();
			if ($sql->rowCount() > 0) {

				$array = $sql->fetch(PDO::FETCH_OBJ);

				$id_comp = $array->id;

				$sql =$this->db->prepare("SELECT * FROM item WHERE id_comp = ? LIMIT 1 ");
				$sql->bindParam(1,$id_comp);

				if ($sql->execute()) {
					if($sql->rowCount() > 0) {
						
					}else {
						return 4;
					}
				}else {
					return 3;
				}
                
            }else {
				return 2;
            }
			return $array;
		}

		public function BuscarItemDescricao($item_cod, $id_comp) {
			$array = array();
			$sql =$this->db->prepare("SELECT id, descricao FROM item WHERE codigo = ? AND id_comp = ? LIMIT 1 ");
            $sql->bindParam(1,$item_cod);
            $sql->bindParam(2,$id_comp);
            
			if ($sql->execute()) {
                $array = $sql->fetch();
            }else {
				return false;
            }
            
            return $array;
			
        }

		public function IniciarServico ($id_usuario,$id_proc,$id_item,$dataAbertura,$horaAbertura,$status_Aberto,$situacao_Ativo,$id_ordem) {

			$this->db->beginTransaction();

			$sql = $this->db->prepare("INSERT INTO servico (id, id_col, id_proc, id_item, dataAbertura, horaAbertura, status, situacao) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?)");
				
			$sql->bindParam(1, $id_usuario);
			$sql->bindParam(2, $id_proc);
            $sql->bindParam(3, $id_item);
			$sql->bindParam(4, $dataAbertura);
			$sql->bindParam(5, $horaAbertura);
            $sql->bindParam(6, $status_Aberto);
            $sql->bindParam(7, $situacao_Ativo);

			if ($sql->execute()) {

				$id_servico = $this->db->lastInsertId();

					$sql = $this->db->prepare("INSERT INTO aux_os_servico (id, id_ordem_de_servico, id_servico, situacao) VALUES (NULL, ?, ?, ?)");
				
					$sql->bindParam(1, $id_ordem);
					$sql->bindParam(2, $id_servico);
					$sql->bindParam(3, $situacao_Ativo);

					if ($sql->execute()) {

						$this->db->commit();
						return true;
						exit;

					} else {

						$this->db->rollBack();
						return $id;
						exit;
						
					}
	
			} else {
						$this->db->rollBack();
						return false;
						exit;
					
				}
		
		}

        
    }
?>