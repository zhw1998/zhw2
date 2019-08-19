<?php

/**
 * Class Controller
 * 控制器父类
 *
 * 访问权限控制
 *
 * 以及未来的功能
 */
class Controller
{
    protected $access_control = false;//设置是否开启访问权限控制

    protected $accessible_list = [];//设置允许未登录访问的操作（控制器方法）

    protected $login_identifier = 'user';//设置session中的登录检测标识

    protected $login_route = '/login';//设置未允许访问时跳转的登录页面

    public function __construct()
    {
        if ($this->access_control && !session($this->login_identifier) && !in_array($GLOBALS['action'], $this->accessible_list)) {
            return redirect($this->login_route);
        }
    }

}