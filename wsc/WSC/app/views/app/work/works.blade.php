@extends('app/masters/app')

@section('title')
    招聘
@endsection
@section('css')
    <style>
        #add{
            position: fixed;
            top: 70px;
            left: 50px;
        }
        #add img:hover{
            transform:rotate(170deg) scale(1.3);
        }
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
        .input-group{
            margin: 5px auto;
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
    @if(session('user')[0]->status == 2)
        <div id="add">
            <img src="/assets/images/addwork.png" width="60" data-toggle="modal" data-target="#myModal">

        </div>
    @endif
    <div id="box">
        <div id="search">
            <div class="input-group">
                <span class="input-group-addon" style="background: #0029ff24">请输入职位名称或者地区：</span>
                <input type="text" class="form-control" id="sw" value="">

                <span class="input-group-btn">
                        <button class="btn btn-default" type="button" onclick="search()">搜索</button>
                </span>
            </div>

        </div>
        <div style="width: 80%;margin: 10px auto">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">搜索结果</h3>
                </div>
                <div class="panel-body" id="searchbox1">

                </div>
            </div>
        </div>
        <div id="articlebox">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">最新推荐(优先地区推荐)</h3>
                </div>
                <div class="panel-body" id="searchbox2">

                </div>
            </div>
        </div>

    </div>


    <!--模态框-->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">发布职位</h4>
                </div>
                <form  action="/addwork" method="post" onsubmit="return checkform()" style="width: 70%;margin: 10px auto;" >
                    <div class="input-group">
                        <span class="input-group-addon">职位名</span>
                        <input type="text" id="workname" name="workname" class="form-control" placeholder="">
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">工作地区</span>
                        <input type="text"  id="workadress" name="workadress" class="form-control" placeholder="">
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">工薪</span>
                        <input type="text"  id="workprice" name="workprice" class="form-control" placeholder="">
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">工作内容</span>
                        <textarea type="text"  id="workcontent" name="workcontent" class="form-control" placeholder="" rows="4"></textarea>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">工作要求</span>
                        <textarea type="text"  id="workask" name="workask" class="form-control" placeholder="" rows="4"></textarea>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">联系方式</span>
                        <input type="text"  id="workphone" name="workphone" class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="发布" class="btn btn-primary btn-block">
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal -->
    </div>
@endsection

@section('js')
    <script>
        window.load = tuijain();
        function search() {
            var s = $('#sw').val();
            $.post('/searchwork',{'sw':s},function (res) {
                $('#searchbox1').html(res);
            });
        }
        function tuijain() {
            $.get('/tjwork/'+20,function (res) {
                $('#searchbox2').html(res);
            });
        }

        function checkform() {
            //js表单验证

            var school = $('#workname').val().trim();
            if(school.length<=0||school==''){

                $('#workname').focus();
                return false;
            }
            var major = $('#workadress').val().trim();
            if(major.length<=0||major==''){

                $('#workadress').focus();
                return false;
            }

            var starttime = $('#workprice').val().trim();
            if(starttime.length<=0||starttime==''){

                $('#workprice').focus();
                return false;
            }

            var endtime = $('#workcontent').val().trim();
            if(endtime.length<=0||endtime==''){
                $('#workcontent').focus();
                return false;
            }
            var endtime = $('#workask').val().trim();
            if(endtime.length<=0||endtime==''){

                $('#workask').focus();
                return false;
            }
            var endtime = $('#workphone').val().trim();
            if(endtime.length<=0||endtime==''){

                $('#workphone').focus();
                return false;
            }
            return true;
        }
    </script>
@endsection