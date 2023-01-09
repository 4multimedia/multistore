@extends('backend::layout.app')

@section('content')
<form-tree url="" root="">
    {{ do_action('category_before') }}

    {{ do_action('category_name_before') }}
    {!! form()->text(null, 'name', ['placeholder' => 'Nazwa kategorii', 'class' => 'text-lg']) !!}
    {{ do_action('category_name_after') }}

    <ui-box header="Podstawowe informacje">
        {!! form()->gallery(null, 'a') !!}
        {!! form()->text('Krótki opis', 'name', ['placeholder' => 'Nazwa kategorii', ':column' => true]) !!}
        {!! form()->text('Opis kategorii', 'name', ['placeholder' => 'Nazwa kategorii', ':column' => true]) !!}
    </ui-box>

    {{ do_action('category_form_before') }}
    @yield('form')
    {{ do_action('category_form_after') }}

    <x-backend-meta></x-backend-meta>
    {{ do_action('category_after') }}
</form-tree>
@endsection
