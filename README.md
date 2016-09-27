# Graylog 日志系统

### 支持框架   

    ThinkPHP 3.2 
    ThinkPHP 3.0 
    ... ...

## 以ThinkPHP 3.2 为例 3.2 以下版本及别的框架请参考 3.2
### 首先使用 `composer` 安装graylog
    
在自己项目根目录下使用如下命令：
`composer require graylog2/gelf-php`
或在 *composer.json* 下添加：
```
"require": {
    // ...
    "graylog2/gelf-php": "^1.5"
    // ...
}

```
在执行 `composer update`

### 其次修改配置   
在 *Application/Common/Conf/config.php* 中加入
```

// ...
LOG_RECORD => true, // 开启日志
LOG_TYPE    =>  'graylog', // 日志类型
LOG_GRAY_PATH   => 'graylog.***.com:5502', // 域名：端口号
// ...

```

### 最后把 *Graylog.class.php* 放到项目的 Log 驱动中即可.
如: *ThinkPHP/Library/Think/Log/Driver/*

