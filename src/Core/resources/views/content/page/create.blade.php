@extends('backend::layouts.app')

@section('content')
    <form-module publish>
        {!! form()->text(null, 'name', ['value' => (isset($page) && isset($page->name)) ? $page->name : '', 'column' => true, 'placeholder' => 'Tytuł strony']) !!}
        <ui-box header="Podstawowe informacje" class="mb-5">
            {!! form()->treeselect('Strona nadrzędna', 'id_page_main', ['url' => '/'.config('multimedia.backend').'/page/tree?empty=false', 'column' => true, 'value' => null, 'table' => 'product_category', ':required' => true]) !!}
			<x-backend-editor label="Treść strony">@if (isset($page) && isset($page->description)){{ $page->description }} @endif</x-backend-editor>
        </ui-box>
        <x-backend-meta></x-backend-meta>
    </form-module>
@endsection
