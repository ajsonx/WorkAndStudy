<?php
/**
 * Created by PhpStorm.
 * User: ajsonx
 * Date: 2019/1/30
 * Time: 11:39
 * 常量
 */

/*
 * const 和 define()的区别
 * php5.3以后可以使用const，
 * 1.define()在执行期定义常量，而const在编译期定义常量，有轻微的速度优势
 * 2.define()可以放在if内,const不行,const 定义必须放在函数外
 * 3.不能使用define()定义类常量，const可以定义类常量和命名空间常量
 * 4.define() 将常量放入全局作用域
 * 5.define() 允许你在常量名和常量值中使用表达式，而 const 则都不允许
 * 6.define() 和const不能重复定义一个同名，会报Notice
 * 7.const定义的常量时大小写敏感，而define可以通过第三个参数（为true表示大小写不敏感）来指定大小写是否敏感。
 */
function Test2(){
    define(a,'s');
    /* const b = 's'; must be declared at the top-level scope */
}
const abc = 2;
class teacher{
    const school = 'MNNU';
}

/*
 * Class Constant 类常量
 * 可以看作静态成员属性
 */
class MyClass
{
    const constant = 'constant value';

    function showConstant() {
        echo  self::constant . "\n";
    }
}

echo MyClass::constant . "\n";

$classname = "MyClass";
echo $classname::constant . "\n"; // 自 5.3.0 起

$class = new MyClass();
$class->showConstant();

echo $class::constant."\n"; // 自 PHP 5.3.0 起
//均可输出constant value

/*
 * 和 heredoc 不同，nowdoc 可以用在任何静态数据中。
 * Nowdoc 支持是在 PHP 5.3.0 新增的。
 * heredoc <<<EOT EOF EOD
 * nowdoc <<<'EOT' 需要带单引号
 */
class foo{
    const bar = <<<'EOT'
bar
EOT;
}
echo foo::bar;
