@extends('backend::layouts.app')

@section('content')

	<div class="box">
		<div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60">
			<h2 class="font-medium text-base mr-auto">
				Podgląd danych
			</h2>
			<div class="form-check form-switch w-full sm:w-auto sm:ml-auto mt-3 sm:mt-0">
				<label class="form-check-label ml-0" for="show-example-1">Nagłówek</label>
				<input id="show-example-1" data-target="#basic-table" class="show-code form-check-input mr-0 ml-3" type="checkbox">
			</div>
		</div>
		<div class="p-5">
			<div class="overflow-x-auto">
				<table class="table">
					<tbody>
					@foreach($rows as $index => $row)
						<tr>
							@foreach ($row as $col)
								<td>
									<input type="text" name="col[]" value="{{ $col }}" />
								</td>
							@endforeach
						</tr>
						@if ($index === 0)
						<tr>
							@foreach ($row as $col)
							<td>
								<select name="">
									<option>nazwa</option>
								</select>
							</td>
							@endforeach
						</tr>
						@endif
					@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>

@endsection
