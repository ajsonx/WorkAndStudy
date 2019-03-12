<?php
/**
 * 经典面试题
 * Created by PhpStorm.
 * User: ajsonx
 * Date: 2019/2/12
 * Time: 16:15
 */

/*
 * 最里层打印 $i 的值 111
 * 外层打印 $i 的类型 3 (INT(3) )
 * 再有就是打印 3 的类型 1 (INT(1) )
 */
$i='111';
printf("%d\n",printf("%d",$i));
printf("%d\n",printf("%d",printf("%d",printf("%d",$i))));
var_dump(printf("%d",$i));

/*
 * 函数名不区分大小写
 * 可以以下划线开头,不能以数字开头
 * 一般以下划线开头的变量或方法，代表类的私有成员
 */
$a = 'ab';
echo gettype($a);
echo GETTYPe($a).PHP_EOL;
$_arg = 's';
function _print(){
    global $_arg;
    print $_arg.PHP_EOL;
}
_print();

/*
 * 变量未赋值都是null
 * ++ 变成 1
 */
static $count;
echo $count; //未赋值是Null 什么也不输出
$count++;  //变成1
echo $count.PHP_EOL;

/*
 * str_split($str,$length)
 * 原字符串，分割到每个数组的长度 默认是1
 * 把字符串分割到数组中
 */
$str = "helloworld";
$arr = str_split($str,1);
foreach ($arr as $v){
    printf("%s",$v);
}echo PHP_EOL;

/*
 * 身份证正则表达式
 * 限制 首位不为0 1800-2300 日期
 */
$str = '350182199706312035';
$pattern = '/^[1-9]\d{5}(18|19|2[0-3])\d{2}(0[1-9]|10|11|12)(([0-2][1-9])|10|20|30|31)\d{3}[0-9Xx]$/is';
preg_match($pattern,$str,$match);
var_dump($match);
$str1 = '350182';
$pattern1 = '/^(?:[1-9]\d{5})$/';
var_dump(preg_match($pattern1,$str1,$matchs));
var_dump($matchs);

/*
 * 正则表达式反向引用
 * preg_replace($pattern,$replacement,$str);
 * 正则，替换串，原字符串
 */
$str = "April 15,2003";
$pattern = '/(\w+) (\d+),(\d+)/i';
$replacement = '${1}22,$3';
echo preg_replace($pattern,$replacement,$str);

/*
 * 输入格式为"get-element-by-id"的任意字符串，将其转换为驼峰命名的字符串。
 * 例如getElementById
 * strtok($str,$split)
 * 分割同一个字符串，仅需在第一次调用 $str 参数，后续仅需要 split 参数。返回
 * 这是因为它清楚自己在当前字符串中所在的位置。
 * 如需分割一个新的字符串，请再次调用带 string 参数的 strtok()
 */
$str = 'get-element-by-id';

$temp = strtok($str,'-');

$ans = array();
while($temp !== false){
    array_push($ans,$temp);
    $temp = strtok('-');
}
var_dump($ans);

for($i = 1; $i < sizeof($ans);$i++){
    $ans[$i] = ucfirst($ans[$i]);
}

$str_ans = implode($ans);

echo $str_ans.PHP_EOL;


/*
 * $a['12345']=1;
 * $a[12345]=null;
 * 执行以上两行代码后，
 * isset($a[12345])和empty($a['12345'])的结果分别是_____
 *
 * 首先 这两行代码顺序执行，其次变量赋值为 null 时会释放内存
 * 并且 $a['12345'] 等价于 $a[12345]
 * 所以答案为 false true
 */

/*
 * array('a')+array('b') 的结果是____________?
 * 它们的 key 值都为 0 ，前者不会被后者覆盖 所以值还是 a
 */
$a =  array([
    '0' => 'a'],[
    2 => 'b',
    3 => 'c',
]);

$b =  array(3 =>[
    1 => 'e',
    2 => 'f',
    3 => 'g',
    4 => 'f',
]);

var_dump($a+$b);

var_dump(array('1'=> 'c') + array('2' => 'b'));

//拓展：同一个数组里，后者会覆盖前者，输出 'e' 因为 '1' == 1
$c = ['1' => 'c','1' => 'b', 1 => 'e'];
var_dump($c);