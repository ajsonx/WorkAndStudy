<?php
/**
 * Created by PhpStorm.
 * User: ajsonx
 * Date: 2019/7/20
 * Time: 17:06
 */
interface iFoo
{
    public function bar (string $baz) : iFoo;
}

class Foo implements iFoo
{

    public function bar (string $baz) : Foo //改为 iFoo 正确 (声明返回类型时为类名而不为接口名会报错)
    {
        echo $baz . PHP_EOL;
        return $this;
    }
}

(new Foo ()) -> bar ("Fred")
    -> bar ("Wilma")
    -> bar ("Barney")
    -> bar ("Betty");

/**
 * 报错如下：
 * Fatal error: Declaration of Foo::bar(string $baz): Foo must be compatible with iFoo::bar(string $baz): iFoo in /usr/local/var/www/php_study/Experience_Work/coding/php.php on line 13
 * 解释如下：
 * The enforcement of the declared return type during inheritance is invariant; this means that when a sub-type overrides a parent method then the return type of the child must exactly match the parent and may not be omitted. If the parent does not declare a return type then the child is allowed to declare one.
 * 如果父类有声明返回类型，则子类的返回类型必须和父类一致
 */
