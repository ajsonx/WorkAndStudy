
# 在工作过程中收集的php使用技巧

* 后端传递的url中带`#`号
    urlencode
    转义 # 号为 %23
* post中的参数值带`#`号

* 方法中命名静态有啥区别？？

    * 静态方法不需要实例化类
    * 静态方法效率上比实例化高，但不自动进行销毁
    * 静态方法和静态变量创建后始终使用同一块内存
    * 静态方法中不能使用$this 因为对象还没创建

## 函数

### Array

* `array_merge` 合并两个数组，不改变键值。类似的还有`array_combine` 

 - 创建一个数组，用一个数组的值作为其键名，另一个数组的值作为其值

* `array_push` 但会改变健名

* `array_merge_recursive`不会进行键名覆盖，而是将多个相同键名的值递归组成一个数组。

	该函数与 `array_merge` 函数的区别在于处理两个或更多个数组元素有相同的键名时。


````php
function merge ($str,$sp="|",$kv="=")
{
    $arr = str_replace(array($kv ,$sp ),
        array('"=>"','","'), 'array("'.$str.'")');
        
    eval("\$arr"." = $arr;");   // 把字符串作为PHP代码执行
    return $arr;
}

````

* `array_diff` 并不是名义上的返回多个数组的差集，简而言之应该是返回第一个参数数组中独一无二的（和后面参数的并集相比较）

  ```php
  $a=array("红");
  $b=array("红","S","酸");
  $res=array_diff($a,$b) ;
  var_dump($res);//空数组
  ```

  计算对称差积：

  ```php
  array_diff(array_merge(array_diff($a,$b),array_diff($a,$b) ));
  ```




### String

* 
* 



### File

* 遍历文件夹下所有文件

  ```
  foreach (glob('./dir/*') as $file ); //返回文件路径的数组
  is_file($file);
  is_dir($file);
  ```

### Curl

```php
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //获取页面内容在变量中
$output = curl_exec($ch);

```



##Vendor

### PhpSpreadsheet（Excel）

> 导出5万行、两列以上的Excel表格耗尽php内存

* 操作一行excel内容约占用`1k`内存

* 引入外部缓存Redis/Memcache

  * `Settings::setCache`虽然减少了内存，接口耗时成倍增长，效果不理想

* `ini_set('memory_limit','512M');`  不建议这么做

* PHP`memory_limit`限制的是`emalloc()`分配的内存，即`memory_get_peak_usage()`不传`true`获取到的峰值内存用量。

*     `$str .= '╔结果数组：'.(memory_get_usage()/1024/1024)."MB\r\n";
      $str .= '╠此前峰值内存：'.(memory_get_peak_usage()/1024/1024)."MB\r\n";`
  
  ```php
  $writer = new Xlsx($spreadsheet);
  $writer->setPreCalculateFormulas(false); //关闭预处理
  $writer->save($file);
```
      
* save()保存输出的过程中是最消耗内存的。

* 数据行列过多建议使用文本拼接生成csv文件。

### Guzzle（network-request）



## 简化项目配置

配置marketing 项目时 
常规操作 `tangram build local`配置环境  +  `composer install` 
进入到项目application/admin/public 下

执行 `php -S localhost:8083 ./index.php `  

此方式使用php自带服务器，自`PHP5.4.0`之后支持

## 该框架的设计方式？

设计初衷
多个service层是为了啥，已有C层，M层  service在这两个中间的作用？ 为了衔接什么？



## PDO问题记录

- 问题描述 执行14万长度的INSERT语句 成功，但执行15万长度时报错指向：`PDO::bindValue()`
- 排查过程
  1. Sql有问题：打印输出。对比发现 sql是以占位符形式的 没有问题。
  2. bindParam 数组大小限制：php对数组无大小限制，string字符最大可以达到16MB，而16万长度的sql也才16万字节，0.12MB
  3. 后发现在执行 `PDO::prepare($sql)` 时不返回数据库对象
  4. 查阅资料，`PDO::prepare($sql)` 中预处理方式有两种： 将带占位符的 sql 语句与 bindParam 分开发给 Mysql
     或者是 直接以一条 拼接好的 sql 直接发给 Mysql 处理。
  5. prepare()函数的处理方式与 参数 `PDO::ATTR_EMULATE_PREPARES` 的值 （`TRUE OR FALSE`) 有关
     `ATTR_EMULATE_PREPARES`，当这个开关为`true`时，就由本地PHP来处理SQL语句，然后再把语句发往数据库。而如果这个开关的值为false，则PHP不会处理SQL语句，而是把含有占位符的SQL语句及相关变量一起放送往数据库，并由数据库自己来处理。
  6. 以本地处理的形式时，会受本地的php缓存大小影响，因此会出现溢出等问题。
  7. 但其实是在 FALSE  情况下失败              

## 请求头是 Content-type: application/json

- 旧版本php： `$GLOBALS ["HTTP_RAW_POST_DATA"]`
- 新版本的PHP 改用 `file_get_contents('php://input')`

