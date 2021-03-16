# CRUD em CI4

## Banco de dados
```sql
CREATE DATABASE IF NOT EXISTS `ci4-crud` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `ci4-crud`;

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL DEFAULT '0',
  `password` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

INSERT INTO `users` (`user_name`, `password`, `email`, `status`) VALUES
	('admin', MD5(MD5('admin')), 'teste@gmail.com', 1);
```