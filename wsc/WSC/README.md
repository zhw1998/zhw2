# mini-framework

> A laravel-like framework for study purpose only.
> 一个类laravel体验的迷你框架，仅供学习使用

# mini-framework 框架参考文档

## mini-framework 框架环境需求
> mini-framework 对框架环境的需求并不高，但你可能还是需要打开
  apache 服务器中的 rewrite module，即重写模块
> apache配置文件 httpd.conf 中 ctrf + f 搜索 rewrite
  找到rewrite module这行 去掉前面的#
> 高级版本的apache服务器或者一体包，如wamp,xampp可能默认开启


## mini-framework 的环境搭建
### mini框架需要将根目录中的源文件解压后放置网站根目录
> 网站根目录默认指apache环境的localhost域名所对应的目录www,或者htdocs文件夹
> 网站根目录亦可以是虚拟主机的根目录
>> 使用phpstudy的站点域名管理创建虚拟站点（切勿忘记通过hosts文件解析域名）


## mini-framework 框架第一步:认识文件结构
### mini框架的文件结构树
-app                 项目文件夹
--controllers          控制器
--models               模型
--views                视图
--config.php           配置文件
--routes.php           路由文件
-assets              资源文件夹
                       存放css,jss,image,fonts等资源
-core                核心文件夹
                       存放框架底层核心类，函数库以及引导文件
-database            数据库文件夹
                       存放与数据库相关的相关文件，实例数据库脚本附上
-services            第三方服务文件夹
                       存放文件上传，验证码，加密，图片, 邮件处理等第三方类
-.htaccess           访问权限控制
                       存放路由重写规则以及访问权限配置相关内容
-gulpfile.js         自动化工作流工具gulp的工作间
-index.php           唯一的入口文件 接收并处理所有服务器请求
-package.json        npm包依赖管理文件
-README.md           参考文件 包含框架相关的参考文档
-template.html       视图模版参考

### 作为非框架开发人员，你可能只需要关注app文件夹下文件的增删改查
#### 当然这并不意味着你不需要查看其他文件 :(

## mini-framework 框架第二步:认识配置文件　app/config.php
> 配置文件负责项目，数据库，验证码，上传等配置信息的修改
> 具体参考文件注释 app/config.php

## mini-framework 框架第三步:认识路由文件　app/routes.php

```php

    Router::get('/', 'PagesController@index');

    Router::get('/about/developer', function(){
        echo '回调函数响应请求';
    });

```
### 定义路由响应的第一种方式: 回调函数

```php

    Router::get('/about/developer', function(){
        echo '回调函数响应请求';
    });

```

### 定义路由响应的第二种方式: 控制器@操作

```php

    Router::get('/', 'PagesController@index');

```

### 定义路由总则:

> Router::请求方法(路由，回调函数或者控制器@操作形式)

>> 请求方法支持get,post,put,delete
>>> 对应操作为显示，添加，更新，与删除

>> 路由的声明要以'/'开头，按照自己意愿有两种方式规划

>>> 不带参数路由
```php

    Router::get('/', 'PagesController@index');
    Router::get('/about', 'PagesController@about');
    Router::get('/admin/login', 'AdminsController@login');

```
>>> 带参数路由 参数通过｛｝表示
```php

    Router::get('/{username}', 'UsersController@index');
    Router::get('/video/{id}', 'VideosController@index');
    Router::get('/user/{id}/edit', function($uid){
        d($uid);
    });

```
>>> 路由不论带参数与不带参数，切记要注意顺序
>>>> 下述代码体现了顺序的重要性，尝试/admin, /about
```php

    Router::get('/{username}', function($username){
        d($username);
    });
    Router::get('/about', function(){
        d('about');
    });

    Router::get('/{username}/edit', function($username){
        d($username);
    });
    Router::get('/user/edit', function(){
        d('/user/edit');
    });

```

>>> 路由如果带有参数，其路由请求中的参数将会被注入到
    回调函数中或者控制器的对象方法中,请按顺序引用

```php

    Router::get('/user/{id}/photo/{id}', function($user_id, $photo_id){
        d('正确');
    });
    Router::get('/user/{id}/photo/{id}', function($photo_id, $user_id){
        d('错误');
    });

```

### 路由定制实例参考
  请求方法  路由地址                对应控制器方法         当前作用
> GET       /article                index()                显示文章列表
> GET       /article/create         create()               文章新建页面
> POST      /article                store()                文章存储操作
> GET       /article/{id}           show($id)              文章详情显示
> GET       /article/{id}/edit      edit($id)              文章编辑页
> PUT       /article/{id}           update($id)            文章更新操作
> DELETE    /article/{id}           destroy($id)           文章删除操作


## mini-framework 框架第四步:认识控制器文件　app/controllers/...

### 控制器介绍
> 控制器是处理请求路由的第二种也是最常用的请求方式
> 控制器的创建需要符合如下规定
>> 控制器所在的文件必须命名为 以Controller.php结尾的文件，存放在app/controllers/下
   如：app/controllers/PagesController.php
>> 控制器类必须为以控制器名+Controller结尾 并且继承 Controller 父类
   如：class PagesController extends Controller{}
>> 当使用控制器时，注意其方法必须与路由绑定中的方法一直，否则，将会
   触发方法不存在错误
   如：
```php

   Router::get('/{username}', 'UsersController@index');

```
   上述代码中，UsersController@index中的index 即控制器的响应方法，即当
   用户访问任何满足路由/{username} get请求时，调用该方法进行响应


### 控制器中的可访问列表使用细则
> 在控制器当中可以控制路由是否需要登录才能访问，该操作通过使用可访问列表实现

>> 在控制器中可以添加如下四个属性，进行可访问列表的设置

```php

    protected $access_control = false;//设置是否开启访问权限控制，如要开启必须设置

    protected $accessible_list = [];//设置允许未登录访问的操作（即控制器中的方法）

    protected $login_identifier = 'user';//设置session中的登录检测标识，根据编码设置

    protected $login_route = '/login';//设置未允许访问时跳转的登录页面，根据路由设置

```

## mini-framework 框架第五步:认识视图文件　app/views/...

### 视图介绍
> 视图是响应用户请求最好的可视化界面
> 使用视图的默认两种方式为
1. 无数据绑定视图的引用
```php

    public function index()
    {
        return view('app/pages/index');
    }

```
2. 携带数据绑定视图的渲染引用
```php

    public function index()
    {
        $message = 'Hello World';
        return view('app/pages/index', compact('message'));
    }

```
2.1 携带的数据可以是一个也可以是多个取决于具体情况
    compact 函数可以打包所有需要渲染的数据

### 视图文件统一存放在views目录下，可以通过配置文件更改（不推荐）

> 视图的规划可以按照模块划分 如框架默认自带的app模块
  或者user模块，admin管理模块，可以依据用户群组进行划分等
>> 在模块中，依据控制器进行划分，文件名以.blade.php结尾
>> 尽量遵循规则, 可以不一样，但尽量命名清晰明了
1. index.blade.php   表示显示所有
2. show.blade.php    表示显示一个
3. create.blade.php  表示添加表单
4. edit.blade.php    表示修改表单

### 视图模版技术

> 视图模版技术是一种能够可以提高代码复用以及管理的高效技术
> 模版技术中支持母版的继承、条件、循环以及数据输出

>> 母版的创建
>>> 母版是可以被继承并使用的前端页面
>>> 使用@yield关键字在母版中定义占位符
>>> 占位符即被子页继承时可以被填充的位置
>>> 如：

```php 创建母版A

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>
            @yield('title')
        </title>

        @yield('style')
    </head>
    <body>
        @yield('header')

        <div class="container">
            @yield('body')
        </div>

        @yield('footer')
    </body>
    </html>

```

>> 子页的继承

>>> 继承是从母版页获得所有母版信息的方式
>>> 可以通过 @extends 实现，并且使用 @section 进行内容填充
>>> 如:

```php 子页继承母版A

    @extends('从视图根目录开始的母版A路径,不包含.blade.php')

    @section('title')
        填充标题
    @endsection

    @section('style')
        <style rel="stylesheet" type="text/css">
            body{
                color: red;
            }
        </style>
    @endsection

    @section('body')
        <h1>这是测试用例，一点没用</h1>
    @endsection

    @section('footer')
        这里其实可以放点javascript

        <script type="text/javascript">
            alert('写文档真烦');
        </script>
    @endsection

```

>>> 母版的占位符不一定都要填充，甚至可以都不填充
>>> 母版可以被另一个母版继承，但需要注意母版的占位符
    如果没有被填充，还需要被继承，请以占位符填充
>>>

```php 假设母版 B继承上述母版

    @extends('母版A路径')

    @section('title')
        @yield('yield 这里需要被再继承子页填充')
    @endsection

    @section('style')
        <style rel="stylesheet" type="text/css">
            body{
                color: red;
            }
        </style>
    @endsection

    @section('body')
        @yield('body 这里也是')
    @endsection

    @section('footer')
        这里其实可以放点javascript

        <script type="text/javascript">
            alert('写文档真烦');
        </script>
    @endsection

```

>>> 上述母版B拥有两个占位符 title, body 需要被继承者继续填充

>> 模版技术之条件分支

>>> 在html代码中可以使用模版技术的@if @elseif @else @endif
    实现对页面元素的控制
>>> 如：

```php

    @if(something)
        <h1>h1</h1>
    @elseif(something)
        <h2>h2</h2>
    @else
        <h3>h3</h3>
    @endif

```

>> 模版技术之循环

>>> 在html代码中可以使用模版技术的@foreach @endforeach
    实现对页面元素的循环产生
>>> 如：

```php
    //循环遍历数组将学生信息输出
    @foreach($students as $student)
        <td>{{ $student->id }}</td>
        <td>{{ $student->name }}</td>
        <td>{{ $student->create_time }}</td>
    @endforeach

```

>> 模版技术之变量输出

>>> 在html代码中可以使用模版技术的 {{  }}
    实现对数据的渲染输出
>>> 如：

```php

    // 直接使用变量名
    欢迎回来，{{ $username }}

    // 使用数组
    用户ID : {{ $user['id'] }}

    // 使用对象
    @foreach($students as $student)
        <td>{{ $student->id }}</td>
        <td>{{ $student->name }}</td>
        <td>{{ $student->create_time }}</td>
    @endforeach

    // 方法的调用
    {{ dd(error()) }}

```
>>> 使用{{  }}时需注意其中的值是否能输出

## mini-framework 框架第六步:认识模型与数据库操作　app/models/...

> 在mini-framework中，内置了非常实用的数据库底层操作
  如非数据库实现非常复杂、控制器业务逻辑非常繁琐或者其他特殊情况
  可以不用考虑添加对应模型

  模型父类Model可以为继承模型类提供系列操作，如下：

  可以设置的属性有
    protected $fillable = [];//设置添加时需要真正需要用户给的数据字段

    protected $table = '';//设置表名

    protected $rules = [

        '字段名' => [
            '验证规则' => '错误信息',
            ....
            '自定义规则'=> '错误信息'
            ....
            'pattern' => [
                'reg'       => '正则表达式',
                'errormsg'  => '错误信息'
            ]
        ]

    ];
    //验证规则支持 required非空验证,unique唯一验证,datetime时间验证,pattern正则表达验证
    //除正则表达验证比较特殊已在上述描述出来，剩下参考统一格式
    //支持自定义规则定制 => 自定义方法名填写在自定义规则中

>> 通过设置上述规则，可以使用validate()方法进行表单数据校验

1. public function validate($data = [])    
>>> 进行表单数据验证
>>> 参数1：表单数据

```php

    //实例化相关对象  $db = new Model(); $db = new UserModel();都可以
    $db->validate(); //不传参表示使用$_POST数据
    $db->validate($data); //自定义数据

```




>> 数据库DB类从底层提供了一些操作，所有模型类均继承可以使用

1. public function query($query, $parameters = [], $intoClass = 'stdClass')
>>> 原生请求处理方法支持增删改查各种请求
>>> 参数1: sql语句
>>> 参数2: 查询参数 具体使用参考 find, update
>>> 参数3: 如果查询语句返回结果集需要转换为指定类，则指定，否则返回标准类

```php

    //实例化相关对象 $db = new DB();  $db = new Model(); $db = new UserModel();都可以
    $db->query('select * from `type`');
    $db->query('update `type` set name = ? where id = ?', [
        '姓名', 10
    ]);

```

2. public function find($query, $parameters = [], $intoClass = 'stdClass')
>>> 唯一数据的查找，如果找不到或者找到多条返回false
>>> 参数1: 带有条件查询的sql语句
>>> 参数2: 查询参数，根据情况传入对应数组
>>>> 如果sql 为 select * from `type` where id = ? and name = ? 形式传入对号入座的索引数组
>>>> $parameters = [ $id, $name ];
>>>> 如果sql 为 select * from `type` where id = :id and name = :name 形式传入关联数组
>>>> $parameters = [ 'id' => $id, 'name' => $name ]; // 键名与 :占位符 一一对应
>>> 参数3: 如果查询语句返回结果集需要转换为指定类，则指定，否则返回标准类

```php

    //实例化相关对象 $db = new DB();  $db = new Model(); $db = new UserModel();都可以
    $parameters = [$id, $name];
    $parameters1 = ['id'=>$id, 'name'=>$name];

    $db->find('select * from `type` where id = ? and name = ?', $parameters);
    $db->find('select * from `type` where id = :id and name = :name', $parameters1);

```

3. public function save($table, $parameters)
>>> 添加数据
>>> 参数1: 表名
>>> 参数2: 添加参数，传入对应表必备属性的关联数组 $parameters = ['name' => $name];

```php

    //实例化相关对象 $db = new DB();  $db = new Model(); $db = new UserModel();都可以
    // type 表的结构参考 database/example.sql, $name 为必备属性
    $parameters = ['name' => $name];

    $db->save('type', $parameters);

```


## mini-framework 框架第七步: 认识全局帮助函数 core/helper.php 以及 Request类

> 全局函数 或直接或间接提高了开发效率

```php

    //debug 工具 die and dump 查看变量的具体信息并停止脚本
    function dd(){}

        dd($data,$data1);//支持不定参数


    //debug 工具 dump 查看变量的具体信息 但不停止脚本
    function d(){}

        d($data,$data1);//支持不定参数


    //重定向函数 重定向至指定路由, 路由参考路由绑定文件 app/routes.php
    function redirect($path){}
    

        return redirect('/');//跳转到路由'/'，一般指主页

    //配置信息获取
    function C($config_string)

        C('app.server');//获得config.php中app下面server对应的值



    //添加特殊请求标记方法 - 往get请求或者表单中添加 PUT 或者 DELETE 请求（默认表单提交不支持）
    function method($method, $tag = 'form'){}

        {{ method('put') }}                           //表单提交put请求时需带上
        {{ method('delete') }}                        //表单提交delete请求时需带上
        href="/user/1/?{{ method('delete', 'get') }}"  //通过get请求发送delete时需要加入第二个参数
                                                                       //注意，ajax发送get请求仅支持get

    //错误重定向函数 - 当处理页面出现问题，可以调用本函数跳回上一次页面
                                                    //（可以携带表单数据返回）
                                                    function back($old_values = []){}
                                                
                                                        return back(); //返回上一次页面
                                                        return back($old_values); //携带数据并返回上一次页面


    //获取表单提交的原始的数据 供再次使用
    //如果back()函数携带了数据返回，则可调用此函数快速获取原始数据
    function old($index = null){}

        <input type="text" name="username" value="{{ old('username') }}">


    //存储或者获取错误信息 - 如果有表单验证等，可以使用此函数进行错误收集，判断，以及展示
    function error($error = null){}

        error('用户名必须为以字母开头的八位字符串');
        error(); //如果不带参数返回所有错误信息，如果没有返回false


    //存储session数据 - 查看或者添加session
    function session($arg1 = null, $arg2 = null){}

        session();//如果不带参数，返回session数组
        session(null);//如果只有一个参数并且为null，清空session数组
        session('old');//如果只有一个参数并且为字符串，则查看对应session值
        session(['old'=>'something']);//如果只有一个参数且为数组，则递归合并数组
        session('old', 'something');//如果有两个参数，则赋值


    //一次性读取session数据 - 一次性查看session数据
    function flash($index){}

        flash('error');//一次性使用error错误信息并销毁

    //邮件发送快捷函数服务
    function send_email($toemail, $subject, $body){}

        send_email('yupeng.kevin.wu@gmail.com', '邮件标题', '邮件内容')
        send_email([
            'yupeng.kevin.wu@gmail.com',
            '第二个邮件',
            ......
        ], '邮件标题', '邮件内容')     //第一个参数为邮件则群发邮件

        如需使用邮件发送请开启php 扩展 openssl, 在config.php的email配置项中进行相关配置

    //视图加载函数 - 视图的加载以及数据渲染
    function view($view, $data = []){}

        return view('app/pages/index');//返回视图未渲染数据的视图
        return view('app/users/index', compact('users'));//返回渲染数据的视图


    Request 类有几个静态方法可供 使用

        //获得请求的uri
        public static function uri()

            Request::uri()

        //获得请求的前置路由 如果没有返回false
        public static function referer()

            Request::referer()

        //获得请求的ip
        public static function ip($numeric = false)

            Request::ip() 获得ip地址默认不带参数为字符串
            Request::ip(true) 获得ip地址的整数形式，方便存储

        //获得请求的方法
        public static function method()

            Request::method() 获得请求类型

```


## mini-framework 框架第八步: 认识第三方服务 service/...

1. Captcha 验证码服务
> 验证码服务可以用来生成并验证有效的提交

```html

    <img src="/captcha" name="captcha" onclick="this.src='/captcha?'+Math.random()">

```

```php

    //in app/routes.php 路由 /captcha
    Router::get('/captcha', function(){
        (new CaptchaService())->entry();//通过/captcha获取验证码
    });

    //in 处理文件

    if((new CaptchaService())->check()){
        dd('检验通过');
    }else{
        dd('检验失败');
    }

```


2. Upload 文件上传服务
> 支持文件上传服务

```html

    <form action="/upload" enctype="multipart/form-data" method="post" >
            <input type="file" name="photo" />
            <input type="submit" value="提交" >
    </form>

    <form action="/upload" enctype="multipart/form-data" method="post" >
        <input type="file" name="photo[]" />
        <input type="file" name="photo[]" />
        <input type="submit" value="提交" >
    </form>

```

```php

    $upload = new UploadService();// 实例化上传类

    $info   =   $upload->upload();// 上传文件

    if(!$info) {// 上传错误提示错误信息
        dd(error($upload->getError()));
    }else{// 上传成功
        dd($this->success('上传成功！'));
    }

```


3. Image 图片处理
>  可以对图片进行裁剪，缩略图生成以及水印

```php

    /*
    IMAGE_THUMB_SCALE     =   1 ; //等比例缩放类型
    IMAGE_THUMB_FILLED    =   2 ; //缩放后填充类型
    IMAGE_THUMB_CENTER    =   3 ; //居中裁剪类型
    IMAGE_THUMB_NORTHWEST =   4 ; //左上角裁剪类型
    IMAGE_THUMB_SOUTHEAST =   5 ; //右下角裁剪类型
    IMAGE_THUMB_FIXED     =   6 ; //固定尺寸缩放类型
    */

    $image = new ImageService();
    $image->open('图片路径');
    $width = $image->width(); // 返回图片的宽度
    $height = $image->height(); // 返回图片的高度
    $type = $image->type(); // 返回图片的类型
    $mime = $image->mime(); // 返回图片的mime类型
    $size = $image->size(); // 返回图片的尺寸数组 0 图片宽度 1 图片高度

    //裁剪
    $image->crop(400, 400)->save('保存图片的路径以及名字');

    //缩略图
    $image->thumb(150, 150)->save('保存图片的路径以及名字');

    //带有指定位置的缩略图
    $image->thumb(150, 150, ImageService::IMAGE_THUMB_CENTER)->save('保存图片的路径以及名字');

    /*
    IMAGE_WATER_NORTHWEST =   1 ; //左上角水印
    IMAGE_WATER_NORTH     =   2 ; //上居中水印
    IMAGE_WATER_NORTHEAST =   3 ; //右上角水印
    IMAGE_WATER_WEST      =   4 ; //左居中水印
    IMAGE_WATER_CENTER    =   5 ; //居中水印
    IMAGE_WATER_EAST      =   6 ; //右居中水印
    IMAGE_WATER_SOUTHWEST =   7 ; //左下角水印
    IMAGE_WATER_SOUTH     =   8 ; //下居中水印
    IMAGE_WATER_SOUTHEAST =   9 ; //右下角水印
    */

    //上水印图片
    $image->water('水印图片')->save("保存图片的路径以及名字");

    //上指定位置的水印
    $image->water('水印图片',ImageService::IMAGE_WATER_NORTHWEST)->save("保存图片的路径以及名字");

    //上指定位置并且带有透明度的水印
    $image->water('水印图片',ImageService::IMAGE_WATER_NORTHWEST,50)->save("保存图片的路径以及名字");

    //上指定位置的水印文字
    $image->text('水印文字','字体文件地址',20,'#000000',ImageService::IMAGE_WATER_SOUTHEAST)->save("保存图片的路径以及名字");

```

