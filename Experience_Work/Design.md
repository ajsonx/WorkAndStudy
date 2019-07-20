# 一些设计思想的记录

## OAtuh or SSO ?
* 现况
1.已有SSO
2.当前系统登陆接口
3.前后端分离

* 问题描述
1.SSO系统接口不直接返回用户信息，重定向一个url并返回一个token。token相当于sessionId，根据token获取用户信息
	* url只存在于后台系统，不可实现直接重定向到前端界面，这样获取用户信息还要一个接口
2.本机配置前后端不同域名，cookie不可跨域，正式环境同域名

* 设计思路
1.设计一个thirdlogin接口，用于接收post请求。并在sso登陆得到token。再调用sso的接口校验token获取用户信息，此时返回给前端用户数据并跳转界面。

* 登出设计
  token只存在于本地，清除本地的token
* 多种登陆方式如何判断？？

### SSO与OAuth的区别

- SSO是为了解决一个用户在鉴权服务器登陆过一次以后，可以在任何应用中畅通无阻，一次登陆，多系统访问，操作用户是实打实的该应用的官方用户，用户的权限和分域以鉴权服务器的存储为准。
- OAuth2.0解决的是通过令牌获取某个系统的操作权限，因为有clientId的标识，一次登陆只能对该系统生效，第三方应用的操作用户不是鉴权系统的官方用户，授权权限鉴权中心可以做限制。



## RBAC 基于角色的访问控制（Role-Based Access Control)

管理员 - 组 - 权限 

管理员表`id`,`role_id`
角色表`id`,`role_auth_id`
权限表`id`,`auth_c`,`auth_a`,`auth_level` 权限控制器，权限方法，权限等级

* Php编写
CommonControl 基础权限控制器
	auth方法返回true/false 判断当前控制器用户是否有权限访问
xxControl 继承Common 调用auth



