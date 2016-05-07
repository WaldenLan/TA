<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	      content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<!-- To be revised -->
	<title><?php echo $page_name ?></title>
	<script src="/ji_js/jquery-2.1.4.min.js"></script>
	<script src="/ji_js/ta/evaluation.js"></script>
	<script src="/ji_js/base64.js"></script>
	<script src="/ji_js/confirmLogout.js"></script>
	<noscript>Your browser does not support JavaScript!</noscript>
	
	<link rel="stylesheet" type="text/css" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="/ji_style/ta/common.css">
	<base target="_self">
</head>

<body>
<div class="wholeBody">
	<!-- Top Banner -->
	<div class='_top'><a href="http://umji.sjtu.edu.cn/cn/"><img src="/ji_style/ta/images/JI logo-01.png" height="110"
	                                                             alt="Logo of Joint Institute" title="上海交大密西根学院"></a>
		<h1 title="Teaching Assistant Evaluation System">Teaching Assistant Evaluation System</h1>
	</div>
	
	
	<link rel="stylesheet" type="text/css" href="/ji_style/ta/evaluation/<?php echo $type; ?>/index.css">
	
	<!-- Nav Bar -->
	
	<ul class="nav nav-pills nav-justified">
		<?php if ($type == 'student'): ?>
			<li class="<?php echo $banner_id != 1 ? 'non-' : ''; ?>active">
				<a href="/ta/evaluation/student">Homepage</a>
			</li>
			<li class="<?php echo $banner_id != 2 ? 'non-' : ''; ?>active">
				<a href="/ta/evaluation/student/evaluation">TA Evaluation</a>
			</li>
			<li class="<?php echo $banner_id != 3 ? 'non-' : ''; ?>active">
				<a href="/ta/evaluation/student/feedback/view">Feedbacks</a>
			</li>
		<?php elseif ($type == 'teacher'): ?>
			<li class="<?php echo $banner_id != 1 ? 'non-' : ''; ?>active">
				<a href="/ta/evaluation/teacher">Homepage</a>
			</li>
			<li class="<?php echo $banner_id != 2 ? 'non-' : ''; ?>active">
				<a href="/ta/evaluation/teacher/evaluation">Evaluation Setup</a>
			</li>
			<li class="<?php echo $banner_id != 3 ? 'non-' : ''; ?>active">
				<a href="/ta/evaluation/teacher/feedback/view">Feedbacks Process</a>
			</li>
			<li class="<?php echo $banner_id != 4 ? 'non-' : ''; ?>active">
				<a href="/ta/evaluation/teacher/report">TA Report</a>
			</li>
		<?php elseif ($type == 'manage'): ?>
			<li class="<?php echo $banner_id != 1 ? 'non-' : ''; ?>active">
				<a href="/ta/evaluation/manage">首页</a>
			</li>
			<li class="<?php echo $banner_id != 2 ? 'non-' : ''; ?>active">
				<a href="/ta/evaluation/manage/evaluation">评教设置</a>
			</li>
			<li class="<?php echo $banner_id != 3 ? 'non-' : ''; ?>active">
				<a href="/ta/evaluation/manage/search">搜索</a>
			</li>
			<li class="<?php echo $banner_id != 4 ? 'non-' : ''; ?>active">
				<a href="/ta/evaluation/manage/feedback/view">投诉处理</a>
			</li>
			<li class="<?php echo $banner_id != 5 ? 'non-' : ''; ?>active">
				<a href="/ta/evaluation/manage/export">导出到Excel</a>
			</li>
		<?php endif ?>
	</ul>
	
	<!-- User Info -->
	<div class="banner">
		<?php if ($_SESSION['userid'] == ''): ?>
			<div class="jAccount_login">
				<a href="student/SignIn_jAccount.html">jAccount Login</a>
			</div>
			<div class="regular_login">
				<a href="/login?url=<?php echo base64_encode($_SERVER["REQUEST_URI"]); ?>">TAES Login</a>
			</div>
		<?php else: ?>
			<div>
				<a onclick="confirmLogout('/ta/evaluation')">Sign out</a>
				<span id="SID"><?php echo $_SESSION['userid']; ?></span>
				<span id="department">Joint Institute</span>
				<span id="name"><?php echo $_SESSION['username']; ?></span>
			</div>
		<?php endif ?>
	</div>
    