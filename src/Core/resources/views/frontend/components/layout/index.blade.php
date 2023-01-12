<div>
	@foreach ($elements as $element)
		<x-layout::children :elements="$element" />
	@endforeach
</div>
