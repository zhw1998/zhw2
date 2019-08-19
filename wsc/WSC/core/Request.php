<?php

/**
 * Class Request
 *
 * 提供请求相关数据
 */
class Request
{
    //获得请求的uri
	public static function uri()
	{
		return isset($_SERVER['REDIRECT_URL'])?$_SERVER['REDIRECT_URL']:'/';
	}

	//获得请求的前置路由 如果没有返回false
	public static function referer()
	{
		return isset($_SERVER['HTTP_REFERER'])?parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH):false;
	}

	//获得请求的ip
	public static function ip($numeric = false)
	{
        if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
            $ip = getenv('HTTP_CLIENT_IP');
        } elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
            $ip = getenv('HTTP_X_FORWARDED_FOR');
        } elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
            $ip = getenv('REMOTE_ADDR');
        } elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        $res =  preg_match ( '/[\d\.]{7,15}/', $ip, $matches ) ? $matches [0] : '';

        if(empty($res)){
            return false;
        }

	    if($numeric){
			return ip2long($res);
		}else{
			return $res;
		}
	}

    //获得请求的方法
	public static function method()
	{
		if(isset($_GET['_method']) || isset($_POST['_method'])){
			$method = isset($_GET['_method']) ? [strtoupper($_GET['_method']), true] : [strtoupper($_POST['_method']), false];
			if(isset($_GET['_method'])){
				unset($_GET['_method']);
			}else{
				unset($_POST['_method']);
			}
		}

		if(isset($method) && ((!$method[1] && in_array($method[0], ['PUT','DELETE'])) || ($method[1] && in_array($method[0], ['DELETE'])))) {
			return $method[0];
		}

		return $_SERVER['REQUEST_METHOD'];
	}
}