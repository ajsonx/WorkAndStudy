<?php
	/**
	* 数组
	**/
	//count()函数统计数组长度。数组下标从0开始
	$arr = array(1,2,3,4);
	for($i = 0 ; $i < count($arr); $i++){
		echo $arr[$i]."\n";
	}
	$relation_arr = array(1=>'2');
	//使用关联数组的键，必须带引号
	echo $relation_arr['1']."\n";
	//关联数组key值一定为字符或字符串，value值可以写为字符或者数值类型
	if($relation_arr['1']===2){
		echo "YES\n";	
	}
	/**
	* foreach循环  $要循环的数组 as 键 => 值
	**/
	foreach($arr as $x){
		echo $x.' ';
	}echo "\n";
	foreach($relation_arr as $key=>$value){
		echo $x.'====>'.$value;	
	}
	/**
	* 各种排序方法
	* sort()升序排序 数字根据大小，字符根据首字母字典序排序
	* rsort()降序排序
	* asort()根据关联数组的值 升序排序  用于索引数组根据值排序
	* ksort()根据关联数组的键 升序排序  用于索引数组时根据下标排序
	* arsort()根据关联数组的值，降序排序
	* krsort()根据关联数组的键，降序排序
	*
	**/
	//双引号单引号都能解析字符串

	/*
	 * PHP 数组是通过哈希表(HashTable)表实现的，
	 * 因此 foreach 遍历数组时是依据元素添加的先后顺序来进行的。
	 * 如果想按照索引大小遍历，应该使用 for() 循环遍历。
	 * foreach 所操作的是指定数组的一个拷贝，而不是该数组本身。
	 * 对返回的数组单元的修改也不会影响原数组（见下面例子）
	 * php7 新版本foreach 数组指针不移动 php5版本数组指针移动
	 */
    $strArr = array('a','b','z','c','sort','array','zzzz');
    print_r($strArr);
    foreach($strArr as $value){
        echo $value.PHP_EOL;
    }
    /*
     * reset()重置数组指针，移到最上方
     * key() 返回当前指针的key值
     * current() 返回当前指针的value值
     * next() 将数组指针向下移动一格
     * end() 将数组指针移动到最后一个
     */
    $znArr = array(1 => "你",2 => "我是你爹", 3 => "嗯冲",'X' => 'hello');
    echo key($znArr);
	echo current($znArr);
    $v = next($znArr); //value
    echo "next is $v \n";
    echo key($znArr);
    echo current($znArr);