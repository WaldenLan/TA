<?php include dirname(dirname(__FILE__)) . '/common_header.php'; ?>


	<!-- The main page content is here -->
	<div class='body'>
		<div class="maincontent">
			<div class="announcement">
				<h2>
					Edit Config > <?php echo $edit_type;?>
					<div id="return">
						<a><span class="glyphicon glyphicon-repeat" aria-hidden="true" title="Return"></span></a>
					</div>
				</h2>
				<?php foreach ($config_list as $config): ?>
					<?php /** @var $config Evaluation_config_obj */ ?>
					<a href="/ta/evaluation/manage/evaluation/edit?id=<?php echo $config->id; ?>">
						<?php echo $config->CREATE_TIMESTAMP; ?>
					</a>
					<br>
				<?php endforeach; ?>
			</div>
		</div>
	</div>

<?php include dirname(dirname(__FILE__)) . '/common_footer.php'; ?>