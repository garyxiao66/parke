CREATE SCHEMA `gary` ;
CREATE TABLE `gary`.`categories` (
  `cate_id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `parent` INT NULL DEFAULT NULL,
  
PRIMARY KEY (`cate_id`));


INSERT INTO gary.categories VALUES((2,'TELEVISIONS',1),(3,'TUBE',2),
 (4,'LCD',2),(5,'PLASMA',2),(6,'PORTABLE ELECTRONICS',1),(7,'MP3 PLAYERS',6),(8,'FLASH',7),
 (9,'CD PLAYERS',6),(10,'2 WAY RADIOS',6);

CREATE TABLE `gary`.`items` (
  `item_id` INT NOT NULL,
  `name` VARCHAR(45) NULL,
  `price` DECIMAL(8,2) NULL,
  `cate_id` INT NOT NULL,
  `type_id` INT NOT NULL,
  PRIMARY KEY (`item_id`));

CREATE TABLE `gary`.`types` (
  `type_id` INT NOT NULL,
  `name` VARCHAR(45) NULL,
  PRIMARY KEY (`type_id`));

INSERT INTO `gary`.`types` (`type_id`, `name`) VALUES ('1', 'small');
INSERT INTO `gary`.`types` (`type_id`, `name`) VALUES ('2', 'median');
INSERT INTO `gary`.`types` (`type_id`, `name`) VALUES ('3', 'large');

INSERT INTO `gary`.`items` (`item_id`, `name`, `price`, `cate_id`, `type_id`) VALUES ('1', 'abc', '100.01', '3', '1'), ('2', 'dfb', '200.10', '5', '2'),('3', 'dfdfg', '300.02', '8', '3'),('4', 'vdf', '400', '9', '2'),('5', 'sfv', '230', '10', '1'),('6', 'gsg', '400', '7', '3'),('7', 'fdg', '400', '6', '2');

SELECT t.name, t.price, y.name FROM gary.items t 
inner join gary.categories c ON c.cate_id = t.cate_id
left join gary.types y ON y.type_id = t.type_id
WHERE c.name = 'FLASH';

SELECT 
t.name AS Item, t.price AS Price, y.name AS Type,c3.name as lev3, 
c2.name as lev2, c1.name as lev1 FROM gary.items t 
LEFT JOIN gary.categories c3 ON c3.cate_id = t.cate_id
LEFT JOIN gary.categories c2 ON c3.parent = c2.cate_id
LEFT JOIN gary.categories c1 ON c2.parent = c1.cate_id
LEFT JOIN gary.types y ON y.type_id = t.type_id
WHERE c3.name = 'FLASH';