<?php

/*
 * 全局自动加载函数
 * 负责项目的类加载
 */
spl_autoload_register(function ($class_name) {
    //核心类的映射表
    $maps = array(
        'DB'         =>  __DIR__.'/DB.php',
        'Request'    =>  __DIR__.'/Request.php',
        'Router'     =>  __DIR__.'/Router.php',
        'Controller' =>  __DIR__.'/Controller.php',
        'Model'      =>  __DIR__.'/Model.php'
    );

    //判断是否是核心类
    if(in_array($class_name, array_keys($maps))) {

        require_once($maps[$class_name]);

    }
    //判断是否是模型
    elseif(preg_match('/Model$/', $class_name)) {

        $path = __DIR__ . '/../app/models/' . $class_name . '.php';
        require_once($path);

    }
    //判断是否是控制器
    else if(preg_match('/Controller$/', $class_name)) {

        $path = __DIR__ . '/../app/controllers/' . $class_name . '.php';
        require_once($path);

    }
    //判断是否是第三方服务
    else if(preg_match('/Service$/', $class_name)) {

        $path = __DIR__ . '/../services/' . $class_name . '.php';
        require_once($path);

    } else {

        dd('请求的类【'.$class_name.'】无法加载');

    }
});