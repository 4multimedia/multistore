@foreach($elements as $element)
	@php
		$component = $element["component"];
		$component = strtr($component, ['visual-' => '']);
		$componentName = "layout::".$component;
		$elements = $element["children"];
		$uuid = $element["uuid"];
	@endphp
	<x-dynamic-component :component="$componentName" :elements="$elements" :uuid="$uuid" />
@endforeach
