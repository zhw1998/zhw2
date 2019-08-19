<!DOCTYPE html>
<html lang="zh-CN">
<head>

</head>
<style>
    .lwcard{
        margin-top: 10px;
        background: #cbecf336;
    }
</style>
<body>


<div style="margin-left: 10px;width: 99%;font-size: 15px">
    <span>
       <a href="#" id="showcm"  title="说两句。。。。"
          data-container="body" data-toggle="popover"
          data-content="<div>
          <textarea name='comment'id='comment'></textarea> <br>
          <button class='btn btn-primary' onclick='addlw({{$id}})'>发表</button>
          &emsp;&emsp;<button class='btn btn-default' onclick='hidepo()'>关闭</button>
          </div>">
           <img  id='pl' src="/assets/images/fabiao.png" width="35">&emsp;说两句
       </a>

         <span class="badge pull-right" style="font-size: 15px;margin-top:15px">留言：{{$lwsnum->num}} 条</span>
    </span>

</div>
<br>
<div id="mesg"></div>

<?php $i=0 ?>
@foreach($lws as $lw)

    <div class="lwcard" id="{{$lw->id}}">
        <p>
            <a href="/user/{{$users[$i]->id}}"><img src="{{$users[$i]->headimg}}" class="img-circle" width="35" height="35">&emsp;{{$users[$i]->username}}</a>&emsp;
            {{$lw->time}}

            @if($_SESSION['user'][0]->id==$lw->lw_id || $_SESSION['user'][0]->id==$lw->user_id)
                <span class="pull-right" onclick="del({{$lw->id}})"><img class="delet" src="/assets/images/delete.png" width="30"></span>
            @endif;
        </p>
        <div class="content">{{$lw->content}}</div>
    </div>
    <?php $i++ ?>
@endforeach



<script type="text/javascript">
    var ue;
    $(function () {
        $('#showcm').popover({html : true });
    });
    $(function () { $('#showcm').on('shown.bs.popover', function () {
        ue = UE.getEditor('comment',{initialFrameWidth:200,initialFrameHeight:100, toolbars : [
            ['simpleupload','emotion']
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

    function addlw(id) {
        $.post('/addlw',{'content':ue.getContent(),'user_id':id},function (rs) {
            if(rs='ok'){
                ue.execCommand('cleardoc');
                leaveword();

            }
        });
    }
    function del(id) {
        //删除
        if(window.confirm('确定删除该留言吗？')){
            //alert("确定");
            $.ajax({
                type: "get",
                url: "/deletelw/"+id,
                success: function (data) {
                    if (data == "ok") {
                      //  $("div").remove("#"+id);
                        leaveword();
                    }else{
                        alert('删除失败');
                    }
                },
                error: function () {
                    alert('删除失败');
                }
            });
        }

    }

</script>
</body>
</html>