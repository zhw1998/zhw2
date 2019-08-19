@extends('app/masters/app')

@section('title')
    登录职场
@endsection

@section('body')
    <div class="col-xs-10 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
        <form action="/login" method="post" onsubmit="return checkform()">

            <h1 class="text-center">职场登录</h1>
            <hr>

            <div class="form-group">
                <label>账号</label>
                <input type="text" name="usercode" value="{{ old('usercode') }}" class="form-control" placeholder="账号">
            </div>
            <div class="form-group">
                <label>密码</label>
                <input type="password" name="password" class="form-control" placeholder="密码">
            </div>

            <div class="form-group">
                <img src="/captcha" name="captcha" style="width:100%" onclick="this.src='/captcha?'+Math.random()">
            </div>
            <div class="form-group">
                <label>验证码</label>
                <input type="text" name="captcha" class="form-control" placeholder="验证码">
            </div>
            <div class="form-group">
                <input type="submit" value="登录" class="btn btn-primary btn-block">
            </div>

            @if(error())
                <div class="alert alert-danger">
                    <ul>
                        @foreach(flash('error') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        </form>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        function checkform() {
            return true;
        }
    </script>
@endsection