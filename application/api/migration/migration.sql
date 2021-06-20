USE `avatar`;
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
    `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `firstname` varchar(50) NOT NULL,
    `lastname` varchar(50) NOT NULL,
    `mail` varchar(150) NOT NULL,
    `password` varchar(150) NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
DROP TABLE IF EXISTS `avatar`;
CREATE TABLE IF NOT EXISTS `avatar` (
    `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` INT UNSIGNED DEFAULT NULL,
    `path` varchar(50) NOT NULL,
    `name` varchar(150) NOT NULL,
    UNIQUE INDEX IDX_3F73783B03A8386 (`user_id`),
    PRIMARY KEY (`id`)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
ALTER TABLE `avatar` ADD CONSTRAINT FK_3F73783B03A8386 FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);