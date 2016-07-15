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
				<div class="question-list" id="choice-list"></div>
				<button class="btn btn-primary btn-add" qtype="choice">Add</button>
				
				<h3>Blanks:</h3>
				<div class="question-list" id="blank-list"></div>
				<button class="btn btn-primary btn-add" qtype="blank">Add</button>
				
				<h3>Number of Addition Questions:</h3>
				<input type="text" name="addition-question" value="<?php echo $config->addition; ?>">
			</div>
			
			
			<div class="modal fade" id="add-modal" aria-hidden="true"
			     aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="add-form">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title" id="add-modal-label">Add a question</h4>
							</div>
							<div class="modal-body">
								<input type="text" class="form-control add-search" placeholder="Search">
								<br>
								<div class="add-list">
								
								</div>
								
								<div class="row">
									<div class="col-sm-6">
										<a href="javascript:void(0)" class="list-group-item add-item add-new active"
										   qid="0">
											New Question
										</a>
									</div>
								</div>
								
								<br>
								
								<div class="add-text">
									<textarea class="form-control" rows="5"
									          style="resize:none;width:100%"></textarea>
									<br>
								</div>
								<button class="btn btn-primary btn-block btn-close">Done</button>
							</div>
						</div>
					</div>
				</div>
			</div><!-- /.modal -->
		
		
		</div>
	</div>
	
	<script type="text/javascript">
		$(document).ready(function ()
		{
			var $addModal = $("#add-modal");
			var $addList = $addModal.find(".add-list");
			var $addText = $addModal.find(".add-text");
			
			var getitem = function ($target)
			{
				while ($target.attr('class') != "question-item" || !$target)
				{
					$target = $target.parent();
				}
				return $target;
			};
			
			var reset = function (type)
			{
				var $children = $("#" + type + "-list").children(".question-item");
				var $target = $children.first();
				if (!$target)
				{
					return;
				}
				$target.find(".btn-up").attr('disabled', 'disabled');
				$target = $target.next();
				if ($target)
				{
					$target.find(".btn-up").removeAttr('disabled');
				}
				$target = $children.last();
				$target.find(".btn-down").attr('disabled', 'disabled');
				$target = $target.prev();
				if ($target)
				{
					$target.find(".btn-down").removeAttr('disabled');
				}
			};
			
			var generate = function (type, id, content, time, state)
			{
				var data = [
					'<div class="question-item" qid="', id, '" qtype="', type, '">',
					'<div class="row">',
					'<div class="col-sm-6">',
					'<textarea class="input-text" rows="5" style = "resize:none;width:100%" ',
					(state == 0) ? 1 : 'disabled="disabled"', '>',
					content, '</textarea>',
					'</div>',
					'<div class="col-sm-6">',
					'<h5>', 'Edited ', time, '</h5>',
					'<button class="btn btn-primary btn-up">UP</button>',
					'&nbsp;<button class="btn btn-primary btn-down">DOWN</button>',
					'&nbsp;<button class="btn btn-danger btn-delete">Delete</button>',
					(state == 0) ?
							/*'<button class="btn btn-primary">Submit</button>'*/ '' :
					'&nbsp;<button class="btn btn-warning btn-modify" data-toggle="tooltip" data-placement="bottom" title="You will create a new question and discard the previous one">Modify</button>',
					'</div>',
					'</div>',
					'</div>'
				].join('');
				
				var $list = $("#" + type + "-list");
				$list.append(data);
				var $target = $list.children(".question-item").last();
				$target.find(".btn-up").click(btn_up);
				$target.find(".btn-down").click(btn_down);
				$target.find(".btn-modify").click(btn_modify);
				$target.find(".btn-delete").click(btn_delete);
				
				reset(type);
			};
			
			
			const UP = -1;
			const DOWN = 1;
			var move = function ($target, direction)
			{
				$target = getitem($target);
				if (direction == UP)
				{
					var $prev = $target.prev(".question-item");
					$prev.before($target);
				}
				else
				{
					var $next = $target.next(".question-item");
					$next.after($target);
				}
				reset($target.attr('qtype'));
			};
			
			var set_list = function (data)
			{
				$addList.html('');
				$addModal.find(".add-new").addClass('active');
				var question_list = JSON.parse(data);
				for (var index in question_list)
				{
					var question = Object.create(question_list[index]);
					
					var html = [
						'<div class="row">',
						'<div class="col-sm-6">',
						'<a href="javascript:void(0)" class="list-group-item add-item" qid=',
						question.id, ' state="', question.state, '" time="', question.UPDATE_TIMESTAMP, '">',
						question.content,
						'</a>',
						'</div>',
						'<div class="col-sm-6">',
						'<h5>',
						'Edit Time: ', question.UPDATE_TIMESTAMP,
						'</h5>',
						'</div>',
						'</div>',
						'<br>'
					
					].join('');
					
					$addList.append(html);
					
					$("#" + question.type + "-list .question-item").each(function ()
					{
						if ($(this).attr('qid') == question.id)
						{
							$addList.children(".row").last().find(".add-item").addClass('disabled');
						}
					});
					
				}
				
				$addList.find(".add-item").click(function (e)
				{
					var $target = $(e.target);
					$addModal.find(".add-item.active").removeClass('active');
					$addText.css('display', 'none');
					$target.addClass('active');
				});
				
			};
			
			var search_lock = new Date().getTime();
			var search = function ()
			{
				var type = $addModal.attr('qtype');
				var key = $addModal.find(".add-search").val();
				var search_time = search_lock = new Date().getTime();
				$.ajax
				 ({
					 type: 'GET',
					 url: '/ta/evaluation/manage/evaluation/search_question',
					 data: {
						 type: type,
						 key: key
					 },
					 dataType: 'text',
					 success: function (data)
					 {
						 if (search_time == search_lock)
						 {
							 set_list(data);
						 }
					 },
					 error: function ()
					 {
						 alert('fail!');
					 }
				 });
			};
			
			var btn_modify = function (e)
			{
				if (!confirm("Are you sure to modify it?\n(You will create a new question and discard the previous one when modifying a used question)"))
				{
					return;
				}
				var $target = getitem($(e.target));
				$target.attr('qid', -1);
				$target.find(".input-text").removeAttr('disabled');
				$target.find(".btn-modify").remove();
			};
			
			var btn_delete = function (e)
			{
				if (!confirm("Are you sure to delete it?"))
				{
					return;
				}
				var $target = getitem($(e.target));
				var type = $target.attr('qtype');
				$target.remove();
				reset(type);
			};
			
			var btn_up = function (e)
			{
				move($(e.target), UP);
			};
			
			var btn_down = function (e)
			{
				move($(e.target), DOWN);
			};
			
			<?php foreach ($choice_list as $choice):?>
			<?php /** @var $choice Evaluation_default_obj */ ?>
			generate('choice', <?php echo $choice->id . ', "' .
			                              $choice->content . '", "' .
			                              $choice->UPDATE_TIMESTAMP .
			                              '", ' . $choice->state;?>);
			<?php endforeach;?>
			
			<?php foreach ($blank_list as $blank):?>
			<?php /** @var $blank Evaluation_default_obj */ ?>
			generate('blank', <?php echo $blank->id . ', "' .
			                             $blank->content . '", "' .
			                             $blank->UPDATE_TIMESTAMP .
			                             '", ' . $blank->state;?>);
			<?php endforeach;?>
			
			$("[data-toggle='tooltip']").tooltip();
			
			$(".btn-add").click(function (e)
			{
				$addModal.attr('qtype', $(e.target).attr('qtype'));
				$addList.html('');
				search();
				$addModal.modal('show');
			});
			
			$(".btn-close").click(function (e)
			{
				var $target = $addModal.find(".add-item.active");
				var id = $target.attr('qid');
				var type = $addModal.attr('qtype');
				if (id > 0)
				{
					generate(type, id, $target.html(), $target.attr('time'), $target.attr('state'));
					$addModal.modal('hide');
					return;
				}
				var textarea = $addText.children("textarea")
				var text = textarea.val();
				if (text.length > 10)
				{
					textarea.val('');
					generate(type, id, text, "now", 0);
					$addModal.modal('hide');
				}
				else
				{
					alert("The question content is too short!");
				}
			});
			
			$addModal.find(".add-search").keyup(function ()
			{
				search();
			});
			
			$addModal.find(".add-new").click(function (e)
			{
				var $target = $(e.target);
				$addModal.find(".add-item.active").removeClass('active');
				$target.addClass('active');
				$addText.css('display', 'inline');
			});
		});
	</script>

<?php include dirname(dirname(__FILE__)) . '/common_footer.php'; ?>