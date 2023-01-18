@extends('backend::layouts.app')

@section('content')

	<form method="post">
		@csrf
		<div class="mt-4 max-w-6xl mx-auto">
			<div class="flex items-center gap-3 mb-2 font-medium">
				<div class="w-64">Nazwa pola w pliku</div>
				<div class="flex-auto">Pole w bazie danych</div>
				<div class="w-16">Aktulizuj</div>
			</div>

			<div class="flex items-center gap-3 mb-2">
				<div class="w-64">
					Nazwa produktu
					<small class="text-xs text-slate-400 block">aaa</small>
				</div>
				<div class="flex-auto"><dropdown :options="[{id: 'product.name', name: 'nazwa'}, {id: 'product.code', name: 'code'}]" /></div>
				<div class="w-16 text-center flex justify-center mt-0 mb-0">
					<input-checkbox />
				</div>
			</div>
			<div class="flex items-center gap-3 mb-2">
				<div class="w-64">
					Nazwa produktu
					<small class="text-xs block text-slate-400">aaa</small>
				</div>
				<div class="flex-auto"><dropdown :options="[{id: 'product.name', name: 'Nazwa produktu'}, {id: 'product.code', name: 'Kod produktu'}]" /></div>
				<div class="w-16 text-center flex justify-center mt-0 mb-0">
					<input-checkbox />
				</div>
			</div>

			<div class="flex justify-end mt-4">
				<button class="w-48 btn btn-light mr-2 bg-white" type="button">Wgraj ponownie plik</button>
				<button class="w-48 btn btn-primary" type="submit">Importuj dane</button>
			</div>
		</div>
	</form>

@endsection
