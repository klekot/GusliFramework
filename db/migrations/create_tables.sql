CREATE TABLE `roles` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`)
)
  COLLATE='utf8_general_ci'
  ENGINE=InnoDB;

CREATE TABLE `users` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255) NULL DEFAULT NULL,
	`email` VARCHAR(255) NULL DEFAULT NULL,
	`login` VARCHAR(255) NOT NULL,
	`password` VARCHAR(255) NOT NULL,
	`role_id` INT(4) NOT NULL DEFAULT '0',
	PRIMARY KEY (`id`),
	CONSTRAINT `users_roles`
	FOREIGN KEY (`role_id`)
	REFERENCES `roles` (`id`)
		ON UPDATE RESTRICT ON DELETE RESTRICT
)
	COLLATE='utf8_general_ci'
	ENGINE=InnoDB;
