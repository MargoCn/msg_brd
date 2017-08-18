<meta charset="utf-8">

<?php
/***********
*思路：第一步获取表单数据并进行验证
       第二步是查询数据库是不是已经注册该用户id
       第三步是将这个刚注册的user insert进入user表
************/
	require "conn.php";
	if(!isset($_POST['submit'])){    //判断是否存在通过post方式提交过来的变量
    	echo ('非法访问!');
    	exit();//之后要停止脚本，否则后面的代码会执行，没有一点限制作用
	}
	$username = $_POST['username'];
	$password = $_POST['password'];
	//$email = $_POST['email'];
	//注册信息判断
	if(!preg_match('/^[\w\x80-\xff]{3,15}$/', $username)){
		//exit() 函数输出一条消息，并退出当前脚本。该函数是 die() 函数的别名。
	    exit('错误：用户名不符合规定。<br><a href="javascript:history.back(-1);">返回</a>');
	}
	if(strlen($password) < 6){
	    exit('错误：密码长度不符合规定。<br><a href="javascript:history.back(-1);">返回</a>');
	}


	$check = mysql_query("select * from user where name='$username' limit 1",$con);
	if($result = mysql_Fetch_array($check)) die('用户'.$username.'已经存在<br><a href="javascript:history.back(-1);">返回</a>');
	$password = md5($password);

	if(!mysql_query("insert into user (name,password) values ('$username','$password')"))
		echo "注册失败".mysql_error().'<br><a href="javascript:history.back(-1);">返回</a>';
	else echo "注册成功<br>"."<a href='login.html'>立即登录</a>";
?>