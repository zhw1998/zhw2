<?php

/**
 * Created by PhpStorm.
 * User: 邹鸿威
 * Date: 2019/6/7
 * Time: 11:27
 */
class CommentController extends Controller
{
    protected $access_control = false;//设置是否开启访问权限控制，如要开启必须设置

    protected $accessible_list = [];//设置允许未登录访问的操作（即控制器中的方法）

    protected $login_identifier = 'user';//设置session中的登录检测标识，根据编码设置

    protected $login_route = '/login';//设置未允许访问时跳转的登录页面，根据路由设置
    public function add(){
        //获取评论内容
        $cm_content = $_POST['content'];
        //获取文章id
        $art_id = $_POST['actid'];

        //获取用户id
        $user_id  = $_SESSION['user'][0]->id;
        //获取当前时间
        $cm_time = date('Y-m-d h:i:sa');
        $db = new DB();
        $param = [
            'user_id' => $user_id,
            'art_id'=> $art_id,
            'cm_content' => $cm_content,
            'cm_time' => $cm_time
        ];
        //存入数据库
        $rs = $db->save('comments',$param);

        if($rs){
            echo 'ok';
        }else{
            echo 'no';
        }
    }

    public function showcomments($id){
        //获取改id文章的所有评论
        $db = new DB();
        $sql = 'select * from comments where art_id = '.$id.' order by cm_time desc';
        $comments = $db->query($sql);
        //获取评论人信息
        $users =  [];

        foreach ($comments as $c){
            $sql = 'select id,username,headimg   FROM users where id = '.$c->user_id;
            $n = $db->query($sql);
            $users = array_merge_recursive($users,$n);
        }
        //获取该文章作者id
        $sql2 = 'select atc_author_id from article where id = '.$id;
        $user_id = $db->find($sql2)->atc_author_id;

        return view('app/comment/comments',compact('comments','users','user_id'),'html');
    }

    public function deletecomment($id){
        $db = new DB();
        $sql = 'delete from comments where id = '.$id;
        $rs = $db->query($sql);
        if($rs){
            echo 'ok';
        }else{
            echo 'no';
        }
    }
}