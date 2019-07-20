
## Mac brew 安装的mysql
* `Can 't connect to local MySQL server through socket '/tmp/mysql.sock '(2) ";`

无法通过tmp下的sock文件连接到数据库服务。缺失mysql.sock文件。

解决 ： mysql启动方式有误 brew service restart mysql

* `Host '127.0.0.1' is not allowed to connect to this MySQL server`

解决 ：/usr/local/etc/my.cnf  注释 # skip_name_resolve 然后restart


## 索引允许为空
1.反向查询不命中索引，变成全表扫描

2.不等于(!=)查询，可能导致无法预期的结果

    id != 1 时  无法筛选出 id = null的结果集

3 使用or条件会导致全表扫描，这时应该优化为union。此时可以命中索引

    select * from table where id!=1 union select * from table where id!=null;

4 使用explain
