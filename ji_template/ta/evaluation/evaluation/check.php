<?php include dirname(dirname(__FILE__)) . '/common_header.php'; ?>

<?php /** @var $course Course_obj */ ?>

	<!-- The main page content is here -->
	<div class='body'>
		<div class="maincontent">
			<div class="announcement">
				<h2>Check</h2>
				<?php foreach ($course->question_list as $question): ?>
					<?php /** @var $question Evaluation_question_obj */ ?>
					<?php echo $question->type; ?>
					<br>
					<?php echo $question->content; ?>
					<br>
					<br>

				<?php endforeach; ?>


			</div>
		</div>
	</div>


<?php include dirname(dirname(__FILE__)) . '/common_footer.php'; ?>