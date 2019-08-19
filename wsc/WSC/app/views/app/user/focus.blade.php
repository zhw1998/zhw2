<!DOCTYPE html>
<html lang="zh-CN">
<head>

</head>
<style>
    .lwcard{
        margin-top: 5px;
        background: #cbecf336;
    }
</style>
<body>


<br>
<div id="mesg"></div>

@foreach($focususer as $user)

    <div class="lwcard" id="{{$user->id}}">
        <p>
            <a href="/user/{{$user->id}}"><img src="{{$user->headimg}}" class="img-circle" width="50" height="50">&emsp;{{$user->username}}</a>&emsp;
            @if($type == 2)
                <span class="pull-right" onclick="nofocus({{$user->id}})" style="margin-top: 5px"><img class="delet" src="/assets/images/nofocus.png" width="100"></span>
            @endif
        </p>

    </div>

@endforeach

<script type="text/javascript">

    function nofocus(id) {
        $.get('/nofocus/'+id,function (res) {
            console.log(res);
            if(res == 'ok') {
                $('#'+id).remove();
            }
        });
    }

</script>
</body>
</html>