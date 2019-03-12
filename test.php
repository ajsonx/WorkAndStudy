<?php
/**
 * Created by PhpStorm.
 * User: ajsonx
 * Date: 2019/1/31
 * Time: 12:16
 */

function sum(){
    $a = 1;
    $x = &$a;
    $b = ($a++); //此处括号等于没加
    echo $a.' '.$x.' '.$b."\n";
}
sum();
$a = 3; $b = 5;
if($a = 5 || $b = 7){
    $a++;
    $b++;
}
echo $a.' '.$b.PHP_EOL;
mt_rand(1,5);//返回结果速度比rand快
echo mt_getrandmax().PHP_EOL; //默认是2^31-1
$flag = rand(1,5); //包含边界值
switch ($flag){
    case '1':
        echo 1;
        break;
    case '2':
        echo 2;
        break;
    case '3':
        echo 3;
        break;
    default:
        break;
}

/*
 * echo isset(array(array()));这么写报错
 * empty(array()) 返回true; empty(array(array()))返回false;
 * 返回false 使用echo 不输出
 * 返回true 使用echo 输出 1
 */
echo isset($error);
echo empty(array());