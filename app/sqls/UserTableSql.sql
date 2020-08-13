CREATE TABLE `usuario` (
    `id` int(11) PRIMARY KEY AUTO_INCREMENT,
    `email` varchar(256),
    `senha` varchar(256),
    `data_ultimo_login` datetime,
    `ativo` tinyint(1)
);