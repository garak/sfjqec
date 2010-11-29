
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- category
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `category`;


CREATE TABLE `category`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255)  NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`slug` VARCHAR(255),
	PRIMARY KEY (`id`),
	UNIQUE KEY `category_slug` (`slug`(255))
) ENGINE=InnoDB;

#-----------------------------------------------------------------------------
#-- product
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `product`;


CREATE TABLE `product`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255)  NOT NULL,
	`category_id` INTEGER  NOT NULL,
	`price` FLOAT  NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`slug` VARCHAR(255),
	PRIMARY KEY (`id`),
	UNIQUE KEY `product_slug` (`slug`(255)),
	INDEX `product_FI_1` (`category_id`),
	CONSTRAINT `product_FK_1`
		FOREIGN KEY (`category_id`)
		REFERENCES `category` (`id`)
		ON DELETE CASCADE
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
