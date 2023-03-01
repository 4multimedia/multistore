<div>
    <ui-box header="Zawartość dla wyszukiwarki">
        {!! form()->text('Tytuł strony', 'seo[title][pl]', ['value' => $item["title"]["pl"] ?? '', 'column' => true]) !!}
        {!! form()->text('Opis strony', 'seo[meta][description][pl]', ['value' => $item["meta"]["meta"]["description"]["pl"] ?? '', 'column' => true]) !!}
        {!! form()->text('Link kanoniczny', 'seo[meta][canonical][pl]', ['value' => $item["meta"]["meta"]["canonical"]["pl"] ?? '', 'column' => true]) !!}
    </ui-box>
    <ui-box header="Reguły indeksowania i wyświetlania">
		{!! print_r($item["meta"]["meta"]["robots"]) !!}
		{{ $item["meta"]["meta"]["robots"]["all"] }}
		@if (in_array('all', $item["meta"]["meta"]["robots"])) jest @endif
        @foreach($robots as $key)
        <div class="my-2">
			@if (!in_array($key["id"], $item["meta"]["meta"]["robots"])) {{ $key["id"] }} @endif
            {!! form()->checkbox($key['name'], 'seo[meta][robots]['.$key['id'].']', ['value' => isset($item["meta"]["meta"]["robots"][$key["id"]]) ? 'true' : 'false', 'center' => 'false']) !!}
        </div>
        @endforeach
    </ui-box>
</div>
