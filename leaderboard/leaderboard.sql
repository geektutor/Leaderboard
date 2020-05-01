CREATE TABLE `leaderboard`.`leaderboard` ( 
    `id` INT NOT NULL AUTO_INCREMENT ,
     `nickname` VARCHAR(225) NOT NULL , 
     `email` VARCHAR(225) NOT NULL , 
     `track` VARCHAR(225) NOT NULL , 
     `level` VARCHAR(255) NOT NULL , 
     `score` INT(11) NOT NULL DEFAULT '0' ,
      PRIMARY KEY (`id`)) ENGINE = InnoDB;