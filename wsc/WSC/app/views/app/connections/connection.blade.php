<!DOCTYPE html>
<html lang="zh-CN">
<head>
<style>
    #aaa{
        width:100%;

    }
    .card{
        float: left;
        width: 130px;
        height: 180px;
        overflow: hidden;
        margin: 10px;
        border-radius: 5px;
        background: #a4dfd438;
    }
    .clear{
        clear: both;
    }
    .bbb{
        width: 100%;
        height: 20px;
        background: #9281a257;
    }
    .ccc{
        width: 100%;
        height: 20px;
        background: #74cf3d47;
    }
</style>

</head>
<body>

    @if($type == 1)

        @if($users3)
            <div class="ccc"><p>这些用户和您是一个学校或者一个专业的哦！！！！</p></div>
            <div>
                @foreach($users3 as $u)
                    @if($_SESSION['user'][0]->id !=$u->id )
                    <a href="/user/{{$u->id}}">
                        <div class="card">
                            <div><img src="{{$u->headimg}}" class="img-circle" width="80" height="80" style="margin: 10px 25px;"></div>
                            <div style="text-align: center"><p>{{$u->username}}</p><p>{{$u->adress}}</p></div>
                        </div>
                    </a>
                    @endif
                @endforeach
                <div class="clear"></div>
            </div>
        @else

        @endif
        @if($users4)
            <div class="ccc"><p>这些用户和您在一个地区哦！！！！</p></div>
            <div>

                @foreach($users4 as $u)
                    @if($_SESSION['user'][0]->id !=$u->id )
                    <a href="/user/{{$u->id}}">
                        <div class="card">
                            <div><img src="{{$u->headimg}}" class="img-circle" width="80" height="80" style="margin: 10px 25px;"></div>
                            <div style="text-align: center"><p>{{$u->username}}</p><p>{{$u->adress}}</p></div>
                        </div>
                    </a>
                        @endif
                @endforeach
                <div class="clear"></div>
            </div>
        @else
            <div class="ccc"><p>对不起！没有跟您推荐的用户！请完善信息！</p></div>
        @endif
    @elseif($type == 2)
        <div id="aaa">

            <div class="bbb"><p>根据用户名，用户地址搜索结果</p></div>
            @if($users1)

                <div>
                    @foreach($users1 as $u)
                        @if($_SESSION['user'][0]->id !=$u->id )
                        <a href="/user/{{$u->id}}">
                            <div class="card">
                                <div><img src="{{$u->headimg}}" class="img-circle" width="80" height="80" style="margin: 10px 25px;"></div>
                                <div style="text-align: center"><p>{{$u->username}}</p><p>{{$u->adress}}</p></div>
                            </div>
                        </a>
                        @endif
                    @endforeach
                    <div class="clear"></div>
                </div>
            @endif
            <br>
            <div  class="bbb"><p>根据学校，专业搜索结果</p></div>
            @if($users2)
                <div>
                    @foreach($users2 as $u)
                        @if($_SESSION['user'][0]->id !=$u->id )
                        <a href="/user/{{$u->id}}">
                            <div class="card">
                                <div><img src="{{$u->headimg}}" class="img-circle" width="80" height="80" style="margin: 10px 25px;"></div>
                                <div style="text-align: center"><p>{{$u->username}}</p><p>{{$u->adress}}</p></div>
                            </div>
                        </a>
                        @endif
                    @endforeach

                    <div class="clear"></div>
                </div>
            @endif
            <br>
            <div  class="bbb"><p>根据公司，职业搜索结果</p></div>

            <p></p>
        </div>
    @endif



</body>
</html>