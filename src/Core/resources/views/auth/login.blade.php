@extends('backend::layout.main')

@section('content')



	<form method="post">
        @csrf
        {!! form()->text('Adres e-mail', 'email') !!}
        {!! form()->password('Hasło', 'password') !!}
        <button>WYSLIJ</button>
	</form>
@endsection
