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
<body>
	<br>
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
		<tr>
		<?php foreach($list as $item): ?>
			<td><?=$item->course_id?></td>
			<td><?=$item->course_name?></td>
			<td><?=$item->professor_name?></td>
			<td><?=$item->xq?></td>
			<td><?=$item->xn?></td>
			<td><?=$item->maxta?></td>
			<td><?=$item->curta?></td>
			<td><?=$item->salary?></td>
			<td><input type="button" name="modify" value="修改" onclick="location='/Edit/editcourse?cid=<?=$item->course_id?>'"/></td>
			<td><input type="button" name="start" value="开放申请" onclick="location='/Edit/editcourse<?php echo "?obj=ta_recruitment_start"?>'"/></td>
			<td><input type="button" name="close" value="关闭申请" onclick="location='/Edit/editcourse<?php echo "?obj=ta_recruitment_start"?>'"/></td>
		<?php endforeach;?>
		</tr>
	</table>
</body>
</html>
