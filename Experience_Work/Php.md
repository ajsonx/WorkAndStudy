
# 在工作过程中收集的php使用技巧

* 后端传递的url中带`#`号
    urlencode
    转义 # 号为 %23
* post中的参数值带`#`号

* 方法中命名静态有啥区别？？


## 关于函数
* `array_merge` 合并两个数组，不改变键值。类似的还有
`array_combine` array_combine() - 创建一个数组，用一个数组的值作为其键名，另一个数组的值作为其值
`array_push` 但会改变健名
array_merge_recursive() 不会进行键名覆盖，而是将多个相同键名的值递归组成一个数组。“该函数与 array_merge() 函数的区别在于处理两个或更多个数组元素有相同的键名时。

string TranAbbr=IPER|AcqSsn=000000073601|MercDtTm=20090615144037
        => 'TranAbbr' => 'IPER' 
再变成数组

function merge ($str,$sp="|",$kv="=")
{
    $arr = str_replace(array($kv,$sp),array('"=>"','","'),'array("'.$str.'")');
    eval("\$arr"." = $arr;");   // 把字符串作为PHP代码执行
    return $arr;
}


## 简化项目配置

配置marketing 项目时 
常规操作 `tangram build local`配置环境  +  `composer install` 
进入到项目application/admin/public 下

执行 `php -S localhost:8083 ./index.php `  

## 该框架的设计方式？

设计初衷
多个service层是为了啥，已有C层，M层  service在这两个中间的作用？ 为了衔接什么？

## X-sendfile blog

## HTTP-Referer 阮一峰
