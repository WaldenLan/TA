<?php include dirname(dirname(__FILE__)) . '/common_header.php'; ?>

<?php /** @var $course Course_obj */ ?>

	<!-- The main page content is here -->
	<div class='body'>
		<div class="maincontent">
			<div class="announcement">
				<h2>Add question</h2>

				<div class="form-group">
					<input type="radio" name="type" value="choice" checked="checked"/>Choice
					<input type="radio" name="type" value="blank"/>Blank
				</div>
				<div class="form-group">
					<input id="input-content" type="text"/>
				</div>
				<button id="submit-button" class="btn btn-primary">Submit</button>

			</div>
		</div>
	</div>

	<script type="text/javascript">
		$(document).ready(function ()
		{
			$("#submit-button").click(function ()
			{
				$.ajax
				 ({
					 type: 'GET',
					 url: '/ta/evaluation/teacher/evaluation/question/',
					 data: {
						 BSID: <?php echo $course->BSID;?>,
						 type: $("input[name='type']:checked").val(),
						 content: $("#input-content").val()
					 },
					 dataType: 'text',
					 success: function (data)
					 {
						 if (data == 'success')
						 {
							 location.href = '/ta/evaluation/teacher/evaluation/check/<?php echo $course->BSID;?>';
						 }
						 else
						 {
							 alert(data);
						 }
					 },
					 error: function ()
					 {
						 alert('fail!');
					 }
				 });
			});
		});
	</script>

<?php include dirname(dirname(__FILE__)) . '/common_footer.php'; ?>