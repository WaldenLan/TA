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
					<h5 class="col-sm-1"><?php echo lang('ta_feedback_info');?>: </h5>
					<h5 class="col-sm-2 _1"><?php echo $feedback->course->KCDM; ?>
						- <?php echo $type == 'manage' ? $feedback->ta->name_ch :
								$feedback->ta->name_en; ?></h5>
					<br><br>
					<h5 class="col-sm-1 _1"><?php echo lang('ta_feedback_state');?>: </h5>
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
						<?php echo lang('ta_feedback_submit_time');?>: <h5
								class="submit_time"><?php echo $feedback->CREATE_TIMESTAMP; ?></h5>
					</div>
				</div>

				<p><?php echo lang('ta_feedback_communication');?>:</p>

				<?php if (count($feedback->replys) <= 1): ?>
					<div><?php echo lang('ta_feedback_empty');?></div>
				<?php endif; ?>

				<?php foreach (array_slice($feedback->replys, 1) as $reply): ?>
					<?php /** @var $reply Feedback_reply_obj */ ?>
					<ul class="list-group">
						<li class="list-group-item _1"><?php echo $this->Mta_feedback->get_reply_title($reply->state); ?></li>
						<li class="list-group-item">
							<h5><?php echo $reply->content; ?></h5>
							<h5 class="submit_time"><?php echo lang('ta_feedback_reply_time');?>: <?php echo $reply->CREATE_TIMESTAMP; ?></h5>
						</li>
					</ul>
				<?php endforeach; ?>

				<?php if ($feedback->is_open() &&
				          (($feedback->is_student() && $type == 'student') ||
				           (!$feedback->is_manage() && $type == 'manage') ||
				           ($feedback->is_teacher() && !$feedback->is_manage() &&
				            $type == 'teacher'))
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