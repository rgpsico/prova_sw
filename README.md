# prova_sw



  CREATE TABLE contato(
    id int PRIMARY KEY AUTO_INCREMENT,
    nome varchar(255),
    sobrenome varchar(255),
    data_nascimento DATE,
    telefone varchar(255),
    celular varchar(255),
    email VARCHAR(155)  
    
);


  CREATE TABLE empresa(
    id int PRIMARY KEY AUTO_INCREMENT,
    nome varchar(255),
    contato_id int, 
    FOREIGN KEY (contato_id) REFERENCES contato (id)
     ON DELETE CASCADE
);


crud simples usando PDO e PHP 
