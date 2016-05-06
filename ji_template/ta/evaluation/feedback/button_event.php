<script type="text/javascript">
	$(document).ready(function ()
	{
		$("#reply-button").click(function (e)
		{
			var flag = 'true';
			$.ajax
			 ({
				 type: 'POST',
				 url: '/ta/evaluation/<?php echo $type;?>/feedback/reply/',
				 data: {
					 id: <?php echo $feedback->id;?>,
					 content: $("#input-content").val(),
					 change_flag: flag
				 },
				 dataType: 'text',
				 success: function (data)
				 {
					 if (data == 'success')
					 {
						 location.reload();
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

		$("#close-button").click(function (e)
		{
			if (confirm("<?php echo lang('ta_feedback_confirm_close');?>") == true)
			{
				$.ajax
				 ({
					 type: 'GET',
					 url: '/ta/evaluation/<?php echo $type;?>/feedback/close/',
					 data: {
						 id: <?php echo $feedback->id;?>
					 },
					 dataType: 'text',
					 success: function (data)
					 {
						 if (data == 'success')
						 {
							 location.reload();
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
			}
		});
	});
</script>
