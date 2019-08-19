<?php

/**
 * Created by PhpStorm.
 * User: 邹鸿威
 * Date: 2019/4/9
 * Time: 9:21
 */
class UserController extends Controller
{

    protected $access_control = true;//设置是否开启访问权限控制，如要开启必须设置

    protected $accessible_list = ['registering','login','register','logining'];//设置允许未登录访问的操作（即控制器中的方法）

    protected $login_identifier = 'user';//设置session中的登录检测标识，根据编码设置

    protected $login_route = '/login';//设置未允许访问时跳转的登录页面，根据路由设置

    public function register(){
        return view('app/user/register');
    }

    public function registering(){
        //获取post
        $username = $_POST['username'];
        if(strlen($username)>18||strlen($username)<6){
            error('用户名应为2-6位！');
            return back($_POST);
        }
        $usercode = $_POST['usercode'];
        if(!preg_match('/^[0-9A-Za-z]{6,12}$/',$usercode)){
            error('账号应为6-12位数字或字母！');
            return back($_POST);
        }
        $userpassword = $_POST['password'];
        if(!preg_match('/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{6,12}$/',$userpassword)){
            error('密码应为6-12位数字和字母组合！');
            return back($_POST);
        }
        $confirm = $_POST['confirm'];

        if($confirm!=$userpassword){
            error('两次密码不一致！');
            return back($_POST);
        }
        $captcha = $_POST['captcha'];
        //验证验证码
        if(!(new CaptchaService())->check($captcha)){
            error('验证码错误');
            return back($_POST);
        }
        $status = $_POST['status'];
        //验证是否存在改用户账号
        $db = new DB();
        $user = $db->query('select * from users where usercode=?',[$usercode]);
        if(!empty($user)){
            error('改账号已存在！');
            return back($_POST);
        }
        //添加该用户

        $params = [
            'username'=>$username,
            'usercode'=>$usercode,
            'userpassword'=>md5($userpassword),
            'status'=>$status
        ];
        $rs = $db->save('users',$params);
        //注册成功自动登录
        if($rs!=false){
            $user = $db->query("select * from users where usercode = $usercode");
            session('user',$user);
            $mesg = '恭喜 '.$username.' 注册成功！5秒将自动登录。。。。';
            return view('app/pages/success',compact('mesg'));
        }else{
            error('注册失败');
            return back($_POST);
        }

    }

    public function login(){
        return view('app/user/login');
    }

    public function logining(){

        $usercode = $_POST['usercode'];
        $userpassword = md5($_POST['password']);
        $captcha = $_POST['captcha'];

        //验证码是否有效
        if(!(new CaptchaService())->check($captcha)){
            error('验证码错误');
            return back($_POST);
        }
        //验证用户名密码
        $sql = 'select * from users where usercode = ? and userpassword = ?';
        $params = [
             $usercode,$userpassword
        ];
        $db = new DB();
        $user = $db->query($sql,$params);
        if(!empty($user)){
            session('user',$user);
            return redirect('/');
        }
        error('账号或密码错误!');
        return back($_POST);
    }


    //个人档案
    public function myarchives($id){
        //获取该用户
        $db = new DB();
        $user = $db->find('select contact,adress,headimg,username,status,id,about from users where id = '.$id);
        //查找教育背景
        $studys = $db->query('select * from study  where user_id = '.$id);
        return  view('app/user/archives',compact('user','studys'));
    }
    //设置个人简介
    public function updatamyabout(){
        $id = $_POST['id'];
        $about = $_POST['about'];
        $userid = $_SESSION['user'][0]->id;
        $adress = $_POST['adress'];
        $contact = $_POST['contact'];
        if($id!=$userid){
            error('对不起您没权限修改！');
            return back();
        }

        if(sizeof($_FILES)>0){
            $size = $_FILES['headimg']["size"];
            //文件的类型限制

            if(!preg_match('/^image\//', $_FILES['headimg']['type'])){
                error('文件类型不符，请选择图片文件！');
                return back();
            }
            //最大文件大小 8872995
            //验证文件类型大小正确
            if($size>=8872995){
                error('文件太大，请重新选择文件！');
            }
            //文件上传
            //1. 转移文件到 对应的文件夹
            $headimg_md5 = md5_file($_FILES['headimg']['tmp_name']);

            $headimg_name = md5(date('Y-m-d H:i:s').rand().md5($headimg_md5));
            if(!file_exists('assets/uploads/usershead')){
                mkdir('assets/uploads/usershead');
            }
            $folder = 'assets/uploads/usershead/'.$userid .'/';
            if(!file_exists($folder)){
                mkdir($folder);
            }
            $dest_file1 =  $folder.$headimg_name.'.jpg';
            move_uploaded_file($_FILES['headimg']['tmp_name'], $dest_file1);
            $dest_file1 = '/'.$dest_file1;
        }else{

            $dest_file1 = $_SESSION['user'][0]->headimg;
        }

        //添加数据库
        $db = new DB();
        $rs = $db->query('update users set headimg = \''.$dest_file1.'\' ,about = \''.$about.'\',adress = \''.$adress.'\',contact = \''.$contact.'\' where id = '.$id);
        if($rs){
            error('修改成功');
            $_SESSION['user'][0]->headimg = $dest_file1;
            $_SESSION['user'][0]->about = $about;
            $_SESSION['user'][0]->adress = $adress;
            $_SESSION['user'][0]->contact = $contact;
            return back();
        }else{
            error('修改失败');
            return back();
        }


    }
    //添加教育背景
    public function addstudy(){
        $school = $_POST['school'];
        $major = $_POST['major'];
        $level = $_POST['level'];
        $starttime = $_POST['starttime'];
        $endtime = $_POST['endtime'];
        $userid = $_SESSION['user'][0]->id;
        $db = new DB();
        $rs = $db->save('study',[
            'user_id'=>$userid,
            'school'=>$school,
            'starttime'=>$starttime,
            'endtime'=>$endtime,
            'level'=>$level,
            'major'=>$major
        ]);
        return back();
    }
    //删除背景
    function  deletstudy($id){
        $d = new DB();
        $rs = $d->query('delete from study where id = '.$id);
        if($rs){
            echo 'ok';
        }else{
            echo 'no';
        }
    }
    //显示用户信息页面
    public function showuser($id){
        //判断id是否是登录用户
        $focusid = $_SESSION['user'][0]->id;
        if($focusid == $id){
            return redirect('/activity/'.$id);
        }else{
            //获取该用户信息
            $db = new DB();
            $user = $db->find('select * from users where id = '.$id);
            //获取用户教育背景
            $study = $db->query('select school,level,major from study where user_id = '.$id);
            //获取关注表中是否有该用户
            $rs = $db->find('select * from focus where user_id = '.$id.' and focus_id = '.$focusid);
            $isfocus = $rs?true:false;
            return  view('app/user/userdetails',compact('user','isfocus','study'));
        }

    }

    //添加关注
    public function addfocus($id){
        //获取登录id
        $focusid = $_SESSION['user'][0]->id;

        $db = new DB();
        $rs = $db->query('INSERT  into focus (user_id,focus_id) VALUE ('.$id.','.$focusid.')');

        if($rs){
            echo 'ok';
        }else{
            echo 'no';
        }
    }

    //取消关注
    public function nofocus($id){
        //获取登录id
        $focusid = $_SESSION['user'][0]->id;
        $db = new DB();
        $rs = $db->query('delete from focus where user_id = '.$id.' and focus_id = '.$focusid);
        if($rs){
            echo 'ok';
        }else{
            echo 'no';
        }
    }
    //显示关注
    public function showfocus(){
        $type = $_POST['type'];
        $id = $_POST['id'];
        $db = new DB();
        $focususer = [];
        if($type == 1){
            //显示被关注的
            $users = $db->query('select focus_id from focus where user_id = '.$id);
            foreach ($users as $id){
                $sql = 'select *  FROM users where id= '.$id->focus_id;
                $n = $db->query($sql);
                $focususer = array_merge_recursive($focususer,$n);
            }

        }else{
            //显示关注
            $users = $db->query('select user_id from focus where focus_id = '.$id);
            foreach ($users as $id){
                $sql = 'select id,username,headimg  FROM users where id= '.$id->user_id;
                $n = $db->query($sql);
                $focususer = array_merge_recursive($focususer,$n);
            }

        }

        return  view('app/user/focus',compact('focususer','type'),'html');
    }
}