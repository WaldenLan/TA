<?php include dirname(dirname(__FILE__)) . '/common_header.php'; ?>

<?php /** @var $config Evaluation_config_obj */ ?>
	
	<!-- The main page content is here -->
	<div class='body'>
		<div class="maincontent">
			<div class="announcement">
				<h2>
					Edit Config > <?php echo $config->id; ?>
					<div id="return">
						<a><span class="glyphicon glyphicon-repeat" aria-hidden="true" title="Return"></span></a>
					</div>
				</h2>
				<h3>Choices:</h3>
				<div id="choice-list"></div>
				<button class="btn btn-primary">Add</button>

				<h3>Blanks:</h3>
				<div id="blank-list"></div>
				<button class="btn btn-primary">Add</button>

				<h3>Number of Addition Questions:</h3>
				<input type="text" name="addition-question" value="<?php echo $config->addition; ?>">
			</div>
		</div>
	</div>

	<script type="text/javascript">
		$(document).ready(function ()
		{
			var generate = function (type, id, content, time, state)
			{
				var data = [
					'<div class="row">',
					'<div class="col-sm-6">',
					'<textarea class="input-choice" rows="5" style = "resize:none;width:100%" >',
					content, '</textarea>',
					'</div>',
					'<div class="col-sm-3">',
					'Edited ', time,
					(state == 0) ?
					'<button class="btn btn-primary">Submit</button>' :
					'<button class="btn btn-warning" data-toggle="tooltip" data-placement="right" title="Question had been used before">Locked</button>',
					'<button class="btn btn-danger btn-delete" btntype="', type, '">Delete</button>',
					'</div>',
					'</div>'
				].join('');
				$("#" + type + "-list").append(data);
			};

			<?php foreach ($choice_list as $choice):?>
			<?php /** @var $choice Evaluation_default_obj */ ?>
			generate('choice', <?php echo $choice->id . ', "' . $choice->content . '", "' . $choice->UPDATE_TIMESTAMP .
			                              '", ' . $choice->state;?>);
			<?php endforeach;?>

			<?php foreach ($blank_list as $blank):?>
			<?php /** @var $blank Evaluation_default_obj */ ?>
			generate('blank', <?php echo $blank->id . ', "' . $blank->content . '", "' . $blank->UPDATE_TIMESTAMP .
			                              '", ' . $blank->state;?>);
			<?php endforeach;?>


			$("[data-toggle='tooltip']").tooltip();


			$(".btn-delete").click(function (e)
			{

			});
		});
	</script>

<?php include dirname(dirname(__FILE__)) . '/common_footer.php'; ?>