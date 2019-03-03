<?php
/**
 * Created by PhpStorm.
 * User: ajsonx
 * Date: 2019/3/1
 * Time: 19:08
 */

/**
 * MySQL数据类型
 * TINYINT、SMALLINT、MEDIUMINT、INT、BIGINT
 * --INT(3) '1234'照样可以存，只会影响显示字符的个数和是否设置0填充(zerofill)
 * VARCHAR、CHAR、TEXT
 * --VARCHAR 可变长 但只会缩小 超出会被截断 比定长节省空间 使用1或2个额外字节记录字符串的长度
 * --CHAR 定长 空格填充 超出被截断 适合存密码
 * FLOAT、DOUBLE、DECIMAL
 * --DECIMAL可以存储比BIGINT还大的整数；可用于存储精确的小数
 * ENUM 枚举
 * TIMESTAMP DATETIME 日期和时间
 * --TIMESTAMP空间效率高 微秒可以使用bigint
 * MySQL数据表引擎：InnoDB、MyISAM、
 * --InnoDB 支持行级锁、支持外键、热备份、安全恢复、默认事务型引擎
 * --MyISAM 全文索引、压缩、空间函数。不支持事务、行级锁、安全恢复（事务只和DML语句有关）
 * --Archive、Blackhole、CSV、Memory
 * MySQL锁机制
 * --共享锁（读锁） 排他锁（写锁）
 * --表锁，系统开销最小，锁定整张表，MyISAM使用表锁
 * --行锁，最大程度支持并发处理，最大锁开销，InnoDB使用行级锁
 *
 */

/* 索引
 * --优点：避免排序和临时表、减少服务器扫描量、随机IO变成顺序IO、提高查询速度
 * --缺点：降低写速度（写的适合操作一遍索引）、占用磁盘
 * --log2N
 * 索引类型，都是实现在存储引擎层的
 * --普通索引：最基本的索引，没有任何约束限制
 * --唯一索引：与普通索引类似，具有唯一性约束
 * --主键索引：特殊的唯一索引，不允许有空值
 * --组合索引：将多个列组合在一起创建索引，可以覆盖多个列（name+age+sex）
 * --外键索引：只有InnoDB才可以使用，保证数据一致性、完整性和实现级联操作
 * --全文索引：只能用于MyISAM，并且只能对英文进行全文检索
 * 创建原则
 * --最适合索引的是出现在WHERE子句中的列，而不是SELECT
 * --索引列基数越大，效果越好
 * --对字符串进行索引，应该制定一个前缀长度（前缀长度内字符串不匹配则不匹配）
 * --复合索引（user，age，sex）=（user，age，sex）+（user，age）+（user）
 *   遵循前缀原则：必须连续，不能跳过第一个
 * 注意事项
 * --like查询 %不能在前，会失效  where name = "%wang%" 可以使用全文索引
 * MySQL估计索引比全表查询慢 会放弃使用索引
 * or 前的列有索引，后面的没有，索引不会被用到 a or b
 * 列类型是字符串，查询时一定要给值加引号，否则索引失效
 */

/**
 * 原生mysql语句
 * CREATE TABLE message(
 * 'id' INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
 * 'title' VARCHAR(120) NOT NULL DEFAULT '',
 * 'user_name' VARCHAR(32) UNSIGNED NOT NULL DEFAULT '',
 * KEY message_user_name(user_name)
 * )ENGINE=InnoDB DEFAULT CHARSET=UTF8;
 */


/*
 * PDO数据库
 * 可拓展性、支持预处理、面向对象
 */
try{
    //就是构造我们的DSN（数据源）：数据库类型是mysql，主机地址是localhost，数据库名称是test，就这么几个信息。不同数据库的数据源构造方式是不一样的。
    $dsn = "mysql:host=localhost;dbname=test";
    $pdo = new PDO($dsn,$username,$password,$attr);
    $sql = 'SELECT id,title,content FROM message where user_name=:user_name';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':user_name' => $user_name]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
}catch (PDOException $e){
    echo $e->getMessage();
}
/*
 * MySQLi
 * 只支持MySQL操作、预处理、面向对象和过程、效率高
 */