## nginx 配置
    * location = / { break } 这个意思是域名后遇到 / 则break。如：www.baseapi.com/  403 forbidden
    * underscores_in_headers on; 把自动去掉Header头信息中带下划线的配置关闭
	* 
	*
	localtion ~* .(ico|jpg|jpeg|png|git|css|js|woff) $ {
		Expires 7d; #设置文件缓存7天
	}
	* nginx开启keep-alive
		keepalive_requests 100; 单个客户端在一条长链接链路上可以同时发起的请求书
		keepalive_timeout 100; 长链接的超时事件
	* GZIP压缩
		gzip on;
		gzip_vary on; 启用varing头
		gzip_types text/plain text/xml text/css text/javascript;
		gzip_com_level 4; 4表示压缩等级，区间1-9。建议中间值
	* 
		worker_processes 4; Nginx进程运行数
		worker_connections 512; 单个Nginx进程可以处理的链接数