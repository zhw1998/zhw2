@extends('app/masters/app')

@section('title')
    文章
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
                <span class="input-group-addon" style="background: #dff0d8">请输入文章名或用户名：</span>
                <input type="text" class="form-control" id="sw" value="">

                <span class="input-group-btn">
                        <button class="btn btn-default" type="button" onclick="search()">搜索</button>
                </span>
            </div>

        </div>
        <div style="width: 80%;margin: 10px auto">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">搜索结果</h3>
                </div>
                <div class="panel-body" id="searchbox1">

                </div>
            </div>
        </div>

        <div id="articlebox">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">文章分类 </h3>
                    <div style="width: 50px;float: left;margin-left: 100px;margin-top: -25px">
                        <select   id="mySelect"  style="width: 200px" class="form-control">
                            <option value="atc_zan"  >最热</option>
                            <option value="atc_time">最新</option>

                        </select>
                    </div>
                </div>
                <div class="panel-body" id="searchbox2">

                </div>
            </div>
        </div>

    </div>



@endsection

@section('js')
    <script>


        $(document).ready(function(){
            $('#mySelect').change(function(){
                var p1=$(this).children('option:selected').val();//这就是selected的值
                order(p1 );
            })
        })

        function search() {
            var s = $('#sw').val();
            $.post('/searchact',{'sw':s},function (res) {
                $('#searchbox1').html(res);
            });
        }
        window.onload = order('atc_zan');
        function order(what) {
            $.get('/order/'+what,function (res) {
                $('#searchbox2').html(res);
            });
        }


    </script>
@endsection