## nginx 配置
    location = / { break } 这个意思是域名后遇到 / 则break 如：www.baseapi.com/  403 forbidden
    underscores_in_headers on; 把自动去掉Header头信息中带下划线的配置关闭
