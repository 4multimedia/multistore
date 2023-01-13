<html lang="en" class="light">
    <head>
        <link rel="stylesheet" href="{{ asset('css/backend.visual.css') }}" />
        <title>{{ get_meta_title('4Mutli.Store - Panel administracyjny') }}</title>
		{{ get_assets_backend_js('before') }}
		<meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="language" content="{{ app()->getLocale() }}">
    </head>
	<body>
		<div id="app">
			@yield('content')
		</div>

		<script src="{{ mix('js/backend.js') }}"></script>
		{{ get_assets_backend_js('after') }}
	</body>
</html>
