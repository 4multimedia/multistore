<{{ $tag }} class="{{ $className }}">
	@yield('content')
	<x-layout::children :elements="$elements" />
</{{ $tag }}>
