<?php

/*
 * 项目配置文件
 * 包含
 *      1. app 项目配置
 *      2. database 数据库配置
 */
return $g_config = [
	'app' =>[
		'server'				=> 'localhost',
		//默认的模式：开发模式 还是 生产模式
		'debug'                 => true,
		//默认时区
		'timezone'				=> 'PRC',
		//默认字符集
		'charset'				=> 'utf-8',
		//默认系统的标志
		'token'                 => 'mini framework sucks',
	],

	'database' =>[
        //数据库名字
		'database'   => 'wsc',
		//数据库用户名
        'username'   => 'root',
        //数据库密码
		'password'   => '',
        //数据库连接字符串
		'connection' => 'mysql:host=127.0.0.1',
        //数据库字符编码
		'charset'    => 'utf8',
        //数据库相关配置项
		'options'    => [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		]
	],

	'captcha' =>[
		'cypher'     =>  'yupengw.io',   // 验证码加密密钥
		'codeSet'   =>  '2345678abcdefhijkmnpqrstuvwxyzABCDEFGHJKLMNPQRTUVWXY',             // 验证码字符集合
		'expire'    =>  1800,            // 验证码过期时间（s）
		'fontSize'  =>  25,              // 验证码字体大小(px)
		'useCurve'  =>  true,            // 是否画混淆曲线
		'useNoise'  =>  true,            // 是否添加杂点
		'length'    =>  5,               // 验证码位数
	],

	'upload' =>[
		'mimes'         =>  array(), //允许上传的文件MiMe类型
		'maxSize'       =>  0, //上传的文件大小限制 (0-不做限制)
		'exts'          =>  array(), //允许上传的文件后缀
		'autoSub'       =>  true, //自动子目录保存文件
		'subName'       =>  array('date', 'Y-m-d'), //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
		'rootPath'      =>  __DIR__.'/../assets/uploads/', //保存根路径
		'savePath'      =>  '', //保存路径
		'replace'       =>  false, //存在同名是否覆盖
	],

	'email'	=>[
		'secure'        	=> 'ssl',     //链接加密方式 Options: "", "ssl" or "tls"; 为空时, 端口一般是25; ssl , 端口一般为 465 ;
		'host'        		=> 'smtp.qq.com',     //SMTP 服务器
		'port'    			=> '465',    //SMTP 端口, 一般为25, QQ为465或587
		'username'    		=> '', //邮箱帐号
		'psw' 				=> '', //邮箱密码 QQ使用SMTP授权码
		'from' 				=> '', //发件人地址
		'from_name' 		=> '', //发件人姓名
	]
];