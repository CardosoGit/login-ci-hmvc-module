# Host: localhost  (Version: 5.5.27)
# Date: 2016-03-02 03:09:11
# Generator: MySQL-Front 5.3  (Build 4.175)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "usuarios"
#

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `admin` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `nomeUser` varchar(200) NOT NULL DEFAULT '',
  `emailUser` varchar(100) NOT NULL DEFAULT '',
  `senhaUser` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "usuarios"
#

INSERT INTO `usuarios` VALUES (1,'Admin','admin@teste.com','$2a$08$MTU3OTcxODc1MDU2Y2EzZ.quWhe/qA2sv.A4ulbNefeC9eUtQkRqO');
