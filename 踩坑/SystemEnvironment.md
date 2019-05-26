# ahead
····
  本机配置
1.MacOS HighSierra 10.13.6
2.PHP7.2.17 /usr/bin/php
    php-fpm /usr/local/Cellar/php\@7.2/7.2.17_1/sbin/php-fpm
3.nginx1.15.12
4.mysql8.0.16
····
##  修改项目域名配置
1.nginx添加域名信息
2.修改hosts
3.修改前端请求url（前后端分离）

##  同一个局域网下使其他人可访问
  	----
  	//配置
  	host： 127.0.0.1 base.com
  	nginx： listen 80;
  			server_name base.com
  	----
1.Nginx配置每个项目监听的端口不能一样,会造成冲突
2.修改host为本机ip，带上nginx监听端口即可
	172.0.0.1:80 base.com


##  配置新项目
1.tangram build
2.composer install
3.README.MD中的注意事项
    安装php-ladp
    安装php-oci8 首先装 instantclient 三个相关的包，解压到/usr/local/instantclient 后建立软连接 到 /usr/local/lib/
        编译命令加上 ./configure --with-oci8=shared,instantclient,/usr/local/instantclient
4.docker安装ORACLE
    部署ORACLE软件在docker中： oracle镜像已经下载好，直接在12.xxxx 下运行./buildDockerImage.sh -v 12.xxxx -e
    创建ORACLE实例： docker run --name oracle -p 1521:1521 -p 5500:5500 -v /Users/[username]/oradata:/opt/oracle/oradata oracle/database:12.2.0.1-ee
    重新设置密码： docker exec oracle ./setPassword.sh XXXXXX
    navicat连接oracle ⭐⭐⭐ 服务名：orclcdb 角色 SYSDBA
5.nginx 配置