<?php include dirname(dirname(__FILE__)) . '/common_header.php'; ?>

<script src="/ji_js/datetimepicker/bootstrap-datetimepicker.min.js"></script>
<script src="/ji_js/datetimepicker/bootstrap-datetimepicker.zh-CN.js"></script>
<link rel="stylesheet" type="text/css" href="/ji_style/datetimepicker/bootstrap-datetimepicker.min.css">
<link href="http://cdn.bootcss.com/prettify/r224/prettify.css" rel="stylesheet">

<!-- The main page content is here -->
<div class='body'>
	<div class="maincontent">
		<div class="announcement">
			<h2>Announcements</h2>
			<ul>
				<li>
					<h4><?php echo lang('ta_evaluation_time_start'); ?></h4>
					<div class="row">
						<div class="col-sm-4">
							<div class="input-group date form_datetime" id="datetime-start">
								<input type="text" class="form-control" size="16" value="" readonly="readonly"
								       aria-describedby="basic-addon1" placeholder="Choose a date">
								<span class="input-group-addon add-on" id="basic-addon1">
									<span class="glyphicon glyphicon-th" aria-hidden="true"></span>
								</span>
							</div>
						</div>
					</div>
				</li>
				<li>
					<h4><?php echo lang('ta_evaluation_time_end'); ?></h4>
					<div class="row">
						<div class="col-sm-4">
							<div class="input-group date form_datetime" id="datetime-end">
								<input type="text" class="form-control" size="16" value="" readonly="readonly"
								       aria-describedby="basic-addon1" placeholder="Choose a date">
								<span class="input-group-addon add-on" id="basic-addon1">
									<span class="glyphicon glyphicon-th" aria-hidden="true"></span>
								</span>
							</div>
						</div>
					</div>
				</li>
			</ul>

			<script type="text/javascript">
				$(document).ready(function ()
				{
					$(".form_datetime").datetimepicker({
						<?php if ($_SESSION['language'] == 'zh-cn'): ?>
						format: "yyyy 年 m 月 d 日",
						language: 'zh-CN',
						<?php else: ?>
						format: "MM d, yyyy",
						<?php endif;?>
						autoclose: true,
						todayBtn: true,
						todayHighlight: true,
						minView: 'month',
						pickerPosition: "bottom-right"
					});

					$.extend
					 ({
						 set_datetime_place: function ($datetime)
						 {
							 //var $datetime = $(this);
							 $(".datetimepicker").each(function ()
							 {
								 var $icon = $datetime.children(".input-group-addon");
								 $(this).css('left', $icon.offset().left);
								 $(this).css('top', $icon.offset().top + $icon.outerHeight());
							 });
						 }
					 });


					$(".form_datetime").datetimepicker().on('show', function (e)
					{
						$.set_datetime_place($(this));
					});
				});
			</script>

		</div>
	</div>
</div>


<?php include dirname(dirname(__FILE__)) . '/common_footer.php'; ?>

