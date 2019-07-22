<?php
class ModelRelatorio extends model {



	public function GerarRlPrVl($id, $situacao) {
		$sql = $this->db->prepare("SELECT * FROM veiculo WHERE id_cliente = ? AND situacao = ? ORDER BY id");
		$sql->bindParam(1, $id);
		$sql->bindParam(2, $situacao);
        $sql->execute();
        
		if($sql->rowCount() > 0) {
            $dados = $sql->fetchAll();
		    return $dados;
        } else {
            return false;
        }

    }
    
    public function RlPrVlToTotaldeVeiculo($id, $situacao) {
		$sql = $this->db->prepare("SELECT COUNT(*) total FROM veiculo WHERE id_cliente = ? AND situacao = ? ");
		$sql->bindParam(1, $id);
		$sql->bindParam(2, $situacao);
        
		if($sql->execute()) {
            $dados = $sql->fetch(PDO::FETCH_OBJ);
		    return $dados;
        } else {
            return false;
        }

    }
    
    public function RlPrVlToProprietario($id, $situacao) {

		$sql = $this->db->prepare("SELECT nome, cpfcnpj FROM cliente WHERE id = ? AND situacao = ? LIMIT 1 ");
		$sql->bindParam(1, $id);
		$sql->bindParam(2, $situacao);
        
		if($sql->execute()) {
            $dados = $sql->fetch(PDO::FETCH_OBJ);
		    return $dados;
        } else {
            return false;
        }

    }

    public function RlManutencao($id, $situacao) {

		$sql = $this->db->prepare("SELECT os.numero_os, col.nome, usa.matricula, proc.codigo prcoCodigo, proc.descricao procDes, item.codigo itemCodigo, item.descricao itemDes, comp.codigo compCodigo, comp.descricao compDes, date_format(servico.dataAbertura,'%d/%m/%Y') dataAbertura , servico.horaAbertura, date_format(servico.dataFechamento,'%d/%m/%Y') dataFechamento, servico.horaFechamento FROM ordem_de_servico os
                                    INNER JOIN aux_os_servico aux ON  aux.id_ordem_de_servico = os.id 
                                        INNER JOIN servico servico ON  servico.id = aux.id_servico
                                            INNER JOIN procedimento AS proc ON servico.id_proc = proc.id
                                                INNER JOIN item AS item ON servico.id_item = item.id
                                                    INNER JOIN componente AS comp ON item.id_comp = comp.id
                                                        INNER JOIN colaborador AS col ON servico.id_col = col.id
                                                            INNER JOIN usuario  usa ON col.id_usuario = usa.id
                                                                WHERE os.id_veiculo = ? AND os.situacao = ? AND servico.situacao = ? ORDER BY servico.id ");
		$sql->bindParam(1, $id);
        $sql->bindParam(2, $situacao);
        $sql->bindParam(3, $situacao);
        $sql->execute();
        
		if($sql->rowCount() > 0) {
            $dados = $sql->fetchAll();
		    return $dados;
        } else {
            return false;
        }

    }

    public function RlManutencaoVeiculo($id, $situacao) {

		$sql = $this->db->prepare("SELECT vl.modelo, vl.marca, vl.ano, vl.cor, vl.placa, cli.nome, cli.cpfcnpj FROM ordem_de_servico os
                                    INNER JOIN veiculo vl ON  vl.id = os.id_veiculo 
                                        INNER JOIN cliente cli ON  cli.id = vl.id_cliente
                                            WHERE os.id_veiculo = ? AND os.situacao = ? LIMIT 1");
		$sql->bindParam(1, $id);
        $sql->bindParam(2, $situacao);
        $sql->execute();
        
		if($sql->rowCount() > 0) {
            $dados = $sql->fetch(PDO::FETCH_OBJ);
		    return $dados;
        } else {
            return false;
        }

    }

    public function RlManutencaoVeiculoTotal($id, $situacao) {

		$sql = $this->db->prepare("SELECT COUNT(*) total FROM ordem_de_servico os
                                    INNER JOIN aux_os_servico aux ON  aux.id_ordem_de_servico = os.id 
                                        INNER JOIN servico servico ON  servico.id = aux.id_servico
                                            WHERE os.id_veiculo = ? AND os.situacao = ? AND servico.situacao = ?");
		$sql->bindParam(1, $id);
        $sql->bindParam(2, $situacao);
        $sql->bindParam(3, $situacao);
        $sql->execute();
        
		if($sql->rowCount() > 0) {
            $dados = $sql->fetch(PDO::FETCH_OBJ);
		    return $dados;
        } else {
            return false;
        }

    }

    public function RlManutencaoDataInicioFinal($id,$dataInicio,$dataFinal,$situacao) {
        //BETWEEN ? AND  ?
		$sql = $this->db->prepare("SELECT os.numero_os, col.nome, usa.matricula, proc.codigo prcoCodigo, proc.descricao procDes, item.codigo itemCodigo, item.descricao itemDes, comp.codigo compCodigo, comp.descricao compDes, date_format(servico.dataAbertura,'%d/%m/%Y') dataAbertura , servico.horaAbertura, date_format(servico.dataFechamento,'%d/%m/%Y') dataFechamento, servico.horaFechamento FROM ordem_de_servico os
                                    INNER JOIN aux_os_servico aux ON  aux.id_ordem_de_servico = os.id 
                                        INNER JOIN servico servico ON  servico.id = aux.id_servico
                                            INNER JOIN procedimento AS proc ON servico.id_proc = proc.id
                                                INNER JOIN item AS item ON servico.id_item = item.id
                                                    INNER JOIN componente AS comp ON item.id_comp = comp.id
                                                        INNER JOIN colaborador AS col ON servico.id_col = col.id
                                                            INNER JOIN usuario  usa ON col.id_usuario = usa.id
                                                                WHERE os.id_veiculo = ?  AND servico.dataAbertura >= ? AND servico.dataFechamento <= ? AND os.situacao = ? AND servico.situacao = ? ORDER BY servico.id ");
        $sql->bindParam(1, $id);
        $sql->bindParam(2, $dataInicio);
        $sql->bindParam(3, $dataFinal);
        $sql->bindParam(4, $situacao);
        $sql->bindParam(5, $situacao);
        $sql->execute();
        
		if($sql->rowCount() > 0) {
            $dados = $sql->fetchAll();
		    return $dados;
        } else {
            return false;
        }

    }

    public function RlManutencaoDataInicioAtual($id,$dataInicio,$dataAtual,$situacao) {
        //BETWEEN ? AND  ?
		$sql = $this->db->prepare("SELECT os.numero_os, col.nome, usa.matricula, proc.codigo prcoCodigo, proc.descricao procDes, item.codigo itemCodigo, item.descricao itemDes, comp.codigo compCodigo, comp.descricao compDes, date_format(servico.dataAbertura,'%d/%m/%Y') dataAbertura , servico.horaAbertura, date_format(servico.dataFechamento,'%d/%m/%Y') dataFechamento, servico.horaFechamento FROM ordem_de_servico os
                                    INNER JOIN aux_os_servico aux ON  aux.id_ordem_de_servico = os.id 
                                        INNER JOIN servico servico ON  servico.id = aux.id_servico
                                            INNER JOIN procedimento AS proc ON servico.id_proc = proc.id
                                                INNER JOIN item AS item ON servico.id_item = item.id
                                                    INNER JOIN componente AS comp ON item.id_comp = comp.id
                                                        INNER JOIN colaborador AS col ON servico.id_col = col.id
                                                            INNER JOIN usuario  usa ON col.id_usuario = usa.id
                                                                WHERE os.id_veiculo = ?  AND servico.dataAbertura >= ? AND servico.dataFechamento <= ? AND os.situacao = ? AND servico.situacao = ? ORDER BY servico.id ");
        $sql->bindParam(1, $id);
        $sql->bindParam(2, $dataInicio);
        $sql->bindParam(3, $dataAtual);
        $sql->bindParam(4, $situacao);
        $sql->bindParam(5, $situacao);
        $sql->execute();
        
		if($sql->rowCount() > 0) {
            $dados = $sql->fetchAll();
		    return $dados;
        } else {
            return false;
        }

    }

    public function RlColaborador($ativo,$situacao) {

		$sql = $this->db->prepare("SELECT col.nome, col.telefone, col.celular, col.ativo colAtivo, usa.matricula, usa.email, usa.cargo, usa.ativo usaAtivo FROM colaborador col
                                    INNER JOIN usuario usa ON  usa.id = col.id_usuario
                                        WHERE col.ativo = ? AND usa.ativo = ? AND col.situacao = ? AND usa.situacao = ? ORDER BY col.id");
        $sql->bindParam(1, $ativo);
        $sql->bindParam(2, $ativo);
        $sql->bindParam(3, $situacao);
        $sql->bindParam(4, $situacao);
        $sql->execute();
        
		if($sql->rowCount() > 0) {
            $dados = $sql->fetchAll();
		    return $dados;
        } else {
            return false;
        }

    }

    public function RlColaboradorTodos($situacao) {

		$sql = $this->db->prepare("SELECT col.nome, col.telefone, col.celular, col.ativo colAtivo, usa.matricula, usa.email, usa.cargo, usa.ativo usaAtivo FROM colaborador col
                                    INNER JOIN usuario usa ON  usa.id = col.id_usuario
                                        WHERE col.situacao = ? AND usa.situacao = ? ORDER BY col.id");
        $sql->bindParam(1, $situacao);
        $sql->bindParam(2, $situacao);
        $sql->execute();
        
		if($sql->rowCount() > 0) {
            $dados = $sql->fetchAll();
		    return $dados;
        } else {
            return false;
        }

    }

    public function RlColaboradorTotal($situacao) {

		$sql = $this->db->prepare("SELECT COUNT(*) total FROM colaborador col
                                    INNER JOIN usuario usa ON  usa.id = col.id_usuario
                                        WHERE col.situacao = ? AND usa.situacao = ? ");
        $sql->bindParam(1, $situacao);
        $sql->bindParam(2, $situacao);
        $sql->execute();
        
		if($sql->rowCount() > 0) {
            $dados = $sql->fetch(PDO::FETCH_OBJ);
		    return $dados;
        } else {
            return false;
        }

    }

    public function RlColaboradorTotalAtivoSim($ativoSim,$situacao) {

		$sql = $this->db->prepare("SELECT COUNT(*) total FROM colaborador col
                                    INNER JOIN usuario usa ON  usa.id = col.id_usuario
                                        WHERE col.ativo = ? AND usa.ativo = ? AND col.situacao = ? AND usa.situacao = ? ");
        $sql->bindParam(1, $ativoSim);
        $sql->bindParam(2, $ativoSim);
        $sql->bindParam(3, $situacao);
        $sql->bindParam(4, $situacao);
        $sql->execute();
        
		if($sql->rowCount() > 0) {
            $dados = $sql->fetch(PDO::FETCH_OBJ);
		    return $dados;
        } else {
            return false;
        }

    }

    public function RlColaboradorTotalAtivoNao($ativoNao,$situacao) {

		$sql = $this->db->prepare("SELECT COUNT(*) total FROM colaborador col
                                    INNER JOIN usuario usa ON  usa.id = col.id_usuario
                                        WHERE col.ativo = ? AND usa.ativo = ? AND col.situacao = ? AND usa.situacao = ? ");
        $sql->bindParam(1, $ativoNao);
        $sql->bindParam(2, $ativoNao);
        $sql->bindParam(3, $situacao);
        $sql->bindParam(4, $situacao);
        $sql->execute();
        
		if($sql->rowCount() > 0) {
            $dados = $sql->fetch(PDO::FETCH_OBJ);
		    return $dados;
        } else {
            return false;
        }

    }

    
    public function RlProducaoIndividual ($id,$dataInicio,$dataFinal,$situacao) {

		$sql = $this->db->prepare("SELECT id, dataAbertura, horaAbertura, dataFechamento, horaFechamento FROM servico WHERE  id_col = ?  AND dataAbertura >= ? AND dataFechamento <= ? AND situacao = ? ORDER BY id ");
        $sql->bindParam(1, $id);
        $sql->bindParam(2, $dataInicio);
        $sql->bindParam(3, $dataFinal);
        $sql->bindParam(4, $situacao);
        $sql->execute();
        
		if($sql->rowCount() > 0) {
            $dados = $sql->fetchAll();
		    return $dados;
        } else {
            return false;
        }

    }

    public function RlListProducaoIndividual($id,$dataInicio,$dataFinal,$situacao) {

		$sql = $this->db->prepare("SELECT servico.id, date_format(servico.dataAbertura,'%d/%m/%Y') dataAbertura, servico.horaAbertura, date_format(servico.dataFechamento,'%d/%m/%Y') dataFechamento, servico.horaFechamento, os.numero_os, vl.modelo, vl.placa, proc.descricao proc_descricao, comp.descricao comp_descricao, item.descricao item_descricao FROM servico servico
                                    INNER JOIN aux_os_servico aux ON  aux.id_servico = servico.id 
                                        INNER JOIN ordem_de_servico os ON  os.id = aux.id_ordem_de_servico 
                                            INNER JOIN veiculo vl ON os.id_veiculo = vl.id
                                                INNER JOIN procedimento proc ON servico.id_proc = proc.id
                                                    INNER JOIN item item ON servico.id_item = item.id
                                                        INNER JOIN componente comp ON item.id_comp = comp.id
                                                            WHERE  servico.id_col = ?  AND servico.dataAbertura >= ? AND servico.dataFechamento <= ? AND servico.situacao = ? ORDER BY servico.id");
        $sql->bindParam(1, $id);
        $sql->bindParam(2, $dataInicio);
        $sql->bindParam(3, $dataFinal);
        $sql->bindParam(4, $situacao);
        $sql->execute();
        
		if($sql->rowCount() > 0) {
            $dados = $sql->fetchAll();
		    return $dados;
        } else {
            return false;
        }

    }

    public function RlColProducao ($id,$situacao) {

		$sql = $this->db->prepare("SELECT * FROM colaborador col 
                                     INNER JOIN usuario usa ON  usa.id = col.id_usuario
                                        WHERE  col.id = ?  AND col.situacao = ? ");
        $sql->bindParam(1, $id);
        $sql->bindParam(2, $situacao);
        $sql->execute();
        
		if($sql->rowCount() > 0) {
            $dados = $sql->fetch(PDO::FETCH_OBJ);
		    return $dados;
        } else {
            return false;
        }

    }

    public function RlProducaoGeral($id,$dataInicio,$dataFinal,$situacao) {

		$sql = $this->db->prepare("SELECT servico.id, date_format(servico.dataAbertura,'%d/%m/%Y') dataAbertura, servico.horaAbertura, date_format(servico.dataFechamento,'%d/%m/%Y') dataFechamento, servico.horaFechamento, os.numero_os, vl.modelo, vl.placa, col.nome, usua.matricula, col.id id_col FROM servico servico
                                    INNER JOIN aux_os_servico aux ON  aux.id_servico = servico.id 
                                        INNER JOIN ordem_de_servico os ON  os.id = aux.id_ordem_de_servico 
                                            INNER JOIN veiculo vl ON os.id_veiculo = vl.id
                                                INNER JOIN colaborador col ON servico.id_col = col.id
                                                    INNER JOIN usuario usua ON col.id_usuario = usua.id
                                    WHERE servico.id_col = ? AND servico.dataAbertura >= ? AND servico.dataFechamento <= ? AND servico.situacao = ? ORDER BY servico.id");
        $sql->bindParam(1, $id);
        $sql->bindParam(2, $dataInicio);
        $sql->bindParam(3, $dataFinal);
        $sql->bindParam(4, $situacao);
        $sql->execute();
        
        
		if($sql->rowCount() > 0) {
            $dados = $sql->fetchAll();
		    return $dados;
        } else {
            return false;
        }

    }

    public function RlProducaoGeralCol ($cargo,$situacao,$ativo) {

		$sql = $this->db->prepare("SELECT col.id id_col, col.nome, usua.matricula, usua.id usua_id FROM colaborador col 
                                    INNER JOIN usuario usua ON usua.id = col.id
                                        WHERE  usua.cargo = ? AND col.ativo = ? AND col.situacao = ?");
        $sql->bindParam(1, $cargo);
        $sql->bindParam(2, $ativo);
        $sql->bindParam(3, $situacao);
        $sql->execute();
        
		if($sql->rowCount() > 0) {
            $dados = $sql->fetchAll();
		    return $dados;
        } else {
            return false;
        }

    }

	
	
}