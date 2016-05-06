<?php include 'common_header.php';?>
<?php include 'student_header.php';?>

    <!-- The main page content is here -->
    <div class='body'>
        <div class="maincontent">
            <div class="announcement">
                <h2>View</h2>
                <h2 id="semester">Current Semester: <?php echo $this->Mta_site->print_semester();?></h2>
                <div class="row">
                    <h4 class="col-sm-2">Title</h4>
                    <h4 class="col-sm-2">Course ID</h4>
                    <h4 class="col-sm-2">TA name</h4>
                    <h4 class="col-sm-3">Time</h4>
                    <h4 class="col-sm-3">Progress</h4>
                </div>
                
				<?php foreach ($list as $feedback):?>
				<?php /** @var $feedback Feedback_obj */?>
                <div class="row">
                    <a class="col-sm-2" href="/ta/evaluation/student/feedback/check/<?php echo $feedback->id.'?page='.$page_id;?>"><h5><?php echo $feedback->title;?></h5></a>
                    <h5 class="col-sm-2"><?php echo $feedback->course->KCDM;?></h5>
                    <h5 class="col-sm-2"><?php echo $feedback->ta->name_en;?></h5>
                    <h5 class="col-sm-3"><?php echo $feedback->CREATE_TIMESTAMP;?></h5>
                    <h5 class="col-sm-3"><?php echo $feedback->get_state_str();?></h5>
                </div>
                <?php endforeach;?>
				<?php echo '<center><h2>'.$this->pagination->create_links().'</h2></center>';?>
                <a class="btn btn-primary" href="/ta/evaluation/student/feedback/add">Add new feedback</a>
            </div>
        </div>
    </div>



<?php include 'common_footer.php';?>