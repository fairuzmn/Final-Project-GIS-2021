/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100406
 Source Host           : localhost:3306
 Source Schema         : postesgis

 Target Server Type    : MySQL
 Target Server Version : 100406
 File Encoding         : 65001

 Date: 19/12/2021 13:26:30
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for places
-- ----------------------------
DROP TABLE IF EXISTS `places`;
CREATE TABLE `places`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `alamat` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `lat` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `lng` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of places
-- ----------------------------
INSERT INTO `places` VALUES (1, 'RSUD Ibnu Sina', 'Jl. DR. Wahidin Sudiro Husodo No.243B, Kembangan, Klangonan, Kec. Kebomas, Kabupaten Gresik, Jawa Timur 61124', '-7.167766725145738', '112.60088661022513');
INSERT INTO `places` VALUES (2, 'Semen Gresik Hospital', 'RS Semen Gresik, Jl. R.A. Kartini No.280, Kesemen, Sukorame, Kec. Gresik, Kabupaten Gresik, Jawa Timur 61111', '-7.16551716672817', '112.64228205212486');
INSERT INTO `places` VALUES (3, 'Petrokimia Gresik Hospital', 'Jl. Jenderal Ahmad Yani No.69, Ngipik, Karangpoh, Kec. Gresik, Kabupaten Gresik, Jawa Timur 61119', '-7.159147255476044', '112.64350311577185');
INSERT INTO `places` VALUES (4, 'Fatma Medika Gresik', 'Jl. Raya Pendopo No.45, Area Sawah/Kebun, Sembayat, Kec. Manyar, Kabupaten Gresik, Jawa Timur 61151', '-7.074459493256975', '112.57418691392205');

SET FOREIGN_KEY_CHECKS = 1;
