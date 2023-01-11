@extends('backend::layouts.app')

@section('content')
<form-module title="{{ __('backend::setting.Add domain') }}">
	<form-section header="Podstawowe informacje">
		<ui-box header="Podstawowe informacje">
			{!! form()->text(__('backend::setting.Domain'), 'domain', ['value' => $item->domain ?? '', 'help' => 'Wpisz adres strony www bez protokułu (http, https) oraz przedrostka www', ':required' => true]) !!}
			{!! form()->switch(__('backend::setting.Set SSL'), 'ssl', ['value' => isset($item->ssl) && $item->ssl === 1 ? true : false ]) !!}
		</ui-box>
	</form-section>
	<form-section header="Dodatkowe ustawienia">
		<ui-box header="Identyfikacja wizualna">
			{!! form()->image('Logo strony', 'logo', ['help' => 'Logo możesz użyc np. w szablonach maila.']) !!}
		</ui-box>
	</form-section>
</form-module>
@endsection
