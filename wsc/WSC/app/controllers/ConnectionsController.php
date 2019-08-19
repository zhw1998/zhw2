<?php

/**
 * Created by PhpStorm.
 * User: 邹鸿威
 * Date: 2019/6/9
 * Time: 19:41
 */
class ConnectionsController extends Controller
{
    protected $access_control = true;//设置是否开启访问权限控制，如要开启必须设置

    protected $accessible_list = [];//设置允许未登录访问的操作（即控制器中的方法）

    protected $login_identifier = 'user';//设置session中的登录检测标识，根据编码设置

    protected $login_route = '/login';//设置未允许访问时跳转的登录页面，根据路由设置
    public function index(){
        $active = 'b';
        return view('app/connections/connections',compact('active'));
    }
    public function csearch(){
        $sw = $_POST['sw'];

        //按用户名和用户地址搜索
        $db = new DB();
        $users1 = $db->query('select headimg,username,adress,id from users where username like \'%'.$sw.'%\' or adress like \'%'.$sw.'%\'');
        //按学校和专业查找
        $userid = $db->query("select user_id from study where school like '%$sw%' or  major like '%$sw%'");
        $users2 = [];
        foreach ($userid as $u){
            $user = $db->query('select headimg,username,adress,id from users where id = '.$u->user_id);
            $users2 = array_merge_recursive($users2,$user);
        }
        $type = 2;
        return view('app/connections/connection',compact('users1','users2','type'),'html');

    }
    public function tuijain($num){
        //获取推荐用户
        $userid = $_SESSION['user'][0]->id;
        $adress = $_SESSION['user'][0]->adress;
        $users4 = [];
        $users3 = [];
        if($adress){
            $db = new DB();
            //根据地区
            $users4 = $db->query("select headimg,username,adress,id from users where adress like '%$adress%'");

            //根据学校和专业推荐
            $a = $db->query('select school,major from study where user_id = '.$userid);
            $school = $a[0]->school;
            $major = $a[0]->major;
            $userids = $db->query("select user_id from study where school = '$school' or major = '$major'");
            foreach ($userids as $u){
                $user = $db->query('select headimg,username,adress,id from users where id = '.$u->user_id);
                $users3 = array_merge_recursive($users3,$user);
            }
        }
        $type = 1;
        return view('app/connections/connection',compact('users4','users3','type'),'html');
    }
}