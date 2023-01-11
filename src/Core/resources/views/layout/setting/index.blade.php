@extends('backend::layouts.app')

@section('content')
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
			<ui-box header="Kolory podstawowe">
				<views-layout-colors name="color[general]" :colors="{!! strtr(json_encode($colors["general"]), ['"' => "'"]) !!}"></views-layout-colors>
			</ui-box>
			<ui-box header="Linki">
				<views-layout-colors name="color[link]" :colors="{!! strtr(json_encode($colors["link"]), ['"' => "'"]) !!}"></views-layout-colors>
			</ui-box>
            <ui-box header="Przyciski, alerty">
				<views-layout-colors name="color[buttons]" :colors="{!! strtr(json_encode($colors["buttons"]), ['"' => "'"]) !!}"></views-layout-colors>
			</ui-box>
			<ui-box header="Kolory dodatkowe">
				<views-layout-colors name="color[additional]" :colors="{!! strtr(json_encode($colors["additional"]), ['"' => "'"]) !!}" add></views-layout-colors>
			</ui-box>
		</form-section>
		<form-section header="Rozmiary responsywne">
			<ui-box header="Rozmiary">
				<input type="text" name="breakpoint[][name]" />
				<input type="text" name="breakpoint[][size]" />
				<input type="text" name="breakpoint[][full]" />
			</ui-box>
		</form-section>
	</form-module>
@endsection
