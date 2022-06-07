CREATE TABLE `tabuleiro`(
	`idTabuleiro` INT NOT NULL AUTO_INCREMENT,
	`LadoTabuleiro` INT NOT NULL,
	PRIMARY KEY(`idTabuleiro`))
ENGINE = InnoDB;

CREATE TABLE `usuario`(
	`idUsuario` INT NOT NULL AUTO_INCREMENT,
	`nome` varchar(45) NOT NULL,
    `login` varchar(45) NOT NULL,
    `senha` varchar(45) NOT NULL,
	PRIMARY KEY(`idUsuario`))
ENGINE = InnoDB;


CREATE TABLE `quadrado`(
	`idQuadrado` INT NOT NULL AUTO_INCREMENT,
	`lado` decimal(16,1) NOT NULL,
    `cor` varchar(100) NOT NULL,
    `tabuleiro_idTabuleiro` INT NOT NULL,
	PRIMARY KEY(`idQuadrado`),
		CONSTRAINT `tabuleiro_idTabuleiro`
        FOREIGN KEY (`tabuleiro_idTabuleiro`)
        REFERENCES `recparalela`.`tabuleiro` (`idTabuleiro`)
        ON DELETE CASCADE 
        ON UPDATE CASCADE
)ENGINE = InnoDB;


