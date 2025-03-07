<?php 
session_start();
if(!isset($_SESSION['username'])) {
    echo "<script>location.replace('login.php');</script>";            
}

else {
    $username = $_SESSION['username'];
    $name = $_SESSION['name'];
} 
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
	<!-- meta data -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<!--font-family-->
	<!-- title of site -->
	<title>ITS 시설관리</title>

	<!--font-awesome.min.css-->
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">
	<!--bootstrap.min.css-->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<!-- bootsnav -->
	<link rel="stylesheet" href="assets/css/bootsnav.css">
	<!--style.css-->
	<link rel="stylesheet" href="assets/css/style.css">
	<!--responsive.css-->
	<link rel="stylesheet" href="assets/css/responsive.css">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

	<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>

<body>
	<!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

	<!--header-top start -->
	<header id="header-top" class="header-top">


	</header>



	<!--welcome-hero start -->
	<section id="home" class="welcome-hero">
		<div class="container">
		
		</div>

	</section><!--/.welcome-hero-->
	<!--welcome-hero end -->

	<!--list-topics start -->
	<section id="list-topics" class="list-topics">
		<div class="container">
			<div class="list-topics-content">
				<ul>
					<a href="ftms_cctv.php"><li>
						<div class="single-list-topics-content">
							<div class="single-list-topics-icon">
								<i class="fa fa-video-camera"></i>
							</div>
							<p class="cont_head">본선 CCTV</p>
							<p>총 개수 </p>
						</div>
					</li></a>
					<a href="bb1_cctv.php"><li>
						<div class="single-list-topics-content">
							<div class="single-list-topics-icon">
								<i class="fa fa-video-camera"></i>
							</div>
							<p class="cont_head">동산1 ~ 북방1터널</p>
							<p>총 개수 </p>
						</div>
					</li></a>
					<a href="bb3_cctv.php"><li>
						<div class="single-list-topics-content">
							<div class="single-list-topics-icon">
								<i class="fa fa-video-camera"></i>
							</div>
							<p class="cont_head">북방2 ~ 화촌2터널</p>
							<p>총 개수 </p>
						</div>
					</li></a>
					<a href="hc3_cctv.php"><li>
						<div class="single-list-topics-content">
							<div class="single-list-topics-icon">
								<i class="fa fa-video-camera"></i>
							</div>
							<p class="cont_head">화촌3 ~ 화촌6터널</p>
							<p>총 개수 </p>
						</div>
					</li></a>
					<a href="hc9_cctv.php"><li>
						<div class="single-list-topics-content">
							<div class="single-list-topics-icon">
								<i class="fa fa-video-camera"></i>
							</div>
							<p class="cont_head">화촌8 ~ 내촌2터널</p>
							<p>총 개수 </p>
						</div>
					</li></a>
				</ul>
			</div>
			<form method="post" action="logout.php" class="form-auth-small">
				<button type="submit"  class="btn btn-primary btn-lg btn-block" id="logout-btn"
				onclick="button()">로그아웃</button>
				</form>
		</div><!--/.container-->

	</section>
	< <!--footer start-->
		<footer id="footer" class="footer">
			<div class="container">
				<div class="footer-menu">
					<div class="row">
						<div class="col-sm-3">
							<div class="navbar-header">
								<a class="navbar-brand" href="index.html">한국정보기술(주)</a>
							</div><!--/.navbar-header-->
						</div>
					</div>
				</div>
				<div class="hm-footer-copyright">
					<div class="row">
						<div class="col-sm-5">
							<p>
								&copy;copyright. designed and developed by Lee
							</p><!--/p-->
						</div>
						<div class="col-sm-7">
							<div class="footer-social">
								<span><i class="fa fa-phone"> +82 (010) 3775 5496</i></span>

							</div>
						</div>
					</div>

				</div><!--/.hm-footer-copyright-->
			</div><!--/.container-->

			<div id="scroll-Top">
				<div class="return-to-top">
					<i class="fa fa-angle-up " id="scroll-top" data-toggle="tooltip" data-placement="top" title=""
						data-original-title="Back to Top" aria-hidden="true"></i>
				</div>

			</div><!--/.scroll-Top-->

		</footer><!--/.footer-->
		<!--footer end-->

		<!--modernizr.min.js-->
		<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script> -->

		<!--bootstrap.min.js-->
		<script src="assets/js/bootstrap.min.js"></script>

		<!-- bootsnav js -->
		<script src="assets/js/bootsnav.js"></script>

		<!--Custom JS-->
		<script src="assets/js/custom.js"></script>

</body>

</html>