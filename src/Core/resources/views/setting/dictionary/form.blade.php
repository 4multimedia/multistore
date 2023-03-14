@extends('backend::layouts.app')

@section('content')
<form-module title="{{ $title }}">
	<ui-box header="Podstawowe informacje" class="mb-5">
		{!! form()->text('Nazwa pozycji', 'name', ['value' => $dictionary->names ?? '', 'column' => true, 'placeholder' => 'Tytuł pozycji', ':translate' => true]) !!}

		@if (isset($cols))
			@foreach($cols as $col)
				@php
					$type = $col["type"];
					$name = $col["id"];
					$label = $col['name'];
					$value = $type == 'gallery' ? (isset($dictionary->all_images) ? $dictionary->all_images : []) : $dictionary->options[$col["id"]] ?? '';
					unset($col['name']);
				@endphp
				{!! form()->$type($label, $name, array_merge(['value' => $value ?? '', 'column' => true, 'placeholder' => $label], $col)) !!}
			@endforeach
		@endif
	</ui-box>
</form-module>
@endsection
