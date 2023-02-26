@extends('backend::layouts.app')

@section('content')
<form-tree url="article/category/tree" update="article/category" root="{{ config('multimedia.backend') }}">
    {{ do_action('category_article_before') }}

    {{ do_action('category_category_name_before') }}
    {!! form()->text(null, 'name', ['value' => isset($category) ? $category->name : '', 'placeholder' => 'Nazwa kategorii', 'class' => 'text-lg']) !!}
    {{ do_action('category_category_name_after') }}

    <ui-box header="Podstawowe informacje">
        {!! form()->gallery(null, 'a') !!}
        {!! form()->text('Krótki opis', 'excrept', ['placeholder' => 'Nazwa kategorii', ':column' => true]) !!}
        {!! form()->text('Opis kategorii', 'description', ['placeholder' => 'Nazwa kategorii', ':column' => true]) !!}
    </ui-box>

    {{ do_action('category_category_form_before') }}
    @yield('form')
    {{ do_action('category_category_form_after') }}

    <div class="mt-5">
        <x-backend-meta></x-backend-meta>
    </div>
    {{ do_action('category_category_after') }}
</form-tree>
@endsection
