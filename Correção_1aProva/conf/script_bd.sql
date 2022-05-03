-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema prova
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema prova
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `prova` DEFAULT CHARACTER SET utf8 ;
USE `prova` ;

-- -----------------------------------------------------
-- Table `prova`.`pessoa_fisica`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `prova`.`pessoa_fisica` (
  `pf_id` INT NOT NULL AUTO_INCREMENT,
  `pf_cpf` VARCHAR(45) NULL,
  `pf_nome` VARCHAR(250) NULL,
  `pf_dt_nascimento` VARCHAR(45) NULL,
  PRIMARY KEY (`pf_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prova`.`conta_corrente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `prova`.`conta_corrente` (
  `cc_numero` INT NOT NULL AUTO_INCREMENT,
  `cc_saldo` DECIMAL(16,3) NULL,
  `cc_pf_id` INT NOT NULL,
  `cc_dt_ultima_alteracao` DATE NULL,
  PRIMARY KEY (`cc_numero`),
  CONSTRAINT `fk_conta_corrente_pessoa_fisica`
    FOREIGN KEY (`cc_pf_id`)
    REFERENCES `prova`.`pessoa_fisica` (`pf_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `prova`.`contatos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `prova`.`contatos` (
  `cont_id` INT NOT NULL AUTO_INCREMENT,
  `cont_tipo` VARCHAR(45) NULL,
  `cont_descricao` VARCHAR(250) NULL,
  `cont_pf_id` INT NOT NULL,
  PRIMARY KEY (`cont_id`),
  CONSTRAINT `fk_contatos_pessoa_fisica1`
    FOREIGN KEY (`cont_pf_id`)
    REFERENCES `prova`.`pessoa_fisica` (`pf_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

INSERT INTO `prova`.`pessoa_fisica` (`pf_cpf`, `pf_nome`, `pf_dt_nascimento`) VALUES ('08097668903', 'Rodrigo', '2005-06-30');
INSERT INTO `prova`.`pessoa_fisica` (`pf_cpf`, `pf_nome`, `pf_dt_nascimento`) VALUES ('23443562523', 'Marcos', '2004-04-28');
INSERT INTO `prova`.`pessoa_fisica` (`pf_cpf`, `pf_nome`, `pf_dt_nascimento`) VALUES ('23423424899', 'Guilherme', '2003-03-10');
INSERT INTO `prova`.`pessoa_fisica` (`pf_cpf`, `pf_nome`, `pf_dt_nascimento`) VALUES ('78746369567', 'Henrique', '2002-08-20');
INSERT INTO `prova`.`pessoa_fisica` (`pf_cpf`, `pf_nome`, `pf_dt_nascimento`) VALUES ('70904345667', 'Julio', '2001-07-16');

INSERT INTO `prova`.`conta_corrente` (`cc_saldo`, `cc_pf_id`, `cc_dt_ultima_alteracao`) VALUES ('290', '1', '2022-04-01');
INSERT INTO `prova`.`conta_corrente` (`cc_saldo`, `cc_pf_id`, `cc_dt_ultima_alteracao`) VALUES ('300', '2', '2022-03-01');
INSERT INTO `prova`.`conta_corrente` (`cc_saldo`, `cc_pf_id`, `cc_dt_ultima_alteracao`) VALUES ('400', '3', '2022-03-25');
INSERT INTO `prova`.`conta_corrente` (`cc_saldo`, `cc_pf_id`, `cc_dt_ultima_alteracao`) VALUES ('500', '4', '2022-03-11');
INSERT INTO `prova`.`conta_corrente` (`cc_saldo`, `cc_pf_id`, `cc_dt_ultima_alteracao`) VALUES ('1000', '5', '2022-03-18');

INSERT INTO `prova`.`contatos` (`cont_tipo`, `cont_descricao`, `cont_pf_id`) VALUES ('A', 'Conta do tipo A', '1');
INSERT INTO `prova`.`contatos` (`cont_tipo`, `cont_descricao`, `cont_pf_id`) VALUES ('B', 'Conta do tipo B', '2');
INSERT INTO `prova`.`contatos` (`cont_tipo`, `cont_descricao`, `cont_pf_id`) VALUES ('A', 'Conta do tipo A', '3');
INSERT INTO `prova`.`contatos` (`cont_tipo`, `cont_descricao`, `cont_pf_id`) VALUES ('C', 'Conta do tipo C', '4');
INSERT INTO `prova`.`contatos` (`cont_tipo`, `cont_descricao`, `cont_pf_id`) VALUES ('B', 'Conta do tipo B', '5');
