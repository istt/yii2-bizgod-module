CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `level` int(11) NOT NULL,
  `belongto` int(11) NOT NULL,
  `lft` int(11) DEFAULT NULL,
  `rgt` int(11) DEFAULT NULL,
  `root` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `belongto` (`belongto`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

CREATE TABLE `category_register` (
  `supplier_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`supplier_id`,`category_id`),
  UNIQUE KEY `supplier_id_2` (`supplier_id`,`category_id`),
  KEY `supplier_id` (`supplier_id`,`category_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `category_register_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`),
  CONSTRAINT `category_register_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(80) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `status` tinyint(3) NOT NULL,
  `score` tinyint(3) NOT NULL,
  `customer_type` tinyint(3) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`,`email`),
  KEY `full_name` (`full_name`,`customer_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Customer Information';

CREATE TABLE `invite` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) NOT NULL,
  `invite_type` tinyint(3) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  `data_msg` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`,`supplier_id`,`date`),
  KEY `supplier_id` (`supplier_id`),
  CONSTRAINT `invite_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`),
  CONSTRAINT `invite_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `order` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `order_name` varchar(255) NOT NULL,
  `order_description` text NOT NULL,
  `order_status` tinyint(3) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `quantity` double NOT NULL,
  `order_type` tinyint(4) NOT NULL,
  `rfp_attach` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `budget` double NOT NULL,
  `order_date` datetime NOT NULL,
  `due_date` datetime NOT NULL,
  `billing_type` tinyint(3) NOT NULL,
  `delivery_type` tinyint(3) NOT NULL,
  `delivery_address` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`,`category_id`,`order_name`,`order_date`,`due_date`,`billing_type`),
  KEY `order_status` (`order_status`),
  CONSTRAINT `order_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `po` (
  `id` bigint(20) NOT NULL,
  `order_id` bigint(20) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `unit` varchar(40) NOT NULL,
  `quantity` double NOT NULL,
  `price` float NOT NULL,
  `po_status` tinyint(3) NOT NULL,
  `billing_type` tinyint(3) NOT NULL,
  `delivery_type` tinyint(3) NOT NULL,
  `invite_id` bigint(20) NOT NULL,
  `delivery_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`,`customer_id`,`supplier_id`,`invite_id`),
  KEY `customer_id` (`customer_id`),
  KEY `supplier_id` (`supplier_id`),
  KEY `invite_id` (`invite_id`),
  CONSTRAINT `po_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`),
  CONSTRAINT `po_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`),
  CONSTRAINT `po_ibfk_3` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`),
  CONSTRAINT `po_ibfk_4` FOREIGN KEY (`invite_id`) REFERENCES `invite` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `rating` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `rating_type` tinyint(3) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `rating_type` (`rating_type`),
  KEY `customer_id` (`customer_id`),
  KEY `supplier_id` (`supplier_id`),
  CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`),
  CONSTRAINT `rating_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(40) NOT NULL,
  `phone` varchar(40) NOT NULL,
  `address` varchar(255) NOT NULL,
  `business_register` varchar(255) NOT NULL,
  `certify` varchar(255) NOT NULL,
  `score` int(11) NOT NULL,
  `supplier_type` tinyint(3) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`,`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(60) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `confirmed_at` int(11) DEFAULT NULL,
  `unconfirmed_email` varchar(255) DEFAULT NULL,
  `blocked_at` int(11) DEFAULT NULL,
  `registration_ip` varchar(45) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `flags` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_unique_username` (`username`),
  UNIQUE KEY `user_unique_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8