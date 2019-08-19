@extends('app/masters/app')

@section('title')
    个人档案
@endsection
@section('css')
    <style>

        #head{
            width: 1000px;
            height:100px;
            margin: 20px auto;
            padding: 9px;
            background: rosybrown;
        }
        #box2{
            width: 1000px;
            min-height: 400px;
            border: 2px solid;
            margin: 20px auto;
            border-radius: 5px;
        }
        .study{
            width: 90%;
            height: 60px;
            margin: 5px auto;
            background: #1dff9b24;
        }
    </style>

@endsection
@section('body')
    <div id="head">

             <img src="{{ $user->headimg}}" class="img-circle" width="80" height="80" style="float: left">
             <div style="float: left;margin-left: 30px;margin-top:10px;font-size: 18px;color: white">
                <p>{{ $user->username}}&emsp;联系方式：{{$user->contact}}</p>
                <p>
                    @if($user->status == 1)
                        在校
                    @elseif($user->status == 2)
                        在职
                    @else
                        其他
                     @endif
                </p></div>


    </div>
    <div id="box2">
        <ul id="myTab" class="nav nav-tabs">
            <li class="active">
                <a href="#act" onclick="myabout()" data-toggle="tab">个人简介<span class="badge"></span></a>
            </li>
            <li><a href="#quest" onclick="mystudy()" data-toggle="tab">教育背景</a></li>
            <li><a href="#myfocus" onclick="mywork()" data-toggle="tab">工作经历</a></li>
            <li><a href="#focusme" onclick="mypower()" data-toggle="tab">职业技能</a></li>
        </ul>
        <div id="content">

        </div>
    </div>
    <!--个人简介框-->
    <div id="myabout" hidden>
        <form action="/updatamyabout" method="post" enctype="multipart/form-data" style="width: 70%;margin: 10px auto" >

            <div class="form-group">
                <label>头像</label>
                <input type="file" name="headimg"  id="inputfile">
            </div>
            <div class="form-group">
                <label>个人简介</label>
                <textarea   name="about" class="form-control" rows="4" placeholder="做一个简单介绍，200字内">{{$user->about}}</textarea>
            </div>
            <div class="form-group">
                <label>现居地址</label>
                <input  name="adress" class="form-control"  value="{{$user->adress}} ">
            </div>
            <div class="form-group">
                <label>联系方式</label>
                <input  name="contact" class="form-control"  value="{{$user->contact}} ">
            </div>
            <input type="hidden" id="id" name="id" value="{{ $user->id}}">
            @if($user->id == $_SESSION['user'][0]->id)
                <div class="form-group">
                    <input type="submit" value="修改" class="btn btn-primary btn-block">
                </div>
            @endif
            @if(error())
                <div class="alert alert-danger">
                    <ul>
                        @foreach(flash('error') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </form>
    </div>
    <!--教育背景-->
    <div id="mystudy" hidden>
        <br>
        @if($user->id == $_SESSION['user'][0]->id)
            <p>&emsp;&emsp;&emsp;&emsp;<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">添加</button></p>
        @endif

        @if($studys)
            @foreach($studys as $study)
                <div class="study" id="{{$study->id}}">
                    <p>{{$study->school}} &emsp;{{$study->starttime}}----{{$study->endtime}} </p>
                    <p>{{$study->major}}&emsp;{{$study->level}}<span class="pull-right" onclick="del({{$study->id}})"><img class="delet" src="/assets/images/delete.png" width="30"></span></p>
                </div>
            @endforeach
        @endif

    </div>
    <!--工作经历-->
    <div id="mywork" hidden>
        未完成！
    </div>
    <!--职业技能-->
    <div id="mypower" hidden>
        未完成！
    </div>
    <!--模态框-->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">添加教育背景</h4>
                </div>
                <form  action="/addstudy" method="post" onsubmit="return checkform()" style="width: 70%;margin: 10px auto" >
                    <div class="form-group">
                        <label>学校</label>
                        <input  name="school" id="school" class="form-control"  value="">
                    </div>
                    <div class="form-group">
                        <label>专业</label>
                        <input  name="major" id="major" class="form-control"  value="">
                    </div>
                    <div class="form-group">
                        <label>入校时间</label>
                        <input  name="starttime"  id="starttime" class="form-control"  value="">
                    </div>
                    <div class="form-group">
                        <label>毕业时间</label>
                        <input  name="endtime" id="endtime" class="form-control"  value="">
                    </div>
                    <div class="form-group">
                        <label>学历</label>
                        <select name="level" id="status"  class="form-control">
                            <option value="专科">专科</option>
                            <option value="本科">本科</option>
                            <option value="研究生">研究生</option>
                            <option value="博士">博士</option>
                        </select>
                    </div>
                    <input type="hidden" id="id" name="id" value="{{ $user->id}}">

                    <div class="form-group">
                        <input type="submit" value="添加" class="btn btn-primary btn-block">
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal -->
    </div>
@endsection

@section('js')
    <script>
        window.onload = myabout();
        function myabout() {
            var html = $('#myabout').html();
            $("#content").html(html);
        }
        function  mystudy() {
            var html = $('#mystudy').html();
            $("#content").html(html);
        }
        function  mywork() {
            var html = $('#mywork').html();
            $("#content").html(html);

        }
        function  mypower() {
            var html = $('#mypower').html();
            $("#content").html(html);

        }
        function checkform() {
            //js表单验证

            var school = $('#school').val().trim();
            if(school.length<=0||school==''){
                $('#school').parent().attr("class","has-error");
                $('#school').focus();
                return false;
            }
            var major = $('#major').val().trim();
            if(major.length<=0||major==''){
                $('#major').parent().attr("class","has-error");
                $('#major').focus();
                return false;
            }

            var starttime = $('#starttime').val().trim();
            if(starttime.length<=0||starttime==''){
                $('#starttime').parent().attr("class","has-error");
                $('#starttime').focus();
                return false;
            }

            var endtime = $('#endtime').val().trim();
            if(endtime.length<=0||endtime==''){
                $('#endtime').parent().attr("class","has-error");
                $('#endtime').focus();
                return false;
            }
            return true;
        }
        function  del(id) {
            if(window.confirm('确定删除吗？')){
                $.get('/deletstudy/'+id,function (res) {
                    if(res == 'ok'){
                        $('#'+id).remove();
                    }
                });
            }
        }
    </script>
@endsection