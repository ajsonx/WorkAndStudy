# my.cnf

	query_cache_type = 1;
		if ( type == 1 && size == 0)查询缓存被禁用
		if ( type == 0 && size == 0)查询缓存被禁用
		if ( type == 0 && size != 0)查询缓存被禁用
	query_cache_size = 128MB;
		表示分配多少内存
	query_cache_limit = 1MB;
		定义被缓存的查询结果最大体积


# 存储引擎

* MyISAM
	* 和SELECT搭配，整张表偏静态，数据不经常变更
	* 表级锁。在表中的数据执行一个特定的操作，整张表将会锁起来
	* 全文索引
	* 数据压缩、自我复制、查询缓存、数据加密
	* 不支持外键
	* 不支持事务等高级处理,所以没有COMMIT和ROLLBACK操作。如果表上执行了一个查询，则没有回退的余地
	* 不支持集群数据库
	* 

* InnoDB
	* 高可靠性和高性能而设计的，适合处理大量数据
	* 支持行级锁
	* 支持外键，对外键约束强制
	* 支持事务
	* 支持数据压缩、自我复制、查询缓存、数据加密
	* 可以用在集群环境，但是没有完全支持。可以转换为NDB存储引擎，就能用在集群环境
	* innodb_buffer_pool_size
		这个配置定义了InnoDB数据和载入内存的索引可以使用多少内存空间
		推荐此配置值为服务器内存的50%-80% 
	* innodb_buffer_pool_instances
		它使得多个缓冲区池实例能相互配合，以此来减少在64位系统以及innobd_buffer_pool_size较大时出现内存竞争的可能性





# in和exists  
测出来没感觉。。。可能数据太小了

in 是把外表和内表作hash 连接，而exists是对外表作loop循环，每次loop循环再对内表进行查询。
如果两个表中一个较小，一个是大表，则子查询表大的用exists，子查询表小的用in：
例如：表A（小表），表B（大表）1：select * from A where cc in (select cc from B)
效率低，用到了A表上cc列的索引；
select * from A where exists(select cc from B where cc=A.cc)
效率高，用到了B表上cc列的索引。

相反的2：select * from B where cc in (select cc from A)
效率高，用到了B表上cc列的索引；select * from B where exists(select cc from A where cc=B.cc)
效率低，用到了A表上cc列的索引。
not in 和not exists
如果查询语句使用了not in 那么内外表都进行全表扫描，没有用到索引；
而not extsts 的子查询依然能用到表上的索引。所以无论那个表大，用not exists都比not in要快。

# 批量修改

MySQL批量修改不同的记录为不同的值呢？
UPDATE mytable SET
    myfield = CASE id
        WHEN 1 THEN 'value'
        WHEN 2 THEN 'value'
        WHEN 3 THEN 'value'
    END
WHERE id IN (1,2,3)


