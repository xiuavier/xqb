Special thanks to JetBrains for offering free licenses to our open source project.
Please visit this website for more information: https://www.jetbrains.com/?from=xqb
![Image text](https://raw.githubusercontent.com/xiuavier/xqb/master/resource/jetbrains.png)




兴趣帮小程序后台代码手册

1、安装db
composer require swoft/db
DB配置文件在官方手册中有，Redis同理

2、安装Redis
composer require swoft/redis

3、克隆完项目之后需要composer install，导入vendor中需要的文件
因为很多文件都是在composer中的，直接克隆下来的项目连app文件夹都没有，哈哈哈太奇葩了

4、修改swoft源文件的参数验证异常类即ValidatorException类
路径：xqb_mini/vendor/swoft/validator/src/Exception/ValidatorException.php，
让它继承自定义的ValidateException，就可以返回自定义的错误信息了，之前code一直是它默认的0，
这样子改了之后就可以返回我自定义的2001了。

5、新建数据库模型Entity的命令
新建表对应的Entity：    php ./bin/swoft entity:create 表名
查看帮助信息：          php ./bin/swoft entity:create -h

6、HTTP项目启动：
切换到根目录下执行：php ./bin/swoft http:start ，这个不是守护进程
php ./bin/swoft http:start -d 这个是以守护进程启动

7、服务器项目热更新代码
切换到项目根目录下执行：php ./bin/swoft http:reload，执行成功即可重新加载项目代码

8、.env文件需要复制
cp .env.example .env

9、HTTP服务器的reload和restart命令
php ./bin/swoft http:reload 表示重新加载工作进程
php ./bin/swoft http:restart 表示重新启动HTTP服务器，git pull更新了代码之后执行该命令
才能成功更新代码

10、要复制根目录下的aliSDK文件夹中的voduploadsdk文件夹到vender文件夹中的alibabacloud下
这样子才能有后台上传SDK使用。这个SDK阿里云没有放在composer中，所以没有办法使用composer安装
实在是蛋疼
