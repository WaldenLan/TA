<?php include 'common_header.php';?>
<link rel="stylesheet" type="text/css" href="/ji_style/ta/evaluation/student/index.css">

    <!-- The main page content is here -->
    <div class='body'>
        <div class="maincontent">
            <div class="announcement">
                <h2>Add</h2>
                <?php foreach ($course_list as $course):?>
                <li>
                    <p><?php echo $course->KCDM.' '.$course->KCZWMC;?></p>
                    <?php foreach ($course->ta_list as $ta):?>
                    	<p><?php echo $ta->name_ch.' '.$ta->name_en;?></p>
                    <?php endforeach?>
                </li>
				<?php endforeach?>
            </div>
        </div>
    </div>



<?php include '../common_footer.php';?>