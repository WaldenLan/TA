<?php include dirname(dirname(__FILE__)) . '/common_header.php'; ?>

<?php include 'button_event.php'; ?>

<?php /** @var $feedback Feedback_obj */ ?>
	<!-- The main page content is here -->
	<div class='body'>
		<div class="maincontent">
			<div class="announcement">
				<h2><a class="navig"
				       href="<?php echo '/ta/evaluation/' . $type . '/feedback/view/' .
				                        ($state_id == NULL ? '' : $state_id . '/') . $page_id; ?>">View</a>
					<?php echo $feedback->title; ?>
					<?php if ($feedback->is_open() &&
					          ($type == 'manage' || $type == 'student' && $feedback->is_student())
					): ?>
						<button id="close-button" class="btn btn-danger">Close</button>
					<?php endif; ?>
				</h2>

				<div class="row">
					<h5 class="col-sm-1">Info: </h5>
					<h5 class="col-sm-2 _1"><?php echo $feedback->course->KCDM; ?>
						- <?php echo $feedback->ta->name_en; ?></h5>
					<br><br>
					<h5 class="col-sm-1 _1">State: </h5>
					<h5 class="col-sm-3 _1"><?php echo $state; ?></h5>
					<br><br>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title"><?php echo $feedback->title; ?></h3>
					</div>
					<div class="panel-body">
						<?php echo $feedback->replys[0]->content; ?>
						<br/><br/>
						Submit Time: <h5
								class="submit_time"><?php echo $feedback->CREATE_TIMESTAMP; ?></h5>
					</div>
				</div>

				<p>Communication:</p>

				<?php if (count($feedback->replys) <= 1): ?>
					<div>No communication till now.</div>
				<?php endif; ?>

				<?php foreach (array_slice($feedback->replys, 1) as $reply): ?>
					<?php /** @var $reply Feedback_reply_obj */ ?>
					<ul class="list-group">
						<li class="list-group-item _1"><?php echo $reply->user_id; ?> Reply</li>
						<li class="list-group-item">
							<h5><?php echo $reply->content; ?></h5>
							<h5 class="submit_time">Reply Time: <?php echo $reply->CREATE_TIMESTAMP; ?></h5>
						</li>
					</ul>
				<?php endforeach; ?>

				<?php if (($feedback->is_student() && $type == 'student') ||
				          (!$feedback->is_manage() && $type == 'manage') ||
				          ($feedback->is_teacher() && $type == 'teacher')
				): ?>
					<br>
					<p>Reply/Addition:</p>
					<textarea id="input-content" rows="15"
					          style="resize:none;width:100%"></textarea>

					<button id="reply-button" class="btn btn-primary">Submit</button>

				<?php endif; ?>
			</div>
		</div>
	</div>
<?php include dirname(dirname(__FILE__)) . '/common_footer.php'; ?>