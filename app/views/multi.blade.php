<!DOCTYPE HTML>
<!--
	Miniport by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Airline562</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery.scrolly.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<!-- <link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" /> -->
			<!-- <link rel="stylesheet" href="css/style-desktop.css" /> -->
			<link rel="stylesheet" href="{{ URL::asset('assets/css/skel.css') }}">
			<link rel="stylesheet" href="{{ URL::asset('assets/css/style.css') }}">
			<link rel="stylesheet" href="{{ URL::asset('assets/css/style-desktop.css') }}">
		</noscript>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="css/ie/v9.css" /><![endif]-->
	</head>
	<body>

		<!-- Nav -->
			<nav id="nav">
				<ul class="container">
					<li><span class="icon featured fa-paper-plane "></span></li>
					<li><a href="#top">Airline562</a></li>
				</ul>
			</nav>

		<!-- Home -->

		<!-- Work -->
			<div class="wrapper style2">
				<article id="form-base">
					<header>
						<h2>Here are some flights that might work for you.</h2>
						<h3>{{$deptCity}} to {{$arrivalCity}}</h3>
					</header>
					<div class="container">
						<div class="row">
							<div class="12u">
								<section class="box style1">
									<div class="row">
										<div class="12u">
											<table class="table table-striped">
											  <tr>
											    
											    <th>Departure</th> 
											    <th>Connection</th>
											    <th>Arrival</th>
											    <th>Departure Time(Local)</th>
											    <th>Arrival Time(Destination)</th>
											    
											  </tr>
											  @foreach($results as $flight)
											  <tr>
											  
											    <td>{{$flight['originating']}}</td> 
											    <td>{{$flight['connecting']}}</td>
											    <td>{{$flight['destination']}}</td>
											    <td>{{date("H:i:s", strtotime($flight['first_flight_dep_time']) + $flight['org_city_utc_offset'] * 3600);}}</td>
											    <td>{{date("H:i:s", strtotime($flight['second_flight_dep_time']) + $flight['dest_city_utc_offset'] * 3600 + $flight['second_flight_time']);}}</td>
											   										
											  </tr>
											  @endforeach
											</table>
										</div>
									</div>
								</section>
							</div>
						</div>
						<div>
						
					</div>
					</div>

					<footer>
					</footer>
				</article>
				
			</div>
			<div class="wrapper style4">
				
			</div>

	</body>
</html>