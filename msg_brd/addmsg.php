
<meta charset="utf-8">
<?php

session_start();

//检测是否登录，若没登录则转向登录界面
if(!isset($_SESSION['userid'])){
    header("Location:login.html");
    exit();
}
if(!isset($_POST['submit'])){
	die('非法访问');
}
$userid = $_SESSION['userid'];
$username = $_SESSION['username'];
	require "conn.php";
	function toHtmlcode($content)  //换行和空格变为html的<br>和$&nbsp才能正确在html页面显示
    {  
        return $content = str_replace("\n","<br>",str_replace(" ", "&nbsp;", $content));  
    }  
	//echo $_POST["title"]."<br>".$_POST["content"]."<br>";
	$title = htmlspecialchars(toHtmlcode($_POST['title']));//表单验证
	$content =htmlspecialchars(toHtmlcode($_POST['content']));
	if(mysql_query("insert into msg (title,content) values ('$title','$content')")) {
		echo "添加留言成功~"."<br>";
		echo "<a href='my.php' border='1' bgcolor='#0000ff'>返回主页</a>";//
	}
	else echo "添加失败".mysql_error();
?>	