兴趣帮小程序后台代码

1、安装db
composer require swoft/db
DB配置文件在官方手册中有，Redis同理

2、安装Redis
composer require swoft/redis

克隆完项目之后需要composer install，导入vendor中需要的文件

3、修改swoft源文件的参数验证异常类即ValidatorException类
路径：xqb_mini/vendor/swoft/validator/src/Exception/ValidatorException.php，
让它继承自定义的ValidateException，就可以返回自定义的错误信息了，之前code一直是它默认的0，
这样子改了之后就可以返回我自定义的2001了。
