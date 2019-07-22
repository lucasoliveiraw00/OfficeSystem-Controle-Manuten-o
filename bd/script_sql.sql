CREATE SCHEMA IF NOT EXISTS OFFICE DEFAULT CHARACTER SET utf8 ;
USE office ;

-- -----------------------------------------------------
-- Table Cliente
-- -----------------------------------------------------
CREATE TABLE cliente (
    id INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(150) NOT NULL,
    cpfcnpj VARCHAR(20) NOT NULL,
    dataNasc DATE NOT NULL,
    email VARCHAR(150) NOT NULL,
    telefone VARCHAR(23) NULL,
    celular VARCHAR(23) NOT NULL,
    cep VARCHAR(15) NOT NULL,
	cidade VARCHAR(150) NOT NULL,
    uf VARCHAR(10) NULL,
    bairro VARCHAR(150) NOT NULL,
    rua VARCHAR(150) NOT NULL,
    numEnd VARCHAR(150)  NOT NULL,
    situacao ENUM('Ativo', 'Inativo') ,
    PRIMARY KEY (id)

);

-- -----------------------------------------------------
-- Table Veiculo
-- -----------------------------------------------------
CREATE TABLE veiculo (
    id INT NOT NULL AUTO_INCREMENT,
    id_cliente INT NOT NULL,
    placa VARCHAR(20) NOT NULL,
    marca varchar(150)  NOT NULL,
    modelo VARCHAR(150)  NOT NULL,
    cor VARCHAR(100)  NOT NULL,
    ano VARCHAR(10)  NOT NULL,
   situacao ENUM('Ativo', 'Inativo')  NOT NULL ,
    PRIMARY KEY (id),
    FOREIGN KEY (id_cliente)
        REFERENCES cliente (id)
        ON DELETE NO ACTION ON UPDATE NO ACTION
);

-- -----------------------------------------------------
-- Table Usuario
-- -----------------------------------------------------
CREATE TABLE usuario (
    id INT NOT NULL AUTO_INCREMENT,
    matricula INT NOT NULL,
    senha VARCHAR (200) NOT NULL,
    email VARCHAR (150) NOT NULL,
    cargo VARCHAR (150) NOT NULL,
    ativo ENUM('Sim', 'Não') NOT NULL,
	situacao ENUM('Ativo', 'Inativo') NOT NULL,
    PRIMARY KEY (id)
);

-- -----------------------------------------------------
-- Table Colaborador
-- -----------------------------------------------------
CREATE TABLE colaborador (
    id INT NOT NULL AUTO_INCREMENT,
    id_usuario INT  NOT NULL,
    nome VARCHAR(150) NOT NULL,
	telefone VARCHAR(23),
    celular VARCHAR(23) NOT NULL,
    ativo ENUM('Sim', 'Não') NOT NULL,
    situacao ENUM('Ativo', 'Inativo') NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (id_usuario)
		REFERENCES usuario (id)
         ON DELETE NO ACTION ON UPDATE NO ACTION
);

-- -----------------------------------------------------
-- Table Solicitacao
-- -----------------------------------------------------
CREATE TABLE solicitacao (
    id INT NOT NULL AUTO_INCREMENT,
    id_usuario int NOT NULL,
    token VARCHAR(300) NOT NULL,
    PRIMARY KEY (id),
     FOREIGN KEY (id_usuario)
		REFERENCES usuario (id)
         ON DELETE NO ACTION ON UPDATE NO ACTION
);

-- -----------------------------------------------------
-- Table Ordem de Servico
-- -----------------------------------------------------
CREATE TABLE ordem_de_servico (
    id INT NOT NULL AUTO_INCREMENT,
    id_veiculo INT NOT NULL,
    id_colaborador INT NOT NULL,
    numero_os INT NOT NULL,
    dataAbertura DATE NOT NULL,
    horaAbertura TIME NOT NULL,
    dataFechamento DATE NULL,
    horaFechamento TIME NULL,
    prazo DATETIME NOT NULL,
    descricao TEXT NOT NULL,
    status ENUM('Aberto', 'Fechado') NOT NULL,
    status_prazo ENUM('Normal','ProximoVen','Vencido') NOT NULL,
    situacao ENUM('Ativo', 'Inativo') NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (id_veiculo)
        REFERENCES veiculo (id)
        ON DELETE NO ACTION ON UPDATE NO ACTION,
    FOREIGN KEY (id_colaborador)
        REFERENCES colaborador (id)
        ON DELETE NO ACTION ON UPDATE NO ACTION
);

-- -----------------------------------------------------
-- Table Procedimento
-- -----------------------------------------------------
CREATE TABLE procedimento (
    id INT NOT NULL AUTO_INCREMENT,
    codigo INT NOT NULL,
    descricao TEXT NOT NULL,
	situacao ENUM('Ativo', 'Inativo') NOT NULL,
    PRIMARY KEY (id)
);

-- -----------------------------------------------------
-- Table componente
-- -----------------------------------------------------
CREATE TABLE componente (
    id INT NOT NULL AUTO_INCREMENT,
    codigo INT NOT NULL,
    descricao TEXT NOT NULL,
    situacao ENUM('Ativo', 'Inativo') NOT NULL,
    PRIMARY KEY (id)
);

-- -----------------------------------------------------
-- Table Item
-- -----------------------------------------------------
CREATE TABLE item (
    id INT NOT NULL AUTO_INCREMENT,
    id_comp INT NOT NULL,
    codigo INT NOT NULL,
    descricao TEXT NOT NULL,
	situacao ENUM('Ativo', 'Inativo') NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (id_comp)
        REFERENCES componente (id)
        ON DELETE NO ACTION ON UPDATE NO ACTION
);

-- -----------------------------------------------------
-- Table Servico
-- -----------------------------------------------------
CREATE TABLE servico (
    id INT NOT NULL AUTO_INCREMENT,
    id_col INT NOT NULL,
    id_proc INT NOT NULL,
    id_item INT NOT NULL,
	dataAbertura DATE,
    horaAbertura TIME,
    dataFechamento DATE,
    horaFechamento TIME,
    status ENUM('Aberto', 'Fechado'), 
    situacao ENUM('Ativo', 'Inativo') NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (id_col)
        REFERENCES colaborador (id)
        ON DELETE NO ACTION ON UPDATE NO ACTION,
    FOREIGN KEY (id_proc)
        REFERENCES procedimento (id)
        ON DELETE NO ACTION ON UPDATE NO ACTION,
    FOREIGN KEY (id_item)
        REFERENCES item (id)
        ON DELETE NO ACTION ON UPDATE NO ACTION
);

-- -----------------------------------------------------
-- Table os_src
-- -----------------------------------------------------
CREATE TABLE aux_os_servico (
    id INT NOT NULL auto_increment,
    id_ordem_de_servico INT NOT NULL,
    id_servico INT NOT NULL,
    situacao ENUM('Ativo', 'Inativo') NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (id_ordem_de_servico)
        REFERENCES ordem_de_servico (id)
        ON DELETE NO ACTION ON UPDATE NO ACTION,
    FOREIGN KEY (id_servico)
        REFERENCES servico (id)
        ON DELETE NO ACTION ON UPDATE NO ACTION
);
    