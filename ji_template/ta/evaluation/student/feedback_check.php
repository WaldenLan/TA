<?php include 'common_header.php';?>
<?php include 'student_header.php';?>

    <!-- The main page content is here -->
    <div class='body'>
        <div class="maincontent">
            <div class="announcement">
                <h2><a class="navig" href="/ta/evaluation/student/feedback/view/<?php echo $page_id;?>">View</a> > <?php echo base64_decode($feedback->title);?></h2>
                <div class="row">
                    <h5 class="col-sm-1">Info: </h5>
                        <h5 class="col-sm-2 _1"><?php echo $feedback->course->KCDM;?> - <?php echo $feedback->ta->name_en;?></h5>
                    <br><br>
                    <h5 class="col-sm-1 _1">State: </h5>
                        <h5 class="col-sm-3 _1"><?php echo $state;?></h5>
                    <br><br>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo base64_decode($feedback->title);?></h3>
                    </div>
                    <div class="panel-body">
                        <?php echo base64_decode($feedback->content);?>
                        <br/><br/>
                        Submit Time: <h5 class="submit_time"><?php echo $feedback->CREATE_TIMESTAMP;?></h5>
                    </div>
                </div>

<!--                <h5 href="/ta/evaluation/student/feedback/check/--><?php //echo $feedback->id?><!--">--><?php //echo $feedback->CREATE_TIMESTAMP;?><!--</h5>-->
                <p>Reply:</p>
                <?php if ($feedback->state < 1):?>
                    <div>No reply has been received till now.</div>
                <?php endif?>
                <?php if ($feedback->state == 1):?>
                    <ul class="list-group">
                        <li class="list-group-item _1">Manage Reply</li>
                        <li class="list-group-item">
                            <h5><?php echo base64_decode($manage_reply->content);?></h5>
                            <h5 class="submit_time">Reply Time: <?php echo $manage_reply->CREATE_TIMESTAMP;?></h5>
                        </li>
                    </ul>
                <?php endif?>
                <?php if ($feedback->state == 3):?>
                    <ul class="list-group">
                        <li class="list-group-item _1">Teacher Reply</li>
                        <li class="list-group-item">
                            <h5><?php echo base64_decode($teacher_reply->content);?></h5>
                            <h5 class="submit_time">Reply Time: <?php echo $teacher_reply->CREATE_TIMESTAMP;?></h5>
                        </li>
                    </ul>
                <?php endif?>

            </div>
        </div>
    </div>
<?php include 'common_footer.php';?>