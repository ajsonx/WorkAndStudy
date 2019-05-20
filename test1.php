<?php
/**
 * Created by PhpStorm.
 * User: ajsonx
 * Date: 2019/2/8
 * Time: 15:20
 */

/**
 * Q:把$arr1 转换为 $arr2
 */
$arr1 = array(
    '0' => array('fid' => 1,'tid' => 1,'name' => 'Name1'),
    '1' => array('fid' => 1,'tid' => 2,'name' => 'Name2'),
    '2' => array('fid' => 2,'tid' => 3,'name' => 'Name3'),
);
$arr2 = array(
    '0' => array(
        '0' => array('fid' => 1,'tid' => 1,'name' => 'Name1'),
        '1' => array('fid' => 1,'tid' => 2,'name' => 'Name2'),
    ),
    '1' => array('fid' => 2,'tid' => 3,'name' => 'Name3'),
);

$result = [];
foreach ($arr1 as $key => $value){
    $result[$value['fid']][] = $value;
}
$arr2 = array_values($result);
//print_r($arr2);

$a = array('a' => 'bill' , 'b' => 'tom' , 'c' => 'jack');
print_r(array_values($a));// [0]=>bill, [1]=>tom,[2]>=jack;

echo microtime().PHP_EOL;
$a = array_sum(explode(' ',microtime()));
var_dump($a);

$arr3 = array(1,2,3,4,5,'0','z');
echo max($arr3).PHP_EOL; //5
echo min($arr3).PHP_EOL; //0
echo array_search('z',$arr3); //6

print_r(array_shift($arr3));
print_r($arr3);

/**
 * str_split() 将字符串分割为单个字符存放到数组中
 * serialize()
 * implode(separator,array) 将数组拼成string,可选分割符
 */

$str = 'i feel bad';
print_r(str_split($str));
var_dump(serialize($str));
echo implode('-',$arr3);//2-3-4-5-0-z
