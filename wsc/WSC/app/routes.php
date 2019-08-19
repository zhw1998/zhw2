<?php

/*
 * 路由加载
 *
 * 使用 Router::get
 *      Router::post
 *      Router::put
 *      Router::delete
 * 
 * 参数
 * 第一个 路由uri
 * 第二个 该路由对应的控制器以及处理操作 或者回调函数
 */



Router::get('/', 'PagesController@index');

//获取验证码图片
//in app/routes.php 路由 /captcha
Router::get('/captcha', function(){
    (new CaptchaService())->entry();//通过/captcha获取验证码
});
//注册
Router::get('/register','UserController@register');
//处理注册
Router::post('/register','UserController@registering');
//登录
Router::get('/login','UserController@login');

//处理登录验证  /login   post
Router::post('/login', 'UserController@logining');

//退出登录
Router::get('/logout',function (){
    session_destroy();
    return redirect('/');
});

//显示用户信息
Router::get('/user/{id}', 'UserController@showuser');
//添加关注
Router::get('/addfocus/{id}','UserController@addfocus');
//取消关注
Router::get('/nofocus/{id}','UserController@nofocus');
//显示关注
Router::post('/focus','UserController@showfocus');
//主页搜索
Router::get('/indexsearch','PagesController@search');

//个人档案
Router::get('/myarchives/{id}','UserController@myarchives');
//修改个人资料
Router::post('/updatamyabout','UserController@updatamyabout');
//添加教育背景
Router::post('/addstudy','UserController@addstudy');
//删除
Router::get('/deletstudy/{id}','UserController@deletstudy');

//文章
Router::get('/activity','ActivityController@index');
//文章管理
Router::get('/activity/{id}','ActivityController@show');
//查询
Router::post('/searchact','ActivityController@searchact');
//排序
Router::get('/order/{what}','ActivityController@orderwhat');
//编辑文章
Router::get('/creatart/{id}','ActivityController@creat');
Router::post('/updataart','ActivityController@update');
//用户管理显示文章
Router::post('/showmyact','ActivityController@showmyact');
//删除文章
Router::get('/deleteact/{id}','ActivityController@deleteact');
//文章显示
Router::get('/detailsart/{id}','ActivityController@detailsart');
//点赞文章
Router::get('/zanatr/{id}','ActivityController@zanatr');


//添加评论
Router::post('/addcomment','CommentController@add');
//显示评论
Router::get('/showcomment/{id}','CommentController@showcomments');
//删除评论
Router::get('/deletecomment/{id}','CommentController@deletecomment');


//显示留言
Router::get('/showleave/{id}','LeaveWordController@showlw');
//添加留言
Router::post('/addlw','LeaveWordController@addlw');
//删除
Router::get('/deletelw/{id}','LeaveWordController@deletelw');

//人脉
Router::get('/connections','ConnectionsController@index');
//搜索
Router::post('/csearch','ConnectionsController@csearch');
//推荐
Router::get('/tuijain/{num}','ConnectionsController@tuijain');
//问题广场
Router::get('/question','QuestionController@index');

//职位
Router::get('/work','WorkController@index');
//发布职位
Router::post('/addwork','WorkController@addwork');
//添加
Router::get('/tjwork/{num}','WorkController@tjwork');
//查询
Router::post('/searchwork','WorkController@searchwork');
Router::get('/workdetail/{id}','WorkController@workdetail');
//提交简历
Router::get('/postwork/{id}','WorkController@postwork');
//删除
Router::get('/deletwork/{id}','WorkController@deletwork');
//用户管理
Router::post('/showwork','WorkController@showwork');