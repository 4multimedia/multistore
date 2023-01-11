@extends('backend::layouts.app')

@section('content')
	{{ get_table('domains') }}
@endsection
