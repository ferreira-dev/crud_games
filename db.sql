-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema crudgames
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema crudgames
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `crudgames` DEFAULT CHARACTER SET utf8 ;
USE `crudgames` ;

-- -----------------------------------------------------
-- Table `crudgames`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `crudgames`.`user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `login` VARCHAR(20) NOT NULL,
  `password` VARCHAR(8) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `crudgames`.`jogo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `crudgames`.`jogo` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(60) NOT NULL,
  `ano_pub` VARCHAR(45) NOT NULL,
  `estilo` VARCHAR(20) NOT NULL,
  `desenv_distrib` VARCHAR(45) NOT NULL,
  `nota` FLOAT NOT NULL,
  `id_usuario` INT NOT NULL,
  PRIMARY KEY (`id`, `id_usuario`),
  INDEX `fk_jogo_usuario_idx` (`id_usuario` ASC) VISIBLE,
  CONSTRAINT `fk_jogo_usuario`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `crudgames`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;