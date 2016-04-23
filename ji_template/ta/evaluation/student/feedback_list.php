<?php include 'common_header.php';?>
<link rel="stylesheet" type="text/css" href="/ji_style/ta/evaluation/student/index.css">

    <!-- The main page content is here -->
    <div class='body'>
        <div class="maincontent">
            <div class="announcement">
                <h2>View</h2>
				<?php foreach ($list as $feedback):?>
                <li>
                    <a href="/ta/evaluation/student/feedback/check/<?php echo $feedback->id?>"><h4><?php echo $feedback->content;?></h4></a>
                    <p><?php echo $this->Mta_feedback->get_state_str($feedback->state);?></p>
                    <p><?php echo $feedback->UPDATE_TIMESTAMP;?></p>
                </li>
                <?php endforeach;?>
				<?php echo '<center><h2>'.$this->pagination->create_links().'</h2></center>';?>
            </div>
        </div>
    </div>



<?php include '../common_footer.php';?>