
## mac brew 安装的mysql
Can 't connect to local MySQL server through socket '/tmp/mysql.sock '(2) ";
解决 ： brew service restart mysql

Host '127.0.0.1' is not allowed to connect to this MySQL server
解决 ：/usr/local/etc/my.cnf  注释 # skip_name_resolve 然后restart
