@extends('backend::layouts.app')

@section('content')
    <form-module publish>
        {!! form()->text(null, 'email', ['column' => true, 'placeholder' => 'Tytuł strony']) !!}
        <ui-box header="Podstawowe informacje">

        </ui-box>
        <x-backend-meta></x-backend-meta>
    </form-module>
@endsection
