@extends('backend::layout.auth')

@section('content')
	<div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
		<h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
			{{ __('backend::auth.Password reminder') }}
		</h2>
		<p class="mt-3 intro-x">{{ __('backend::auth.Enter the e-mail address used to log in') }}</p>
		<div class="intro-x mt-2 text-slate-400 xl:hidden text-center">{{ __('backend::auth.to the administration panel') }}</div>
		<form-body class="intro-x mt-8">
			@csrf
			{!! form()->text(null, 'email', ['placeholder' => __('backend::auth.E-mail adress'), 'class' => 'intro-x login__input']) !!}

			<div class="intro-x flex justify-between items-center text-slate-600 dark:text-slate-500 text-xs sm:text-sm mt-4">
				<a href="{{ route('backend.auth.login') }}">{{ __('backend::auth.Go back to login') }}</a>
				<button class="btn btn-primary py-3 px-4 w-full xl:w-40 align-top">{{ __('backend::auth.Reset password') }}</button>
			</div>

			<template #buttons> <div></div> </template>
		</form-body>
	</div>
@endsection
