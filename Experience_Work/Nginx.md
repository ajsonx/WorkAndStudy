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
		
	*   location /download/ {
            internal;
            root   /some/path;//绝对路径
        }
        internal 表示这个路径只能在 Nginx 内部访问，不能用浏览器直接访问防止未授权的下载
        注意添加在location / {...}的前面
        结合php发送头请求，就可以把下载请求传递给服务器，还可以控制速率
        header（
            'Content-Type'        => 'application/octet-stream',
            'Content-Disposition' => 'attachment;filename=' . $downloadName,
            'X-Accel-Redirect'    => $pathToFile,//让Xsendfile发送文件
            'X-Sendfile'          => $pathToFile,
            'X-Accel-Limit-Rate'  => $download_rate,
        ）
        这样你在代码中使用时，文件路径就可以写成“/download/myfile.csv”
    
    *   referer防盗链，盗图等
        location ~* \.(gif|jpg|png|webp)$ {
             valid_referers none blocked domain.com *.domain.com server_names ~\.google\. ~\.baidu\.;
             if ($invalid_referer) {
                return 403;
                #rewrite ^/ http://www.domain.com/403.jpg;
             }
             root /opt/www/image;
        }
        以上所有来至domain.com和域名以及baidu和google的站点都可以访问到当前站点的图片,如果来源域名不在这个列表中，
        那么$invalid_referer等于1，在if语句中返回一个403给用户
