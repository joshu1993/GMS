-- MySQL Script generated by MySQL Workbench
-- 11/08/16 20:17:08
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema gimnasio
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema gimnasio
-- -----------------------------------------------------
DROP DATABASE if exists `gymGMS`;
CREATE DATABASE IF NOT EXISTS `gymGMS` DEFAULT CHARACTER SET utf8 ;
USE `gymGMS` ;


-- -----------------------------------------------------
-- Table `gimnasio`.`Usuario` 
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gymGMS`.`Usuario` (
  `nombreusuario` VARCHAR(45) NOT NULL,
  `contraseña` VARCHAR(45) NULL,
  `correo` VARCHAR(45) NULL,
  `tipousuario` VARCHAR(15) NULL,
  PRIMARY KEY (`nombreusuario`))
ENGINE = InnoDB;

INSERT INTO `Usuario` (`nombreusuario`, `contraseña`, `correo`, `tipousuario`) VALUES
( 'domingo', 'domingo1', 'domingo@gmail.com', 'admin'),
( 'javier', 'javier1', 'javier@gmail.com', 'admin'),
( 'joshua', 'joshua1', 'joshua@gmail.com', 'admin'),
( 'jose', 'jose1', 'jose@gmail.com', 'admin');


-- -----------------------------------------------------
-- Table `gimnasio`.`Sesion` 
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gymGMS`.`Sesion` (
  `idsesion` INT NOT NULL AUTO_INCREMENT,
  `fechasesion` DATE NULL,
  `duracionsesion` INT NULL,
  `comentario` VARCHAR(255) NULL,
  `Usuario_nombreusuario`  VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idsesion`, `Usuario_nombreusuario`),
  INDEX `fk_Sesion_Usuariox_nombreusuariox` (`Usuario_nombreusuario` ASC),
  CONSTRAINT `fk_Sesion_Usuariox`
    FOREIGN KEY (`Usuario_nombreusuario`)
    REFERENCES `gymGMS`.`Usuario` (`nombreusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gimnasio`.`Actividad`  
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gymGMS`.`Actividad` (
  `idactividad` INT NOT NULL AUTO_INCREMENT,
  `nombreactividad` VARCHAR(45) NULL,
  `descripcionactividad` VARCHAR(45) NULL,
  `horario` DATETIME NOT NULL,
  `capacidad` INT NULL,
  `tipoActividad` VARCHAR(45) NOT NULL,
   PRIMARY KEY (`idactividad`))
 
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `gimnasio`.`Reserva`  
-- -----------------------------------------------------


CREATE TABLE IF NOT EXISTS `gymGMS`.`Reserva` (
  `idReserva` INT NOT NULL AUTO_INCREMENT,
  `Usuario_nombreusuario` VARCHAR(10) NOT NULL,
  `Actividad_idactividad` INT NOT NULL,
  `fecha` DATE NOT NULL,
  `plazas_ocupadas` INT(2) NOT NULL,
  PRIMARY KEY (`idReserva`),
  INDEX `fk_Reserva_Actividad1_idx` (`Actividad_idactividad` ASC),
  INDEX `fk_Reserva_Usuario1_idx` (`Usuario_nombreusuario` ASC),
  CONSTRAINT `fk_Reserva_Actividad1`
    FOREIGN KEY (`Actividad_idactividad`)
    REFERENCES `gymGMS`.`Actividad` (`idactividad`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Reserva_Usuario1`
    FOREIGN KEY (`Usuario_nombreusuario`)
    REFERENCES `gymGMS`.`Usuario` (`nombreusuario`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gimnasio`.`TablaEjercicios` 
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gymGMS`.`TablaEjercicios` (
  `idtabla` INT NOT NULL AUTO_INCREMENT,
  `nombretabla` VARCHAR(45) NULL,
  PRIMARY KEY (`idtabla`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gimnasio`.`Ejercicio` 
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gymGMS`.`Ejercicio` (
  `idejercicio` INT NOT NULL AUTO_INCREMENT,
  `nombreejercicio` VARCHAR(45) NULL,
  `descripcionejercicio` VARCHAR(1000) NULL,
  `numerorepeticiones` INT NULL,
  `numeroseries` INT NULL,
  PRIMARY KEY (`idejercicio`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gimnasio`.`Notificacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gymGMS`.`Notificacion` (
  `idnotificacion` INT NOT NULL AUTO_INCREMENT,
  `nombrenotificacion` VARCHAR(45) NULL,
  `descripcionnotificacion` VARCHAR(255) NULL,
  `caducidad` INT NULL,
  `Usuario_nombreusuario`  VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idnotificacion`, Usuario_nombreusuario),
  INDEX `fk_Notificacion_Usuario1_nombreusuariox` (`Usuario_nombreusuario` ASC),
  CONSTRAINT `fk_Notificacion_Usuario1`
    FOREIGN KEY (`Usuario_nombreusuario`)
    REFERENCES `gymGMS`.`Usuario` (`nombreusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gimnasio`.`Ejercicio_has_TablaEjercicios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gymGMS`.`Ejercicio_pertenece_TablaEjercicios` (
  `Ejercicio_idejercicio` INT NOT NULL,
  `TablaEjercicios_idtabla` INT NOT NULL,

  PRIMARY KEY (`Ejercicio_idejercicio`, `TablaEjercicios_idtabla`),
  INDEX `fk_Ejercicio_pertenece_TablaEjercicios_TablaEjercicios1_idx` (`TablaEjercicios_idtabla` ASC),
  INDEX `fk_Ejercicio_pertenece_TablaEjercicios_Ejercicio1_idx` (`Ejercicio_idejercicio` ASC),
  CONSTRAINT `fk_Ejercicio_pertenece_TablaEjercicios_Ejercicio1`
    FOREIGN KEY (`Ejercicio_idejercicio`)
    REFERENCES `gymGMS`.`Ejercicio` (`idejercicio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Ejercicio_pertenece_TablaEjercicios_TablaEjercicios1`
    FOREIGN KEY (`TablaEjercicios_idtabla`)
    REFERENCES `gymGMS`.`TablaEjercicios` (`idtabla`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `gymGMS`.`Usuario_hace_TablaEjercicios` (
  `Usuario_nombreusuario`  VARCHAR(45) NOT NULL,
  `TablaEjercicios_idtabla` INT NOT NULL,

  PRIMARY KEY (`Usuario_nombreusuario`, `TablaEjercicios_idtabla`),
  INDEX `fk_Usuario_hace_TablaEjercicios_TablaEjerciciosx_idx` (`TablaEjercicios_idtabla` ASC),
  INDEX `fk_Usuario_hace_TablaEjercicios_Usuariox_nombreusuariox` (`Usuario_nombreusuario` ASC),
  CONSTRAINT `fk_Usuario_hace_TablaEjercicios_Usuariox`
    FOREIGN KEY (`Usuario_nombreusuario`)
    REFERENCES `gymGMS`.`Usuario` (`nombreusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Usuario_hace_TablaEjercicios_TablaEjerciciosx`
    FOREIGN KEY (`TablaEjercicios_idtabla`)
    REFERENCES `gymGMS`.`TablaEjercicios` (`idtabla`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;


INSERT INTO `ejercicio` (`nombreejercicio`, `descripcionejercicio`, `numerorepeticiones`, `numeroseries`) VALUES
( 'Press Inclinado con barra', 'Tumbados boca arriba sobre un banco que tenga una inclinación entre 10 y 40 grados, sujetad una barra sobre la parte superior del pecho, empleando un agarre equivalente al del press de banca con barra.

Se bajan luego los brazos hasta acercar el peso a la parte media alta del pectoral, y vuelven a estirarse hasta casi extenderlos por completo, para repetir después las veces necesarias.

Como en todo ejercicio de pectoral sobre un banco, los glúteos y la espalda nunca se despegarán del asiento.

MÚSCULOS IMPLICADOS: Pectoral mayor, con incidencia en las fibras superiores, deltoide anterior, serrato y tríceps.', '12', '3'),
( 'Fondos en paralelas con agarre abierto', 'Con las manos apoyadas sobre las paralelas, y manteniendo un agarre neutro, estiraremos el cuerpo para bajar luego hasta que los brazos queden paralelos al piso, sin dejar caer el cuerpo más ya que existe el riesgo de lesión por exceso de estiramiento.

Volveremos al punto de partida, apretando los pectorales, sin estirar del todo los brazos, para pasar a la próxima repetición.

MÚSCULOS IMPLICADOS: Pectoral mayor con incidencia en fibras inferiores. Deltoide anterior, serrato y tríceps.', '8', '3'),
( 'Press de banca con barra en banco plano', 'Para realizar el press de banca con barra en banco plano debes empezar tumbado boca arriba en un banco plano con una barra sobre el pecho, agarre de las manos más separadas que la anchura de los hombros, brazos en perpendicular al tronco. Se hace una extensión de los codos acompañada de una ligera elevación del hombro.

La apertura de las manos puede variar hacia afuera. Mantendremos la espalda apoyada al banco, y evitaremos todo movimiento lateral.

Músculos implicados: Pectoral mayor, fibras anteriores del Deltoides, Serrato mayor y Tríceps.', '5', '5'),
( 'Remo con barra', 'De pie, con el tronco casi en ángulo de 90 grados respecto al suelo, las rodillas ligeramente flexionadas y sujetando con agarre prono y manos separadas a la anchura de los hombros una barra apoyada en el piso.

Desde allí, se sube el peso hasta acercarlo a la cintura, echando codos y hombros hacia atrás para acercar las escápulas, a la vez que se eleva ligeramente el tronco, evitando los impulsos y el arqueo de la espalda.

Bajad controladamente y repetid las veces prescritas.

Músculos implicados: Dorsal, con incidencia en las zonas baja y media, redondo mayor, deltoide posterior, zona lumbar y de la cadera.', '12', '3');


INSERT INTO `tablaejercicios` (`idtabla`, `nombretabla`) VALUES
( '10', 'Lunes'),
( '11', 'Martes'),
( '12', 'Jueves'),
( '13', 'Viernes');

INSERT INTO `ejercicio_pertenece_tablaejercicios` (`Ejercicio_idejercicio`, `TablaEjercicios_idtabla`) VALUES
( '1', '10'),
( '2', '10'),
( '3', '11'),
( '4', '11'),
( '1', '12'),
( '3', '12'),
( '2', '13'),
( '4', '13');
