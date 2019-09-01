# PHP7新特性·第二章

### 形参类型声明

````
function age(int $age){ 
  return $age;
}
echo age(1.1); 
````
> 按形参声明类型返回,输出 1

### 返回类型声明
`function age(int age) : int  `

> 让函数、方法的形参与返回值有所预期，避免出现不必要的数据传递，代码更清晰，可读性更强

### 严格类型检查模式

`declare(strict_type = 1)`  

> 此模式下不遵守类型返回会引起	Fatal Error

## 命名空间与use关键字批量声明

* 非混合模式

	````
	use Publishers\Packt\{Book,Ebook,Video,Presentation};
	use function Publishers\Packt\{getBook,saveBook};
	use const Publishers\Packt\{COUNT,KEY};
	````
* 混合模式

	````
	use Publishers\Packt\{Book,Ebook,getBook,COUNT};
	````
* 复合模式
	````
	use Publishers\Packt\{Paper\Book,Electronic\Ebook,Media\Video};
	````


## 匿名类

* 参数可以直接设置再匿名类中

* 匿名类可以继承父类，父类中`public`，`protected`属性依然有效

	````
	$number = new class(5) extends packt{
	  public function __construct(float $number){  
	    parent::__constuct(); $this->number = $number;    
	  }
	};
	````
  同样可以继承接口`implement`



* 匿名类可以嵌套在一个类中使用 ⭐⭐（有点厉害）

	````
	class Math{
		public $first_number = 10;
		public function add() : float
		{
			return $this->first_number + 10 ;
		}
		public function multiply_sum()
		{
			return new class() extends Math //这里继承了本身
			{
				public function multiply(float $num) : float
				{
					return $this->add() * $num;
				}
			};
		}
	}
	echo new Math()->multiply_sum()->multiply(2);
	````
	调用multiply_sum方法生成一个由匿名类创建的对象执行multiply方法

	Math类可以被外部类调用，匿名类可以被内部类调用，但内部类不需要调用外部类，直接就可以用。

	在这个例子中，为了证明内部类可以通过继承外部类的方式来调用外部类中被声明为保护权限的方法

## Throwable接口


* PHP7之前 异常可以被截获，而错误不能。

* PHP7开始可以，但为了更好的截获诸多的错误，提供了`Throwable`接口

* 现在大多数的错误会抛出一个`Error`实例，我们自己写的php类是不能继承`Throwable`接口的，如果希望继承`Throwable`，需要继承某个异常类。

	````
	class AppException extends \Exception implements \Throwable{
		public function exceptionHandler();
	}
	error_reporting(E_ALL); //设置错误的报告级别，返回给客户端

	set_error_handler(array($appException, '_errorHandler')); //自定义 error 处理逻辑。但是以下级别的错误不能由用户定义的函数来处理： E_ERROR、 E_PARSE、 E_CORE_ERROR、 E_CORE_WARNING、 E_COMPILE_ERROR、 E_COMPILE_WARNING

   set_exception_handler(array($appException, '_exceptionHandler'));//当发现某个 exception 没有被 catch 的时候，就会调用这个函数，不管这个自定义的异常处理逻辑运行状况如何，在异常处理完之后，程序一定会被中断

	try{}
	catch(Throwable $t){}

	````


## 太空飞船操作符(<=>)
* 当符号两边相等时返回 **0**
* 右边大于左边 返回 **-1** (0 <=> 1)
* 左边大于右边 返回 **1** （1 <=> 0）

````
//php也可以自定义排序方式，（试试其他规则）
function space_sort($a, $b) : int
{
	return $a <=> $b;
}
$arrays = [1,34,56,67,45,2];

usort($arrys, 'space_sort');
foreach($arrays as $val)
{
	echo $val.PHP_EOL;
}
````
## 合并运算符(??)

经常用，不写了

## 统一变量语法
* 在PHP5.X版本中可以使用可变变量正常输出，但在PHP7引入之后，为了遵守从左到右解析的原则需要做出修改

````
//PHP5.x
$first =['name' => 'second'];
$second = 'Howdy';
echo $$first['name'];

//PHP7
echo ${$first['name']}; //需要添加大括号
````

## 其他特性变更
* PHP5.6开始，常量数组可以使用`const`声明，PHP7中常量数组可以通过`define`函数来初始化。

````
	const STORES = ['en','fr','ar'];

	define('STORES',['ec','a','de']);
````
* PHP7之前，`switch`多个`default`是允许的，但**现在会提示Fatal Error**
* `Session_start`函数支持传递参数选项数组，不需要去修改php.ini

````
	session_start([
		'cookie_lifetime' => 3600,
		'read_and_close' => true
	]);
````
* `unserialize`函数引入过滤器。

	* `unserialize`函数并不安全，它没有任何过滤器，可以反序列化任何类型的对象。
		PHP7引入了过滤器，默认情况下允许反序列化所有类型的对象。

		`$result = unserialize($object,['allowed_classes' => ['Packt','Books']]);
`



# PHP7应用性能提升·第三章

* Apache

	**Apache 2.X**  支持插入式并行处理模块，称为多进程处理模块（MPM）。在编译apache时必须选择也只能选择一个MPM。对类UNIX系统，有几个不同的MPM可供选择，它们会影响到apache的速度和可伸缩性。

	* **`prefork`**模式（线程创建进程）

		子进程一对一处理请求，处理请求快，内存消耗大。

	* **`worker`**模式（进场创建线程）

		子进程创建多线程处理请求，共享内存空间。

		一个线程出现了问题也会导致同一进程下的线程出现问题

	* **`events`**驱动模式

		与worker模式类似，不同的是在于它解决了`keep-alive`长连接的时候占用线程资源被浪费的问题（HTTP的Keepalive方式能减少TCP连接数量和网络负载），在`event`工作模式中，会有一些专门的线程用来管理这些`keep-alive`类型的线程，当有真实请求过来的时候，将请求传递给服务器的线程，执行完毕后，又允许它释放。这增强了在高并发场景下的请求处理

* Nginx

	* 异步、事件驱动、非阻塞请求处理。

	* 无内置解释性语言，解析脚本语言的进程则在Nginx之外。

   	* 对于静态资源，Apache也有自己的优势。

* HTTP Server优化（以下配置可在代理服务器开启，如Nginx）

	* 缓存静态文件 
	* HTTP Keep-alive (与TCP的Keepalive不同 )

		1.cpu和内存占用减少。TCP链接数减少，后续请求和响应无需打开新链接

		2.请求等待时间减少

	* GZIP压缩

		将网络传输内容进行压缩后传递，同时，浏览器若支持GZIP压缩，服务器端程序在输出内容时便使用GZIP压缩

	* 在Apache或Nginx关闭不必要的模块


* 内容分发网络（CDN）
	* 给用户就近节点访问，加速。
	* 如何进行CDN节点的选择？ 参考`HTTP.智能DNS` 
	 
* CSS和JavaScript优化
	* 合并
	* 缩小

* 一些工具
	* Minify - php缩小合并文件
	* Grunt - js 自动化任务
	* Varnish web应用程序加速器
	* HAProxy 负载均衡器

# 提升数据库性能·第四章

* 查询缓存
	缓存了SELECT 查询及其结果数据集，同一个SELECT查询发生时，从内存中直接取出结果。
	打开查询缓存 `show variables like `have_query_cache`; `
	Mysql.md=>my.cnf

* 存储引擎
	修改存储引擎 `Alter table pkt_user ENGINE=INNODB`;
	MyISAM和InnoDB存储引擎的区别详见 Mysql.md=>存储引擎
	

		
* Mysql的一些辅助工具
	* Percona Server
	* phpMyAdmin
	* Percona工具箱
	* Percona XtraDB 集群 (PXC)

* Redis
	* 基础用法介绍
	* Redis桌面管理 - RDM


* Memcached 
	* 类似于Redis，基础用法的介绍


# 调试和分析·第五章

* Xdebug拓展
* Sublime Text调试

# PHP应用的压力/负载测试·第六章





# 总结
**第5，6章的实践内容较多，需要自己去亲手操作，所谓的性能提升不能只停留在字面上，还需要利用各种工具，去观察实际的运行状况。**

  读完这本书，对于PHP7的一些新特性有相当的了解。

  本书大章按一整套的开发流程，从php-sql-debug-测试。大部分讲了工具的使用。

  技术和工具是不断更新的，还需要不断学习，才不会和社会脱节。
