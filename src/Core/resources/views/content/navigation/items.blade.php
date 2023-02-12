@extends('backend::layouts.app')

@section('content')
    <div class="mt-4">
	    <navigation-builder :groups="{!! strtr(json_encode($array), ["\"" => "&quot;"]) !!}" id="{{ $navigation->id_navigation }}" hash="{{ $navigation->hash }}"></navigation-builder>
    </div>
@endsection
