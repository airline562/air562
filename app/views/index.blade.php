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
		<script type="text/javascript"
        src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <script type="text/javascript"
        src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
        <link rel="stylesheet" type="text/css"
        href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" />
 
        <script type="text/javascript">
                $(function()
					{
						 $( "#q" ).autocomplete({
						  source: "/home/autocomplete",
						  minLength: 3,
						  select: function(event, ui) {
						  	$('#q').val(ui.item.value);
						  }
						});
					});

                $(function()
					{
						 $( "#v" ).autocomplete({
						  source: "/home/autocomplete",
						  minLength: 3,
						  select: function(event, ui) {
						  	$('#v').val(ui.item.value);
						  }
						});
					});



               $(document).ready(function() {
				    src = '/home/autocompletecity';

				    // Load the cities straight from the server, passing the country as an extra param
				    $("#p").autocomplete({
						        source: function(request, response) {
						            $.ajax({
						                url: src,
						                dataType: "json",
						                data: {
						                    term : request.term,
						                    country : $("#q").val()
						                },
						                success: function(data) {
						                    response(data);
						                }
						            });
						        },
						        min_length: 3
						    });
						});

               $(document).ready(function() {
				    src = '/home/autocompletecity';

				    // Load the cities straight from the server, passing the country as an extra param
				    $("#u").autocomplete({
						        source: function(request, response) {
						            $.ajax({
						                url: src,
						                dataType: "json",
						                data: {
						                    term : request.term,
						                    country : $("#v").val()
						                },
						                success: function(data) {
						                    response(data);
						                }
						            });
						        },
						        min_length: 3
						    });
						});


        </script>
		<noscript>
			<!-- <link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" /> -->
			<!-- <link rel="stylesheet" href="css/style-desktop.css" /> -->
			<link rel="stylesheet" href="{{ URL::asset('assets/css/skel.css') }}">
			<link rel="stylesheet" href="{{ URL::asset('assets/css/style.css') }}">
			<link rel="stylesheet" href="{{ URL::asset('assets/css/style-desktop.css') }}">
		</noscript>
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="css/ie/v9.css" /><![endif]-->
	</head>
	<body>

		<!-- Nav -->
			<nav id="nav">
				<ul class="container">
					<li><span class="icon featured fa-paper-plane "></span></li>
					<li><a href="/">Airline562</a></li>
				</ul>
			</nav>

		<!-- Home -->

		<!-- Work -->
			<div class="wrapper style2">
				<article id="form-base">
					<header>
						<h2>Find your flight?</h2>
					</header>
					<div class="container">
						<div class="row">
							<div class="12u">
								<section class="box style1">
									<div class="row">
										<div class="12u">
											{{ Form::open(['action' => ['HomeController@postFlights'], 'method' => 'POST']) }}
												<div>
													<div class="row">
														<div class="4u">
															{{ Form::text('q', '', ['id' =>  'q', 'placeholder' =>  'Enter Departure Country'])}}
														</div>
														<div class="4u">
															{{ Form::text('p', '', ['id' =>  'p', 'placeholder' =>  'Enter Departure City'])}}
														</div>
														<div class="4u">
															<input type="date" name="dept_date" id="detpdate" placeholder="Date" />
														</div>
													</div>
													<div class="row">
														<div class="4u">
															{{ Form::text('v', '', ['id' =>  'v', 'placeholder' =>  'Enter Arrival Country'])}}
														</div>
														<div class="4u">
															{{ Form::text('u', '', ['id' =>  'u', 'placeholder' =>  'Enter Arrival City'])}}
														</div>
														<div class="4u">
															<input type="radio" name="group1" value="direct"> Direct<br>
															<input type="radio" name="group1" value="multi" checked> Multiple Flights
														</div>
													</div>
													<div class="row 200%">
														<div class="12u">
															<ul class="actions">
																<li><input type="submit" value="Find Flights" /></li>
																<!-- <li><input type="reset" value="Clear Form" class="alt" /></li> -->
															</ul>
														</div>
													</div>
												</div>
											{{ Form::close() }}
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