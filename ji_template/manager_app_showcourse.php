<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>UM-SJTU JI</title>
<link href="/ji_style/common.css" type="text/css" rel="stylesheet" />
<link href="/ji_style/home.css" type="text/css" rel="stylesheet" />
</head>
	<meta charset="utf-8">
	<title>Edit TA Recruitment Time</title>
</head>
<script type="text/javascript">
	$(document).ready(function(){
		$("[name=submit1]").click(function(){
			$.post("/SearchInfo/searchcourse",
				{
					'xq':$("#xq").children('option:selected').val(),
					'xn':$("#xn").children('option:selected').val(),
					'kcdm':$("#kcdm").val()
				},
				function(userid){
//					alert(userid);
					$("#show1").html(userid);
					$("#tz").click(function(){
						window.location.href="/Edit/editcourse?cid="+$("#tz").attr('mb');
					});
				});
		});
	});
</script>

<body>
	<div>
		<form action="">
			学期
			<select id="xq">
				<option value ="0">全部</option>
				<option value ="1">1</option>
				<option value ="2">2</option>
			</select>
			学年
			<select id="xn">
				<option value ="0">全部</option>
				<option value ="2014-2015">2014-2015</option>
				<option value ="2015-2016">2015-2016</option>
			</select>
			课程代码
			<input type="text" id="kcdm">
			<button type="button" name="submit1">搜索</button>
		</form>
		<form action="">
			搜索TA
			<select id="type">
				<option value ="0">学号</option>
				<option value ="1">姓名中文</option>
				<option value ="2">姓名拼音</option>
			</select>
			输入
			<input type="text" id="stuinfo">
			<button type="button" name="submit2">搜索</button>
		</form>
	</div>
	<br>
	<caption align="top">课程信息</caption>
	<div id="show1">
		<table border="1">
			<tr>
				<td>课程代码</td>
				<td>课程名称</td>
				<td>授课老师</td>
				<td>授课学期</td>
				<td>授课学年</td>
				<td>最大TA人数</td>
				<td>已有TA申请人数</td>
				<td>工资</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<?php foreach($list as $item): ?>
			<tr>
				<td><?=$item->KCDM?></td>
				<td><?=$item->KCZWMC?></td>
				<td><?=$item->XM?></td>
				<td><?=$item->XQ?></td>
				<td><?=$item->XN?></td>
				<td><?=$item->maxta?></td>
				<td><?=$item->curta?></td>
				<td><?=$item->salary?></td>
				<td><input type="button" name="modify" value="修改" onclick="location='/Edit/editcourse?cid=<?=$item->KCDM?>'"/></td>
				<td><input type="button" name="start" value="开放申请" onclick="location='/Edit/editcourse<?php echo "?obj=ta_recruitment_start"?>'"/></td>
				<td><input type="button" name="close" value="关闭申请" onclick="location='/Edit/editcourse<?php echo "?obj=ta_recruitment_start"?>'"/></td>
			</tr>
			<?php endforeach;?>
		</table>
	</div>
</body>
</html>
