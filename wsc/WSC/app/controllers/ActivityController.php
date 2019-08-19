<?php

class ActivityController extends Controller
{
    protected $access_control = true;//设置是否开启访问权限控制，如要开启必须设置

    protected $accessible_list = ['detailsart'];//设置允许未登录访问的操作（即控制器中的方法）

    protected $login_identifier = 'user';//设置session中的登录检测标识，根据编码设置

    protected $login_route = '/login';//设置未允许访问时跳转的登录页面，根据路由设置

    public function index(){
        $active = 'd';
        return view('app/activity/activity',compact('active'));
    }
    public function show($id)
    {
        $db = new DB();
        //获取草稿箱文章id
        $author_id = $_SESSION['user'][0]->id;
        $sql = "select id from article where atc_author_id = $author_id and status = 0  ORDER by atc_time DESC";
        $rs = $db->query($sql);
        if($rs){
            $id = $rs[0]->id;
        }else{
            $id = -1;
        }
//        $id = -1;
        //统计文章总数
        $sql1 = "select count(*) as count from article where atc_author_id = $author_id and status = 1";
        $rs1 = $db->query($sql1);
        $count = $rs1[0]->count;
        //统计招聘总数
        $count2 = $db->query("select count(*) as count2 from work where user_id = $author_id ")[0]->count2;

        return view('app/activity/admin',compact('id','count','count2','lwsnum'));
    }

    public function creat($id){
        //草稿
        if($id!='new'){
        //获取草稿箱文章
            $db = new DB();
            $sql = "select * from article where id = $id";
            $rs = $db->query($sql);
            //将值存入old
            $art_title = $rs[0]->atc_title;
            $atc_content = $rs[0]->atc_content;
            $id =  $rs[0]->id;
            //设置到old中
//            dd($_SESSION);
            $_SESSION['old']['id'] = $id;
            $_SESSION['old']['art_title'] = $art_title;
            $_SESSION['old']['atc_content'] = $atc_content;

        }else{
            //清除old
            unset($_SESSION['old']);
        }
        //新建
        return view('app/activity/creatart');
    }

    /**
     * 编辑文章
     */

    public function update(){
        //获取post内容
        $title = $_POST['art_title'];
        $content = $_POST['art_content'];
        $type = $_POST['type'];
        $id = $_POST['id'];
        $author = $_SESSION['user'][0]->username;
        $author_id = $_SESSION['user'][0]->id;
        $creattime = date('Y-m-d h:i:sa');
        $param = [
            'atc_author'=>$author,
            'atc_author_id'=>$author_id,
            'atc_title'=>$title,
            'atc_content'=>$content,
            'atc_time'=>$creattime,
        ];
        $db = new DB();
        if(trim($id)==""||sizeof(trim($id))==0){
            //不存在
            if($type==1){
                //发布
                $p = array_merge_recursive($param,['status'=>'1']);
                $rs = $db->save('article',$p);
                session('ok','发布成功');
                return  back();
            }else if($type==0){
                //保存
                $p = array_merge_recursive($param,['status'=>'0']);
                $rs = $db->save('article',$p);
                $_POST['id'] = $rs->id;
                $_SESSION['old']['art_title'] = $title;
                $_SESSION['old']['atc_content'] = $content;
                $id = number_format($rs->id);
                session('ok','保存成功');
                return redirect("/creatart/$id");
            }
        }else{
            //存在
            if($type==1){
                //发布
                $id = $_POST['id'];
                $sql = 'update article set status = 1 where id='.$id;
                $rs = $db->query($sql);
                if($rs){
                    session('ok','发布成功');
                    return back();
                }else{
                    session('ok','！！！！发布失败');
                    return back($_POST);
                }
            }else if($type==0){
                //保存
                $id = $_POST['id'];
                $p = [
                    'atc_title'=>$title,
                    'atc_content'=>$content,
                    'atc_time'=>$creattime,
                    'id'=>$id
                ];
                $sql = 'update article set atc_title= :atc_title ,atc_content= :atc_content , atc_time = :atc_time where id= :id';
                $rs = $db->query($sql,$p);
                if($rs){
                    session('ok','保存成功');
//                    $_SESSION['old']['art_title'] = $title;
//                    $_SESSION['old']['atc_content'] = $content;
//                    $id = number_format($id);
//                    return redirect("/creatart/ $id");
                    return back($_POST);
                }else{
                    session('ok','！！！！保存失败');
                    return back($_POST);
                }
            }
        }
        //判断数据库中是否已存在该草稿 存在直接则修改内容发布
        //插入数据库返回id
        //如果是保存向前端发送id信息
        //如果是发布返回管理页面
        dd($_POST);
    }

    /**
     *显示所有文章 ajax请求
     */
    public function  showmyact(){
        $num = $_POST['num']; // num 一次显示多少条  懒加载后续开发
        $author_id = isset($_POST['id'])?$_POST['id']: $_SESSION['user'][0]->id;

        //查询文章
        $db = new DB();
        $sql = 'select * from article where atc_author_id = '.$author_id.' and status = 1  order by atc_time desc limit  '.$num;
        $rs = $db->query($sql);
        //获取每个文章的评论数
        $count =  [];
        foreach ($rs as $r){
            $sql = 'select count(*) as total FROM comments where art_id= '.$r->id;
            $n = $db->query($sql);

            $count = array_merge_recursive($count,$n);
        }
//        dd($count);
        return view('app/activity/activitys',compact('rs','count'),'html');
    }

    /**
     * 删除
     */
    public function deleteact($id){
        $sql = 'delete from article where id = '.$id;
        $db = new DB();
        $rs = $db->query($sql);
        if($rs){
            echo 'ok';
        }else{
            echo 'no';
        }
    }

    /**
     * 显示文章详情
     */
    public function detailsart($id){
        $db = new DB();
        //阅读+1
        $db->query('update article set atc_read = atc_read+1 where id = '.$id);
        //获取文章信息

        $sql = "select * from article where id = $id";
        $rs = $db->find($sql);
        //获取类似文章  以文章名模糊查询
        $sql2 = 'select * from article where atc_title like \'%'.$rs->atc_title.'%\' order by atc_zan desc limit 10';
        $likecomments = $db->query($sql2);

        return view('app/activity/artdetails',compact('rs',likecomments));
    }

    /**
     * 点赞
     */
    public function zanatr($id){
        $db = new DB();
        $sql = "update article set atc_zan = atc_zan+1 where id = $id";
        $rs = $db->query($sql);
    }

    /**
     * 查询
     */
    public function searchact(){
        $w = $_POST['sw'];
        $db = new DB();
        $rs = $db->query("select * from article where atc_title like '%$w%' or atc_author like '%$w%'");
        //获取每个文章的评论数
        $count =  [];
        foreach ($rs as $r){
            $sql = 'select count(*) as total FROM comments where art_id= '.$r->id;
            $n = $db->query($sql);

            $count = array_merge_recursive($count,$n);
        }
        return view('app/activity/activitys',compact('rs','count'),'html');
    }

    public function orderwhat($what){

        $db = new DB();
        $rs = $db->query("select * from article order by $what desc");
        //获取每个文章的评论数
        $count =  [];
        foreach ($rs as $r){
            $sql = 'select count(*) as total FROM comments where art_id= '.$r->id;
            $n = $db->query($sql);
            $count = array_merge_recursive($count,$n);
        }
        return view('app/activity/activitys',compact('rs','count'),'html');
    }
}