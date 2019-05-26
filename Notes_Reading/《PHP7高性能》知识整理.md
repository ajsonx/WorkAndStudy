 
# PHP7新特性

* 类型声明
````
形参类型声明
function age(int $age)
{ return $age;}
echo age(1.1); 按形参声明类型返回-返回int
declare(strict_type = 1 ) 若声明，再传入浮点型，则会报fatel error ：Uncaught Type Error
-----
返回类型声明
function age(int age) : int  (工作中出现的 :?int 什么意思)
让函数、方法的形参与返回值有所预期，避免出现不必要的数据传递，代码更清晰，可读性更强


````
* 命名空间与use关键字批量声明
````
非混合模式
use Publishers\Packt\{Book,Ebook,Video,Presentation};
use function Publishers\Packt\{getBook,saveBook};
use const Publishers\Packt\{COUNT,KEY};

混合模式
use Publishers\Packt\{Book,Ebook,getBook,COUNT};

复合模式
use Publishers\Packt\{Paper\Book,Electronic\Ebook,Media\Video}

````
* 匿名类
````
参数可以直接设置再匿名类中
匿名类可以继承父类，父类中public，protected属性依然有效
$number = new class(5) extends packt{ public function __construct(float $number){ parent::__constuct(); $this->number = $number;}};

同样可以继承接口
implement 

匿名类可以嵌套在一个类中使用 ⭐⭐（有点厉害）
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
调用multiply_sum方法生成一个由匿名类创建的对象执行multiply方法
Math类可以被外部类调用，匿名类可以被内部类调用，但内部类不需要调用外部类，直接就可以用。
在这个例子中，为了证明内部类可以通过继承外部类的方式来调用外部类中被声明为保护权限的方法
````
* Throwable接口
	PHP7之前 异常可以被截获，而错误不能。
	PHP7开始可以，但为了更好的截获诸多的错误，提供了Throwable接口
	现在大多数的Fatal错误会抛出一个error实例，我们自己写的php类是不能继承Throwable接口的，如果希望继承Throwable，需要继承某个异常类。
````
try{
	$a = 20;
	$division = $a / 20;
}catch(DivisionByZeroError $e){
	echo $e->getMessage();
}
````

* 太空飞船操作符(<=>)
	当符号两边相等时返回 0
	右边大于左边 返回 -1 (0 <=> 1)
	左边大于右边 返回 1 （1 <=> 0）

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

*  合并运算符(??)

````
经常用，不写了
```` 

* 统一变量语法
	在PHP5.X版本中可以使用可变变量正常输出，但在PHP7引入之后，为了遵守从左到右解析的原则需要做出修改

````
//PHP5.x
$first =['name' => 'second'];
$second = 'Howdy';

echo $$first['name'];

//PHP7
echo ${$first['name']}; 
````

* 其他特性变更
	* PHP5.6开始，常量数组可以使用const声明，PHP7中常量数组可以通过define函数来初始化
	````
		const STORES = ['en','fr','ar'];
		define('STORES',['ec','a','de']);
	````
	* PHP7之前，switch多个default是允许的，但现在会产生Fatal级别错误
	* Session_start函数支持传递参数选项数组，不需要去修改php.ini

	````
		session_start([
			'cookie_lifetime' => 3600,
			'read_and_close' => true
		]);
	````
	* unserialize函数引入过滤器
		unserialize函数并不安全，它没有任何过滤器，可以反序列化任何类型的对象。
		PHP7引入了过滤器，默认情况下允许反序列化所有类型的对象
		````
		//看看手册
		$result = unserialize($object,['allowed_classes' => ['Packt','Books']]);
		````


# PHP7应用性能提升

* Nginx与Apache






