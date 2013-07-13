/*
######### RG - Quality #########
Data 07/09/2012

- Script para criação das tabelas do Banco de dados e inserção de alguns dados default do sistema. -

*/


CREATE SCHEMA IF NOT EXISTS rg_quality DEFAULT CHARACTER SET utf8;

 USE rg_quality;



-- -----------------------------------------------------
-- Table rg_quality.Status
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS rg_quality.Status (
  
  statusID 		INT NOT NULL AUTO_INCREMENT ,
  statusNome	VARCHAR(45) NOT NULL ,
  statusCode  VARCHAR(45) NOT NULL ,
  
  PRIMARY KEY (statusID)


  )ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table rg_quality.Unidade
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS rg_quality.Unidade (
  
  unidadeID INT NOT NULL AUTO_INCREMENT ,
  unidadeNome VARCHAR(45) NOT NULL ,
  unidadeAtivo VARCHAR(3) NOT NULL,  
  PRIMARY KEY (unidadeID)

  )ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table rg_quality.Departamento
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS rg_quality.Departamento (
 
  departamentoID INT NOT NULL AUTO_INCREMENT ,
  departamentoNome VARCHAR(45) NOT NULL ,
  unidadeID INT NOT NULL ,
  departamentoAtivo VARCHAR(3) NOT NULL,
  
  PRIMARY KEY (departamentoID) ,
  FOREIGN KEY (unidadeID) REFERENCES rg_quality.Unidade(unidadeID)

  )ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table rg_quality.Tipo
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS rg_quality.Tipo (
  
  tipoID INT NOT NULL AUTO_INCREMENT ,
  tipoNome VARCHAR(45) NOT NULL ,
  
  PRIMARY KEY (tipoID)

  )ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table rg_quality.Cargo
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS rg_quality.Cargo (
  
  cargoID INT NOT NULL AUTO_INCREMENT ,
  cargoNome VARCHAR(45) NOT NULL ,
  cargoAtivo VARCHAR(3) NOT NULL, 	
  
  PRIMARY KEY (cargoID)

  )ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table rg_quality.Usuario
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS rg_quality.Usuario (
  
  usuarioID INT NOT NULL AUTO_INCREMENT ,
  usuarioNome VARCHAR(45) NOT NULL ,
  usuarioMatricula INT NOT NULL ,
  usuarioLogin VARCHAR(10) NOT NULL ,
  usuarioPassword VARCHAR(10) NOT NULL ,
  usuarioEmail VARCHAR(45) NOT NULL ,
  cargoID INT NOT NULL ,
  departamentoID INT NOT NULL ,
  tipoID INT NOT NULL ,
  usuarioAtivo VARCHAR(3) NOT NULL,
  
  PRIMARY KEY (usuarioID) ,

  FOREIGN KEY (cargoID) REFERENCES rg_quality.Cargo (cargoID) ,
  FOREIGN KEY (departamentoID) REFERENCES rg_quality.Departamento (departamentoID) ,
  FOREIGN KEY (tipoID) REFERENCES rg_quality.Tipo (tipoID)

  )ENGINE = InnoDB;



-- -----------------------------------------------------
-- Table rg_quality.Mensagem
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS rg_quality.Mensagem (
  
  mensagemID    INT NOT NULL AUTO_INCREMENT ,
  remetenteID   INT NOT NULL ,
  destinatarioID  INT NOT NULL ,
  mensagemAssunto VARCHAR(35) NOT NULL ,
  mensagemBody	TEXT NOT NULL ,
  mensagemData 	TIMESTAMP NOT NULL ,
  
  PRIMARY KEY (mensagemID) ,

  FOREIGN KEY (remetenteID) REFERENCES rg_quality.Usuario (usuarioID) ,
  FOREIGN KEY (destinatarioID) REFERENCES rg_quality.Usuario (usuarioID)

  )ENGINE = InnoDB;



-- -----------------------------------------------------
-- Table rg_quality.Artefato
-- -----------------------------------------------------
	CREATE TABLE IF NOT EXISTS rg_quality.Artefato (
  
  artefatoID INT NOT NULL AUTO_INCREMENT ,
  artefatoNome VARCHAR(45) NOT NULL ,
  artefatoDescricao TEXT NOT NULL ,
  artefatoAtivo VARCHAR(3) NOT NULL,
  
  PRIMARY KEY (artefatoID)

  
  )ENGINE = InnoDB;



-- -----------------------------------------------------
-- Table rg_quality.Perguntas
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS rg_quality.Perguntas (
  
  perguntasID INT NOT NULL AUTO_INCREMENT ,
  artefatoID INT NOT NULL ,
  artefatoPergunta VARCHAR(45) NOT NULL ,
  perguntaAtivo VARCHAR(3) NOT NULL,
  
  PRIMARY KEY (perguntasID) ,
  
  FOREIGN KEY (artefatoID) REFERENCES rg_quality.Artefato (artefatoID)
  
  )ENGINE = InnoDB;



-- -----------------------------------------------------
-- Table rg_quality.Projeto
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS rg_quality.Projeto (
  
  projetoID INT NOT NULL AUTO_INCREMENT ,
  projetoNome VARCHAR(45) NOT NULL ,
  departamentoID INT NOT NULL ,
  projetoAtivo VARCHAR(3) NOT NULL,
  
  PRIMARY KEY (projetoID) ,
  
  FOREIGN KEY (departamentoID) REFERENCES rg_quality.Departamento (departamentoID)
  
  )ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table rg_quality.Auditoria
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS rg_quality.Auditoria (
  
  auditoriaID INT NOT NULL AUTO_INCREMENT ,
  auditorID INT NOT NULL ,
  acompanhanteID INT,
  projetoID INT NOT NULL ,
  auditoriaDataInicio DATE NOT NULL ,
  auditoriaDataFinal DATE NULL ,
  statusID INT NOT NULL ,	
  
  PRIMARY KEY (auditoriaID) ,
  
  FOREIGN KEY (projetoID) REFERENCES rg_quality.Projeto (projetoID) ,
  FOREIGN KEY (statusID) REFERENCES rg_quality.Status (statusID) ,
  FOREIGN KEY (auditorID) REFERENCES rg_quality.Usuario (usuarioID),
  FOREIGN KEY (acompanhanteID) REFERENCES rg_quality.Usuario (usuarioID)

  )ENGINE = InnoDB;



-- -----------------------------------------------------
-- Table rg_quality.NC
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS rg_quality.NC (
  
  ncID INT NOT NULL AUTO_INCREMENT ,
  ncDescricao VARCHAR(45) NOT NULL ,
  ncDataFinalprev DATE NOT NULL ,
  ncDataFinal DATE NULL ,
  ncComentario TEXT NOT NULL,

  auditoriaID INT NOT NULL ,
  statusID INT NOT NULL ,
  artefatoID INT NOT NULL ,
  ncResponsavel INT NOT NULL ,  

  PRIMARY KEY (ncID),

  FOREIGN KEY (statusID) REFERENCES rg_quality.Status (statusID) ,
  FOREIGN KEY (artefatoID) REFERENCES rg_quality.Artefato (artefatoID) ,
  FOREIGN KEY (auditoriaID) REFERENCES rg_quality.Auditoria (auditoriaID),
  FOREIGN KEY (ncResponsavel) REFERENCES rg_quality.Usuario (usuarioID)


  )ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table rg_quality.AC
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS rg_quality.AC (
 
  acID INT NOT NULL AUTO_INCREMENT ,
  acDescricao TEXT NOT NULL ,
  acDataFinal DATE NULL ,
  acAcao VARCHAR(45) NOT NULL,
  statusID INT NOT NULL ,
  ncID INT NOT NULL ,   
  
  PRIMARY KEY (acID) ,

  FOREIGN KEY (ncID) REFERENCES rg_quality.NC (ncID) ,
  FOREIGN KEY (statusID) REFERENCES rg_quality.Status (statusID)
  
  )ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table rg_quality.Projeto_Artefato
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS rg_quality.Projeto_Artefato (
  
  projetoID INT NOT NULL ,
  artefatoID INT NOT NULL ,
  statusID INT NOT NULL ,
  perguntasID INT NOT NULL ,
  
  PRIMARY KEY (projetoID, artefatoID,statusID, perguntasID) ,
  
  FOREIGN KEY (projetoID) REFERENCES rg_quality.Projeto (projetoID) ,
  FOREIGN KEY (artefatoID) REFERENCES rg_quality.Artefato (artefatoID),
  FOREIGN KEY (perguntasID) REFERENCES rg_quality.Perguntas (perguntasID),
  FOREIGN KEY (statusID) REFERENCES rg_quality.Status (statusID)

  )ENGINE = InnoDB;


/*
##### Abaixo script adicional para fazer a inserção dos dados default no sistema #####
*/



-- Inserindo Status --
INSERT INTO rg_quality.Status VALUES (null, 'Agendada'      , 'info');
INSERT INTO rg_quality.Status VALUES (null, 'Realizada'     , 'success');
INSERT INTO rg_quality.Status VALUES (null, 'Andamento'     , 'warning');
INSERT INTO rg_quality.Status VALUES (null, 'Não Aplicável' , 'info');
INSERT INTO rg_quality.Status VALUES (null, 'Conforme'      , 'success');
INSERT INTO rg_quality.Status VALUES (null, 'Não Conforme'  , 'important');
INSERT INTO rg_quality.Status VALUES (null, 'Aberta'        , 'important');
INSERT INTO rg_quality.Status VALUES (null, 'Fechada'       , 'success');
INSERT INTO rg_quality.Status VALUES (null, 'Executada'     , 'warning');
INSERT INTO rg_quality.Status VALUES (null, 'Retornada'     , 'important');


-- Inserindo Unidades de negocio --
INSERT INTO rg_quality.Unidade VALUES (null, 'ISOL', 'SIM');
INSERT INTO rg_quality.Unidade VALUES (null, 'INET', 'SIM');
INSERT INTO rg_quality.Unidade VALUES (null, 'ISEC', 'SIM');
INSERT INTO rg_quality.Unidade VALUES (null, 'QUALIDADE', 'SIM');


-- Inserindo departamentos --
INSERT INTO rg_quality.Departamento VALUES (null, 'SIP e Rede', 1, 'SIM');
INSERT INTO rg_quality.Departamento VALUES (null, 'UC', 1, 'SIM');
INSERT INTO rg_quality.Departamento VALUES (null, 'Grandes Sistemas', 1, 'SIM');
INSERT INTO rg_quality.Departamento VALUES (null, 'BroadBand', 2, 'SIM');
INSERT INTO rg_quality.Departamento VALUES (null, 'Cameras IP', 3, 'SIM');
INSERT INTO rg_quality.Departamento VALUES (null, 'SGQ', 4, 'SIM' );


-- Inserindo tipos de usuario --
INSERT INTO rg_quality.Tipo VALUES (null, 'Admin');
INSERT INTO rg_quality.Tipo VALUES (null, 'Auditor');
INSERT INTO rg_quality.Tipo VALUES (null, 'Supervisor');
INSERT INTO rg_quality.Tipo VALUES (null, 'Usuario');


-- Inserindo Cargo --
INSERT INTO rg_quality.Cargo VALUES (null, 'Técnico', 'SIM');
INSERT INTO rg_quality.Cargo VALUES (null, 'Analista', 'SIM');
INSERT INTO rg_quality.Cargo VALUES (null, 'Engenheiro', 'SIM');
INSERT INTO rg_quality.Cargo VALUES (null, 'Coordenador de Projetos', 'SIM');
INSERT INTO rg_quality.Cargo VALUES (null, 'Supervisor', 'SIM');
INSERT INTO rg_quality.Cargo VALUES (null, 'Especialista', 'SIM');

-- Inserindo Usuario --
--									  (ID, 		Nome,			 Matricula, Login, Password, Email, cargoID, departamentoID, tipoID, ativo) --
INSERT INTO rg_quality.Usuario VALUES (null, 'Administrador'	  ,000001, 'admin','admin','admin@localhost.com'		   , 2, 1, 1, 'SIM');

INSERT INTO rg_quality.Usuario VALUES (null, 'Reg_user'   ,111111, 're111111','re111111','reginaldo.goncalves.sc@gmail.com', 6, 1, 4, 'SIM');
INSERT INTO rg_quality.Usuario VALUES (null, 'Reg_audt'   ,222222, 're222222','re222222','reginaldo.goncalves.sc@gmail.com', 2, 6, 2, 'SIM');
INSERT INTO rg_quality.Usuario VALUES (null, 'Reg_supr'   ,333333, 're333333','re333333','reginaldo.goncalves.sc@gmail.com', 5, 1, 3, 'SIM');

INSERT INTO rg_quality.Usuario VALUES (null, 'Jai_user'   ,111111, 'ja111111','ja111111','jairojair@gmail.com', 6, 4, 4, 'SIM');
INSERT INTO rg_quality.Usuario VALUES (null, 'Jai_audt'   ,222222, 'ja222222','ja222222','jairojair@gmail.com', 2, 6, 2, 'SIM');
INSERT INTO rg_quality.Usuario VALUES (null, 'Jai_supr'   ,333333, 'ja333333','ja333333','jairojair@gmail.com', 5, 4, 3, 'SIM');


-- Inserindo Projeto --
INSERT INTO rg_quality.Projeto VALUES (null, 'Gateway Cisco', 1, 'SIM');
INSERT INTO rg_quality.Projeto VALUES (null, 'Modem ADSL', 4, 'SIM');
INSERT INTO rg_quality.Projeto VALUES (null, 'Nave Espacial', 1, 'SIM');
INSERT INTO rg_quality.Projeto VALUES (null, 'Submarino', 4, 'SIM');


-- Inserindo Artefatos --
INSERT INTO rg_quality.Artefato VALUES (null, 'ATA-Reunião', 'ATA da Reunião de abertura do projeto', 'SIM');
INSERT INTO rg_quality.Artefato VALUES (null, 'Cronograma', 'Cronograma Macro das Atividades do Projeto', 'SIM');
INSERT INTO rg_quality.Artefato VALUES (null, 'Requisitos de mercado', 'Documento Detalhado dos Requisitos de mercado', 'SIM');
INSERT INTO rg_quality.Artefato VALUES (null, 'Book-1', 'Book com todas as informações do projeto', 'SIM');
INSERT INTO rg_quality.Artefato VALUES (null, 'Requisitos de SW', 'Documento Detalhado dos Requisitos de SW', 'SIM');
INSERT INTO rg_quality.Artefato VALUES (null, 'Casos de Teste', 'Documento Detalhado com os casos de teste', 'SIM');

