<?php

//引导配置文件
require __DIR__.'/core/bootstrap.php';

//载入路由并且进行路由分发（请求处理）
Router::routes(Request::uri(), Request::method());

