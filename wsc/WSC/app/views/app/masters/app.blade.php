<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>
        @yield('title')
    </title>
    <link rel="shortcut icon" href="/assets/images/icon.ico" />

    <link rel="bookmark"href="/assets/images/icon.ico" />
    <!-- Bootstrap -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="/assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="/assets/css/common.css" rel="stylesheet">
@yield('css')

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you View the page via file:// -->
    <!--[if lt IE 9]>
    <script src="/assets/js/html5shiv.min.js"></script>
    <script src="/assets/js/respond.min.js"></script>
    <![endif]-->

    <script src="/assets/js/ie10-viewport-bug-workaround.js"></script>
    <script src="/assets/js/ie-emulation-modes-warning.js"></script>
    <style>
        body{
            /*background: url("/assets/images/bg.jpg") no-repeat;*/
            /*background-size:100% 100% ;*/
            background: #d9edf71c;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <img src="/assets/images/icon.ico" class="navbar-brand"  >
            <a class="navbar-brand" href="/">WSC</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

            <form class="navbar-form navbar-left" action="/indexsearch" method="get">
                <div class="form-group">
                    <input type="text" name="content" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default">搜索</button>
            </form>


            <ul class="nav navbar-nav navbar-right">
                @if(session('user'))
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ $_SESSION['user'][0]->username}} <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li>
                                <div style="text-align: center">
                                    <img src="{{$_SESSION['user'][0]->headimg}}" class="img-circle" width="50" height="50">
                                    <label>华东交通大学理工学院</label>
                                    <p><a href="/myarchives/{{$_SESSION['user'][0]->id}}">个人档案</a></p>
                                </div>
                            </li>
                            <li role="separator" class="divider"> </li>

                            <li><a href="/activity/{{$_SESSION['user'][0]->id}}">文章和动态</a></li>

                            <li role="separator" class="divider"></li>
                            <li><a href="/logout">退出登录</a></li>
                        </ul>
                    </li>
                @else
                    <li><a href="/register">注册</a></li>
                    <li><a href="/login">登录</a></li>
                @endif
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li id="a"><a href="/">主页</a></li>
                <li id="d"><a href="/activity">文章</a></li>
                <li id="b"><a href="/connections">人脉</a></li>
                <li id="c"><a href="/work"> 职位</a></li>

            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<div class="container-fluid">
    <div style="height: 50px"></div>


    @yield('body')
    <div style="height: 10px"></div>
</div>

<footer>
    <hr>
    <div class="text-center">
        <input type="hidden" id="active" value="{{$active}}">
        Copyright@职场社交,2019
    </div>
</footer>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="/assets/js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/assets/js/bootstrap.min.js"></script>

@yield('js')
<script>
    window.onload = function () {
        var a = $('#active').val();
        $('#'+a).attr('class','active');
    }
</script>
</body>
</html>