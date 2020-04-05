--table for universities

CREATE TABLE `universities` ( 
    `id` INT NOT NULL AUTO_INCREMENT ,
     `university_id` VARCHAR(50) NOT NULL , 
     `university` VARCHAR(500) NOT NULL , 
     PRIMARY KEY (`id`)) ENGINE = InnoDB;


INSERT INTO `universities` (`id`, `university_id`, `university`) VALUES (NULL, '123v7h', 'JKUAT'), (NULL, '78abhy', 'Rongo University'), (NULL, '66qwgb', 'University of The Gambia')