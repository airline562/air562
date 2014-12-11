<!DOCTYPE HTML>
<!--
	Miniport by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Kanoe</title>
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
			<nav class="navbar navbar-default" role="navigation">
		  <div class="container-fluid">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar fa-paper-plane"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <a class="navbar-brand" href="/">Kanoe</a>
		    </div>

		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      <ul class="nav navbar-nav">
		        <li class="active"><a href="/">Home <span class="sr-only">(current)</span></a></li>
		    </div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav>

		<!-- Home -->

		<!-- Work -->
			<div class="wrapper style2">
				<article id="form-base">
					<header>
						<h2>Here are some flights that might work for you.</h2>
						<h3>{{$deptCity}}({{$deptCode}}) to {{$arrivalCity}}({{$arriveCode}})</h3>
					</header>
					<div class="container">
						<div class="row">
							<div class="12u">
								<section class="box style1">
									<div class="row">
										<div class="12u">
										@foreach($results as $flight)
										<?php $airline1 = DB::table('Flight')->select('airline_code')->where('id', $flight['first_flight_id'])->first(); ?>
										<?php $airline2 = DB::table('Flight')->select('airline_code')->where('id', $flight['second_flight_id'])->first();
										$assetString1 = 'images/' .  $airline1->airline_code . '.png';
										$assetString1 = asset($assetString1);
										
										$assetString2 = 'images/' .  $airline2->airline_code . '.png';
										$assetString2 = asset($assetString2);


										 ?>

											<table class="table table-striped">
											  <tr>
											    <th>Airline</th>
											    <th>Flight Number</th>
											    <th>Departure</th> 
											    <th>Arrival</th>
											    <th>Departure Time(Local)</th>
											    <th>Arrival Time(Destination)</th>
											    <th>Flight Time</th>
											    
											  </tr>
											  
											  <tr>
											  	<td><img src="{{$assetString1}}" alt="" width="75" height='20' /></td>
											  	<td>{{$flight['first_flight_id']}}</td>
											    <td>{{$flight['originating']}}</td>
											    <td>{{$flight['connecting']}}</td>
											    <td>{{date("H:i:s", strtotime($flight['first_flight_dep_time']) + $flight['org_city_utc_offset'] * 3600);}}</td>
											    <td>{{date("H:i:s", strtotime($flight['first_flight_dep_time']) + ($flight['con_city_utc_offset'] * 3600) + ($flight['first_flight_time'] * 60));}}</td>								
										    	<td>{{date('H:i', mktime(0,$flight['first_flight_time']))}}</td>											
											  </tr>

											   <tr>
											   <td><img src="{{$assetString2}}" alt="" width="75" height='20' /></td>
											   	<td>{{$flight['second_flight_id']}}</td>
											    <td>{{$flight['connecting']}}</td> 
											    <td>{{$flight['destination']}}</td>
											    <td>{{date("H:i:s", strtotime($flight['second_flight_dep_time']) + $flight['con_city_utc_offset'] * 3600);}}</td>
											    <td>{{date("H:i:s", strtotime($flight['second_flight_dep_time']) + ($flight['second_flight_time'] * 60) + ($flight['dest_city_utc_offset'] * 3600))}}</td>								
											    <td>{{date('H:i', mktime(0,$flight['second_flight_time']))}}</td>	
											  </tr>
											 
											</table>
											 @endforeach
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