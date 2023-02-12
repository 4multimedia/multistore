@extends('backend::layouts.app')

@section('content')
<form-module>
    {!! form()->text(null, 'name', ['column' => true, 'placeholder' => 'Nazwa']) !!}
    <ui-box header="Dodatkowe ustawienia">
        {!! form()->text('Dodatkowa klasa CSS', 'params[class]', ['column' => true, 'placeholder' => 'Klasa CSS']) !!}
    </ui-box>
</form-module>
@endsection
