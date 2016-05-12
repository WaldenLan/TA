<?php include dirname(dirname(__FILE__)) . '/common_header.php'; ?>

    <!-- The main page content is here -->
    <div class='body'>
        <div class="maincontent">
            <div class="announcement">
                <h2 id="semester">
                    <span class="label label-info">
                        <?php echo $this->Mta_site->print_semester(); ?> > Course ID > TA name
                    </span>
                </h2>

                <div class="evaluation_question">
                    <h2>Evaluation Questions for 2016</h2>
                    <div class="main_question">
                        <h3>I) Choice Questions: (max score is 5 points for each questions)</h3>
                        <form action="" method="get">
                            <h4>&nbsp;&nbsp;1. I have a question blablabla..</h4>
                            <br /><br />
                            <label><input name="q1" type="radio" value="" />hahaha </label>
                            <label><input name="q1" type="radio" value="" />sadsadsad </label>
                            <label><input name="q1" type="radio" value="" />wowwow </label>
                            <label><input name="q1" type="radio" value="" />youyoyou </label>
                            <label><input name="q1" type="radio" value="" />others </label>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>




<?php include dirname(dirname(__FILE__)) . '/common_footer.php'; ?>