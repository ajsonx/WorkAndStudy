<?php
  
  /**
  * $GLOBALS 全局组合数组,包含全部变量 严格区分大小写
  * 变量区分大小写，类名和方法名不区分
  * 变量必须初始化 $a = '';
  **/
  $x = 123 ; $y = 321; $X = 456;$z = 0;
  function test(){
    $GLOBALS['Z'] = $GLOBALS['x'];
    echo $GLOBALS['x']."\n";
    echo $GLOBALS['X']."\n";
    /**
    * 也可以使用global在方法内引入非全局变量
    **/  
    global $x,$y,$z;
    $z = $x + $y;
}
    test();
    //方法名大小写无所谓，都可以执行
    //  Test();
    //  TEST();	  
    echo $z."\n";
    /**
    * $_SERVER['PHP_SELF'] 当前执行脚本文件
    * $_SERVER['SERVER_ADDR'] 当前脚本所在服务器IP ,通过浏览器才显示，cli下模式未定义
    * $_SERVER['PATH_TRANSLATED']当前脚本所在文件系统的基本路径
    * $_SERVER['SCRIPT_NAME'] 当前脚本的路径
    **/
   
    /**
     echo $_SERVER['PHP_SELF']."\n";
     echo $_SERVER['SERVER_NAME']."\n";
     echo $_SERVER['HTTP_HOST']."\n";
     echo $_SERVER['REQUEST_TIME']."\n";
     echo $_SERVER['REMOTE_ADDR']."\n";   
     echo $_SERVER['PATH_TRANSLATED']."\n";
     echo $_SERVER['SCRIPT_NAME']."\n";
    **/

    /**
    * $_REQUEST 收集表单提交的数据
    * $_REQUEST['任意表单名']
    * $_GET
    * $_POST
    * $_SERVER
    * $GLOBALS
    * $_FILES 处理文件上传
    * $_ENV 通过环境方式传给当前脚本变量的数组，一般是当前系统环境
    * $_COOKIE  存在于客户端，可设置过期时间，根据过期时间不同保存在内存，硬盘，浏览器缓存。大小3K 之内
    * $_SESSION  保存在服务器上 安全性更高，访问增多占用服务器性能，这是考虑COOKIE
    **/
    //echo $_ENV["USER"]."\n";
    //echo $_ENV['COMPUTERNAME'];
    var_dump($_ENV);
    /*
     * PHP中的$_ENV存储了一些系统的环境变量，因为牵扯到实际的操作系统，所以不可能给出$_ENV的完整列表。
     * $_ENV为空的可能原因：
     * php.ini的variables_order值为"GPCS"，也就是说系统在定义PHP预定义变量时的顺序是 GET,POST,COOKIES,SERVER,没有定义Environment(E)，
     * 可以修改php.ini文件的 variables_order值为你想要的顺序，如："EGPCS"。这时，$_ENV的值就可以取得了。
     * EGPCS是Environment、Get、Post、Cookies、Server的缩写，这是PHP中外部变量来源的全部范围，可以用print_r($_ENV)来打印这个变量，查看他的数据。
     * 注意，生产环境下，$_ENV都是空数组，主要是为了安全起见，不让它获取操作系统信息！
     * $_ENV，PHP的第9个超全局变量
     */