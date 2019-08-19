@extends('app/masters/app')

@section('title')
    文章管理
@endsection
@section('css')
    <style>

        #mybox{
            position: fixed;
            width: 200px;
            height: 400px;
            left:50px;
            top: 60px;
        }
        #nav{
            width:800px ;
            position: fixed;
            top: 60px;
            left: 280px;
            background-color: #bce8f1;
            border-radius: 2px;
        }
        #mycomments{
            position: fixed;
            width: 350px;
            left:1120px;
            top: 60px;
        }

        #content{
            margin-top: 70px;
            margin-left: 265px;
            width: 800px;
            min-height: 400px;
        }
    </style>

@endsection
@section('body')
    <div id="mybox">
        <div class="panel panel-success">
            <div class="panel-heading" style="text-align: center">
                <img src="{{ $_SESSION['user'][0]->headimg}}" class="img-circle" width="70" height="70">
                <p>{{ $_SESSION['user'][0]->username}}</p>
                <input type="hidden" id="id" value="{{ $_SESSION['user'][0]->id}}">
            </div>
            <div class="panel-body">
                <p>
                    <a href="/creatart/new"><button type="button" class="btn btn-primary btn-lg btn-block">发布文章</button></a>
                    <br>
                    @if($id!=-1)
                        <a href="/creatart/{{$id}}"><button type="button" class="btn btn-default btn-lg btn-block">草稿箱</button></a>
                    @else
                        <a href="javascript:alert('空空如也');"><button type="button" class="btn btn-default btn-lg btn-block">草稿箱</button></a>
                    @endif

                </p>
            </div>
        </div>
    </div>
    <div id="nav">
        <ul id="myTab" class="nav nav-tabs">
            <li class="active">
                <a href="#act" onclick="showact()" data-toggle="tab">我的文章  &nbsp;<span class="badge">{{$count}}</span></a>
            </li>
            @if(session('user')[0]->status == 2)
                <li><a href="#showwork" onclick="showwork()" data-toggle="tab">我的招聘<span class="badge">{{$count2}}</span></a></li>
            @endif
            <li><a href="#myfocus" onclick="myfocus()" data-toggle="tab">关注</a></li>
            <li><a href="#focusme" onclick="focusme()" data-toggle="tab">粉丝</a></li>

        </ul>
    </div>
     <div id="content">

     </div>
    <div id="mycomments">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">留言板</h3>
            </div>
            <div class="panel-body" id="lwcontent">
                这是一个基本的面板
            </div>
        </div>

    </div>


@endsection

@section('js')
    <script type="text/javascript" src="/assets/Ueditor/ueditor.config.js"></script>
    <script type="text/javascript" src="/assets/Ueditor/ueditor.all.min.js"></script>
    <script type="text/javascript" src="/assets/Ueditor/lang/zh-cn/zh-cn.js"></script>
    <script type="text/javascript">
        window.onload = showact();
        window.onload = leaveword();
        function showact() {
            $.post("/showmyact",{num:10},function(result){
                $("#content").html(result);
            });
        }
        function  showques() {
            $.post("/showmyact", {num: 10}, function (result) {
                $("#content").html(result);
            });
        }
        function  focusme() {
            $.post("/focus",{num:10,type:1,id:$('#id').val()},function(result){
                $("#content").html(result);
            });
        }
        function  myfocus() {
            $.post("/focus",{num:10,type:2,id:$('#id').val()},function(result){
                $("#content").html(result);
            });
        }
        //显示留言
        function leaveword() {
            var id = $('#id').val();
            $.get("/showleave/"+id,{num:10},function(result){
                $("#lwcontent").html(result);
            });
        }
        //显示招聘
        function showwork() {
            $.post("/showwork",{},function(result){
                $("#content").html(result);
            });
        }


    </script>
@endsection