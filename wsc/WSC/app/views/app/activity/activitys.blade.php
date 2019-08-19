<!DOCTYPE html>
<html lang="zh-CN">
<head>

</head>
<style>
    .actcard .panel-body p{
        margin:2px;
        white-space:nowrap;
        text-overflow:ellipsis;
        overflow: hidden;
    }
    .actcard .content{
        width: 100%;
        height: 50px;
        overflow: hidden;
        background-color: #F7FBFF;
    }
</style>
<body>

    <div id="mesg"></div>

    @if(!$rs)
        <div style="width: 80%;text-align: center;margin:100px auto">
            <img src="/assets/images/none.png">
            <h3>空空如也</h3>
        </div>
    @else
    <?php $i=0 ?>
    @foreach($rs as $art)

        <div class="actcard" id="{{$art->id}}">

            <div class="panel panel-default">
                <a href="/detailsart/{{$art->id}}">
                    <div class="panel-body">
                        <p><h4>{{$art->atc_title}}</h4></p>
                        <div class="content">
                            {{$art->atc_content}}
                        </div>
                    </div>
                </a>
                <div class="panel-footer" style="font-size: 18px">
                    <span><img src="/assets/images/zan.png" width="25"> {{$art->atc_zan}}</span> &nbsp;&nbsp;&nbsp;
                    <span><img src="/assets/images/pinglun.png" width="25">{{$count[$i]->total}}</span>&nbsp;&nbsp;&nbsp;
                    <span><img src="/assets/images/liulan.png" width="25"> {{$art->atc_read}}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <span>{{$art->atc_time}}</span>
                    @if($art->atc_author_id == $_SESSION['user'][0]->id)
                        <span class="pull-right" onclick="del({{$art->id}})"><img src="/assets/images/delete.png" width="25"></span>
                    @endif
                </div>
            </div>

        </div>
        <?php $i++ ?>

    @endforeach
    <br>
    <p style="width: 100%;text-align: center"><a href="javascript:alert('亲！懒加载功能尚未完善。。。');">加载更多》》》》》</a></p>
    @endif
    <script>
        @if($art->atc_author_id == $_SESSION['user'][0]->id)
        function del(id) {
            //删除
            if(window.confirm('确定删除该文章吗？')){
                //alert("确定");
                $.ajax({
                    type: "get",
                    url: "/deleteact/"+id,
                    success: function (data) {
                        if (data == "ok") {
                            $("div").remove("#"+id);
                            alert('删除成功');
                        }
                    },
                    error: function () {
                        alert('删除失败');
                    },
                    complet:function () {
                        alert('删除');
                    }
                });
            }else{
            }

        }
        @endif


    </script>
</body>
</html>