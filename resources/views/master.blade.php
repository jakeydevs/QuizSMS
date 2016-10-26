<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
	<title>QuizSMS</title>

	<!-- Stylesheets -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
	<style>
		/* Space out content a bit */
		body {
			padding-top: 1.5rem;
			padding-bottom: 1.5rem;
		}

		/* Everything but the jumbotron gets side spacing for mobile first views */
		.header,
		.marketing,
		.footer {
			padding-right: 1rem;
			padding-left: 1rem;
		}

		/* Custom page header */
		.header {
			padding-bottom: 1rem;
			border-bottom: .05rem solid #e5e5e5;
		}
		/* Make the masthead heading the same height as the navigation */
		.header h3 {
			margin-top: 0;
			margin-bottom: 0;
			line-height: 3rem;
		}

		/* Custom page footer */
		.footer {
			padding-top: 1.5rem;
			color: #777;
			border-top: .05rem solid #e5e5e5;
		}

		/* Customize container */
		@media (min-width: 48em) {
			.container {
				max-width: 46rem;
			}
		}
		.container-narrow > hr {
			margin: 2rem 0;
		}

		/* Main marketing message and sign up button */
		.jumbotron {
			text-align: center;
			border-bottom: .05rem solid #e5e5e5;
		}
		.jumbotron .btn {
			padding: .75rem 1.5rem;
			font-size: 1.5rem;
		}

		/* Supporting marketing content */
		.marketing {
			margin: 3rem 0;
		}
		.marketing p + h4 {
			margin-top: 1.5rem;
		}

		/* Responsive: Portrait tablets and up */
		@media screen and (min-width: 48em) {
			/* Remove the padding we set earlier */
			.header,
			.marketing,
			.footer {
				padding-right: 0;
				padding-left: 0;
			}
			/* Space out the masthead */
			.header {
				margin-bottom: 2rem;
			}
			/* Remove the bottom border on the jumbotron for visual effect */
			.jumbotron {
				border-bottom: 0;
			}
		}
	</style>

	<!-- Page CSS -->
	@yield('head')

</head>
<body>

	<div class="container">
		<div class="header clearfix">
			<nav>
				<ul class="nav nav-pills pull-xs-right">
					<li class="nav-item">
						<a class="nav-link" href="{{ action('DisplayController@showDashboard') }}">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="{{ action('DisplayController@showUsers') }}">Users</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="{{ action('DisplayController@showCorrect') }}">Corrects</a>
					</li>
				</ul>
			</nav>
			<h3 class="text-muted">QuizSMS</h3>
		</div>

		@yield('body')

	</div>

	<!-- Javascript -->
	<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
	<script src="https://js.pusher.com/3.2/pusher.min.js"></script>

	<!-- Page JS -->
	@yield('js')
	
</body>
</html>