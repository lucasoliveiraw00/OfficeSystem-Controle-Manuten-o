<?php
class ModelOrdemDeServico extends model {

			//FUNCTION GET NUMERO DE OS PARA NOVO CADASTRO
				public function GetNumeroOS() {

					$array = array();
					$sql = $this->db->prepare("SELECT MAX(numero_os) as numero_os FROM ordem_de_servico LIMIT 1");
					$sql->execute();
					
					if($sql->rowCount() > 0) {
						$array = $sql->fetch();
						}

					return $array;
				}

			//BUSCANDO OS DADOS CLIENTE PARA LISTAR 
				public function GetProprietario($situacao) {
						$array = array();
						$sql =$this->db->prepare("SELECT * FROM cliente WHERE situacao = ? ORDER BY nome ");
						$sql->bindParam(1, $situacao);
						$sql->execute();
								
						$linha = $sql->fetchAll(PDO::FETCH_ASSOC);
								
						return $linha;
										
				} 	
				
			//FUCTION BUSCAR DADOS DE VEICULO
				public function GetDadosVeiculo($id_proprietario) {		
					$array = array();

					$sql =$this->db->prepare("SELECT * FROM veiculo WHERE  id_cliente = ? ");
					$sql->bindParam(1, $id_proprietario);
					$sql->execute();
					
					if($sql->rowCount() > 0) {
						$array = $sql->fetchAll();
						}

					return $array;
					
				}	
			
			// VERIFICAR SE JA EXISTE ALGUMA ORDEM DE SERVICO ABERTA PARA O VEICULO SELECIONADO
				public function VerificarDadosOrdemDeServico ($id_veiculo,$status,$situacao) {
					$array = array();
					
					$sql = $this->db->prepare("SELECT * FROM ordem_de_servico WHERE id_veiculo = ? AND status = ? AND situacao = ? LIMIT 1");
					$sql->bindParam(1, $id_veiculo);
                    $sql->bindParam(2, $status);
                    $sql->bindParam(3, $situacao);
					$sql->execute();

					if($sql->rowCount() > 0) {
					
						return true;

					}else {
						return false;
					}
				}


			//FUNCTION VERIFICAR EXISTI ALGUM DADOS AO EDITAR
			public function VerificarDadosOrdemDeServicoEditar($id_veiculo,$id,$status,$situacao) {

				$dados = array();
		
				$sql =$this->db->prepare("SELECT * FROM ordem_de_servico WHERE id_veiculo = ? AND status = ? AND situacao = ?");
                $sql->bindParam(1, $id_veiculo);
                $sql->bindParam(2, $status);
                $sql->bindParam(3, $situacao);
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

			// ADICIONAR UMA NOVA ORDEM DE SERVICO
				public function Adicionar ($id_veiculo,$id_colaborador,$numero_os,$dataAbertura,$horaAbertura,$prazo,$status_prazo,$descricao,$status,$situacao) {

					$sql = $this->db->prepare("INSERT INTO ordem_de_servico (id, id_veiculo, id_colaborador, numero_os, dataAbertura, horaAbertura, prazo, descricao, status, status_prazo, situacao) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
				
					$sql->bindParam(1, $id_veiculo);
					$sql->bindParam(2, $id_colaborador);
					$sql->bindParam(3, $numero_os);
					$sql->bindParam(4, $dataAbertura);
					$sql->bindParam(5, $horaAbertura);
					$sql->bindParam(6, $prazo);
					$sql->bindParam(7, $descricao);
					$sql->bindParam(8, $status);
					$sql->bindParam(9, $status_prazo);
					$sql->bindParam(10, $situacao);

					if ($sql->execute()) {
						return true;
					} else {
						return false;
					}

				}	

				// FUNCTION PARA EDITAR ORDEM DE SERVICO 
				public function Editar($id_veiculo,$id_colaborador,$descricao,$id) {
					
						$sql = $this->db->prepare("UPDATE ordem_de_servico SET id_veiculo = ?, id_colaborador = ?, descricao = ? WHERE id = ? LIMIT 1");
					
						$sql->bindParam(1, $id_veiculo);
						$sql->bindParam(2, $id_colaborador);
						$sql->bindParam(3, $descricao);
						$sql->bindParam(4, $id);
						
						if($sql->execute()) {
							return true;
							exit;
						} else {
							return false;
							exit;
						}
					
				}


				//FUNCTION GET TOTAL ORDEM DE SERVICO ABERTA
				public function GetTotalOrdemAberta() {
					$result = array();
					$status_Aberto = 'Aberto';	
					$situacao_Ativo = 'Ativo';

					$sql = $this->db->prepare("SELECT COUNT('Aberto') as resultOrdemAberta FROM ordem_de_servico WHERE status = ? AND situacao = ?");
					$sql->bindParam(1, $status_Aberto);
					$sql->bindParam(2, $situacao_Ativo);
					$sql->execute();

					if($sql->rowCount() > 0) {
						$result = $sql->fetch();
					}
					
						return $result;
				}

				//FUNCTION GET TOTAL ORDEM DE SERVICO FECHADA
				public function GetTotalOrdemFechada() {
					$result = array();
					$status_Fechado = 'Fechado';
					$situacao_Ativo = 'Ativo';

					$sql = $this->db->prepare("SELECT COUNT('Fechado') as resultOrdemFechada FROM ordem_de_servico WHERE status = ? AND situacao = ?");
					$sql->bindParam(1, $status_Fechado);
					$sql->bindParam(2, $situacao_Ativo);
					$sql->execute();

					if($sql->rowCount() > 0) {
						$result = $sql->fetch();
					}
					
						return $result;
				}

				//FUCTION BUSCAR DADOS DE ORDEM DE SERVIÇO ABERTA
				public function GetDadosOrdemAberta($status_Aberto, $situacao_Ativo) {		
					$array = array();

					$sql =$this->db->prepare("SELECT os.id, os.numero_os, date_format(os.dataAbertura,'%d/%m/%Y') dataAbertura, os.horaAbertura, os.status, os.status_prazo, os.situacao, vl.modelo, vl.placa, cl.nome FROM ordem_de_servico as os 
												INNER JOIN veiculo as vl ON os.id_veiculo = vl.id 
												INNER JOIN cliente as cl ON vl.id_cliente = cl.id 
												WHERE os.status = ? AND os.situacao = ?");
					$sql->bindParam(1, $status_Aberto);
					$sql->bindParam(2, $situacao_Ativo);
					$sql->execute();
					
					if($sql->rowCount() > 0) {
						$array = $sql->fetchAll();
						}

					return $array;
					
				}	

				//FUCTION BUSCAR DADOS DE ORDEM DE SERVIÇO FECHADA
				public function GetDadosOrdemFechada($status_Fechado, $situacao_Ativo) {		
					$array = array();

					$sql =$this->db->prepare("SELECT os.id, os.numero_os, date_format(os.dataAbertura,'%d/%m/%Y') dataAbertura, os.horaAbertura,date_format(os.dataFechamento,'%d/%m/%Y') dataFechamento, os.status, os.situacao, vl.modelo, vl.placa, cl.nome FROM ordem_de_servico as os
												INNER JOIN veiculo as vl ON os.id_veiculo = vl.id 
												INNER JOIN cliente as cl ON vl.id_cliente = cl.id 
														WHERE os.status = ? AND os.situacao = ?");
					$sql->bindParam(1, $status_Fechado);
					$sql->bindParam(2, $situacao_Ativo);
					$sql->execute();
					
					if($sql->rowCount() > 0) {
						$array = $sql->fetchAll();
						}

					return $array;
					
				}	

				

				//FUCTION VERIFICAR APONTAMENTO NA ORDEM DE SERVIÇO ABERTA
				public function VerificarApontamentoOS($id_Ordem,$status_Aberto,$situacao) {		
					$array = array();
					$sql =$this->db->prepare("SELECT * FROM aux_os_servico  aux
                                                INNER JOIN servico  servico ON aux.id_servico = servico.id
                                                    WHERE aux.id_ordem_de_servico = ? AND servico.status = ? AND servico.situacao = ? AND aux.situacao = ? LIMIT 1");
					$sql->bindParam(1, $id_Ordem);
                    $sql->bindParam(2, $status_Aberto);
                    $sql->bindParam(3, $situacao);
                    $sql->bindParam(4, $situacao);
					$sql->execute();
					
						if($sql->rowCount() > 0) {

							return true;

						} else {

							return false;
						}
					
				}
				
				// FUNCTION FECHAR ORDEM DE SERVICO
				public function FecharOrdemDeServico($id_Ordem,$dataFechamento,$horaFechamento,$status_Fechado) {
					
					$sql = $this->db->prepare("UPDATE ordem_de_servico SET dataFechamento = ?, horaFechamento = ?, status = ? WHERE id = ? LIMIT 1");
					
						$sql->bindParam(1, $dataFechamento);
						$sql->bindParam(2, $horaFechamento);
						$sql->bindParam(3, $status_Fechado);
						$sql->bindParam(4, $id_Ordem);
						
					if($sql->execute()) {
						return true;
						exit;
					} else {
						return false;
						exit;
					}
				}

				//FUCTION BUSCAR DADOS DE ORDEM DE SERVIÇO (EDITAR/ VERIFICAÇAO DE DATA E HORA)
				public function GetDadosOrdem($id,$situacao) {	
				
					$sql =$this->db->prepare("SELECT os.id AS id_ordem, os.id_veiculo, os.id_colaborador, os.numero_os, date_format(os.dataAbertura,'%d/%m/%Y') AS dataAbertura , os.horaAbertura, date_format(os.dataFechamento,'%d/%m/%Y') AS dataFechamento , os.horaFechamento, os.descricao, os.status, os.status_prazo, os.prazo, col.nome AS nome_col, usa.matricula, vcl.modelo, vcl.marca, vcl.ano, vcl.placa, cliente.id AS id_cliente, cliente.nome, cliente.cpfcnpj  FROM ordem_de_servico AS os 
																		INNER JOIN veiculo AS vcl ON os.id_veiculo = vcl.id
																			INNER JOIN cliente AS cliente ON vcl.id_cliente= cliente.id
																				INNER JOIN colaborador AS col ON os.id_colaborador = col.id
																					INNER JOIN usuario AS usa ON col.id_usuario = usa.id
																						WHERE os.id = ? AND os.situacao = ? AND cliente.situacao = ? ");
					$sql->bindParam(1, $id);
                    $sql->bindParam(2, $situacao);
                    $sql->bindParam(3, $situacao);
					$sql->execute();
									
						if($sql->rowCount() > 0) {
								$dados = $sql->fetch(PDO::FETCH_OBJ);

								return $dados;

						}else {
									return false;
						}	
									
				}	

				//FUCTION BUSCAR DADOS DE ORDEM DE SERVIÇO
				public function BuscarDadosOrdemDeServico($id_Ordem, $situacao_Ativo) {		
					$array = array();

					$sql =$this->db->prepare("SELECT os.id AS id_Ordem , os.numero_os AS numeroOs, date_format(os.dataAbertura,'%d/%m/%Y') AS dataAbertura , os.horaAbertura AS horaAbertura,date_format(os.dataFechamento,'%d/%m/%Y') AS dataFechamento , os.horaFechamento AS horaFechamento, os.status AS status_os, os.descricao AS descricao_os, os.situacao AS situacao_os, os.prazo, status_prazo, vl.placa AS placaVeiculo, vl.modelo AS modeloVeiculo, vl.marca AS marcaVeiculo, vl.ano AS anoVeiculo, cl.nome AS nomeCliente, cl.cpfcnpj AS cpfcnpjCliente, col.nome AS nomeUsuario, usa.matricula AS matriculaUsuario FROM ordem_de_servico AS os
						INNER JOIN veiculo as vl ON os.id_veiculo = vl.id
							INNER JOIN cliente as cl ON vl.id_cliente = cl.id
								INNER JOIN colaborador as col ON os.id_colaborador = col.id
									INNER JOIN usuario as usa ON col.id_usuario = usa.id
									WHERE os.id = ? AND os.situacao = ? ");

					$sql->bindParam(1, $id_Ordem);
					$sql->bindParam(2, $situacao_Ativo);
					$sql->execute();
					
					if($sql->rowCount() > 0) {
						$dados = $sql->fetch(PDO::FETCH_OBJ);
						return $dados;
						}

					return $array;
					
				}	
				
				//FUCTION BUSCAR DADOS DE  SERVIÇO APONTAMENTO
				public function ListarDadosOrdemApontamento($id_Ordem , $situacao_Ativo) {		
					$array = array();
			
					$sql =$this->db->prepare("SELECT aux.id AS id_aux, aux.id_ordem_de_servico AS id_ordem, aux.id_servico AS id_servico, servico.id_proc,  proc.codigo AS codigo_proc, proc.descricao AS descricao_proc, servico.id AS id_item, item.codigo AS codigo_item, item.descricao AS descricao_item, item.id_comp, comp.codigo AS codigo_comp, comp.descricao AS descricao_comp, date_format(servico.dataAbertura,'%d/%m/%Y') AS dataAbertura, servico.horaAbertura, date_format(servico.dataFechamento, '%d/%m/%Y') AS dataFechamento, servico.horaFechamento, servico.status, col.nome, usua.matricula  FROM aux_os_servico AS aux 
						INNER JOIN servico AS servico ON aux.id_servico = servico.id
							INNER JOIN procedimento AS proc ON servico.id_proc = proc.id
								INNER JOIN item AS item ON servico.id_item = item.id
									INNER JOIN componente AS comp ON item.id_comp = comp.id
										INNER JOIN colaborador AS col ON servico.id_col = col.id
											INNER JOIN usuario AS usua ON col.id_usuario = usua.id
												WHERE id_ordem_de_servico = ? AND servico.situacao = ? ");
			
					$sql->bindParam(1, $id_Ordem);
					$sql->bindParam(2, $situacao_Ativo);
					$sql->execute();
						
					if($sql->rowCount() > 0) {
							$array = $sql->fetchAll();
					}else {
						return false;
					}
			
					return $array;
						
				}	

				//FUCTION BUSCAR DADOS DE  SERVIÇO APONTAMENTO
				public function ExibirDadosOrdemApontamento($id_servico,$situacao) {		
					$array = array();
			
					$sql =$this->db->prepare("SELECT aux.id AS id_aux, aux.id_ordem_de_servico AS id_ordem, aux.id_servico AS id_servico, servico.id_proc,  proc.codigo AS codigo_proc, proc.descricao AS descricao_proc, servico.id AS id_item, item.codigo AS codigo_item, item.descricao AS descricao_item, item.id_comp, comp.codigo AS codigo_comp, comp.descricao AS descricao_comp, date_format(servico.dataAbertura,'%d/%m/%Y') AS dataAbertura, servico.horaAbertura, date_format(servico.dataFechamento, '%d/%m/%Y') AS dataFechamento, servico.horaFechamento, servico.status, col.nome, usua.matricula, os.status AS os_status  FROM aux_os_servico AS aux 
						INNER JOIN servico AS servico ON aux.id_servico = servico.id
							INNER JOIN ordem_de_servico AS os ON os.id = aux.id_ordem_de_servico
								INNER JOIN procedimento AS proc ON servico.id_proc = proc.id
									INNER JOIN item AS item ON servico.id_item = item.id
										INNER JOIN componente AS comp ON item.id_comp = comp.id
											INNER JOIN colaborador AS col ON servico.id_col = col.id
												INNER JOIN usuario AS usua ON col.id_usuario = usua.id
													WHERE aux.id_servico = ? AND aux.situacao = ? ");
			
					$sql->bindParam(1, $id_servico);
					$sql->bindParam(2, $situacao);
					$sql->execute();
						
					if($sql->rowCount() > 0) {
							$array = $sql->fetch();
					}else {
						return false;
					}
			
					return $array;
						
				}

				//FUCTION BUSCAR DADOS DE ORDEM DE SERVIÇO (PARA ADD NOVO SERVICO)
				public function BuscarDadosOrdem($id, $situacao) {		
					$sql =$this->db->prepare("SELECT dataFechamento, horaFechamento, status FROM ordem_de_servico WHERE id = ? AND situacao = ?");
					$sql->bindParam(1, $id);
					$sql->bindParam(2, $situacao);
					$sql->execute();
					
					if($sql->rowCount() > 0) {

						$Resultdados = $sql->fetch(PDO::FETCH_OBJ);
						return $Resultdados;

					} else {

							return false;
						}
					
				}	

				//FUCTION VERIFICAR SE EXISTE DADOS LIGADOS A ORDEM DE SERVICO 	
				public function VerificarExistApt($id_Ordem,$situacao) {	

					$sql = $this->db->prepare("SELECT * FROM aux_os_servico WHERE id_ordem_de_servico =  ? AND situacao = ? ");
                    $sql->bindParam(1, $id_Ordem);
                    $sql->bindParam(2, $situacao);
					$sql->execute();

						if($sql->rowCount() > 0) {
							
							return true;

						}else {

							return false;	

						}	
				
									
				}

				//FUCTION BUSCAR DADOS DE ORDEM DE SERVIÇO STATUS PRAZO NORMAL,PROCIMO VENCIMENTO, VENCIDA
				public function DadosOrdemStatusPrazo($status_prazo,$status,$situacao) {		
					$array = array();

					$sql =$this->db->prepare("SELECT os.id, os.numero_os, date_format(os.dataAbertura,'%d/%m/%Y') dataAbertura, os.horaAbertura, os.status, os.situacao, os.status_prazo, vl.modelo, vl.placa, cl.nome FROM ordem_de_servico as os 
												INNER JOIN veiculo as vl ON os.id_veiculo = vl.id
												INNER JOIN cliente as cl ON vl.id_cliente = cl.id  
													WHERE os.status_prazo = ? AND os.status = ? AND os.situacao = ? ");
					$sql->bindParam(1, $status_prazo);
					$sql->bindParam(2, $status);
					$sql->bindParam(3, $situacao);
					$sql->execute();
					
					if($sql->rowCount() > 0) {
						$array = $sql->fetchAll();
						}

					return $array;
					
				}	

				public function InativarOrdemEservico($id, $situacao_Inativo) {
					$this->db->beginTransaction();

						$sql = $this->db->prepare(" UPDATE servico AS servico INNER JOIN aux_os_servico AS aux ON aux.id_servico = servico.id SET servico.situacao = ?	WHERE aux.id_ordem_de_servico = ? ");
						$sql->bindParam(1, $situacao_Inativo);
						$sql->bindParam(2, $id);
					
						if ($sql->execute()) {
					
							$sql = $this->db->prepare("UPDATE ordem_de_servico SET situacao = ? WHERE id = ? LIMIT 1");
							$sql->bindParam(1, $situacao_Inativo);
							$sql->bindParam(2, $id);

							if ($sql->execute()) {

								$sql = $this->db->prepare(" UPDATE aux_os_servico SET situacao = ? WHERE id_ordem_de_servico = ? ");
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

				public function InativarOrdem($id, $situacao_Inativo) {
					$this->db->beginTransaction();

						$sql = $this->db->prepare("UPDATE ordem_de_servico SET situacao = ? WHERE id = ? LIMIT 1");
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

