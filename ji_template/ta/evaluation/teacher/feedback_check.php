<?php include 'common_header.php';?>
<link rel="stylesheet" type="text/css" href="/ji_style/ta/evaluation/teacher/index.css">

    <!-- The main page content is here -->
    <div class='body'>
        <div class="maincontent">
            <div class="announcement">
                <h2>View</h2>
                <li>
                    <a href="/ta/evaluation/teacher/feedback/check/<?php echo $feedback->id?>"><h4><?php echo $feedback->CREATE_TIMESTAMP;?></h4></a>
                    <p>content: <?php echo base64_decode($feedback->content);?></p>
                    <p>state: <?php echo $state;?></p>
                    
                    <?php if ($feedback->state >= 1):?>
                    <p>manage_reply: <?php echo base64_decode($manage_reply->content);?></p>
                    <?php endif?>
                    
                    <?php if ($feedback->state >= 3):?>
					<p>teacher_reply: <?php echo base64_decode($teacher_reply->content);?></p>
                    <?php endif?>

                    
                </li>
            </div>
        </div>
    </div>



<?php include '../common_footer.php';?>