<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <!-- To be revised -->
    <title>TA Evaluation System: Student Homepage</title>
    <script src="/ji_js/jquery-1.8.3.min.js"></script>
    <script src="/ji_js/ta/evaluation.js"></script>
    <script src="/ji_js/confirmLogout.js"></script>
    <!--<script src="../Formal Project/bootstrap-3.3.5-dist/js/bootstrap.js"></script>-->
    <noscript>Your browser does not support JavaScript!</noscript>
    <link rel="stylesheet" type="text/css" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/ji_style/ta/common.css">
    <link rel="stylesheet" type="text/css" href="/ji_style/ta/evaluation/student/index.css">
    <base target="_self">
</head>

<body>
<div class="wholeBody">
    <!-- Top Banner -->
    <div class='_top'> <a href="http://umji.sjtu.edu.cn/cn/"><img src="/ji_style/ta/images/JI logo-01.png" height="110" alt="Logo of Joint Institute"
                                                                  title="上海交大密西根学院"></a> <h1 title="Teaching
		Assistant Evaluation System">Teaching Assistant Evaluation System</h1>
    </div>

    <ul class="nav nav-pills nav-justified">
        <li class="active"><a href="#">Homepage</a></li>
        <li class="non-active"><a href="../Formal Project/Student_Page/Student_TA Evaluation.html">TA Evaluation</a></li>
        <li class="non-active"><a href="#">Feedbacks</a></li>
    </ul>
    <div class="banner">
        <div>
            <a onclick="confirmLogout()">Sign out</a>
            <span id="SID">5143709XXX</span>
            <span id="department">Joint Institute</span>
            <span id="name">Xiao Ming</span>
        </div>
    </div>

    <!-- The main page content is here -->
    <div class='body'>
        <div class="maincontent">
            <div class="announcement">
                <h2>Announcements</h2>
                <ul>
                    <li>
                        <h4>Title_1</h4>
                        <p>Here is the main content of the announcement 1...</p>
                    </li>
                    <li>
                        <h4>Title_2</h4>
                        <p>Here is the main content of the announcement 2...</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>



    <!-- The end bar is here -->
    <div class="endbar">
        <div class="_content">
            <p>Address: 800 Dong Chuan Road,Shanghai, 200240, China</p>
            <p><a href="http://umji.sjtu.edu.cn/cn/">© 2015 University of Michigan – Shanghai Jiao Tong University Joint Institute</a></p>
            <p>Server Time: &nbsp<span id="serverTime"></span>
                <script type="text/javascript">
                    // <!--
                    updateFooterTime();
                    // <!--// &ndash;&gt;-->
                </script></p>
        </div>
    </div>

</div>
</body>
</html>
