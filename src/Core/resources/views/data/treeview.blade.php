@extends('backend::layout.app')

@section('content')
<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12 2xl:col-span-3">
        <div class="2xl:border-r -mb-10 pb-10">
            <div class="2xl:pr-6 grid grid-cols-12 gap-x-6 2xl:gap-x-0 gap-y-6">
                <div class="col-span-12 md:col-span-6 xl:col-span-4 2xl:col-span-12 mt-3 2xl:mt-8">
                    <h2 class="text-lg intro-y font-medium truncate mr-5 mb-3">Kategorie</h2>

                    <data-tree url="" root=""></data-tree>
                </div>
            </div>
        </div>
    </div>
    <div class="col-span-12 2xl:col-span-9">
        <div class="mt-6">
            {!! form()->text(null, 'name', ['placeholder' => 'Nazwa kategorii']) !!}
            {{ do_action('category__after__name') }}

            <x-backend-meta></x-backend-meta>
        </div>
    </div>
</div>
@endsection
