<?php include 'common_header.php'; ?>
<?php include 'teacher_header.php'; ?>
	
	<!-- The main page content is here -->
	<div class='body'>
		<div class="maincontent">
			<div class="announcement">
				<h2>View&nbsp;&nbsp;&nbsp;&nbsp;<a
							class="btn btn-primary <?php echo $state_id == 2 ? 'btn active' : ''; ?>"
							href="/ta/evaluation/teacher/feedback/view/2">Applying</a>&nbsp;&nbsp;
					<a class="btn btn-primary <?php echo $state_id == 3 ? 'btn active' : ''; ?>"
					   href="/ta/evaluation/teacher/feedback/view/3">Disposed</a></h2>
				<h2 id="semester">Current Semester: <?php echo $ji_academic_year . '-' . $ji_academic_term; ?></h2>
				<div class="row">
					<h4 class="col-sm-2">Title</h4>
					<h4 class="col-sm-2">Course ID</h4>
					<h4 class="col-sm-2">TA name</h4>
					<h4 class="col-sm-3">Time</h4>
					<h4 class="col-sm-3">Progress</h4>
				</div>
				
				<?php foreach ($list as $feedback): ?>
					<div class="row">
						<a class="col-sm-2"
						   href="/ta/evaluation/teacher/feedback/check/<?php echo $feedback->id . '?state=' .
						                                                          $state_id . '&page=' . $page_id; ?>">
							<h5><?php echo base64_decode($feedback->title); ?></h5></a>
						<h5 class="col-sm-2"><?php echo $feedback->course->KCDM; ?></h5>
						<h5 class="col-sm-2"><?php echo $feedback->ta->name_en; ?></h5>
						<h5 class="col-sm-3"><?php echo $feedback->UPDATE_TIMESTAMP; ?></h5>
						<h5 class="col-sm-3"><?php echo $this->Mta_feedback->get_state_str($feedback->state); ?></h5>
					</div>
				<?php endforeach; ?>
				<?php echo '<center><h2>' . $this->pagination->create_links() . '</h2></center>'; ?>
			</div>
		</div>
	</div>


<?php include 'common_footer.php'; ?>