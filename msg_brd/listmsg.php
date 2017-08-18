<?php
session_start();

//检测是否登录，若没登录则转向登录界面
if(!isset($_SESSION['userid'])){
    header("Location:login.html");
    exit();
}
$userid = $_SESSION['userid'];
$username = $_SESSION['username'];

  include("conn.php");
  @$p = $_GET['p']?$_GET['p']:1;
  $pagenum = 5;
  $offset = ($p-1)*$pagenum;
  $result = mysql_query("select * from msg order by id desc limit $offset ,$pagenum");
  while ($row = mysql_fetch_array($result)) {
    echo $row['title']."&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp".$row['content']."<br>";
  }
  $result = mysql_query("select count(*) as count from msg");
  $row = mysql_fetch_array($result);
  $page = ceil($row['count']/$pagenum);
    echo "共".$page."页";
  for($i =1;$i<=$page;$i++){
    if($p==$i) echo "[".$i."]";
    else echo "["."<a href='listmsg.php?p=".$i."'>".$i."</a>"."]";
  }
  echo "<br>"."<a href='my.php' border='1' bgcolor='#0000ff'>返回主页</a>";
?>