# 常用易忘Linux命令


* 命令详解主要针对`UNIX`风格的系统 

> UNIX 风格，选项可以组合在一起，并且选项前必须有“-”连字符

> BSD 风格，选项可以组合在一起，但是选项前不能有“-”连字符

> GNU 风格的长选项，选项前有两个“-”连字符

> Mac 命令行多是BSD风格，可以输入 man ps 查看详情


## 根据端口号查找PID

1.  `lsof -i:端口号`

1.  `netstat -tunlp|grep 端口号`

> Mac下推荐第一种方式

### `Netstat`命令详解

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

1.`ps -aux | grep PID`

### `ps`命令详解

* ps命令支持三种使用的语法格式

* `ps -a` 显示当前所有进程，同时加上`x`参数会显示没有控制终端的进程。

	结果默认会显示4列信息。

	PID: 运行着的命令(CMD)的进程编号
	
	TTY: 命令所运行的位置（终端）
	
	TIME: 运行着的该命令所占用的CPU处理时间
	
	CMD: 该进程所运行的命令
* `ps -ax` 这个命令的结果或许会很长。为了便于查看，可以结合less命令和管道来使用。 `ps -ax | less`

* `ps -u root` 根据特定用户过滤进程
* `ps -aux | less` 根据内存和cpu用量来过滤  `|grep mysql` 来过滤进程
* `ps -aux --sort -pcpu/pmem | less` 根据cpu/内存 升序显示
* `ps -L PID` 根据线程来过滤进程
* `ps -axjf` 树形显示进程
* `watch -n 1 ‘ps -aux --sort -pmem, -pcpu’ `结合watch命令，使用PS实时监控进程状态 `-n 1` 每秒刷新一次。 `|head 20` 限制前20条



## SSH 连接、远程上传下载文件

* 将 文件/文件夹 从远程  拷至本地 (scp) 
  `$scp -r username@192.168.0.1:/home/username/remotefile.txt /usr/local`
* 将 文件/文件夹 从本地拷至远程 (scp) 
  `$scp -r localfile username@192.168.0.1:/home/username/`



## Mac ssh免密连接、Tree命令

* 创建`.ssh/`目录下文件名为  `authorized_keys`的文件，写入连接主机的 `id_rsa.pub` 密钥

* `Tree -L N` 输出N级的结构

  * `Tree -L 2 >Readme.md` 输入结构到文件中
  * `Tree -d` 只显示文件夹

  

## w

