<?php include dirname(dirname(__FILE__)) . '/common_header.php'; ?>

<?php
/** @var $ta Ta_obj */
echo $ta->name_en;
echo '<br>';
echo $ta->name_ch;
echo '<br>';
echo $ta->gender;
echo '<br>';
echo $ta->faculty;
echo '<br>';
echo $ta->email;
echo '<br>';
echo $ta->phone;
echo '<br>';
echo '<br>';
echo '<br>';

echo '<div id="course-list">';
echo '<h5>Course:</h5><br>';
foreach ($ta->course_list as $course)
{
	echo $course->KCZWMC;
	echo '<br>';
}
echo '</div>';
echo '<br>';
echo '<br>';

echo '<div id="feedback-list">';
echo '<h5>Feedback:</h5><br>';
foreach ($ta->feedback_list as $feedback)
{
	echo $feedback->title;
	echo '<br>';
}
echo '</div>';
echo '<br>';
echo '<br>';


echo '<div id="report-list">';
echo '<h5>Report:</h5><br>';
foreach ($ta->report_list as $report)
{
	echo $report->title;
	echo '<br>';
}

echo '</div>';

?>

<?php include dirname(dirname(__FILE__)) . '/common_footer.php'; ?>
