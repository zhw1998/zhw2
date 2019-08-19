<!DOCTYPE html>
<html lang="zh-CN">
<head>

</head>
<style>
    .actcard{
        margin-top: 20px;
    }
    .img-circle:hover{
        transform:scale(1.3);
    }
    .delet:hover{
        transform:scale(1.2);
    }
    .content{
         background: white;
    }
</style>
<body>

<div id="mesg"></div>
<?php $i=0 ?>
@foreach($comments as $comment)

    <div class="actcard" id="{{$comment->id}}">
        <p>
            <a href="/user/{{$users[$i]->id}}"><img src="{{$users[$i]->headimg}}" class="img-circle" width="35" height="35">&emsp;{{$users[$i]->username}}</a>&emsp;
            {{$comment->cm_time}}

            @if($_SESSION['user'][0]->id==$comment->user_id || $_SESSION['user'][0]->id==$user_id)
                <span class="pull-right" onclick="del({{$comment->id}})"><img class="delet" src="/assets/images/delete.png" width="30"></span>
            @endif;
        </p>
        <div class="content">{{$comment->cm_content}}</div>
    </div>
    <?php $i++ ?>
@endforeach

<script>
    function del(id) {
        //删除
        if(window.confirm('确定删除该评论吗？')){
            //alert("确定");
            $.ajax({
                type: "get",
                url: "/deletecomment/"+id,
                success: function (data) {
                    if (data == "ok") {
                        $("div").remove("#"+id);
                        getcomment($('#id').val());
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