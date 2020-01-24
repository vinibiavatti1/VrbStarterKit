CREATE TABLE `log` (
    `id` int(8) PRIMARY KEY AUTO_INCREMENT,
    `user_id` int(8),
    `url` varchar(2000),
    `ip` varchar(50),
    `type` varchar(10),
    `text` varchar(5000),
    `sql` varchar(5000),
    `date` datetime
);