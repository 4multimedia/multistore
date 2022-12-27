{{ get_css() }}
<div id="app">
	<div>{!! do_menu() !!}</div>
	<div>
    	@yield('content')
	</div>
</div>

<script src="{{ mix('js/backend.js') }}"></script>
