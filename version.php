<?php
/**
 * Created by PhpStorm.
 * User: ajsonx
 * Date: 2019/2/5
 * Time: 14:05
 * php版本间的差别
 */
/*
 * PHP7.2 版本修改
 * each() 返回数组中当前的键／值对并将数组指针向前移动一步,使用 foreach 代替
 * count() 返回数组中元素的数目
 * create_function() 创建函数
 */

$arr = array(1,2,3,4);
while (list(, $value) = each($arr)) {
    echo "Value: $value<br>\n";
}
reset($arr); //必须要将指针重新指向最上方
while(list($key,$value) = each($arr)) {
    echo "Key: $key Value: $value<br />\n";
}
//等价于
foreach ($arr as $value) {
    echo "Value: $value<br />\n";
}
foreach ($arr as $key => $value){
    echo "Key: $key Value: $value<br />\n";
}

/*
 * count(array,mode);
 * mode:
 * 0 - 默认。不对多维数组中的所有元素进行计数
 * 1 - 递归地计数数组中元素的数目（计算多维数组中的所有元素）
 * 在7.2版本中将严格执行类型区分，参数类型不正确，将会出现警告，所以需要在使用count方法时注意参数的值，不过也可以通过自己修改方法来替代(不建议)：
 */

count('');
// Warning: count(): Parameter must be an array or an object that implements Countable
if(is_array($arr) || is_object($arr)) {
     count($arr,COUNT_NORMAL);
}

/*
 * create_function(string $args, string $code) 参数,代码
 * return unique function name as a string,or false on error
 * 一般用来创建匿名函数，该方法在PHP7.2.0已经废弃
 * 与eval()类似 但eval有安全问题
 */
$newfunc = create_function('$a,$b', 'return "ln($a) + ln($b) = " . log($a * $b);');
echo "New anonymous function: $newfunc\n";
echo $newfunc(2,M_E)."\n";

//使用匿名函数替换
$av = array("the ","a ","that ","this ");
array_walk($av,function(&$v,$k){ //array_walk(array,function,userdata)
    $v = $v . "sun";
});
var_dump($av);