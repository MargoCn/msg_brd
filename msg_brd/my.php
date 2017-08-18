<?php
session_start();

//检测是否登录，若没登录则转向登录界面
if(!isset($_SESSION['userid'])){
    header("Location:login.html");  //header("Location:")作为php的转向语句要求header前没有任何输出,要求header前没有任何输出
    exit();
}
//包含数据库连接文件
include('conn.php');
$userid = $_SESSION['userid'];    
$username = $_SESSION['username'];
//$user_query = mysql_query("select * from user where id=$userid limit 1");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
	<title>我的留言板</title>
</head>
<body>
	<a href="my.php">添加留言</a>
	<a href="listmsg.php">浏览留言</a>  
	<a href="login.php?action=logout">退出</a> <!-- action=logout没有引号 -->
	<form action="addmsg.php" method="post">
		标题：<input type="text" name="title"><br><br>
		内容：<textarea type="text" name="content" rows="10" cols="60"></textarea> <br>
		<input type="submit" name="submit" value="提交留言" >
	</form>
</body>
</html>