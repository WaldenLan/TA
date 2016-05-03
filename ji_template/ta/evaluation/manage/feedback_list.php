<?php include 'common_header.php';?>
<?php include 'manage_header.php';?>
    <script>
        function confirmClose(url) {
            if (confirm("是否确认关闭反馈?")==true){
                location.href="/logout?url="+Base64.encodeURI(url);
            }
            else {
                location.href="#";
            }
        }
    </script>
    <!-- The main page content is here -->
    <div class='body'>
        <div class="maincontent">
            <div class="announcement">
                <h2>查看&nbsp;&nbsp;&nbsp;&nbsp;
                    <a class="btn btn-primary <?php echo $state_id==0?'btn active':'';?>" href="/ta/evaluation/manage/feedback/view/0">申请中</a>
                    &nbsp;&nbsp;
                    <a class="btn btn-primary <?php echo $state_id==1?'btn active':'';?>" href="/ta/evaluation/manage/feedback/view/1">已回复</a>
                    &nbsp;&nbsp;
                    <a class="btn btn-primary <?php echo $state_id==2?'btn active':'';?>" href="/ta/evaluation/manage/feedback/view/2">老师正在受理</a>
                    &nbsp;&nbsp;
                    <a class="btn btn-primary <?php echo $state_id==3?'btn active':'';?>" href="/ta/evaluation/manage/feedback/view/3">老师已回复</a>
                    <button type="button" class="btn btn-warning" onclick="confirmClose()">关闭投诉</button>
                </h2>
                <h2 id="semester">当前学期: <?php echo $this->Mta_site->print_semester();?></h2>
                <div class="row">
                    <h4 class="col-sm-2">标题</h4>
                    <h4 class="col-sm-2">课程代码</h4>
                    <h4 class="col-sm-2">助教姓名</h4>
                    <h4 class="col-sm-3">提交时间</h4>
                    <h4 class="col-sm-3">处理进度</h4>
                </div>
                
				<?php foreach ($list as $feedback):?>
                <div class="row">
                    <a class="col-sm-2" href="/ta/evaluation/manage/feedback/check/<?php echo $feedback->id.'?state='.$state_id.'&page='.$page_id;?>"><h5><?php echo base64_decode($feedback->title);?></h5></a>
                    <h5 class="col-sm-2"><?php echo $feedback->course->KCDM;?></h5>
                    <h5 class="col-sm-2"><?php echo $feedback->ta->name_ch;?></h5>
                    <h5 class="col-sm-3"><?php echo $feedback->UPDATE_TIMESTAMP;?></h5>
                    <h5 class="col-sm-3"><?php echo $this->Mta_feedback->get_state_str_ch($feedback->state);?></h5>
                </div>
                <?php endforeach;?>
				<?php echo '<center><h2>'.$this->pagination->create_links().'</h2></center>';?>
            </div>
        </div>
    </div>



<?php include 'common_footer.php';?>