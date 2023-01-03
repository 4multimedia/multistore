<html lang="en" class="light">
    <!-- BEGIN: Head -->
    <head>
        <link rel="stylesheet" href="{{ asset('css/backend.css') }}" />
        <title>{{ get_meta_title(config('multimedia.name').' - Panel administracyjny') }}</title>
		{{ get_assets_backend_js('before') }}
    </head>
    <!-- END: Head -->
    <body class="login">
        <div class="container sm:px-10" id="app">
			@if(session('success'))
				<div class="fixed z-50 right-0 top-0 p-5 w-full">
					<div class="container sm:px-10">
						<message severity="success" :sticky="false" :life="8000">{{session('success')}}</message>
					</div>
				</div>
			@endif
            <div class="block xl:grid grid-cols-2 gap-4">
                <div class="hidden xl:flex flex-col min-h-screen">
                    <a href="" class="-intro-x flex items-center pt-5">
                        <span class="text-white text-lg"> {{ config('multimedia.name') }} </span>
                    </a>
                    <div class="my-auto">
                        <div class="-intro-x text-white font-medium text-4xl leading-tight">
                            {{ __('backend::auth.Administration panel') }}
                        </div>
                        <div class="-intro-x mt-5 text-lg text-white text-opacity-70 dark:text-slate-400">{{ __('backend::auth.Log in to the administration panel and manage your website.') }}</div>
                    </div>
                </div>

				<div class="hidden xl:flex flex-col min-h-screen">
					<div class="flex justify-end text-right">
						<div class="pt-5">
							<div class="intro-x dropdown mr-4 sm:mr-6">
								<div class="dropdown-toggle languages languages--items cursor-pointer" role="button" aria-expanded="false" data-tw-toggle="dropdown">
									<div class="flex">
										<span class="fi fi-{{ get_backend_language()["flag"] }} mr-2"></span>
										<span>{{ get_backend_language()["label"] }}</span>
									</div>
								</div>
								<div class="languages-content pt-2 dropdown-menu">
									<div class="languages-content__box dropdown-content">
										<ul class="px-2">
											@foreach(get_backend_languages() as $key => $lang)
												<li class="@if ($key > 0) mt-3 @endif">
													<a href="?lang={{ $lang["code"] }}" class="flex">
														<span class="fi fi-{{ $lang["flag"] }} mr-2"></span>
														<span>{{ $lang["label"] }}</span>
													</a>
												</li>
											@endforeach
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="my-auto">
						<div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
							@yield('content')
						</div>
					</div>
				</div>


            </div>
        </div>

		<script src="{{ mix('js/backend.js') }}"></script>
    </body>
</html>
