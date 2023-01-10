@extends('backend::layouts.app')

@section('content')
<form method="post">
	@csrf
	<form-module>
		<form-section header="Typografia">
			<ui-box header="Ustawienia globalne">
				{!! form()->dropdown('Czcionka globalna', 'global.font', ['help' => 'Podstawowa czcionka w witrynie']) !!}
				{!! form()->dropdown('Nagłówki', 'global.font', ['help' => 'Podstawowa czcionka w witrynie']) !!}
				{!! form()->dropdown('Nagłówek H1', 'global.font') !!}
				{!! form()->dropdown('Nagłówek H2', 'global.font') !!}
				{!! form()->dropdown('Nagłówek H3', 'global.font') !!}
				{!! form()->dropdown('Nagłówek H4', 'global.font') !!}
			</ui-box>
		</form-section>
		<form-section header="Kolorystyka">
			<ui-box header="Ustawienia globalne">
				<views-layout-colors></views-layout-colors>
			</ui-box>
		</form-section>
		<form-section header="Rozmiary responsywne">
			<ui-box header="Rozmiary">
				<input type="text" name="breakpoint[][name]" />
				<input type="text" name="breakpoint[][size]" />
				<input type="text" name="breakpoint[][full]" />
			</ui-box>
		</form-section>

		<div class="flex mt-5 justify-end">
			<button class="btn btn-primary w-48" type="submit">Zapisz zmiany</button>
		</div>
	</form-module>
</form>
@endsection
