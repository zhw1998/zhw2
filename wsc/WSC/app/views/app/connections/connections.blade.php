@extends('app/masters/app')

@section('title')
    人脉
@endsection
@section('css')
    <style>
        #search{
            width: 50%;
            height: 50px;
            margin: 20px auto;
            text-align: center;
        }
        #articlebox{
            width: 80%;
            min-height: 400px;
            margin: 20px auto;
        }
        #searchbox{

        }
    </style>

@endsection
@section('body')

    @if(error())
        <div class="alert alert-success" style="text-align: center">
            <ul>
                @foreach(flash('error') as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div id="box">
        <div id="search">
            <div class="input-group">
                <span class="input-group-addon">请输入你想找的人相关信息：</span>
                <input type="text" class="form-control" id="sw" value="">

                <span class="input-group-btn">
                        <button class="btn btn-default" type="button" onclick="search()">搜索</button>
                </span>
            </div>

        </div>
        <div style="width: 80%;margin: 10px auto">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">搜索结果</h3>
                </div>
                <div class="panel-body" id="searchbox1">

                </div>
            </div>
        </div>
        <div id="articlebox">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">更多推荐</h3>
                </div>
                <div class="panel-body" id="searchbox2">

                </div>
            </div>
        </div>

    </div>

@endsection

@section('js')
    <script>
        window.load = tuijain();
        function search() {
            var s = $('#sw').val();
            $.post('/csearch',{'sw':s},function (res) {
                $('#searchbox1').html(res);
            });
        }
        function tuijain() {
            $.get('/tuijain/'+20,function (res) {
                $('#searchbox2').html(res);
            });
        }
    </script>
@endsection