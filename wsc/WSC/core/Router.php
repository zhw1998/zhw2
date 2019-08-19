<?php

/**
 * Class Router
 *
 * 负责路由的绑定与分发
 */
class Router
{
    //路由表
	protected static $routes = [
		'GET'     => [],
		'POST'    => [],
		'PUT'     => [],
		'DELETE'  => []
	];

    //加载路由配置文件
	private static function load($file)
	{
		require_once $file;
	}

    //负责绑定get路由请求
	public static function get($uri, $callback)
	{
		static::$routes['GET'][$uri] = $callback;
	}

    //负责绑定post路由请求
	public static function post($uri, $callback)
	{
		static::$routes['POST'][$uri] = $callback;
	}

	//负责绑定post路由请求
	public static function put($uri, $callback)
	{
		static::$routes['PUT'][$uri] = $callback;
	}

	//负责绑定post路由请求
	public static function delete($uri, $callback)
	{
		static::$routes['DELETE'][$uri] = $callback;
	}

    //负责路由分发，即请求处理
	public static function routes($uri, $requestType)
	{
	    self::load(__DIR__.'/../app/routes.php');

        //检测路由是否在路由表中存在
		if(!($route = self::route($uri, static::$routes[$requestType]))){
			dd('你请求的路由【'.$uri.'】不存在');
		}

        //获得路由携带的数据
        $parameters = self::retrieve_data($route, $uri);

        //提取键名对应的值
        $callback = static::$routes[$requestType][$route];

        //检测是否为回调函数
        if(is_callable($callback)) {
			//调用回调函数
			return call_user_func_array($callback, $parameters);
        }

		$pairs = explode('@', $callback);

        //执行路由请求
		return self::callAction($pairs[0], $pairs[1], $parameters);
	}

    //执行路由请求
	private static function callAction($controller, $action, $parameters)
	{
        $GLOBALS['controller'] = $controller;
        $GLOBALS['action'] = $action;

        //实例化控制器
		$controller = new $controller;

		if(!method_exists($controller, $action)) {
			dd('你请求的控制器【'.$controller.'】中的方法【'.$action.'】不存在');
		}

		call_user_func_array([$controller, $action], $parameters);
	}

    //检测路由是否在路由表中，存在返回路由表键名，否则false
	private static function route($uri, $routes)
	{
		$is_matched = false;

        //遍历路由表键名，检测是否匹配
		foreach($routes as $route=>$c)
		{
			$route_arr = explode('/',$route);
			$uri_arr = explode('/',$uri);

            //如果长度不一样，证明不匹配
			if(count($uri_arr) != count($route_arr)) {
				continue;
			}

            //如果长度一样，则进行细微匹配
            //检测是否在特征上匹配
            //如：/user/10 => /user/{id}
			$count = 0;
			for($i=0; $i<count($uri_arr); $i++) {
				if(!preg_match('/^{.+}$/i', $route_arr[$i]) && !preg_match("/^$route_arr[$i]$/i", $uri_arr[$i])) {
					break;
				}else{
					$count++;
				}
			}

            //如果匹配成功 返回匹配的路由表键名
			if($count == count($uri_arr)) {
				return $route;
			}
		}

        //如果始终没找到，返回false
		if(!$is_matched){
			return false;
		}
	}

    //根据路由表键名，获取路由中携带的参数
	private static function retrieve_data($route, $uri)
	{
		$route_arr = explode('/',$route);
		$uri_arr = explode('/',$uri);

        //遍历路由， 将与路由表键名匹配字段缓存
		for($i=0; $i<count($uri_arr); $i++) {
            //匹配
			if(preg_match('/^{.+}$/i', $route_arr[$i]) && !preg_match("/$route_arr[$i]/i", $uri_arr[$i])) {
				$parameters[] = urldecode($uri_arr[$i]);
			}
		}

        //如果数据为空返回空数组，否则返回数据
		return isset($parameters) ? $parameters : [];
	}
}