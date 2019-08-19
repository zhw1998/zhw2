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
            background: #c2c2c238;
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

<div>

    @foreach($works as $w)
            <a href="/workdetail/{{$w->id}}">
                <div class="card">
                    <div><img src="/assets/images/work.png" class="img-circle" width="80" height="80" style="margin: 10px 25px;"></div>
                    <div style="text-align: center"><p>{{$w->workname}}</p><p>{{$w->workadress}}</p><p>{{$w->workprice}}</p></div>
                </div>
            </a>

    @endforeach
    <div class="clear"></div>
</div>


</body>
</html>