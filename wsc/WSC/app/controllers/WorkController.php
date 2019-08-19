<?php

/**
 * Created by PhpStorm.
 * User: 邹鸿威
 * Date: 2019/6/10
 * Time: 9:08
 */
class WorkController extends Controller
{
    protected $access_control = true;//设置是否开启访问权限控制，如要开启必须设置

    protected $accessible_list = [];//设置允许未登录访问的操作（即控制器中的方法）

    protected $login_identifier = 'user';//设置session中的登录检测标识，根据编码设置

    protected $login_route = '/login';//设置未允许访问时跳转的登录页面，根据路由设置

    public function index(){
        $active = 'c';
        return view('app/work/works',compact('active'));
    }

    public function addwork(){

        $para = [
            'workname'=>$_POST['workname'],
            'workprice'=>$_POST['workprice'],
            'workadress'=>$_POST['workadress'],
            'workcontent'=>$_POST['workcontent'],
            'workask'=>$_POST['workask'],
            'workphone'=>$_POST['workphone'],
            'time'=>date('Y-m-d'),
            'user_id'=>$_SESSION['user'][0]->id
        ];

        $db = new DB();
        $rs =  $db->save('work',$para);
        if($rs){
            error('发布成功！');
        }else{
            error('发布失败！');
        }
        return back();
    }
    public function tjwork($num){
        //获取前二十个最新招聘 且在同地区
        $user_id = $_SESSION['user'][0]->id;
        $db = new DB();
        $rs = $db->find('select adress from users where id = '.$user_id);
        $adress = trim($rs->adress);
        $works = $db->query("select * from work where workadress like '%$adress%'  order by time desc limit $num ");
        return view('app/work/work',compact('works'),'html');
    }

    public function searchwork(){
        $w = $_POST['sw'];
        $db = new DB();
        $works = $db->query("select * from work where workadress like '%$w%' or workname like '%$w%'");

        return view('app/work/work',compact('works'),'html');
    }

    public function workdetail($id){
        $db = new DB();
        $work = $db->find("select * from work where  id = $id");
        //查询已投简历数
        $count = $db->find("select count(*) as count from forwork where work_id = $id")->count;
        //查询已投简历用户的信息
        $userid = $db->query("select user_id from forwork where work_id = $id order by time desc");
        $users = [];
        foreach ($userid as $id){
            $id = $id->user_id;
            $user = $db->query("select headimg,id,username from users where id = $id");
            $users = array_merge_recursive($users,$user);
        }

        return view('app/work/workdetail',compact('work','count','users'));
    }
    public function postwork($id){
        $user_id = $_SESSION['user'][0]->id;
        //先查询是否已存在简历
        $db = new DB();
        $rs = $db->find("select * from forwork where user_id = $user_id and work_id = $id");
        if($rs){
            echo '您已递交过简历';
        }else{
            $time = date('Y-m-d');
            $rs2 = $db->query(" insert into forwork (user_id,work_id,time) VALUE ($user_id,$id,'$time')");
            if($rs2){
                echo '递交成功';
            }else{
                echo '递交失败';
            }
        }
    }

    public  function showwork(){
        $user_id = $_SESSION['user'][0]->id;
        $db = new DB();
        $works = $db->query("select * from work where user_id = $user_id");

        return view('app/work/work',compact('works'),'html');
    }

    public function deletwork($id){
        $db = new DB();
        $rs = $db->query("delete  from work where id = $id");

        if($rs){
            echo 'ok';
        }else{
            echo 'no';
        }

    }
}