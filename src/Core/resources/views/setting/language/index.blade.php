@extends('backend::layouts.app')

@section('content')
	<form method="post">
		@csrf
		<div class="intro-y flex items-center mt-8  justify-between">
			<h2 class="text-lg font-medium mr-auto">Wersje językowe</h2>
			<button class="btn btn-primary shadow-md ml-2">Zapisz zmiany</button>
		</div>
		<table class="w-full bg-white text-left border mt-6">
			<thead class="">
				<tr class="">
					<th class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 !pr-2 bg-slate-50 dark:bg-darkmode-800 text-slate-500 w-16 text-center">Status</th>
					<th class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 !px-2 bg-slate-50 dark:bg-darkmode-800 text-slate-500 whitespace-nowrap w-20 text-center"> Domyślny </th>
					<th class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 bg-slate-50 dark:bg-darkmode-800 text-slate-500 w-16 text-center">Kod</th>
					<th class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 !px-2 bg-slate-50 dark:bg-darkmode-800 text-slate-500 whitespace-nowrap"> Nazwa </th>
				</tr>
			</thead>
			<tbody>
			@foreach($languages as $language)
				<tr>
					<td class="px-5 py-3 border-b dark:border-darkmode-300 !pr-2 w-16 text-center">
						<label class="text-center flex justify-center checkbox-icon">
							<input type="checkbox" name="status[{{ $language["code"] }}]" value="1" @if (is_array($options["languages"]) && array_key_exists($language["code"], $options["languages"])) checked="checked" @endif />
							<i data-lucide="x" class="text-danger w-12"></i>
							<i data-lucide="check" class="text-success w-12"></i>
						</label>
					</td>
					<td class="px-5 py-3 border-b dark:border-darkmode-300 !pr-2 w-20">
						<label class="text-center flex justify-center checkbox-icon">
							<input type="radio" name="default" value="{{ $language["code"] }}" @if ($language["code"] == $options["default"]) checked="checked" @endif />
							<i data-lucide="x" class="text-danger w-12"></i>
							<i data-lucide="check" class="text-success w-12"></i>
						</label>
					</td>
					<td class="px-5 py-3 border-b dark:border-darkmode-300 !pr-2 w-16 text-center">{{ $language["code"] }}</td>
					<td class="px-5 py-3 border-b dark:border-darkmode-300 !pr-2">
						<div class="flex items-center">
							<span class="fi fi-{{ $language["flag"] }}"></span>
							<span class="text-slate-800 ml-4">{{ $language["name"] }}</span>
						</div>
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</form>
@endsection
