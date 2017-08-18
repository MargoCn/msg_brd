<meta charset="utf-8">
<?php
/*********
*获取表单数据
 验证
 查询数据库，成功进入用户中心，用户中心首先验证session的脚本
**********/
	require "conn.php";
	session_start();
	//注销登录
	//该段代码在处理用户登录的代码之前，只允许以 login.php?action=logout 的方式访问，否则会直接非法访问，无法执行退出脚本
	if(@$_GET['action'] == "logout"){
	    unset($_SESSION['userid']); //前面没有session_start就会报错没有该变量
	    unset($_SESSION['username']);
	    session_unset();
	    echo '注销登录成功！点击此处 <a href="login.html">登录</a>';
	    exit;
	}
	
	if(!isset($_POST['submit'])){   //用户登录的话，必须是 POST 动作提交。
    exit('非法访问!');
    
	}
	$username = htmlspecialchars($_POST['username']);
	$password = md5($_POST['password']);
	$check = mysql_query("select * from user where name='$username' and password='$password' limit 1");  
	if($result = mysql_fetch_array($check)) {
		
		$_SESSION['username'] = $result['name'];
		$_SESSION['userid'] = $result['id'];
		echo"登录成功"."<br><a href ='my.php'>点此进入用户中心</a>";
		echo '<br> <a href="login.php?action=logout">点处注销登录</a><br />';
		
	}
	else die("用户名或密码错误".mysql_error()."<br><a href='login.html'>返回</a>");
	//为什么登录老是错，因为密码长度是char(30)，MD5之后超出了，没有保存，槽槽槽~~~


?>