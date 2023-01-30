@foreach($elements as $element)
	@php
		$component = $element["component"];
		$component = strtr($component, ['visual-' => '']);
		$componentName = "layout::".$component;
		$elements = $element["children"];
		$uuid = $element["uuid"];
		$setting = $element["setting"];
	@endphp
	<x-dynamic-component :component="$componentName" :elements="$elements" :uuid="$uuid" :setting="$setting" />
@endforeach
