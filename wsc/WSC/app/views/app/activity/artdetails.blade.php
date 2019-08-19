@extends('app/masters/app')

@section('title')
   文章详情
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
            width: 350px;
            min-height: 300px;
            left: 1050px;
            top: 70px;
        }
        #commentbox{
            width: 100%;
            min-height: 50px;
            border-top:2px solid #cda0a0 ;
        }
        #zan:hover{
            transform:rotate(-20deg) scale(1.3);
        }
        #pl:hover{
            transform:rotate(90deg) scale(1.3);
        }

    </style>
@endsection
@section('body')
    <div id="artbox">
        <input type="hidden" id="id" value="{{$rs->id}}">
        <p style="font-size: 30px">{{$rs->atc_title}}</p>
        <p><span><img src="/assets/images/user.png" width="21">&emsp;<a href="/user/{{$rs->atc_author_id}}">{{$rs->atc_author}}</a></span>&emsp;&emsp;&emsp;
            <span> <img src="/assets/images/time.png" width="21">&emsp;{{$rs->atc_time}}</span>&emsp;&emsp;&emsp;
            <span> <img src="/assets/images/liulan.png" width="21">&emsp;{{$rs->atc_read}}</span></p>
        <br>
        <div class="actcontent">
            {{$rs->atc_content}}
        </div>
        <br>
        <br>
        <br>
        <br>
        <p>
            <span style="font-size: 20px"> <img  id='zan' src="/assets/images/zan.png" width="35" onclick="dianzan({{$rs->id}})">&nbsp;<span  id='zanbox'>{{$rs->atc_zan}}</span></span>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
            @if(session('user'))
                <span style="font-size: 15px">

               <a href="#" id="showcm"  title="说两句。。。。"
                  data-container="body" data-toggle="popover"
                  data-content="<div>
                  <textarea name='comment'id='comment'></textarea> <br>
                  <button class='btn btn-primary' onclick='saywhat({{$rs->id}})'>发表</button>
                  &emsp;&emsp;<button class='btn btn-default' onclick='hidepo()'>关闭</button>
                  </div>">
                   <img  id='pl' src="/assets/images/fabiao.png" width="35">&emsp;说两句
               </a>
            </span>
            @endif

        </p>
        <div id="commentbox">

        </div>
    </div>
    <div id="about">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">相似文章</h3>
            </div>
            <div class="panel-body">
                <ul class="list-group">

                    @foreach($likecomments as $com)
                        <a href="/detailsart/{{$com->id}}"><li class="list-group-item">{{$com->atc_title}} <span class="badge">{{$com->atc_zan}}</span></li></a>
                    @endforeach

                </ul>
            </div>
        </div>
    </div>




@endsection

@section('js')
    <script type="text/javascript" src="/assets/Ueditor/ueditor.config.js"></script>
    <script type="text/javascript" src="/assets/Ueditor/ueditor.all.min.js"></script>
    <script type="text/javascript" src="/assets/Ueditor/lang/zh-cn/zh-cn.js"></script>
    <script type="text/javascript">
        @if(session('user'))
            window.onload = getcomment($('#id').val());
        @endif

        var ue;
        $(function () {
            $('#showcm').popover({html : true });
        });
        $(function () { $('#showcm').on('shown.bs.popover', function () {
            var offset = $('#showcm').offset().top;
            $(window).scrollTop(offset);
            ue = UE.getEditor('comment',{initialFrameWidth:200,initialFrameHeight:100, toolbars : [
                ['simpleupload','emotion'  ]
            ]});

         })
        });
        $(function () { $('#showcm').on('hide.bs.popover', function () {
            ue.destroy();
         })
        });
        function  hidepo() {
            $('#showcm').popover('hide')
        }
        function dianzan(id) {
            //点赞+1
            $.get("/zanatr/"+id, function(result){
                $('#zan').attr('src', '/assets/images/zan2.png');
                $('#zanbox').text(parseInt($('#zanbox').text())+1);
            });
        }
        function saywhat(id) {

            $.post('/addcomment',{'content':ue.getContent(),'actid':id},function (rs) {

                if(rs='ok'){
                    ue.execCommand('cleardoc');
                    getcomment(id);
                }
            });
        }
        //获取评论
        function getcomment(id) {
            $.get('/showcomment/'+id,function (rs) {
                $("#commentbox").html(rs);
            });
        }
    </script>
@endsection