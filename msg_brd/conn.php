<meta charset="utf-8">

<?php
	error_reporting(E_ALL ^ E_DEPRECATED);
	$con = mysql_connect("127.0.0.1","root","") or die("连接数据库失败") ; 
	if(!mysql_query("create database if not exists msg_brd",$con)) echo "创建数据库失败".mysql_error();
	mysql_select_db("msg_brd",$con) ;
	//mysql_query("DROP TABLE IF EXISTS msg");
	$str = "create table if not exists msg(id int unsigned auto_increment,title varchar(20) not null ,content varchar(200) not null,primary key (id) ,unique key(title),key(content))ENGINE=InnoDB DEFAULT CHARSET=utf8;";
	if(!mysql_query($str,$con)) echo "创建表失败".mysql_error();
	mysql_query("set names 'utf8'");//使用utf8编码，这个和数据库的设置对应
	// if(!($result = mysql_query("select count(title) as count from msg",$con))) echo "查询数据失败".mysql_error();
	// else {
	// 	while($array = mysql_fetch_array($result)){
	// 		//echo $array['title'];//错误的，只有数目这一列，也就是只有一个数组
	// 		echo $array['count']."<br>";
	// 	};
		
	//}

?>

<!-- 下面是关于user表的创建和连接等操作 -->
<?php
	if(!mysql_query("create table if not exists user (id int unsigned not null auto_increment,name char(20) not null default'' ,password char(200) not null default'',primary key(id))default charset=utf8",$con)) echo "创建user表失败".mysql_error();
	mysql_query("set names 'utf8'");
	 // if(mysql_query("delete from user where name =' '")) echo '删除了';
	 // else echo mysql_error();
?>