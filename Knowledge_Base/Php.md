# php的基础知识


## 垃圾回收机制

* 当没有任何变量指向该对象时，对象被销毁。
* 内存中对变量有引用计数，当计数到0时被销毁。
* php5.?之前的版本会存在数组环形问题。

## ob_flush和flush()的区别

*   ob_*系列函数, 是操作PHP本身的输出缓冲区. 
  所以, ob_flush是刷新PHP自身的缓冲区. 

  而flush, 严格来讲, 这个只有在PHP做为apache的Module(handler或者filter)安装的时候, 才有实际作用. 它是刷新WebServer(可以认为特指apache)的缓冲区

  [ob_flush和flush的深入理解](https://blog.csdn.net/superhosts/article/details/42292053)