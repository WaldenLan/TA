<link rel="stylesheet" type="text/css" href="/ji_style/ta/evaluation/teacher/index.css">

    <ul class="nav nav-pills nav-justified">
        <li class="<?php echo $banner_id!=1?'non-':'';?>active"><a href="/ta/evaluation/teacher">Homepage</a></li>
        <li class="<?php echo $banner_id!=2?'non-':'';?>active"><a href="/ta/evaluation/teacher/evaluation">Evaluation Setup</a></li>
        <li class="<?php echo $banner_id!=3?'non-':'';?>active"><a href="/ta/evaluation/teacher/feedback/view">Feedbacks Process</a></li>
        <li class="<?php echo $banner_id!=4?'non-':'';?>active"><a href="/ta/evaluation/teacher/report">TA Report</a></li>
    </ul>
    <div class="banner">
        <div>
            <a onclick="confirmLogout()">Sign out</a>
            <span id="SID"><?php echo $_SESSION['userid'];?></span>
            <span id="department">Joint Institute</span>
            <span id="name"><?php echo $_SESSION['username'];?></span>
        </div>
    </div>