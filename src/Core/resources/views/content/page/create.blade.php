@extends('backend::layouts.app')

@section('content')
    <form-module publish>
        {!! form()->text(null, 'name', ['value' => (isset($page) && isset($page->name)) ? $page->name : '', 'column' => true, 'placeholder' => 'Tytuł strony']) !!}
        <ui-box header="Podstawowe informacje" class="mb-5">
			<x-backend-editor>@if (isset($page) && isset($page->description)){{ $page->description }} @endif</x-backend-editor>
        </ui-box>
        <x-backend-meta></x-backend-meta>
    </form-module>
@endsection
