@extends('backend::layout.app')

@section('content')
    <form-module>
        <form-section header="Podstawowe informacje">
            <ui-box header="Dane podstawowe">
				{!! form()->text('Imię', 'firstname') !!}
				{!! form()->text('Nazwisko', 'lastname') !!}
				{!! form()->text('Adres e-mail', 'email') !!}
				{!! form()->text('Hasło', 'password') !!}
				{!! form()->text('Uprawienia', 'password') !!}
            </ui-box>
        </form-section>
        <form-section header="Ograniczenia dostępu">
            <ui-box header="Powiadomienia"></ui-box>
            <ui-box header="Ograniczenia dostępu IP"></ui-box>
        </form-section>
        <form-section header="Aktywność">
            <ui-box header="Aktywne sesje"></ui-box>
            <ui-box header="Aktywność uzytkownika"></ui-box>
        </form-section>
        <form-section header="Logi">
            <ui-box header="Logi"></ui-box>
        </form-section>
    </form-module>
@endsection
