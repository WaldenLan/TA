<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>学院信息管理系统管理中心</title>

<style type="text/css">
<!--
body{ background-color:#18345C; padding:0; margin:0; font-size:14px; font-family:Geneva, Arial, Helvetica, sans-serif}
.loginbox {
	width:400px; height:200px; margin:0 auto; margin-top:200px; padding:10px; border:1px solid #DDDDDD; border-radius:20px; background-color:#FFFFFF; list-style:none;
}
.loginbox li{ width:100%; height:60px; margin:0 auto; line-height:60px; list-style:none}
.loginbox li span{ float:left; font-weight:bold; margin-left:20px;}
.loginbox li input{ width:200px; float:left; height:20px; border:1px solid #DDDDDD; line-height:20px; margin-top:20px; padding-left:10px; font-size:16px;}
.loginbox li input.s{ width:100px; height:30px; border:1px solid #DDDDDD; background-color:#fdca00; margin-left:100px; cursor:pointer}
.loginbox li input.s:hover{ background-color:#C60}
.jaccount span{ width:100%; border-radius: 10px;  float: left;  height: 200px;  line-height: 200px;  text-align: center;  font-size: 22px;}
-->
</style>
</head>

<body>
<div class="loginbox">

<form method="post" action="login/validate">
<li><span>账户：</span><input name="username" type="text" /></li>
<li><span>密码：</span>
  <input name="password" type="password" /></li>
<li><input class="s" name="submit" value="登陆系统" type="submit" /><a href="/jaccount.php"><span>Jaccount登录系统</span></a></li>
</form>

<!--
<?
if($logout == 1){?>
	<a class="jaccount" href="/jaccount_logout.php" ><span>权限不足，切换账户</span></a>
<? }else{?>
	<a class="jaccount" href="/jaccount.php" ><span>Jaccount统一账户认证</span></a>
<? }?>
-->
</div>
</body>
</html>
