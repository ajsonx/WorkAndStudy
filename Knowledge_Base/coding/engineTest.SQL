DROP TABLE IF EXISTS `XXX`;
CREATE TABLE `XXX`(
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`name` varchar(50) NOT NULL,
	`time` varchar(11),
	PRIMARY KEY (`id`)
)ENGINE=MyISAM DEFAULT CHARSET=UTF8 COMMENT='test表';

INSERT INTO `XXX` VALUES(1,'jake',104332);
INSERT INTO `XXX` VALUES(2,'sill',104352);
INSERT INTO `XXX` VALUES(3,'furis',104425);
INSERT INTO `XXX` VALUES(4,'kris',105018);


SELECT max(id)
FROM `XXX` ;

SELECT id,name,time
FROM `XXX`
GROUP BY time;

INSERT INTO `XXX` VALUES(4,'kim',110110) ON DUPLICATE KEY UPDATE name='kankan',time='172615';

/*
  MyISAM支持大部分增删改查。
  可以用聚合函数、on Duplicaate key、group by等等

  正常使用没啥差别。
  不支持事务的高级操作，不能 begin-commit
 */

BEGIN
SELECT max(id)
FROM `XXX`
COMMIT
