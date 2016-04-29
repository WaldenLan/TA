<link rel="stylesheet" type="text/css" href="/ji_style/ta/evaluation/manage/index.css">

    <ul class="nav nav-pills nav-justified">
        <li class="<?php echo $banner_id!=1?'non-':'';?>active"><a href="/ta/evaluation/manage">首页</a></li>
        <li class="<?php echo $banner_id!=2?'non-':'';?>active"><a href="">评教设置</a></li>
        <li class="<?php echo $banner_id!=3?'non-':'';?>active"><a href="/ta/evaluation/manage/search">搜索</a></li>
        <li class="<?php echo $banner_id!=4?'non-':'';?>active"><a href="/ta/evaluation/manage/feedback/view">投诉处理</a></li>
        <li class="<?php echo $banner_id!=5?'non-':'';?>active" ><a href="">导出到Excel</a></li>
    </ul>
    <div class="banner">
        <div>
            <a onclick="confirmLogout('/ta/evaluation')">Sign out</a>
            <span id="SID"><?php echo $_SESSION['userid'];?></span>
            <span id="department">Joint Institute</span>
            <span id="name"><?php echo $_SESSION['username'];?></span>
        </div>
    </div>