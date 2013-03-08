/*
 Navicat Premium Data Transfer

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 50166
 Source Host           : localhost
 Source Database       : agenda

 Target Server Type    : MySQL
 Target Server Version : 50166
 File Encoding         : utf-8

 Date: 03/08/2013 18:10:54 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `cpt_AuthAssignment`
-- ----------------------------
DROP TABLE IF EXISTS `cpt_AuthAssignment`;
CREATE TABLE `cpt_AuthAssignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`),
  CONSTRAINT `cpt_authassignment_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `cpt_authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
--  Records of `cpt_AuthAssignment`
-- ----------------------------
BEGIN;
INSERT INTO `cpt_AuthAssignment` VALUES ('Admin', '1', null, 'N;');
COMMIT;

-- ----------------------------
--  Table structure for `cpt_AuthItem`
-- ----------------------------
DROP TABLE IF EXISTS `cpt_AuthItem`;
CREATE TABLE `cpt_AuthItem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
--  Records of `cpt_AuthItem`
-- ----------------------------
BEGIN;
INSERT INTO `cpt_AuthItem` VALUES ('Admin', '2', 'Super Usuario', null, 'N;'), ('Callcenter', '2', 'Operario de Call Center', null, 'N;'), ('Escritorio.*', '1', null, null, 'N;'), ('Escritorio.Contact', '0', null, null, 'N;'), ('Escritorio.Error', '0', null, null, 'N;'), ('Escritorio.Index', '0', null, null, 'N;'), ('Escritorio.Login', '0', null, null, 'N;'), ('Escritorio.Logout', '0', null, null, 'N;'), ('Formulario.Default.*', '1', null, null, 'N;'), ('Formulario.Default.Index', '0', null, null, 'N;'), ('Geocoder.Default.*', '1', null, null, 'N;'), ('Geocoder.Default.Index', '0', null, null, 'N;'), ('Guest', '2', 'Usuario no Autenticado', null, 'N;'), ('Listado.Default.*', '1', null, null, 'N;'), ('Listado.Default.Index', '0', null, null, 'N;'), ('Menu.Default.*', '1', null, null, 'N;'), ('Menu.Default.Index', '0', null, null, 'N;'), ('Menu.Default.MenuItems', '0', null, null, 'N;'), ('User.Activation.*', '1', null, null, 'N;'), ('User.Activation.Activation', '0', null, null, 'N;'), ('User.Admin.*', '1', null, null, 'N;'), ('User.Admin.Admin', '0', null, null, 'N;'), ('User.Admin.Create', '0', null, null, 'N;'), ('User.Admin.Delete', '0', null, null, 'N;'), ('User.Admin.Update', '0', null, null, 'N;'), ('User.Admin.View', '0', null, null, 'N;'), ('User.Default.*', '1', null, null, 'N;'), ('User.Default.Index', '0', null, null, 'N;'), ('User.Login.*', '1', null, null, 'N;'), ('User.Login.Login', '0', null, null, 'N;'), ('User.Logout.*', '1', null, null, 'N;'), ('User.Logout.Logout', '0', null, null, 'N;'), ('User.Profile.*', '1', null, null, 'N;'), ('User.Profile.Changepassword', '0', null, null, 'N;'), ('User.Profile.Edit', '0', null, null, 'N;'), ('User.Profile.Profile', '0', null, null, 'N;'), ('User.ProfileField.*', '1', null, null, 'N;'), ('User.ProfileField.Admin', '0', null, null, 'N;'), ('User.ProfileField.Create', '0', null, null, 'N;'), ('User.ProfileField.Delete', '0', null, null, 'N;'), ('User.ProfileField.Update', '0', null, null, 'N;'), ('User.ProfileField.View', '0', null, null, 'N;'), ('User.Recovery.*', '1', null, null, 'N;'), ('User.Recovery.Recovery', '0', null, null, 'N;'), ('User.Registration.*', '1', null, null, 'N;'), ('User.Registration.Registration', '0', null, null, 'N;'), ('User.User.*', '1', null, null, 'N;'), ('User.User.Index', '0', null, null, 'N;'), ('User.User.View', '0', null, null, 'N;');
COMMIT;

-- ----------------------------
--  Table structure for `cpt_AuthItemChild`
-- ----------------------------
DROP TABLE IF EXISTS `cpt_AuthItemChild`;
CREATE TABLE `cpt_AuthItemChild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `cpt_authitemchild_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `cpt_authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cpt_authitemchild_ibfk_2` FOREIGN KEY (`child`) REFERENCES `cpt_authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
--  Records of `cpt_AuthItemChild`
-- ----------------------------
BEGIN;
INSERT INTO `cpt_AuthItemChild` VALUES ('Guest', 'User.Activation.*'), ('Guest', 'User.Login.*'), ('Guest', 'User.Login.Login'), ('Guest', 'User.Logout.*'), ('Guest', 'User.Logout.Logout'), ('Guest', 'User.Profile.Changepassword'), ('Guest', 'User.Recovery.Recovery'), ('Guest', 'User.Registration.*'), ('Guest', 'User.Registration.Registration');
COMMIT;

-- ----------------------------
--  Table structure for `cpt_Rights`
-- ----------------------------
DROP TABLE IF EXISTS `cpt_Rights`;
CREATE TABLE `cpt_Rights` (
  `itemname` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  PRIMARY KEY (`itemname`),
  CONSTRAINT `cpt_rights_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `cpt_authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
--  Table structure for `cpt_agenda`
-- ----------------------------
DROP TABLE IF EXISTS `cpt_agenda`;
CREATE TABLE `cpt_agenda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_paciente` int(11) NOT NULL,
  `id_medico` int(11) NOT NULL,
  `fe_inicial` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fe_final` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `fk_cpt_agenda_cpt_pacientes1_idx` (`id_paciente`),
  KEY `fk_cpt_agenda_cpt_medicos1_idx` (`id_medico`),
  CONSTRAINT `fk_cpt_agenda_cpt_medicos1` FOREIGN KEY (`id_medico`) REFERENCES `cpt_medicos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_cpt_agenda_cpt_pacientes1` FOREIGN KEY (`id_paciente`) REFERENCES `cpt_pacientes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `cpt_agenda`
-- ----------------------------
BEGIN;
INSERT INTO `cpt_agenda` VALUES ('1', '1', '1', '2013-03-08 08:30:00', '2013-03-08 09:00:00'), ('2', '2', '1', '2013-03-08 09:00:00', '2013-03-08 09:30:00'), ('3', '1', '1', '2013-03-08 11:00:00', '2013-03-08 11:30:00');
COMMIT;

-- ----------------------------
--  Table structure for `cpt_especialidades`
-- ----------------------------
DROP TABLE IF EXISTS `cpt_especialidades`;
CREATE TABLE `cpt_especialidades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `cpt_especialidades`
-- ----------------------------
BEGIN;
INSERT INTO `cpt_especialidades` VALUES ('1', 'General'), ('2', 'Oncología'), ('3', 'Geriatría'), ('4', 'Cardiología'), ('5', 'Neurología'), ('6', 'Pediatría'), ('7', 'Ginecología'), ('8', 'Infectología');
COMMIT;

-- ----------------------------
--  Table structure for `cpt_especialidades_medicos`
-- ----------------------------
DROP TABLE IF EXISTS `cpt_especialidades_medicos`;
CREATE TABLE `cpt_especialidades_medicos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_medico` int(11) NOT NULL,
  `id_especialidad` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cpt_especialidades_medicos_cpt_medicos1_idx` (`id_medico`),
  KEY `fk_cpt_especialidades_medicos_cpt_especialidades1_idx` (`id_especialidad`),
  CONSTRAINT `fk_cpt_especialidades_medicos_cpt_medicos1` FOREIGN KEY (`id_medico`) REFERENCES `cpt_medicos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_cpt_especialidades_medicos_cpt_especialidades1` FOREIGN KEY (`id_especialidad`) REFERENCES `cpt_especialidades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `cpt_especialidades_medicos`
-- ----------------------------
BEGIN;
INSERT INTO `cpt_especialidades_medicos` VALUES ('1', '1', '1'), ('2', '1', '2'), ('3', '2', '1'), ('4', '2', '3'), ('5', '3', '4'), ('6', '3', '5'), ('7', '4', '1'), ('8', '4', '6'), ('9', '5', '2'), ('10', '6', '1'), ('11', '6', '7'), ('12', '6', '8'), ('13', '7', '6');
COMMIT;

-- ----------------------------
--  Table structure for `cpt_medicos`
-- ----------------------------
DROP TABLE IF EXISTS `cpt_medicos`;
CREATE TABLE `cpt_medicos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identificador` varchar(45) NOT NULL DEFAULT '0000',
  `nombre` varchar(100) NOT NULL,
  `fe_nacimiento` date NOT NULL DEFAULT '0000-00-00',
  `hr_inicio` time NOT NULL,
  `hr_fin` time NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `cpt_medicos`
-- ----------------------------
BEGIN;
INSERT INTO `cpt_medicos` VALUES ('1', '0001', 'John Barrientos', '1988-12-05', '08:00:00', '18:00:00', '1'), ('2', '0002', 'Juan David Henao', '1985-06-20', '14:00:00', '18:00:00', '1'), ('3', '0003', 'Jorge Morales', '1986-01-23', '14:00:00', '18:00:00', '1'), ('4', '0004', 'Cristian Marín', '1991-05-13', '14:00:00', '18:00:00', '0'), ('5', '0005', 'Andrés Cañola', '1985-02-09', '08:00:00', '18:00:00', '1'), ('6', '0006', 'Abner Trejos', '1972-12-25', '08:00:00', '18:00:00', '1'), ('7', '0007', 'Sandra Arias', '1985-08-30', '08:00:00', '18:00:00', '1');
COMMIT;

-- ----------------------------
--  Table structure for `cpt_menu`
-- ----------------------------
DROP TABLE IF EXISTS `cpt_menu`;
CREATE TABLE `cpt_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_padre` int(11) NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL,
  `subtitle` varchar(100) DEFAULT NULL,
  `subtitle_pos` tinyint(1) NOT NULL DEFAULT '1',
  `url` varchar(50) NOT NULL,
  `active` varchar(100) DEFAULT NULL,
  `visible` varchar(100) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_padre` (`id_padre`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
--  Records of `cpt_menu`
-- ----------------------------
BEGIN;
INSERT INTO `cpt_menu` VALUES ('1', '0', 'Agenda', '<span class=\"icon16 icomoon-icon-calendar-2\"></span>', '1', '/Agenda', null, null, '1'), ('2', '0', 'Pacientes', '<span class=\"icon16 icomoon-icon-users\"></span>', '1', '/Pacientes', null, null, '1'), ('3', '0', 'Médicos', '<span class=\"icon16 icomoon-icon-user-4\"></span>', '1', '/Medicos', null, null, '1'), ('4', '0', 'Especialidades', '<span class=\"icon16 icomoon-icon-vcard\"></span>', '1', '/Especialidades', null, null, '1');
COMMIT;

-- ----------------------------
--  Table structure for `cpt_pacientes`
-- ----------------------------
DROP TABLE IF EXISTS `cpt_pacientes`;
CREATE TABLE `cpt_pacientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identificador` varchar(45) NOT NULL DEFAULT '0000',
  `nombre` varchar(100) NOT NULL,
  `fe_nacimiento` date NOT NULL DEFAULT '0000-00-00',
  `telefono` varchar(15) NOT NULL,
  `observaciones` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records of `cpt_pacientes`
-- ----------------------------
BEGIN;
INSERT INTO `cpt_pacientes` VALUES ('1', '3414469', 'Juan Fernando Gaviria S.', '1981-07-07', '3017870088', 'Muy buen paciente'), ('2', '123456', 'Juan Guillermo Segura', '1977-03-17', '3203260', 'Paciente');
COMMIT;

-- ----------------------------
--  Table structure for `cpt_profiles`
-- ----------------------------
DROP TABLE IF EXISTS `cpt_profiles`;
CREATE TABLE `cpt_profiles` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `lastname` varchar(50) NOT NULL DEFAULT '',
  `firstname` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`user_id`),
  CONSTRAINT `user_profile_id0` FOREIGN KEY (`user_id`) REFERENCES `cpt_users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
--  Records of `cpt_profiles`
-- ----------------------------
BEGIN;
INSERT INTO `cpt_profiles` VALUES ('1', 'Gaviria S.', 'Juan Fernando'), ('2', 'Auditor', 'Usuario');
COMMIT;

-- ----------------------------
--  Table structure for `cpt_profiles_fields`
-- ----------------------------
DROP TABLE IF EXISTS `cpt_profiles_fields`;
CREATE TABLE `cpt_profiles_fields` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `varname` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `field_type` varchar(50) NOT NULL,
  `field_size` varchar(15) NOT NULL DEFAULT '0',
  `field_size_min` varchar(15) NOT NULL DEFAULT '0',
  `required` int(1) NOT NULL DEFAULT '0',
  `match` varchar(255) NOT NULL DEFAULT '',
  `range` varchar(255) NOT NULL DEFAULT '',
  `error_message` varchar(255) NOT NULL DEFAULT '',
  `other_validator` varchar(5000) NOT NULL DEFAULT '',
  `default` varchar(255) NOT NULL DEFAULT '',
  `widget` varchar(255) NOT NULL DEFAULT '',
  `widgetparams` varchar(5000) NOT NULL DEFAULT '',
  `position` int(3) NOT NULL DEFAULT '0',
  `visible` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `varname` (`varname`,`widget`,`visible`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
--  Records of `cpt_profiles_fields`
-- ----------------------------
BEGIN;
INSERT INTO `cpt_profiles_fields` VALUES ('1', 'lastname', 'Apellidos', 'VARCHAR', '50', '3', '1', '', '', 'Incorrect Last Name (length between 3 and 50 characters).', '', '', '', '', '1', '3'), ('2', 'firstname', 'Nombres', 'VARCHAR', '50', '3', '1', '', '', 'Incorrect First Name (length between 3 and 50 characters).', '', '', '', '', '0', '3');
COMMIT;

-- ----------------------------
--  Table structure for `cpt_users`
-- ----------------------------
DROP TABLE IF EXISTS `cpt_users`;
CREATE TABLE `cpt_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `activkey` varchar(128) NOT NULL DEFAULT '',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastvisit_at` timestamp NOT NULL DEFAULT '1970-01-01 00:00:01',
  `superuser` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `status` (`status`),
  KEY `superuser` (`superuser`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
--  Records of `cpt_users`
-- ----------------------------
BEGIN;
INSERT INTO `cpt_users` VALUES ('1', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'juan.gaviria@sevensense.co', 'a38c7e9ec986ae28082f54ee2d3a72bb', '2012-10-19 14:34:08', '2013-03-08 09:43:49', '1', '1'), ('2', 'demo', 'fe01ce2a7fbac8fafaed7c982a04e229', 'demo@example.com', '099f825543f7850cc038b90aaff39fac', '2012-10-19 14:34:08', '2012-12-29 00:50:19', '0', '1');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
