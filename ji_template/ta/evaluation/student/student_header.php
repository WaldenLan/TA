<link rel="stylesheet" type="text/css" href="/ji_style/ta/evaluation/student/index.css">


<ul class="nav nav-pills nav-justified">
        <li class="<?php echo $banner_id!=1?'non-':'';?>active"><a href="/ta/evaluation/student">Homepage</a></li>
        <li class="<?php echo $banner_id!=2?'non-':'';?>active"><a href="/ta/evaluation/student/evaluation">TA Evaluation</a></li>
        <li class="<?php echo $banner_id!=3?'non-':'';?>active"><a href="/ta/evaluation/student/feedback/view">Feedbacks</a></li>
    </ul>
    <div class="banner">
    	<?php if ($_SESSION['userid'] == ''):?>
        
        <?php else:?>
        <div>
            <a onclick="confirmLogout('/ta/evaluation')">Sign out</a>
            <span id="SID"><?php echo $_SESSION['userid'];?></span>
            <span id="department">Joint Institute</span>
            <span id="name"><?php echo $_SESSION['username'];?></span>
        </div>
        <?php endif?>
    </div>