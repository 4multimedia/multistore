@extends('backend::layouts.auth')

@section('content')
	<div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
		<h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
			{{ __('backend::auth.Login') }}
		</h2>
		<div class="intro-x mt-2 text-slate-400 xl:hidden text-center">{{ __('backend::auth.to the administration panel') }}</div>
		<form-body class="intro-x mt-8">
			@csrf
			{!! form()->text(null, 'email', ['placeholder' => __('backend::auth.E-mail adress'), 'class' => 'intro-x login__input']) !!}
			{!! form()->password(null, 'password', ['placeholder' => __('backend::auth.Password'), 'class' => 'intro-x login__input', 'toggle-mask' => true, ':feedback' => false, 'input-class' => 'form-control']) !!}

			<div class="intro-x flex text-slate-600 dark:text-slate-500 text-xs sm:text-sm mt-4">
				{!! form()->checkbox(__('backend::auth.Remember me'), 'remember_me') !!}
				<a href="{{ route('backend.auth.reset') }}">{{ __('backend::auth.Forgot password?') }}</a>
			</div>

			<template #buttons>
				<div class="intro-x mt-5 xl:mt-8 text-right">
					<button class="btn btn-primary py-3 px-4 w-full xl:w-40 align-top">{{ __('backend::auth.Log in') }}</button>
				</div>
			</template>
		</form-body>
	</div>
@endsection
