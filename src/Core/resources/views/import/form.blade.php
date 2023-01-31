@extends('backend::layouts.app')

@section('content')

	<form method="post" enctype="multipart/form-data">
		@csrf
		<input type="file" name="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
		<select name="separator">
			<option value=";">Średnik</option>
			<option value=".">Przecinek</option>
			<option value="\t">Tabulator</option>
		</select>
		<button>Wgraj plik</button>
	</form>

@endsection
