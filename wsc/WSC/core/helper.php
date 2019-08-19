<?php

//debug 工具 die and dump
function dd()
{
    echo '<pre>';
    call_user_func_array('var_dump', func_get_args());
    echo '</pre>';
    die();
}

//debug 工具 dump
function d()
{
    echo '<pre>';
    call_user_func_array('var_dump', func_get_args());
    echo '</pre>';
}

//重定向函数
function redirect($url)
{
    return header('location:'.$url);
}

//配置获取
function C($config_string)
{
    $config_string = trim($config_string);
    $configs = preg_split('/\./', $config_string);

    if(count($configs) === 2){
        return isset($GLOBALS['g_config'][$configs[0]][$configs[1]])?$GLOBALS['g_config'][$configs[0]][$configs[1]]:false;
    }else{
        return isset($GLOBALS['g_config'][$configs[0]])?$GLOBALS['g_config'][$configs[0]]:false;
    }
}

//添加特殊请求标记方法
function method($method, $tag = 'form')
{
    $method = strtoupper($method);

    switch($tag){
        case 'form':
            return '<input type="hidden" name="_method" value="'.$method.'">';
        case 'get':
            return '_method='.$method;
        default:
            return '';
    }
}


//错误重定向函数
function back($old_values = [])
{
    $_SESSION['old'] = (empty($old_values) ? [] : $old_values);

    $referer = Request::referer();

    $uri = $referer ? $referer:'/';

    return header("location: $uri");
}



//获取表单提交的原始的数据 供再次使用
function old($index = null)
{
    if(func_num_args() === 0) {
        return isset($_SESSION['old']) ? $_SESSION['old'] : false;
    }

    return isset($_SESSION['old'][$index])?$_SESSION['old'][$index]:false;
}

//存储或者获取错误信息
function error($arg1 = null, $arg2 = null)
{
    //如果没有参数 获取错误数组
    if(func_num_args() === 0) {
        return isset($_SESSION['error']) ? $_SESSION['error'] : false;
    }

    //如果有1个参数 并且是字符串 按照索引数组存储错误
    if(func_num_args() === 1 && is_string($arg1)){
        $_SESSION['error'][] = $arg1;
        return true;
    }

    //如果有1个参数 并且是数组 按照递归合并
    if(func_num_args() === 1 && is_array($arg1)){
        $_SESSION['error'] = array_merge_recursive($_SESSION['error'], $arg1);
        return true;
    }

    //如果有2个参数 并且是字符串 存储错误，如果有相同键名的错误合并成一个数组
    if(func_num_args() === 2 && is_string($arg1) && is_string($arg2)) {
        if(!isset($_SESSION['error'][$arg1])){
            $_SESSION['error'][$arg1] = $arg2;
            return true;
        }

        if(!is_array($_SESSION['error'][$arg1])){
            $old[] = $_SESSION['error'][$arg1];
        }else{
            $old = $_SESSION['error'][$arg1];
        }

        if(!is_array($arg2)){
            $new[] = $arg2;
        }else{
            $new = $arg2;
        }

        $_SESSION['error'][$arg1] = array_merge_recursive($old, $new);

        return true;
    }

    return false;
}

//存储session数据
function session($arg1 = null, $arg2 = null)
{
    if(func_num_args() === 0) {
        return isset($_SESSION) ? $_SESSION : false;
    }

    else if(func_num_args() === 1 && (is_string($arg1) || is_numeric($arg1))) {
        return isset($_SESSION[$arg1]) ? $_SESSION[$arg1] : false;
    }

    else if(func_num_args() === 1 && is_array($arg1)){
        $_SESSION = array_merge_recursive($arg1, $_SESSION);
        return true;
    }

    else if(func_num_args() === 1 && is_null($arg1)){
        $_SESSION = [];
        return true;
    }

    else if(func_num_args() === 2) {
        if($arg2 === null){
            unset($_SESSION[$arg1]);
        }else{
            $_SESSION[$arg1] = $arg2;
        }
        return true;
    }

    return false;
}

//一次性读取session数据
function flash($index)
{
    if(is_string($index) || is_numeric($index)) {
        if(!isset($_SESSION[$index])) {
            return false;
        }

        $res = $_SESSION[$index];
        unset($_SESSION[$index]);
        return $res;
    }

    return false;
}

function send_email($toemail, $subject, $body) {
    //示例化PHPMailer核心类
    //vendor模式
    $mail = new PHPMailerService();
    //nameplace 模式;
    //$mail = new \LaneLead\PHPMailer\PHPMailer();
    //是否启用smtp的debug进行调试 开发环境建议开启 生产环境注释掉即可 默认关闭debug调试模式
    $mail->SMTPDebug = 0;

    //使用smtp鉴权方式发送邮件，当然你可以选择pop方式 sendmail方式等 本文不做详解
    //可以参考http://phpmailer.github.io/PHPMailer/当中的详细介绍
    $mail->isSMTP();
    //加密方式 "ssl" or "tls"
    $mail->SMTPSecure = C('email.secure'); //这里要注意, QQ发送邮件使用的ssl方式,如果不设置, 则会失败! 请认真查看下面的配置文件!!!
    //smtp需要鉴权 这个必须是true
    $mail->SMTPAuth=true;
    //链接qq域名邮箱的服务器地址
    $mail->Host = C('email.host');
    //设置ssl连接smtp服务器的远程服务器端口号 可选465或587
    $mail->Port = C('email.port');
    //smtp登录的账号 这里填入字符串格式的qq号即可
    $mail->Username = C('email.username');
    //smtp登录的密码 这里填入“独立密码” 若为设置“独立密码”则填入登录qq的密码 建议设置“独立密码”
    $mail->Password = C('email.psw');
    //设置发件人邮箱地址 这里填入上述提到的“发件人邮箱”
    $mail->From = C('email.from');
    //设置发件人姓名（昵称） 任意内容，显示在收件人邮件的发件人邮箱地址前的发件人姓名
    $mail->FromName = C('email.from_name');
    //设置发送的邮件的编码 可选GB2312 我喜欢utf-8 据说utf8在某些客户端收信下会乱码
    $mail->CharSet = 'UTF-8';
    //邮件正文是否为html编码 注意此处是一个方法 不再是属性 true或false
    $mail->isHTML(true);
    //设置收件人邮箱地址 该方法有两个参数 第一个参数为收件人邮箱地址 第二参数为给该地址设置的昵称 不同的邮箱系统会自动进行处理变动 这里第二个参数的意义不大
    // 添加收件人地址，可以多次使用来添加多个收件人
    if(is_array($toemail)){
        foreach($toemail as $to_email){
            $mail->AddAddress($to_email);
        }
    }else{
        $mail->AddAddress($toemail);
    }
    //添加该邮件的主题
    $mail->Subject = $subject;
    //添加邮件正文 上方将isHTML设置成了true，则可以是完整的html字符串 如：使用file_get_contents函数读取本地的html文件
    $mail->Body = $body;
    //为该邮件添加附件 该方法也有两个参数 第一个参数为附件存放的目录（相对目录、或绝对目录均可） 第二参数为在邮件附件中该附件的名称
    //$mail->addAttachment('./d.jpg','mm.jpg');
    //同样该方法可以多次调用 上传多个附件
    //$mail->addAttachment('./Jlib-1.1.0.js','Jlib.js');
    //dump($mail);exit;

    //发送命令 返回布尔值
    //PS：经过测试，要是收件人不存在，若不出现错误依然返回true 也就是说在发送之前 自己需要些方法实现检测该邮箱是否真实有效
    $status = $mail->send();

    //简单的判断与提示信息
    if($status) {
        //echo 'success';
        return true;
    }else{
        //dump($mail->ErrorInfo);
        return false;
    }
}


//视图加载函数
function view($view, $data = [])
{
    $view_path = __DIR__.'/../app/views/';
    $file_name = $view_path."{$view}.blade.php";
    $temp_file_name = $view_path.$view.rand().time().'.tmp';

    //处理母版文件的继承
    process_masters($file_name, $temp_file_name, $view_path);

    //渲染数据并回处理好页面
    return render_data($temp_file_name, $data);;
}

//处理母版的继承
function process_masters($file_name, $temp_file_name, $view_path)
{
    $is_processed = false;

    while(($lines = file($file_name)) && isset($lines[0]) && strstr($lines[0],"@extends")) {
        $left_quote_pos = strpos($lines[0], "(") + 1;
        $right_quote_pos = strpos($lines[0], ")", $left_quote_pos) - 1;
        $template_path = $view_path . trim(substr($lines[0], $left_quote_pos + 1, $right_quote_pos - $left_quote_pos - 1));
        $template_path .= '.blade.php';

        if(!file_exists($template_path)) {
            dd("模版文件{$template_path}找不到");
        }

        $template = file_get_contents($template_path);

        $find = false;
        $segments = array();
        $segment = $segment_content = '';

        foreach ($lines as $line_num => $line) {
            if (strstr($line, "@section")) {
                $find = true;
                $left_quote_pos = strpos($line, "(") + 1;
                $right_quote_pos = strpos($line, ")", $left_quote_pos) - 1;
                $segment = trim(substr($line, $left_quote_pos + 1, $right_quote_pos - $left_quote_pos - 1));
            } else if (strstr($line, "@endsection") && $find) {
                $segments[$segment] = $segment_content;
                $segment_content = $segment = '';
                $find = false;
            } else if ($find) {
                $segment_content .= $line;
            }
        }

        foreach ($segments as $segment => $content) {
            $search = '@yield(\'' . $segment . '\')';
            $template = str_replace($search, $content, $template);
        }

        $template = preg_replace('/\@yield\(\'.*\'\)/', '', $template);

        $file_name = $temp_file_name;
        file_put_contents($temp_file_name, $template);
        $is_processed = true;
    }

    if(!$is_processed) {
        file_put_contents($temp_file_name, implode($lines));
    }
}

//渲染数据
function render_data($temp_file_name, $data = [])
{
    $lines = file($temp_file_name);

    foreach($lines as $line_num=>$line) {
        if(strstr($line,"@if")) {
            $new_str = substr($line,strpos($line, "@if") + 1);
            $new_str = '<?php ' . $new_str . ': ?>';
            $lines[$line_num] = substr_replace($line, $new_str, strpos($line, "@if"));
        } else if(strstr($line,"@elseif")) {
            $new_str = substr($line,strpos($line, "@elseif") + 1);
            $new_str = '<?php ' . $new_str . ': ?>';
            $lines[$line_num] = substr_replace($line, $new_str, strpos($line, "@elseif"));
        } else if(strstr($line,"@else")) {
            $lines[$line_num] = substr_replace($line, '<?php else: ?>', strpos($line, "@else"));
        } else if(strstr($line,"@endif")) {
            $lines[$line_num] = substr_replace($line, '<?php endif; ?>', strpos($line, "@endif"));
        } else if(strstr($line,"@foreach")) {
            $new_str = substr($line,strpos($line, "@foreach") + 1);
            $new_str = '<?php ' . $new_str . ': ?>';
            $lines[$line_num] = substr_replace($line, $new_str, strpos($line, "@foreach"));
        } else if(strstr($line,"@endforeach")) {
            $lines[$line_num] = substr_replace($line, '<?php endforeach; ?>', strpos($line, "@foreach"));
        }
    }

    $file = implode($lines);

    $file = preg_replace('/\{\{\s*/', '<?php echo ', $file);
    $file = preg_replace('/\s*\}\}/', '; ?>', $file);

    file_put_contents($temp_file_name, $file);

    foreach($data as $key => $value) {
        $$key = $value;
    }

    $output = require $temp_file_name;

    @unlink($temp_file_name);

    return $output;
}
