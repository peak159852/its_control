<!doctype html>
<html lang="en" class="fullscreen-bg">

<head>
	<title>Login | ITS WEBSITE</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/bootsnav.css">
	<!--style.css-->
	<link rel="stylesheet" href="assets/css/login.css">
	<!-- GOOGLE FONTS -->


</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle">
				<div class="auth-box ">
					<div class="left">
						<div class="content">
							<div class="header">
								<div class="logo text-center"><img src="assets/images/logo.png" alt=""></div>
								<p class="lead">Login to your account</p>
							</div>
							<form method="post" action="check_login.php" class="form-auth-small">
								<div class="form-group">
									<label for="signin-email" class="control-label sr-only">I D</label>
									<input type="text" name="id" class="form-control" id="inputemail" placeholder="Id">
								</div>
								<div class="form-group">
									<label for="signin-password" class="control-label sr-only">Password</label>
									<input type="password" name="pw" class="form-control" id="inputpw" placeholder="Password">
								</div>
								<!-- <div class="form-group clearfix">
									<label class="fancy-checkbox element-left">
										<input type="checkbox">
										<span>Remember me</span>
									</label>
								</div> -->
								<button type="submit" class="btn btn-primary btn-lg btn-block" id="login-btn"
									onclick="button()">LOGIN</button>
								<div class="bottom">
									<span class="helper-text"><i class="fa fa-lock"></i> <a href="#">아이디,패스워드 입력해주세요
										</a></span>
								</div>
							</form>
						</div>
					</div>
					<div class="right">
						<div class="overlay"></div>
						<div class="content text">
							<h1 class="heading">ITS 확인용 홈페이지</h1>
							<p>by 이재균</p>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- END WRAPPER -->
	<script src="assets/js/jquery.js"></script>
	<script src="assets/js/jquery.counterup.min.js"></script>
	<script src="assets/js/slick.min.js"></script>
	<script src="assets/js/feather.min.js"></script>
	<script src="assets/js/custom.js"></script>
</body>

</html>