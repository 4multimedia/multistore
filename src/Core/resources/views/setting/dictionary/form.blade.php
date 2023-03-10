@extends('backend::layouts.app')

@section('content')
<form-module title="{{ $title }}">
	<ui-box header="Podstawowe informacje" class="mb-5">
		{!! form()->text(null, 'name', ['value' => $dictionary->names ?? '', 'column' => true, 'placeholder' => 'Tytuł pozycji', ':translate' => true]) !!}
	</ui-box>
</form-module>
@endsection
