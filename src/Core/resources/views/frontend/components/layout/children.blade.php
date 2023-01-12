@foreach($elements as $element)
	@php
		$component = $element["props"]["component"];
		$componentName = "layout::".$component;
		$elements = $element["children"];
		$uuid = $element["uuid"];
	@endphp
	<x-dynamic-component :component="$componentName" :elements="$elements" :uuid="$uuid" />
@endforeach
