@extends('app/masters/app')

@section('title')
    注册账号
@endsection

@section('body')

    <div class="col-xs-10 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
        <form action="/register" method="post" onsubmit="return checkform()">

            <h1 class="text-center">注册</h1>
            <hr>
            <div class="form-group">
                <label>用户名</label>
                <input type="text" name="username" id="username" value="{{ old('username') }}" class="form-control" placeholder="用户名长度2-6位">
            </div>
            <div class="form-group">
                <label>账号</label>
                <input type="text" name="usercode" id="usercode" value="{{ old('usercode') }}" class="form-control" placeholder="账号6-12位英文或数字">
            </div>
            <div class="form-group">
                <label>密码</label>
                <input type="password" name="password" id="password"  class="form-control" placeholder="密码6-12位英文数字结合">
            </div>
            <div class="form-group">
                <label>确认密码</label>
                <input type="password" name="confirm" id="confirm" class="form-control" placeholder="确认密码">
            </div>
            <div class="form-group">
                <label>身份</label>
                <select name="status" id="status"  class="form-control">
                    <option value="1">在校</option>
                    <option value="2">在职</option>

                </select>
            </div>
            <div class="form-group">
                <img src="/captcha" name="captcha" style="width:100%" onclick="this.src='/captcha?'+Math.random()">
            </div>
            <div class="form-group">
                <label>验证码</label>
                <input type="text" name="captcha" class="form-control" placeholder="验证码">
            </div>
            <div class="form-group">
                <input type="submit" value="注册" class="btn btn-primary btn-block">
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
            //js表单验证
            //用户名长度2-6
            var name = $('#username').val();
            if(name.length>6||name.length<2){
                $('#username').parent().attr("class","has-error");
                $('#username').focus();
                return false;
            }
            //账号6-12位英文或数字
            var code = $('#usercode').val();
            var reg =/^[0-9A-Za-z]{6,12}$/;
            if(!reg.test(code)){
                $('#usercode').parent().attr("class","has-error");
                $('#usercode').focus();
                return false;
            }
            //密码为6-12位英文数字结合
            var pas1 = $('#password').val();
            var reg2 = /^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{6,12}$/;
            if(!reg2.test(pas1)){
                $('#password').parent().attr("class","has-error");
                $('#password').focus();
                return false;
            }
            var pas2 = $('#confirm').val();
            //两次密码是否一致
            if(pas2!=pas1){
                $('#confirm').parent().attr("class","has-error");
                $('#confirm').focus();
                return false;
            }

            return true;
        }
    </script>
@endsection