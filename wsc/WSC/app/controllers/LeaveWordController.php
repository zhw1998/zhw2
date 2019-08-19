<?php

/**
 * Created by PhpStorm.
 * User: 邹鸿威
 * Date: 2019/6/9
 * Time: 1:04
 */
class LeaveWordController extends Controller
{
    protected $access_control = true;//设置是否开启访问权限控制，如要开启必须设置

    protected $accessible_list = [];//设置允许未登录访问的操作（即控制器中的方法）

    protected $login_identifier = 'user';//设置session中的登录检测标识，根据编码设置

    protected $login_route = '/login';//设置未允许访问时跳转的登录页面，根据路由设置

    //显示所有留言
    public function showlw($id){
        $db = new DB();
        $lws = $db->query('select * from leaveword where user_id = '.$id.' order by time desc');
        //获取留言人信息
        $users =  [];
        foreach ($lws as $lw){
            $sql = 'select id,username,headimg  FROM users where id = '.$lw->lw_id;
            $n = $db->query($sql);
            $users = array_merge_recursive($users,$n);
        }
        $lwsnum = $db->find('select COUNT(*) as num from leaveword where user_id ='.$id);

        return view('app/leaveword/leavewords',compact('lws','users','id','lwsnum'),'html');
    }
    //添加留言
    public function addlw(){
        $user_id = $_POST['user_id'];
        $lw_id = $_SESSION['user'][0]->id;
        $content = $_POST['content'];
        $time = date('Y-m-d h:i:sa');
        $db = new DB();
        $rs = $db->save('leaveword',['user_id'=>$user_id,'lw_id'=>$lw_id,'content'=>$content,'time'=>$time]);
        if($rs){
            echo 'ok';
        }else{
            echo 'no';
        }
    }
    //删除留言
    public function deletelw($id){
        $db = new DB();
        $rs = $db->query('delete from leaveword where id = '.$id);
        if($rs){
            echo 'ok';
        }else{
            echo 'no';
        }
    }
}