@extends('backend::layouts.app')

@section('content')
<form-module title="{{ $title }}" :action-split="false">
	<form-section header="Podstawowe informacje">
		<ui-box header="Sortowanie" class="mb-5">
			<div class="flex space-x-4">
				<div class="basis-1/2">
					{!! form()->dropdown('Kolumna', 'sort_col', ['column' => true, 'options' => $cols, 'value' => $dictionary->options["sort_col"] ?? 'position']) !!}
				</div>
				<div class="basis-1/2">
					{!! form()->dropdown('Kierunek', 'sort_by', ['column' => true, 'options' => [['id' => 'asc', 'name' => 'Rosnąco'], ['id' => 'desc', 'name' => 'Malejąco']], 'value' => $dictionary->options["sort_by"] ?? 'asc']) !!}
				</div>
			</div>
		</ui-box>
	</form-section>
	<form-section header="Dodatkowe kolumny">
		<ui-box header="Dodatkowe pola" class="mb-5" padding-header="px-5 py-3">
			<template #right>
				<button class="btn w-32" type="button">Dodaj kolumnę</button>
			</template>
			<div>
				<div class="flex justify-end">

				</div>
			</div>
		</ui-box>
	</form-section>
</form-module>
@endsection
