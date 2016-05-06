<?php include dirname(dirname(__FILE__)) . '/common_header.php'; ?>
	
	<!-- The main page content is here -->
	<div class='body'>
		<div class="maincontent">
			<div class="announcement">
				<h2>
					View
					<?php if ($type == 'teacher'): ?>
						&nbsp;&nbsp;&nbsp;&nbsp;
						<a class="btn btn-primary <?php echo $state_id == 1 ? 'btn active' : ''; ?>"
						   href="/ta/evaluation/teacher/feedback/view/<?php echo $state_id; ?>">Applying</a>
						&nbsp;&nbsp;
						<a class="btn btn-primary <?php echo $state_id == 2 ? 'btn active' : ''; ?>"
						   href="/ta/evaluation/teacher/feedback/view/<?php echo $state_id; ?>">Checking</a>
						&nbsp;&nbsp;
						<a class="btn btn-primary <?php echo $state_id == 3 ? 'btn active' : ''; ?>"
						   href="/ta/evaluation/teacher/feedback/view/<?php echo $state_id; ?>">Disposed</a>
					<?php elseif ($type == 'manage'): ?>
					<?php endif; ?>
				</h2>
				<h2 id="semester">Current Semester: <?php echo $this->Mta_site->print_semester(); ?></h2>
				<div class="row">
					<h4 class="col-sm-2"><?php echo lang('ta_feedback_name_title'); ?></h4>
					<h4 class="col-sm-2"><?php echo lang('ta_feedback_name_course'); ?></h4>
					<h4 class="col-sm-2"><?php echo lang('ta_feedback_name_ta'); ?></h4>
					<h4 class="col-sm-3"><?php echo lang('ta_feedback_name_time'); ?></h4>
					<h4 class="col-sm-3"><?php echo lang('ta_feedback_name_state'); ?></h4>
				</div>

				<?php foreach ($list as $feedback): ?>
					<?php /** @var $feedback Feedback_obj */ ?>
					<div class="row">
						<a class="col-sm-2"
						   href="/ta/evaluation/student/feedback/check/<?php echo $feedback->id . '?page=' .
						                                                          $page_id; ?>">
							<h5><?php echo $feedback->title; ?></h5></a>
						<h5 class="col-sm-2"><?php echo $feedback->course->KCDM; ?></h5>
						<h5 class="col-sm-2"><?php echo $feedback->ta->name_en; ?></h5>
						<h5 class="col-sm-3"><?php echo $feedback->CREATE_TIMESTAMP; ?></h5>
						<h5 class="col-sm-3"><?php echo $feedback->get_state_str(); ?></h5>
					</div>
				<?php endforeach; ?>
				<?php echo '<center><h2>' . $this->pagination->create_links() . '</h2></center>'; ?>

				<?php if ($type == 'student'): ?>
					<a class="btn btn-primary" href="/ta/evaluation/student/feedback/add">Add new feedback</a>
				<?php endif ?>
			</div>
		</div>
	</div>

<?php include dirname(dirname(__FILE__)) . '/common_footer.php'; ?>