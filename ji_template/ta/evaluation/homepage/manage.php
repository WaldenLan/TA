<?php include dirname(dirname(__FILE__)) . '/common_header.php'; ?>

<script src="/ji_js/datetimepicker/bootstrap-datetimepicker.min.js"></script>
<script src="/ji_js/datetimepicker/bootstrap-datetimepicker.zh-CN.js"></script>
<link rel="stylesheet" type="text/css" href="/ji_style/datetimepicker/bootstrap-datetimepicker.min.css">


<!-- The main page content is here -->
<div class='body'>
	<div class="maincontent">
		<div class="announcement">
			<h2>Announcements</h2>
			<ul>
				<li>
					<h4>Title_1</h4>
					<p>Here is the main content of the announcement 1...</p>
				</li>
				<li>
					<h4>Title_2</h4>
					<p>Here is the main content of the announcement 2...</p>
				</li>
			</ul>

			<div class="input-append date form_datetime">
				<input size="16" type="text" value="" readonly>
				<span class="add-on"><i class="icon-th"></i></span>
			</div>

			<script type="text/javascript">
				$(".form_datetime").datetimepicker({
					<?php if ($_SESSION['language'] == 'zh-cn'): ?>
					format: "yyyy 年 m 月 d 日",
					language: 'zh-CN',
					<?php else: ?>
					format: "MM dd, yyyy",
					<?php endif;?>
					autoclose: true,
					todayBtn: true,
					todayHighlight: true,
					minView: 'month',
					pickerPosition: "bottom-left"
				});
			</script>

		</div>
	</div>
</div>


<?php include dirname(dirname(__FILE__)) . '/common_footer.php'; ?>

