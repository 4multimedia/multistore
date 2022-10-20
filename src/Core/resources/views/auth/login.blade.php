@extends('backend::layout.main')

@section('content')

<form method="post">
    @csrf
    @method('post')
    @input("12adres e-mail", "email", "type")

    <button type="submit">Zaloguj się</button>
</form>
@endsection
