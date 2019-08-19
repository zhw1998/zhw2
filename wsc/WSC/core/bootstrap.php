<?php

require __DIR__.'/autoload.php';//加载自动加载机制

require __DIR__.'/../app/config.php';//绑定全局配置

require __DIR__.'/helper.php';//加载全局帮助函数

//根据配置指定生产以及开发模式的错误配置
if(C('app.debug')){
    error_reporting(E_ALL);
}else{
    error_reporting(0);
}

//时区设置
date_default_timezone_set(C('app.timezone'));

//设置字符编码
header('Content-Type:text/html;charset='.C('app.charset'));

//开启session
session_start();