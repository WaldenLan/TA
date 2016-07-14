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
				<h3>
					Choices:
				</h3>
				<?php foreach ($choice_list as $choice): ?>
					<?php /** @var $choice Evaluation_default_obj */ ?>
					<div class="row">
						<div class="col-sm-6">
							<textarea class="input-choice" rows="5"
							          style="resize:none;width:100%"><?php echo $choice->content; ?></textarea>
						</div>
						<div class="col-sm-3">
							Edited <?php echo $choice->UPDATE_TIMESTAMP; ?>
							<br>
							<div class="edit">
								<?php if ($choice->state == 0): ?>
									<button class="btn btn-primary">Submit</button>
								<?php else: ?>
									<button class="btn btn-warning" data-toggle="tooltip" data-placement="right"
									        title="Question had been used before">Locked
									</button>
								<?php endif; ?>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
				<h3>
					Blanks:
				</h3>
				<?php foreach ($blank_list as $blank): ?>
					<?php /** @var $blank Evaluation_default_obj */ ?>
					<div class="row">
						<div class="col-sm-6">
							<textarea class="input-choice" rows="5"
							          style="resize:none;width:100%"><?php echo $blank->content; ?></textarea>
						</div>
						<div class="col-sm-3">
							Edited <?php echo $blank->UPDATE_TIMESTAMP; ?>
							<br>
							<div class="edit">
								<?php if ($blank->state == 0): ?>
									<button class="btn btn-primary">Submit</button>
								<?php else: ?>
									<button class="btn btn-warning" data-toggle="tooltip" data-placement="right"
									        title="Question had been used before">Locked
									</button>
								<?php endif; ?>
							</div>
						</div>
					</div>
				<?php endforeach; ?>

				<h3>
					Number of Addition Questions:
				</h3>
				<input type="text" name="addition-question" value="<?php echo $config->addition; ?>">
			</div>
		</div>
	</div>

	<script type="text/javascript">
		$(document).ready(function ()
		{
			$("[data-toggle='tooltip']").tooltip();
		});
	</script>

<?php include dirname(dirname(__FILE__)) . '/common_footer.php'; ?>