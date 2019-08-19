@extends('app/masters/app')

@section('title')
    首页
@endsection
@section('css')
    <style>
        #box{
            position: relative;
            min-height: 800px;
            margin:20px auto;
            width: 1100px;
        }

        #mybox{
            position: fixed;
            width: 300px;
            height: 400px;
            left:100px;
            top: 60px;
        }

        #articlebox{
            width: 800px;
            position: absolute;
            right: 20px;
            min-height:80%;
        }

        .panel{
            width: 100%;
        }
        .art_card{
            margin-top:15px;
            min-height: 110px;
            width: 100%;
            background: honeydew;
            border: 1px solid #b6c6d7;
            border-radius: 3px;
        }
        .atc_content{
            width: 100%;
            height: 50px;
            overflow: hidden;
            background: beige;
        }
    </style>

@endsection
@section('body')
    <div id="box">

        <div id="mybox">

            <div class="panel panel-success">

                <div class="panel-heading" style="text-align: center">
                    @if(session('user'))
                        <p>wsc职场社交平台 欢迎您！ {{ $_SESSION['user'][0]->username}} </p>
                        <img src="{{ $_SESSION['user'][0]->headimg}}" class="img-circle" width="70" height="70">
                        <p>{{ $_SESSION['user'][0]->adress}}</p>
                        <p>{{ $_SESSION['user'][0]->about}}</p>
                        <input type="hidden" id="id" value="{{ $_SESSION['user'][0]->id}}">
                    @endif
                </div>
                <div class="panel-body">
                    @if(session('user'))
                    <p>
                        <a href="/creatart/new"><button type="button" class="btn btn-primary btn-lg btn-block">发布文章</button></a>
                    </p>
                    <p>
                        <a href="/myarchives/{{$_SESSION['user'][0]->id}}"><button type="button" class="btn btn-default btn-lg btn-block">完善资料</button></a>
                    </p>
                    @else
                        <p>登录更精彩哦！！ &emsp;<span> <a href="/login">去登陆》》》》</a></span></p>
                    @endif
                </div>

            </div>

        </div>

        <div id="articlebox">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">热点文章</h3>
                </div>
                <div class="panel-body"style="">
                    <?php $i=0 ?>
                    @foreach($rs as $art)
                        <div class="art_card">
                            <p class="atc_title" style="font-size: 18px;padding: 3px"><a class="text-muted" href="/detailsart/{{$art->id}}"><i> {{$art->atc_title}} </i></a>
                                <span class="pull-right" > <a href="/user/{{$art->atc_author_id}}"> {{$art->atc_author}}</a></span>
                            </p>
                            <a class="text-muted" href="/detailsart/{{$art->id}}"><div class="atc_content"> {{$art->atc_content}}</div></a>
                            <p style="padding: 5px;">
                                <span><img src="/assets/images/zan.png" width="22">  {{$art->atc_zan}}</span> &nbsp;&nbsp;&nbsp;
                                <span><img src="/assets/images/pinglun.png" width="22"> {{$count[$i]->total}}</span>&nbsp;&nbsp;&nbsp;
                                <span><img src="/assets/images/liulan.png" width="22">  {{$art->atc_read}}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <span>{{$art->atc_time}}</span>

                            </p>
                        </div>
                        <?php $i++ ?>
                    @endforeach
                        <br>
                        <p style="width: 100%;text-align: center"><a href="javascript:alert('亲！懒加载功能尚未完善。。。');">加载更多》》》》》</a></p>
                </div>
            </div>
        </div>


    </div>

@endsection

@section('js')
    <script>

    </script>
@endsection