/*
 Navicat Premium Data Transfer

 Source Server         : 本地MySQL
 Source Server Type    : MySQL
 Source Server Version : 80022
 Source Host           : localhost:3306
 Source Schema         : ktv

 Target Server Type    : MySQL
 Target Server Version : 80022
 File Encoding         : 65001

 Date: 28/06/2023 13:28:25
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for buy
-- ----------------------------
DROP TABLE IF EXISTS `buy`;
CREATE TABLE `buy`  (
  `order_id` int(0) NOT NULL COMMENT '订单编号',
  `comm_id` int(0) NOT NULL COMMENT '商品编号',
  `number` int(0) NOT NULL COMMENT '数量',
  `createtime` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updatetime` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`order_id`, `comm_id`) USING BTREE,
  INDEX `buy2comm`(`comm_id`) USING BTREE,
  CONSTRAINT `buy2comm` FOREIGN KEY (`comm_id`) REFERENCES `commodity` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `buy2order` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of buy
-- ----------------------------
INSERT INTO `buy` VALUES (1, 1, 20, '2023-06-27 14:10:00', '2023-06-27 14:10:00');
INSERT INTO `buy` VALUES (1, 3, 1, '2023-06-27 14:10:00', '2023-06-27 14:10:00');
INSERT INTO `buy` VALUES (27, 3, 1, '2023-06-27 16:41:15', '2023-06-27 16:43:14');
INSERT INTO `buy` VALUES (27, 8, 1, '2023-06-27 16:43:27', '2023-06-27 16:43:27');
INSERT INTO `buy` VALUES (28, 8, 6, '2023-06-27 20:22:55', '2023-06-27 20:22:55');
INSERT INTO `buy` VALUES (29, 3, 3, '2023-06-27 16:48:35', '2023-06-27 16:53:22');
INSERT INTO `buy` VALUES (29, 8, 2, '2023-06-27 16:53:06', '2023-06-27 16:53:06');
INSERT INTO `buy` VALUES (30, 8, 10, '2023-06-27 21:11:56', '2023-06-27 21:11:56');

-- ----------------------------
-- Table structure for commodity
-- ----------------------------
DROP TABLE IF EXISTS `commodity`;
CREATE TABLE `commodity`  (
  `id` int(0) NOT NULL AUTO_INCREMENT COMMENT '商品编号',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '商品名称',
  `cate_id` int(0) NOT NULL COMMENT '商品类别编号',
  `price` decimal(10, 2) NOT NULL COMMENT '价格',
  `unit` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '计量单位',
  `inventory` int(0) NOT NULL COMMENT '库存',
  `annotate` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL COMMENT '备注',
  `createtime` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) COMMENT '创建时间',
  `updatetime` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0) COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `comm2cate`(`cate_id`) USING BTREE,
  CONSTRAINT `comm2cate` FOREIGN KEY (`cate_id`) REFERENCES `commodity_category` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of commodity
-- ----------------------------
INSERT INTO `commodity` VALUES (1, '哈尔滨啤酒', 1, 5.00, '350ml', 35, '', '2023-06-25 21:42:09', '2023-06-27 16:28:46');
INSERT INTO `commodity` VALUES (2, '青岛啤酒', 1, 5.00, '350ml', 5, '', '2023-06-25 23:35:51', '2023-06-27 16:28:41');
INSERT INTO `commodity` VALUES (3, '轩尼诗（Hennessy）', 5, 50.00, '350ml', 16, '', '2023-06-25 23:36:08', '2023-06-27 16:53:22');
INSERT INTO `commodity` VALUES (8, '可口可乐', 4, 10.00, '350ml', 31, '', '2023-06-27 16:28:28', '2023-06-27 21:11:56');

-- ----------------------------
-- Table structure for commodity_category
-- ----------------------------
DROP TABLE IF EXISTS `commodity_category`;
CREATE TABLE `commodity_category`  (
  `id` int(0) NOT NULL AUTO_INCREMENT COMMENT '商品类别编号',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '商品类别名称',
  `annotate` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL COMMENT '备注',
  `createtime` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updatetime` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of commodity_category
-- ----------------------------
INSERT INTO `commodity_category` VALUES (1, '一般酒水', '', '2023-06-25 21:41:54', '2023-06-25 22:12:22');
INSERT INTO `commodity_category` VALUES (2, '水果', NULL, '2023-06-25 21:46:53', '2023-06-25 21:46:53');
INSERT INTO `commodity_category` VALUES (3, '零食', NULL, '2023-06-25 21:46:58', '2023-06-25 21:46:58');
INSERT INTO `commodity_category` VALUES (4, '饮料', '', '2023-06-25 22:01:10', '2023-06-25 22:01:10');
INSERT INTO `commodity_category` VALUES (5, '精品洋酒', '', '2023-06-25 22:08:42', '2023-06-25 22:12:38');

-- ----------------------------
-- Table structure for group
-- ----------------------------
DROP TABLE IF EXISTS `group`;
CREATE TABLE `group`  (
  `id` int(0) NOT NULL AUTO_INCREMENT COMMENT '用户组编号',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '用户组名称',
  `permission` json NOT NULL COMMENT '权限',
  `
annotate` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL COMMENT '注解',
  `createtime` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) COMMENT '创建时间',
  `updatetime` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0) COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of group
-- ----------------------------
INSERT INTO `group` VALUES (1, '管理员', '{\"work\": true, \"setting\": true}', '超级管理员', '2023-06-24 21:06:01', '2023-06-25 11:11:22');
INSERT INTO `group` VALUES (2, '普通用户', '{\"work\": true, \"setting\": false}', '一般用户', '2023-06-25 00:25:39', '2023-06-25 11:11:35');

-- ----------------------------
-- Table structure for order
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order`  (
  `id` int(0) NOT NULL AUTO_INCREMENT COMMENT '订单编号',
  `room_id` int(0) NOT NULL COMMENT '房间编号',
  `user_id` int(0) NOT NULL COMMENT '负责员工编号',
  `customer_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL COMMENT '顾客姓名',
  `customer_phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL COMMENT '顾客联系方式',
  `begintime` timestamp(0) NULL DEFAULT NULL COMMENT '开始时间',
  `endtime` timestamp(0) NULL DEFAULT NULL COMMENT '结束时间',
  `total_amount` decimal(10, 2) NOT NULL COMMENT '总金额',
  `discount` decimal(10, 2) NOT NULL DEFAULT 1.00 COMMENT '折扣',
  `actual_payment` decimal(10, 2) NOT NULL COMMENT '实际收款',
  `createtime` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updatetime` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `annotate` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL COMMENT '注解',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `order2room`(`room_id`) USING BTREE,
  INDEX `order2user`(`user_id`) USING BTREE,
  CONSTRAINT `order2room` FOREIGN KEY (`room_id`) REFERENCES `room` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `order2user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 30 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of order
-- ----------------------------
INSERT INTO `order` VALUES (1, 1, 27, '张三', '123456', '2023-06-27 10:00:00', '2023-06-27 15:49:16', 1134.00, 1.00, 1134.00, '2023-06-26 00:24:57', '2023-06-27 15:49:21', '');
INSERT INTO `order` VALUES (20, 1, 27, 'LYC', '123', '2023-06-27 15:59:46', '2023-06-27 16:15:26', 50.00, 1.00, 50.00, '2023-06-27 15:59:50', '2023-06-27 16:15:32', '');
INSERT INTO `order` VALUES (21, 2, 27, 'cwt', '456', '2023-06-27 16:00:46', '2023-06-27 16:15:35', 34.00, 1.00, 34.00, '2023-06-27 16:00:52', '2023-06-27 16:15:38', '');
INSERT INTO `order` VALUES (26, 1, 27, '123', '123', '2023-06-27 16:37:51', '2023-06-27 16:37:54', 0.00, 1.00, 0.00, '2023-06-27 16:37:52', '2023-06-27 16:38:00', '');
INSERT INTO `order` VALUES (27, 1, 27, 'LYC', '13545671324', '2023-06-27 16:40:42', '2023-06-27 16:45:19', 77.00, 1.00, 77.00, '2023-06-27 16:40:54', '2023-06-27 16:45:32', '服务周到，五星好评');
INSERT INTO `order` VALUES (28, 1, 27, 'CWT', '12346579801', '2023-06-27 16:46:44', NULL, 0.00, 1.00, 0.00, '2023-06-27 16:46:50', '2023-06-27 16:46:50', NULL);
INSERT INTO `order` VALUES (29, 2, 27, 'LYC', '1234567980', '2023-06-27 16:48:07', '2023-06-27 16:53:35', 187.00, 1.00, 187.00, '2023-06-27 16:48:17', '2023-06-27 16:54:00', '服务周到，五星好评');
INSERT INTO `order` VALUES (30, 2, 27, 'TEST', '123', '2023-06-27 21:11:34', '2023-06-27 21:11:59', 100.00, 1.00, 100.00, '2023-06-27 21:11:41', '2023-06-27 21:22:36', '');

-- ----------------------------
-- Table structure for room
-- ----------------------------
DROP TABLE IF EXISTS `room`;
CREATE TABLE `room`  (
  `id` int(0) NOT NULL AUTO_INCREMENT COMMENT '房间编号',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '房间名称',
  `type_id` int(0) NOT NULL COMMENT '房型编号',
  `floor` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL COMMENT '楼层',
  `state` int(0) NULL DEFAULT 1 COMMENT '状态',
  `annotate` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL COMMENT '注释',
  `createtime` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0) COMMENT '创建时间',
  `updatetime` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0) COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `room2rtype`(`type_id`) USING BTREE,
  CONSTRAINT `room2rtype` FOREIGN KEY (`type_id`) REFERENCES `room_type` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of room
-- ----------------------------
INSERT INTO `room` VALUES (1, '201', 1, '2', 2, '', '2023-06-27 16:46:50', '2023-06-27 16:46:50');
INSERT INTO `room` VALUES (2, '202', 1, '2', 1, NULL, '2023-06-27 21:22:36', '2023-06-27 21:22:36');
INSERT INTO `room` VALUES (3, '203', 1, '2', 1, '', '2023-06-26 20:21:41', '2023-06-26 20:21:41');
INSERT INTO `room` VALUES (5, '204', 1, '1', 1, '', '2023-06-26 23:25:59', '2023-06-26 23:25:59');
INSERT INTO `room` VALUES (6, '205', 1, '1', 1, '', '2023-06-26 23:29:50', '2023-06-26 23:29:50');
INSERT INTO `room` VALUES (7, '206', 1, '1', 1, '', '2023-06-26 16:37:08', '2023-06-26 16:37:08');
INSERT INTO `room` VALUES (8, '207', 1, '2', 1, '', '2023-06-26 16:44:02', '2023-06-26 16:44:02');
INSERT INTO `room` VALUES (9, '208', 5, '2', 1, '', '2023-06-26 16:37:19', '2023-06-26 16:37:19');
INSERT INTO `room` VALUES (10, '301', 2, '3', 1, '', '2023-06-26 16:37:33', '2023-06-26 16:37:33');
INSERT INTO `room` VALUES (11, '302', 2, '3', 1, '', '2023-06-26 16:37:40', '2023-06-26 16:37:40');
INSERT INTO `room` VALUES (12, '303', 2, '3', 1, '', '2023-06-26 16:37:45', '2023-06-26 16:37:45');
INSERT INTO `room` VALUES (13, '304', 2, '3', 1, '', '2023-06-26 16:37:52', '2023-06-26 16:37:52');
INSERT INTO `room` VALUES (14, '305', 2, '3', 1, '', '2023-06-26 16:38:00', '2023-06-26 16:38:00');
INSERT INTO `room` VALUES (15, '306', 3, '3', 1, '', '2023-06-26 16:38:05', '2023-06-26 16:38:05');

-- ----------------------------
-- Table structure for room_type
-- ----------------------------
DROP TABLE IF EXISTS `room_type`;
CREATE TABLE `room_type`  (
  `id` int(0) NOT NULL AUTO_INCREMENT COMMENT '房型编号',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '房型名称',
  `price` decimal(10, 2) NOT NULL COMMENT '价格',
  `capacity` int(0) NULL DEFAULT NULL COMMENT '容纳人数',
  `annotate` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL DEFAULT NULL COMMENT '注释',
  `createtime` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) COMMENT '创建时间',
  `updatetime` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0) COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of room_type
-- ----------------------------
INSERT INTO `room_type` VALUES (1, '小房', 168.00, 4, '', '2023-06-25 11:21:03', '2023-06-25 20:45:49');
INSERT INTO `room_type` VALUES (2, '中房', 208.00, 8, NULL, '2023-06-25 11:57:25', '2023-06-25 13:11:17');
INSERT INTO `room_type` VALUES (3, '大房', 268.00, 16, NULL, '2023-06-25 11:57:41', '2023-06-25 20:33:28');
INSERT INTO `room_type` VALUES (5, 'VIP包厢', 388.00, 8, '', '2023-06-25 20:37:11', '2023-06-25 20:37:11');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(0) NOT NULL AUTO_INCREMENT COMMENT '用户编号',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '用户名称',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '用户密码',
  `group_id` int(0) NOT NULL COMMENT '用户组编号',
  `createtime` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) COMMENT '创建时间',
  `updatetime` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0) COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `user2group`(`group_id`) USING BTREE,
  INDEX `userIname`(`name`) USING BTREE COMMENT '用户名索引',
  CONSTRAINT `user2group` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 34 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (27, 'wilson', '123', 1, '2023-06-25 00:40:59', '2023-06-25 00:40:59');
INSERT INTO `users` VALUES (28, 'cwt', '123', 1, '2023-06-25 00:41:50', '2023-06-26 11:54:17');
INSERT INTO `users` VALUES (29, 'lzh', '123', 1, '2023-06-25 00:41:57', '2023-06-26 11:54:22');
INSERT INTO `users` VALUES (30, 'lxj', '123', 1, '2023-06-25 00:42:17', '2023-06-26 11:54:27');
INSERT INTO `users` VALUES (31, 'lml', '123', 1, '2023-06-25 00:42:25', '2023-06-26 11:54:30');
INSERT INTO `users` VALUES (33, 'test', '123', 2, '2023-06-25 18:07:27', '2023-06-27 23:29:48');

-- ----------------------------
-- View structure for v_category_list
-- ----------------------------
DROP VIEW IF EXISTS `v_category_list`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_category_list` AS select `t`.`id` AS `id`,`t`.`name` AS `name`,count(`s`.`id`) AS `num`,`t`.`annotate` AS `annotate` from (`commodity_category` `t` left join `commodity` `s` on((`t`.`id` = `s`.`cate_id`))) group by `t`.`id`;

-- ----------------------------
-- View structure for v_commodity_list
-- ----------------------------
DROP VIEW IF EXISTS `v_commodity_list`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_commodity_list` AS select `t`.`id` AS `id`,`t`.`name` AS `name`,`t`.`cate_id` AS `cate_id`,`s`.`name` AS `cate_name`,`t`.`price` AS `price`,`t`.`unit` AS `unit`,`t`.`inventory` AS `inventory`,`t`.`annotate` AS `annotate`,sum(`r`.`number`) AS `sale` from ((`commodity` `t` left join `commodity_category` `s` on((`t`.`cate_id` = `s`.`id`))) left join `buy` `r` on((`t`.`id` = `r`.`comm_id`))) group by `t`.`id`;

-- ----------------------------
-- View structure for v_order_briefly
-- ----------------------------
DROP VIEW IF EXISTS `v_order_briefly`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_order_briefly` AS select `o`.`id` AS `订单编号`,`u`.`id` AS `负责人编号`,`u`.`name` AS `负责人`,`o`.`room_id` AS `房间编号`,`r`.`name` AS `房间`,`rt`.`id` AS `房类编号`,`rt`.`name` AS `房类`,`rt`.`price` AS `房价`,`o`.`begintime` AS `开房时间`,`o`.`endtime` AS `退房时间`,((`o`.`endtime` - `o`.`begintime`) / 10000) AS `时长`,(`rt`.`price` * ((`o`.`endtime` - `o`.`begintime`) / 10000)) AS `房费`,sum((`c`.`price` * `b`.`number`)) AS `商品消费`,`o`.`total_amount` AS `应付`,`o`.`actual_payment` AS `实付` from (((((`order` `o` left join `users` `u` on((`o`.`user_id` = `u`.`id`))) left join `room` `r` on((`o`.`room_id` = `r`.`id`))) left join `room_type` `rt` on((`r`.`type_id` = `rt`.`id`))) left join `buy` `b` on((`o`.`id` = `b`.`order_id`))) left join `commodity` `c` on((`b`.`comm_id` = `c`.`id`))) group by `o`.`id`;

-- ----------------------------
-- View structure for v_order_buy_list
-- ----------------------------
DROP VIEW IF EXISTS `v_order_buy_list`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_order_buy_list` AS select `o`.`id` AS `订单编号`,`b`.`comm_id` AS `商品编号`,`c`.`name` AS `商品名`,`b`.`number` AS `数量`,`c`.`price` AS `单价` from ((`buy` `b` left join `order` `o` on((`b`.`order_id` = `o`.`id`))) left join `commodity` `c` on((`b`.`comm_id` = `c`.`id`)));

-- ----------------------------
-- View structure for v_order_detail
-- ----------------------------
DROP VIEW IF EXISTS `v_order_detail`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_order_detail` AS select `o`.`id` AS `订单编号`,`u`.`id` AS `负责人编号`,`u`.`name` AS `负责人`,`o`.`room_id` AS `房间编号`,`r`.`name` AS `房间`,`rt`.`id` AS `房类编号`,`rt`.`name` AS `房类`,`rt`.`price` AS `房价`,`o`.`begintime` AS `开房时间`,`o`.`endtime` AS `退房时间`,((`o`.`endtime` - `o`.`begintime`) / 10000) AS `时长`,(`rt`.`price` * ((`o`.`endtime` - `o`.`begintime`) / 10000)) AS `房费`,sum((`c`.`price` * `b`.`number`)) AS `商品消费`,(sum((`c`.`price` * `b`.`number`)) + (`rt`.`price` * ((`o`.`endtime` - `o`.`begintime`) / 10000))) AS `应付`,`o`.`actual_payment` AS `实付`,`o`.`customer_name` AS `顾客姓名`,`o`.`customer_phone` AS `联系方式` from (((((`order` `o` left join `users` `u` on((`o`.`user_id` = `u`.`id`))) left join `room` `r` on((`o`.`room_id` = `r`.`id`))) left join `room_type` `rt` on((`r`.`type_id` = `rt`.`id`))) left join `buy` `b` on((`o`.`id` = `b`.`order_id`))) left join `commodity` `c` on((`b`.`comm_id` = `c`.`id`))) group by `o`.`id`;

-- ----------------------------
-- View structure for v_room_detail
-- ----------------------------
DROP VIEW IF EXISTS `v_room_detail`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_room_detail` AS select `t`.`id` AS `id`,`t`.`name` AS `name`,`t`.`type_id` AS `type_id`,`s`.`name` AS `type_name`,`s`.`price` AS `price`,`s`.`capacity` AS `capacity`,`t`.`floor` AS `floor`,`t`.`annotate` AS `annotate`,`t`.`state` AS `state` from (`room` `t` left join `room_type` `s` on((`t`.`type_id` = `s`.`id`)));

-- ----------------------------
-- View structure for v_room_list
-- ----------------------------
DROP VIEW IF EXISTS `v_room_list`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_room_list` AS select `t`.`id` AS `id`,`t`.`name` AS `name`,`t`.`type_id` AS `type_id`,`s`.`name` AS `type_name`,`s`.`price` AS `price`,`s`.`capacity` AS `capacity`,`t`.`floor` AS `floor`,`t`.`state` AS `state` from (`room` `t` left join `room_type` `s` on((`t`.`type_id` = `s`.`id`)));

-- ----------------------------
-- View structure for v_roomtype_detail
-- ----------------------------
DROP VIEW IF EXISTS `v_roomtype_detail`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_roomtype_detail` AS select `t`.`id` AS `id`,`t`.`name` AS `name`,`t`.`price` AS `price`,`t`.`capacity` AS `capacity`,`t`.`annotate` AS `annotate`,count(`s`.`id`) AS `num` from (`room_type` `t` left join `room` `s` on((`t`.`id` = `s`.`type_id`))) group by `t`.`id`;

-- ----------------------------
-- View structure for v_roomtype_list
-- ----------------------------
DROP VIEW IF EXISTS `v_roomtype_list`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_roomtype_list` AS select `t`.`id` AS `id`,`t`.`name` AS `name`,`t`.`price` AS `price`,`t`.`capacity` AS `capacity`,count(`s`.`id`) AS `num` from (`room_type` `t` left join `room` `s` on((`t`.`id` = `s`.`type_id`))) group by `t`.`id`;

-- ----------------------------
-- View structure for v_user_detail
-- ----------------------------
DROP VIEW IF EXISTS `v_user_detail`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_user_detail` AS select `t`.`id` AS `id`,`t`.`name` AS `name`,`t`.`password` AS `password`,`t`.`group_id` AS `group_id`,`s`.`name` AS `group_name`,`s`.`permission` AS `permission` from (`users` `t` left join `group` `s` on((`t`.`group_id` = `s`.`id`)));

-- ----------------------------
-- View structure for v_user_list
-- ----------------------------
DROP VIEW IF EXISTS `v_user_list`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_user_list` AS select `t`.`id` AS `id`,`t`.`name` AS `name`,`t`.`group_id` AS `group_id`,`s`.`name` AS `group_name`,`s`.`permission` AS `permission` from (`users` `t` left join `group` `s` on((`t`.`group_id` = `s`.`id`)));

-- ----------------------------
-- Procedure structure for p_checkout
-- ----------------------------
DROP PROCEDURE IF EXISTS `p_checkout`;
delimiter ;;
CREATE PROCEDURE `p_checkout`(in oid int,in endT TIMESTAMP,in totalPay DECIMAL,in dicount1 DECIMAL,in actualPay DECIMAL,in note LONGTEXT)
BEGIN
	DECLARE rid int;
	SELECT t.room_id from `order` as t WHERE t.id=oid into rid;
	UPDATE `order` as o set o.endtime=endT,o.total_amount=totalPay,o.discount=dicount1,o.actual_payment=actualPay,o.annotate=note where o.id=oid;
	UPDATE room as s set s.state=1 WHERE s.id=rid;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for p_delete_comm
-- ----------------------------
DROP PROCEDURE IF EXISTS `p_delete_comm`;
delimiter ;;
CREATE PROCEDURE `p_delete_comm`(in cid int)
begin
	DELETE FROM buy WHERE buy.comm_id=cid;
	DELETE FROM commodity WHERE id=cid;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for p_delete_order
-- ----------------------------
DROP PROCEDURE IF EXISTS `p_delete_order`;
delimiter ;;
CREATE PROCEDURE `p_delete_order`(in oid int)
BEGIN
	/*删除购物信息*/
	DELETE FROM buy WHERE order_id=oid;
	/*删除订单*/
	DELETE FROM `order` WHERE id=oid;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for p_order_buy
-- ----------------------------
DROP PROCEDURE IF EXISTS `p_order_buy`;
delimiter ;;
CREATE PROCEDURE `p_order_buy`(in oid int,in cid int,in num int)
BEGIN
	DECLARE flag int;
	DECLARE kuc int;
	DECLARE hb int;
	SELECT count(*) from buy as p WHERE p.comm_id=cid and p.order_id=oid into flag;
	SELECT inventory FROM commodity WHERE id=cid into kuc;
	if(kuc-num)>=0 then
	begin
		/*库存足够*/
		set kuc=kuc-num;/*更新库存*/
		UPDATE `commodity` as q set q.inventory=kuc WHERE q.id=cid;
		if(flag>0) then
		begin
			/*购买过，更新数量*/
			SELECT number from buy WHERE order_id=oid and comm_id=cid into hb;
			set hb=hb+num;
			update buy SET number=hb WHERE order_id=oid and comm_id=cid;
		end;
		ELSE
		BEGIN
			/*未购买过，新增*/
			INSERT INTO buy(order_id,comm_id,number) VALUES(oid,cid,num);
		END;
		end if;
	end;
	end if;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for p_room_begin
-- ----------------------------
DROP PROCEDURE IF EXISTS `p_room_begin`;
delimiter ;;
CREATE PROCEDURE `p_room_begin`(in rid int,in uid int,in cus_name VARCHAR(255),in cus_phone VARCHAR(255),in beg_time TIMESTAMP,out res VARCHAR(255))
BEGIN
	/*判断房间是否可用*/
	DECLARE check_room int;
	SELECT room.state FROM room WHERE room.id=rid INTO check_room;
	if check_room=1 then
	begin
		UPDATE room set room.state=2 WHERE room.id=rid;
		INSERT INTO `order`(`order`.room_id,`order`.user_id,`order`.begintime,`order`.total_amount,`order`.actual_payment,`order`.customer_name,`order`.customer_phone) VALUES(rid,uid,beg_time,0,0,cus_name,cus_phone);
		set res='200';
	end;
	else 
	set res='400';
	end if;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for p_update_buynum
-- ----------------------------
DROP PROCEDURE IF EXISTS `p_update_buynum`;
delimiter ;;
CREATE PROCEDURE `p_update_buynum`(in oid int,in cid int,in num int)
BEGIN
	DECLARE ku int;
	UPDATE commodity as c set c.inventory=c.inventory-num WHERE c.id=cid;
	SELECT number FROM buy WHERE order_id=oid AND comm_id=cid into ku;
	SET ku=ku+num;
	UPDATE buy as b SET b.number=ku WHERE b.order_id=oid and b.comm_id=cid;
	if ku=0 then
		DELETE FROM buy as q WHERE q.order_id=oid and q.comm_id=cid; 
	end if;
END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
