CREATE TABLE `item` (
	`nm-item` VARCHAR(255) NOT NULL,
	`cd-categ` INT NOT NULL,
	`cd-item` INT NOT NULL AUTO_INCREMENT UNIQUE,
	`des-item` VARCHAR(255) NOT NULL,
	`val-item` FLOAT NOT NULL,
	PRIMARY KEY (`cd-item`)
);

CREATE TABLE `estoque` (
	`cd-item` INT NOT NULL,
	`qtd-estoque` INT NOT NULL,
	PRIMARY KEY (`cd-item`)
);

CREATE TABLE `pedido` (
	`cd-pedido` INT NOT NULL UNIQUE,
	`cd-item` INT NOT NULL AUTO_INCREMENT UNIQUE,
	`qtd-item` INT NOT NULL,
	`cd-cliente` INT NOT NULL,
	PRIMARY KEY (`cd-pedido`)
);

ALTER TABLE `estoque` ADD CONSTRAINT `estoque_fk0` FOREIGN KEY (`cd-item`) REFERENCES `item`(`cd-item`);

ALTER TABLE `pedido` ADD CONSTRAINT `pedido_fk0` FOREIGN KEY (`cd-item`) REFERENCES `item`(`cd-item`);

