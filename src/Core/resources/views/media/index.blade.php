@extends('backend::layout.app')

@section('content')
	<div class="grid grid-cols-12 gap-6 mt-8">
		<div class="col-span-12 lg:col-span-3 2xl:col-span-2">
			<div class="intro-y box p-5">
				<div class="mt-1">
					<a href="?type=all" class="flex items-center px-3 py-2 rounded-md bg-primary text-white font-medium"> Wszystkie pliki </a>
					<a href="?type=images" class="flex items-center px-3 py-2 mt-2 rounded-md"> Pliki graficzne </a>
					<a href="?type=documents" class="flex items-center px-3 py-2 mt-2 rounded-md"> Dokumenty </a>
					<a href="?type=archive" class="flex items-center px-3 py-2 mt-2 rounded-md"> Spakowane pliki </a>
					<a href="/trash" class="flex items-center px-3 py-2 mt-2 rounded-md"> Usunięte </a>
				</div>
				<div class="border-t border-slate-200 dark:border-darkmode-400 mt-4 pt-4">
					<a href="javascript:;" class="flex items-center px-3 py-2 mt-2 rounded-md"> Dodaj tag </a>
				</div>
			</div>
		</div>
		<div class="col-span-12 lg:col-span-9 2xl:col-span-10">
			<media root="{{ $hash }}" show="" updateBreadcrumb></media>
		</div>
	</div>
@endsection
