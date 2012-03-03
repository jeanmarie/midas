SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `midas` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `midas` ;

-- -----------------------------------------------------
-- Table `midas`.`caisse`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `midas`.`caisse` (
  `idcaisse` INT NOT NULL ,
  `date_caisse` DATE NULL ,
  `agent` VARCHAR(45) NULL ,
  `caisse_debut` FLOAT NULL ,
  `caisse_fin` FLOAT NULL ,
  PRIMARY KEY (`idcaisse`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `midas`.`reglement`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `midas`.`reglement` (
  `idreglement` INT NOT NULL ,
  `date_cheque` DATE NULL ,
  `nom` VARCHAR(45) NULL ,
  `montant` FLOAT NULL ,
  `type_paiement` INT NULL ,
  `numero chaque` VARCHAR(45) NULL ,
  `id_agent` INT NULL ,
  PRIMARY KEY (`idreglement`) )
ENGINE = InnoDB
COMMENT = 'table contenant les chèques et autres modes de paiement avec' /* comment truncated */;


-- -----------------------------------------------------
-- Table `midas`.`type_reglement`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `midas`.`type_reglement` (
  `idtype_reglement` INT NOT NULL ,
  `libelle_reglement` VARCHAR(45) NULL ,
  PRIMARY KEY (`idtype_reglement`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `midas`.`agents`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `midas`.`agents` (
  `idagent` INT NOT NULL ,
  `initiale` VARCHAR(45) NULL ,
  `nom_agent` VARCHAR(45) NULL ,
  PRIMARY KEY (`idagent`) )
ENGINE = InnoDB
COMMENT = 'nom et ID des agents utilsant l\'application\n';


-- -----------------------------------------------------
-- Table `midas`.`spectacle`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `midas`.`spectacle` (
  `idspectacle` INT NOT NULL ,
  `date_spectacle` DATETIME NULL ,
  `libelle_spectacle` VARCHAR(45) NULL ,
  `code_spectacle` VARCHAR(45) NULL ,
  `spectaclecol` VARCHAR(45) NULL ,
  `tarif_T1` FLOAT NULL ,
  `tarif_T2` FLOAT NULL ,
  `tarif_T3` FLOAT NULL COMMENT '\n' ,
  `tarif_T4` FLOAT NULL ,
  `tarif_T5` FLOAT NULL ,
  `tarif_T6` FLOAT NULL ,
  `tarif_T7` FLOAT NULL ,
  `tarif_T8` FLOAT NULL ,
  `tarif_T9` FLOAT NULL ,
  `tarif_T10` FLOAT NULL ,
  PRIMARY KEY (`idspectacle`) )
ENGINE = InnoDB
COMMENT = 'liste des spectacles avec les code et tarifs';



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
