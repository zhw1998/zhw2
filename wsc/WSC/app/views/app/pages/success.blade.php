@extends('app/masters/app')

@section('title')
    注册成功
@endsection
@section('css')
    <style>
        #mybox{
            width: 70%;
            text-align: center;
            margin: 100px auto;
        }

    </style>

@endsection
@section('body')
    <div id="mybox">
        <h1>{{$mesg}} &emsp;&emsp; <span id="time">5</span></h1>
    </div>


@endsection

@section('js')
    <script>
        window.onload = countDown();
        var t = 5;
        function countDown(){
            var time = $('#time').text();
            t--;
            $('#time').html(t);
            if (t<=0) {
                location.href="/";
                clearInterval(inter);
            };
        }
        var inter = setInterval("countDown()",1000);
    </script>
@endsection