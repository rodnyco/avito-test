SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tasks
-- ----------------------------
USE ads;
CREATE TABLE IF NOT EXISTS `ads` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `title` varchar(100) NOT NULL,
    `description` text,
    `photo` VARCHAR(512),
    `price` decimal(19,2),
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of ads
-- ----------------------------
INSERT INTO `ads` (`title`, `description`, `photo`, `price`)
    VALUES (
            'Продам гараж',
            'Очень дорого кстати',
            'https://images.unsplash.com/photo-1519677704001-6d410c3ef07e?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80',
            200000
            );
INSERT INTO `ads` (`title`, `description`, `photo`, `price`)
    VALUES (
            'Погуляю с собакой',
            'Порода важна!',
            'https://images.unsplash.com/photo-1519677704001-6d410c3ef07e?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80',
            200
            );
INSERT INTO `ads` (`title`, `description`, `photo`, `price`)
    VALUES (
            'Куплю гараж',
            'Дешевли плз..',
            'https://images.unsplash.com/photo-1519677704001-6d410c3ef07e?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80',
            50000
            );


CREATE TABLE IF NOT EXISTS `photos` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `photo` VARCHAR(512),
    `adId` int(11) NOT NULL,
    PRIMARY KEY (`id`),
    CONSTRAINT `photos_ads_fk` FOREIGN KEY (`adId`) REFERENCES `ads` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO `photos` (`photo`, `adId`) VALUES ('https://photo.com/', 1);
INSERT INTO `photos` (`photo`, `adId`) VALUES ('https://photo.com/2', 2);
INSERT INTO `photos` (`photo`, `adId`) VALUES ('https://photo.com/2_2', 2);
INSERT INTO `photos` (`photo`, `adId`) VALUES ('https://photo.com/3', 3);
INSERT INTO `photos` (`photo`, `adId`) VALUES ('https://photo.com/1_2', 1);

SET FOREIGN_KEY_CHECKS = 1;