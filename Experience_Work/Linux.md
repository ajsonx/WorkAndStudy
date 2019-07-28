# 常用易忘Linux命令

> 收集

## 根据端口号查找PID

* `lsof -i:`
* `netstat`


### `Netstat`命令拓展

* `netstat -a` 列出当前所有连接
* `netstat -t/-u` 列出tcp/udp 协议的连接
* `netstat -n` 禁用反向域名解析，加快查询速度
	* 默认情况下 `netstat` 会通过反向域名解析技术查找每个 IP 地址对应的主机名。这会降低查找速度。如果你觉得 IP 地址已经足够，而没有必要知道主机名，就使用 -n 选项禁用域名解析功能。

* `netstat -L` 只列出监听的连接
* `netstat -p` 获取进程名、进程号以及用户ID
	* 很多进程是`sudo`权限的，最好使用`sudo`命令

* `netstat -s` 打印统计数据
* `netstat -i` 打印网络接口
* `netstat -c` 持续输出

## 根据PID查找进程执行文件



