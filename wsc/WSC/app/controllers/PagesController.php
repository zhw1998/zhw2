<?php

class PagesController extends Controller
{
    protected $access_control = false;//设置是否开启访问权限控制，如要开启必须设置

    protected $accessible_list = [];//设置允许未登录访问的操作（即控制器中的方法）

    protected $login_identifier = 'user';//设置session中的登录检测标识，根据编码设置

    protected $login_route = '/login';//设置未允许访问时跳转的登录页面，根据路由设置
    public function index()
    {
        //获取点赞多的文章前10
        $db = new DB();
        $sql = 'select * from article where status = 1 order by atc_zan desc limit 10';
        $rs = $db->query($sql);
        //获取每个文章的评论数
        $count =  [];
        foreach ($rs as $r){
            $sql = 'select count(*) as total FROM comments where art_id= '.$r->id;
            $n = $db->query($sql);

            $count = array_merge_recursive($count,$n);
        }

        $active = 'a';
        return view('app/pages/index',compact('rs','count','active'));
    }

    public function search(){
        $content = $_GET['content'];
        return view('app/pages/search');
    }
}