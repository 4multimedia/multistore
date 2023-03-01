<div>
    <ui-box header="Zawartość dla wyszukiwarki">
        {!! form()->text('Tytuł strony', 'seo[title][pl]', ['value' => ($item["title"]["pl"]) ?? '', 'column' => true]) !!}
        {!! form()->text('Opis strony', 'seo[meta][description][pl]', ['value' => ($item["meta"]["description"]["pl"]) ?? '', 'column' => true]) !!}
        {!! form()->text('Link kanoniczny', 'seo[meta][canonical][pl]', ['value' => ($item["meta"]["canonical"]["pl"]) ?? '', 'column' => true]) !!}
    </ui-box>
    <ui-box header="Reguły indeksowania i wyświetlania">
        @foreach($robots as $key)
        <div class="my-2">
            {!! form()->checkbox($key['name'], 'seo[meta][robots]['.$key['id'].']', ['value' => isset($item["meta"]["robots"]) ? (array_key_exists($key["id"], $item["meta"]["robots"]) ? 'true' : 'false') : 'false', 'center' => 'false']) !!}
        </div>
        @endforeach
    </ui-box>
</div>
