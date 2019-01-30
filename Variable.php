<?php
/**
 * Created by PhpStorm.
 * User: ajsonx
 * Date: 2019/1/29
 * Time: 13:46
 * 变量范围
 */

/*
 * PHP Notice:  Undefined variable: a Variable.php
 * 原因：函数内引用局部变量，范围内未定义。需要声明为global才能使用。静态变量等同理
 */
$a = 1;
function Test(){
    echo $a;
}
//Test();

/*
 * 静态变量仅在局部函数域中存在，但当程序执行离开此作用域时，其值并不丢失。
 * 保证$a变量只有在函数第一次调用时才会被初始化
 * static变量不会存储引用
 */
function Test1(){
    static $a = 0; /*static variable 静态变量不能用表达式或者函数声明 如：$a = 1+1; */
    echo $a;
    $a++;
}
//Test1();
//Test1();
//Test1();
//Result:0;1;2;

/*
 * 利用静态变量写递归
 */
function f(){
    static $count = 0;

    $count++;
    echo $count;
    if ($count < 10) {
        test();
    }
}
//f();

/*
 * static变量不会存储引用(但是可以存储对象)
 */
function &get_instance_ref(){
    static $obj;

    echo 'Static Object: ';
    var_dump($obj);
    if(!isset($obj)){
        $obj = &new stdClass;/*当static存储引用时，二次调用函数后，该变量的值并未被保存下来，且运行上面程序会报Deprecated错误，即返回引用值赋值的用法已弃。*/
    }
    $obj->property++;
    return $obj;
}
function &get_instance_noref(){
    static $obj;

    echo 'Static Object: ';
    var_dump($obj);
    if(!isset($obj)){
        $obj = new stdClass;
    }
    $obj->property++;
    return $obj;
}
$obj1 = get_instance_ref();
$still_obj1 = get_instance_ref();
$obj2 = get_instance_noref();
$still_obj2 = get_instance_noref();
//1有结果，2没有。
