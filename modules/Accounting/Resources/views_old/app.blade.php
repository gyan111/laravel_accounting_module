<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<meta name="locale" content="{{ App::getLocale() }}" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('title')</title>

	<link href="{{ asset('/modules/accounting/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('/modules/accounting/css/accounting.css') }}" rel="stylesheet">

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">

	<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">

				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="{{-- route('transaction.index') --}}{{ url('/') }}">{{ Lang::get('message.app') }} </a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<!-- <ul class="nav navbar-nav">
					<li><a href="{{ url('/') }}">Home</a></li>
				</ul> -->

				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="{{ url('/login') }}">{{ trans('phrases.login') }}</a></li>
						<!-- <li><a href="{{ url('/auth/register') }}">Register</a></li> -->
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->first_name }}<span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/logout') }}">{{ trans('phrases.logout') }}</a></li>
								<li><a href="{{ url('profile') }}">{{ trans('phrases.update_profile') }}</a></li>
								@if (Auth::user()->isSuperAdmin())
									<li><a href="{{ url('user') }}">{{ trans('phrases.user_management') }}</a></li>
								@endif
								<li><a href="{{ url('category') }}">{{ trans('phrases.category_management') }}</a></li>
								<li><a href="{{ url('account') }}">{{ trans('phrases.account_management') }}</a></li>
							</ul>
						</li>
					@endif
				</ul>

				<ul class="nav navbar-nav navbar-right">
                	<?php  
                	$languages = [
                			// 'nl' => trans('languages.nl'),
    						'en' => trans('languages.en'),
    						'fr' => trans('languages.fr'),
    						// 'de' => trans('languages.de'),
    						// 'it' => trans('languages.it'),
    						// 'pl' => trans('languages.pl'),
    						// 'pt' => trans('languages.pt'),
    						// 'ru' => trans('languages.ru'),
    						// 'es' => trans('languages.es')
    					]
                	?>
                	<li class="dropdown">
	                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#" aria-expanded="false">
	                        <i class="lang lang-{{ App::getLocale() }}"></i><span class="caret"></span>
	                    </a>
	                    <ul class="dropdown-menu	">
		                    @foreach ($languages as $language => $language_name)
		                    	<li>
		                            <a href="{{ url('language/' . $language) }}">
		                            	<i class="lang lang-{{ $language }}" ></i> {{ $language_name }}
		                            </a>
		                        </li>
		                    @endforeach	
	                    </ul>
	                </li>
                </ul>

				<!-- <ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Select language<span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="{{ url('language/en') }}">en</a></li>
							<li><a href="{{ url('language/or') }}">or</a></li>
						</ul>
					</li>
				</ul> -->

			</div>
		</div>
	</nav>

	@yield('content')

	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	
	<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
		<script src="{{ asset('/js/config.js') }}"></script>
	<script src="{{ asset('/js/underscore.js') }}"></script>
	<script src="{{ asset('/js/backbone.js') }}"></script>
	<script src="{{ asset('localisation/language/' . App::getLocale() . '.js') }}"></script>
	<script src="{{ asset('/js/script.js') }}"></script>
		<!-- Scripts -->
	


	
</body>
</html>
