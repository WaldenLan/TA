<?php include 'common_header.php'; ?>
<?php include 'teacher_header.php'; ?>
	
	<script type="text/javascript">
		$(document).ready(function ()
		                  {
			                  $("#submit-button").click(function (e)
			                                            {
				                                            $.ajax
				                                             ({
					                                              type: 'POST',
					                                              url: '/ta/evaluation/teacher/feedback/submit/',
					                                              data: {
						                                              id: <?php echo $feedback->id;?>,
						                                              content: $("#input-content").val(),
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
		                  });
	</script>
	
	<!-- The main page content is here -->
	<div class='body'>
		<div class="maincontent">
			<div class="announcement">
				<h2><a class="navig"
				       href="/ta/evaluation/teacher/feedback/view/<?php echo $state_id . '/' . $page_id; ?>">View</a>
					> <?php echo base64_decode($feedback->title); ?></h2>
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
						<h3 class="panel-title"><?php echo base64_decode($feedback->title); ?></h3>
					</div>
					<div class="panel-body">
						<?php echo base64_decode($feedback->content); ?>
						<br/><br/>
						<?php if ($feedback->anonymous == 0): ?>
							------------------<br/>
							Many Regards<br/>
							<?php echo $feedback->content; ?><br/>
							University of Michigan - Shanghai Jiaotong University Joint Institute<br/>
							Phone: +86 18702130985<br/>
							200240 Shanghai<br/>
							P. R. China<br/>
						<?php endif ?>
						Submit Time: <h5 class="submit_time"><?php echo $feedback->CREATE_TIMESTAMP; ?></h5>
					</div>
				</div>
				<p>Reply:</p>
				<ul class="list-group">
					<li class="list-group-item _1">Manage Reply</li>
					<li class="list-group-item">
						<h5><?php echo base64_decode($manage_reply->content); ?></h5>
						<h5 class="submit_time">Reply Time: <?php echo $manage_reply->CREATE_TIMESTAMP; ?></h5>
					</li>
				</ul>
				<?php if ($feedback->state == 2): ?>
					
					<textarea id="input-content" rows="15" style="resize:none;width:100%"></textarea>
					
					<button id="submit-button" class="btn btn-primary">Reply</button>
				
				<?php else: ?>
					<ul class="list-group">
						<li class="list-group-item _1">Teacher Reply</li>
						<li class="list-group-item">
							<h5><?php echo base64_decode($teacher_reply->content); ?></h5>
							<h5 class="submit_time">Reply Time: <?php echo $teacher_reply->CREATE_TIMESTAMP; ?></h5>
						</li>
					</ul>
				<?php endif ?>
			</div>
		</div>
	</div>


<?php include 'common_footer.php'; ?>