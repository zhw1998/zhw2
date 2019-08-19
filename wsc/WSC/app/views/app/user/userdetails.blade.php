@extends('app/masters/app')

@section('title')
    个人信息
@endsection
@section('css')
    <style>

        #mybox{
            width:100%;
            margin:10px auto;
        }
        #userbox{
            margin: auto;
            width:1000px;
            height: 100px;
            background: #2f544b80;
            padding: 10px;

        }
        #box2{
            margin: 20px auto;
            width: 1000px;
            min-height: 600px;
        }
        #focus{
            float: right;
            margin-top: 10px;
        }
        #mesg{
            float: left;
            margin-top:5px;
            margin-left:20px;
            color: white;
            overflow: hidden;
        }
        #focus img:hover{
            transform: scale(1.1);
        }
        #content{
            height: 600px;
            overflow:auto;
        }
    </style>

@endsection
@section('body')
    <div id="mybox">
        <div id="userbox">

            <input type="hidden" id="id" value="{{$user->id}}">
            <img src="{{$user->headimg}}" class="img-circle" width="80" height="80" style="float: left">
            <div id="mesg">
                <p>{{$user->username}}</p>
                @foreach($study as $s)
                <p>{{$s->school}} &emsp;&emsp;{{$s->major}}&emsp;&emsp;{{$s->level}}</p>
                @endforeach
            </div>
            <div id="focus">
                @if($isfocus)
                    <img id="focusimg" src="/assets/images/nofocus.png" width="100" height="50" onclick="nofocus()">
                @else
                    <img id="focusimg" src="/assets/images/focus.png" width="100" height="50" onclick="addfocus()">
                @endif

            </div>


        </div>
        <p style="border-top: 1px solid black"></p>
        <div id="box2">
            <div id="nav">
                <ul id="myTab" class="nav nav-tabs">
                    <li class="active">
                        <a href="#act" onclick="showact()" data-toggle="tab">他的文章<span class="badge"></span></a>
                    </li>

                    <li><a href="#leaveword" onclick="leaveword()" data-toggle="tab">留言</a></li>
                </ul>
            </div>
            <div id="content">

            </div>
        </div>

    </div>


@endsection

@section('js')

    <script type="text/javascript" src="/assets/Ueditor/ueditor.config.js"></script>
    <script type="text/javascript" src="/assets/Ueditor/ueditor.all.min.js"></script>
    <script type="text/javascript" src="/assets/Ueditor/lang/zh-cn/zh-cn.js"></script>

    <script>
        window.onload = showact();

        function showact() {
            var id = $('#id').val();
            $.post("/showmyact",{num:10,'id':id},function(result){
                $("#content").html(result);
            });
        }
        function  showques() {
            var id = $('#id').val();
            $.post("/showmyact", {num: 10}, function (result) {
                $("#content").html(result);
            });
        }
        function  leaveword() {
            var id = $('#id').val();
            $.get("/showleave/"+id,{num:10},function(result){

                $("#content").html(result);
            });
        }
        function addfocus() {
            var id = $('#id').val();
            $.get('/addfocus/'+id,function (res) {
                console.log(res);
                if(res == 'ok'){
                    $('#focusimg').attr('src','/assets/images/nofocus.png');
                    $('#focusimg').attr('onclick','nofocus()');
                }
            });
        }
        function nofocus() {
            var userid = $('#id').val();
            $.get('/nofocus/'+userid,function (res) {
                console.log(res);
                if(res == 'ok') {
                    $('#focusimg').attr('src', '/assets/images/focus.png');
                    $('#focusimg').attr('onclick', 'addfocus()');
                }
            });
        }
    </script>
@endsection