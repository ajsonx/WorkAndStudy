<?php
/**
 * Created by PhpStorm.
 * User: ajsonx
 * Date: 2019/2/1
 * Time: 18:59
 * php运算符
 */

/*
 * 先运行右边
 * $h = $g+= 10 = $g; 这样写就是错误的，无法相等
 */
$g = 14;
$h = $g = $g+= 10;
//echo $h.' '.$g."\n";

/*
 * echo 11
 * 等式不分左右，字符都转换为整型比较
 */
if('top' == 0){
    echo 1;
}else{
    echo 0;
}
if(0 == 'top'){
    echo 1;
}else{
    echo 0;
}
/*
 * echo 0
 * 同类型不转换
 */
if('0' == 'top'){
    echo 1;
}else{
    echo 0;
}
/*
 * 1 < 2 > 1 不合法 <  >优先级相同
 * 1 <= 1 == 1 是合法的, 因为 == 的优先级低于 <=
 */
//echo 1 < 2 > 1; 报错
echo 1 <= 1 == 1; //echo 1;
echo "\n";
/*
 * php二进制 5.4.0
 * 要使用二进制表达，数字前必须加上 0b
 */
$num = 0b11;
echo $num;

/*
 * & 将两个数都为 1 的位设为 1
 * | 将两个数只要为 1 的位设为 1
 * ^ 两个数不同的位设为 1
 * << 左移$b位
 * >> 右移$b位
 * ～ 求反运算
 * $a 10; $b 11;
 * echo 2 3 1 16 0;
 */
$a = 2; $b = 3;
echo $a&$b;
echo $a|$b;
echo $a^$b;
echo PHP_EOL;
echo $a<<$b;
echo $a>>$b;