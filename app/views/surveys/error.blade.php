<html>
<head>
		<title>Puškice anketa</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

		<link rel="icon" href="https://www.puskice.org/repo/images/favicon.ico" type="image/x-icon">


		<!-- Bootstrap -->
		<link rel="stylesheet" href="{{Request::root()}}/assets/frontend/css/bootstrap.min.css">
		<link rel="stylesheet" href="{{Request::root()}}/assets/frontend/css/bootstrap-glyphicons.css">
		<!-- Custom css -->
		<link rel="stylesheet" href="{{Request::root()}}/assets/frontend/css/survey-styles.css">
		<link rel="stylesheet" href="{{Request::root()}}/assets/frontend/css/survey-themes.css">

		<!-- Scripts -->
		<script src="{{Request::root()}}/assets/frontend/js/jquery.js"></script>	
		<script src="{{Request::root()}}/assets/frontend/js/bootstrap.min.js"></script>	
		<script src="{{Request::root()}}/assets/frontend/js/survey-script.js"></script>	

	</head>
<body>	


	<div class="container" id="main-content">
		<h1 style="margin-top: 50px; color:#d43f3a;"><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span></h1>
		<h1 style="color:#337ab7;" class="center-block">{{$message}}</h1>
	</div>

</body>
</html>