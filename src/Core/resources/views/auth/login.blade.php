@extends('backend::layout.main')

@section('content')
	<form-body>
        @csrf
        {!! form()->text('Adres e-mail', 'email') !!}
        {!! form()->password('Hasło', 'password') !!}
	</form-body>

    <visual-builder></visual-builder>
@endsection
