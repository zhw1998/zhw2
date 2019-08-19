@extends('app/masters/app')

@section('title')
    招聘详情
@endsection
@section('css')
    <style>

        #artbox{
            margin: 20px 100px;
            width:800px;
            min-height: 400px;
        }
        #about{
            position: fixed;
            width: 300px;
            min-height: 300px;
            left: 1100px;
            top: 70px;
        }
        #tou{
            position: fixed;
            width: 60px;
            height:60px;
            left: 920px;
            top:100px;
            text-align: center;
            font-size: 10px;
        }
        #tou img:hover{
            transform: scale(1.3);
        }
        #del{
            position: fixed;
            width: 60px;
            height:60px;
            left: 1000px;
            top:100px;
            text-align: center;
            font-size: 10px;
        }
        #del img:hover{
            transform: scale(1.2);
        }
        ul{
            list-style:none;
        }
        .usercard{
            width: 60%;
            height: 60px;
            margin: 5px auto;
            border-bottom:1px solid black;
        }
        .usercard img:hover{
            transform: scale(1.2);
        }
        .username{
            width: 50%;
            margin-left: 20px;
            margin-top: 10px;
            float: left;
        }
    </style>
@endsection
@section('body')

    @if($work->user_id != $_SESSION['user'][0]->id)
        <div id="tou">
            <img src="/assets/images/post.png" width="60" height="60" onclick="post({{$work->id}})">
            <p>提交简历</p>
        </div>
    @endif
    @if($work->user_id == $_SESSION['user'][0]->id)
        <div id="del">
            <img src="/assets/images/dele.png" width="60" height="60" onclick="delet({{$work->id}})">
            <p>删除</p>
        </div>
    @endif
    <div id="artbox">
        <br>
        <input type="hidden" id="id" value="{{$work->id}}">
        <p style="font-size: 35px">{{$work->workname}}</p>
       <p> 薪资： &emsp;<span style="font-size: 25px">{{$work->workprice}}</p>
        <p> 联系方式： &emsp;<span style="font-size: 20px">{{$work->workphone}}</span></p>
        <br>
        <br>

        <div class="workcontent">
            <div class="panel panel-default">
                <div class="panel-heading">
                    工作内容
                </div>
                <div class="panel-body">
                    {{$work->workcontent}}
                </div>
            </div>
        </div>
        <div class="workask">
            <div class="panel panel-default">
                <div class="panel-heading">
                    工作要求
                </div>
                <div class="panel-body">
                    {{$work->workask}}
                </div>
            </div>
        </div>



    </div>


    @if($work->user_id == $_SESSION['user'][0]->id)
        <div id="about">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">已投简历 &nbsp; <span class="badge" style="color: red;font-size: 18px">{{$count}}</span></h3>
                </div>
                <div class="panel-body">
                    <ul class="list-group">
                        @foreach($users as $user)
                            <li>
                                <a href="/myarchives/{{$user->id}}">
                                    <div class="usercard">
                                        <img src="{{$user->headimg}}" class="img-circle" width="40" height="40" style="float: left">
                                        <div class="username">{{$user->username}}</div>
                                    </div>
                                </a>
                            </li>
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>
    @endif



@endsection

@section('js')
    <script type="text/javascript" src="/assets/Ueditor/ueditor.config.js"></script>
    <script type="text/javascript" src="/assets/Ueditor/ueditor.all.min.js"></script>
    <script type="text/javascript" src="/assets/Ueditor/lang/zh-cn/zh-cn.js"></script>
    <script type="text/javascript">


        function post(id) {
            //点赞+1
            $.get("/postwork/"+id, function(result){
                alert(result);
            });
        }
        function delet(id) {
            $.get("/deletwork/"+id, function(res){
                if(res == 'ok'){
                    alert('删除成功');
                    window.history.go(-1);
                }else {
                    alert('删除失败');
                }
            });
        }

    </script>
@endsection