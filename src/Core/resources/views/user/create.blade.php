@extends('backend::layout.app')

@section('content')
    <form-module>
        <form-section header="Podstawowe informacje">
            <ui-box header="Dane podstawowe">

                <div class="form-inline items-start flex-col xl:flex-row mt-5 pt-5 first:mt-0 first:pt-0">
                    <div class="form-label xl:w-64 xl:!mr-10">
                        <div class="text-left">
                            <div class="flex items-center">
                                <div class="font-medium">Imię i nazwisko</div> <span class="ml-2 text-red-700">*</span>
                            </div>
                            <div class="leading-relaxed text-slate-500 text-xs mt-3">Include min. 40 characters to make it more attractive and easy for buyers to find, consisting of product type, brand, and information such as color, material, or type. </div>
                        </div>
                    </div>
                    <div class="w-full mt-3 xl:mt-0 flex-1">
                        <input id="product-name" type="text" class="form-control" placeholder="Imię i nazwisko">
                        <div class="form-help text-right">Maximum character 0/70</div>
                    </div>
                </div>

            </ui-box>
        </form-section>
        <form-section header="Ograniczenia dostępu">
            <ui-box header="Powiadomienia"></ui-box>
            <ui-box header="Ograniczenia dostępu IP"></ui-box>
        </form-section>
        <form-section header="Aktywność">
            <ui-box header="Aktywne sesje"></ui-box>
            <ui-box header="Aktywność uzytkownika"></ui-box>
        </form-section>
        <form-section header="Logi">
            <ui-box header="Logi"></ui-box>
        </form-section>
    </form-module>
@endsection
