@extends('app/masters/app')

@section('title')
    编辑文章
@endsection
@section('css')
    <style>

        .box2{ width:1000px;margin:40px auto; }
        p{text-align: center;}
    </style>

@endsection
@section('body')
    <div id="box">
        <div class="box2">
            <form  role="form" method="post" action="" name="artform">
                @if(session('ok'))
                    <div class="form-group alert alert-success">
                        {{flash('ok')}}
                    </div>
                @endif
                <div class="form-group">
                    <input type="text" class="form-control" name="art_title" value="{{old('art_title')}}" id="art_title" placeholder="标题">
                </div>
                <br>
                <div class="form-group">
                    <textarea name="art_content" id="art_content"> {{old('atc_content')}} </textarea>
                </div>
                    <input type="hidden" name="id" value=" {{old('id')}}" >
                    <input type="hidden" name="type" value="">

                <div class="form-group" id="error">

                </div>


            </form>
            <button class="btn btn-primary btn-lg btn-block" onclick="submit()">发布</button>
            <button class="btn btn-default  btn-lg btn-block" onclick="save()">保存草稿</button>
        </div>
    </div>

@endsection

@section('js')
    <script type="text/javascript" src="/assets/Ueditor/ueditor.config.js"></script>
    <script type="text/javascript" src="/assets/Ueditor/ueditor.all.min.js"></script>
    <script type="text/javascript" src="/assets/Ueditor/lang/zh-cn/zh-cn.js"></script>
    <script type="text/javascript">
        var ed = UE.getEditor('art_content',{initialFrameWidth:1000,initialFrameHeight:400, toolbars : [
            [ 'fullscreen', 'bold', 'italic',
                'underline', 'forecolor', 'simpleupload','fontsize', 'fontfamily',
                'justifyleft', 'justifyright', 'justifycenter', 'justifyjustify',
                'time', 'date',
                'selectall', 'cleardoc', 'emotion' ]
        ]})
        function save() {

            if(check()){
                //保存
                document.artform.type.value='0';
                document.artform.action="/updataart";
                document.artform.submit();
            }
        }
        function submit() {

            if(check()){
                //发布
                document.artform.type.value='1';
                document.artform.action="/updataart";
                document.artform.submit();
            }
        }
        function check(){
            var art_title=$('#art_title').val();
            var art_content=ed.getContent();

            var b = /^\s*$/g;
            if(art_title==""||b.test(art_title)){
                $('#art_title').parent().attr("class","has-error");
                $('#error').attr("class","alert alert-danger");
                $('#error').html('标题不能为空！');
                return false;
            }
            if(art_content==""||b.test(art_content)){
                $('#error').attr("class","alert alert-danger");
                $('#error').html('内容能为空！');
                return false;
            }

            return true;
        }
    </script>

@endsection