<?php include dirname(dirname(__FILE__)) . '/common_header.php'; ?>

	<!-- The main page content is here -->
    <div class='body'>
        <div class="maincontent">
            <div class="announcement">
                <h2>Evaluation Setup</h2>
                <h2 id="semester">
					<span class="label label-info">
                        Current Semester: <?php echo $this->Mta_site->print_semester(); ?>
                    </span>
                </h2>

                <div class="attention teacher_setup">
                    <h2>Attention</h2>
                    <ul>
                        <li>1. You can add at most two questions to TA evaluation.</li>
                        <li>2. Attention tips attention tips attention tips attention tips.</li>
                        <li>3. Attention tips attention tips attention tips.</li>
                    </ul>
                </div>

                <h4>Course List</h4>
                <div class="row feedback_schema">
                    <h4 class="col-sm-2">Course ID</h4>
                    <h4 class="col-sm-4">Course Name</h4>
                    <h4 class="col-sm-2">TA Number</h4>
                    <h4 class="col-sm-2">Process</h4>
                </div>
                <div class="list_container">

                </div>

            </div>
        </div>
    </div>



<?php include dirname(dirname(__FILE__)) . '/common_footer.php'; ?>