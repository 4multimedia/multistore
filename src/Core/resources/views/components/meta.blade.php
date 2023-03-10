<div>
    <ui-box header="Zawartość dla wyszukiwarki">
        {!! form()->text('Tytuł strony', 'seo[title]', ['value' => ($item["title"]) ?? '', 'column' => true, ':translate' => true]) !!}
        {!! form()->text('Opis strony', 'seo[meta][description]', ['value' => ($item["meta"]["description"]) ?? '', 'column' => true, ':translate' => true]) !!}
        {!! form()->text('Link kanoniczny', 'seo[meta][canonical]', ['value' => ($item["meta"]["canonical"]) ?? '', 'column' => true, ':translate' => true]) !!}
    </ui-box>
    <ui-box header="Reguły indeksowania i wyświetlania">
        @foreach($robots as $key)
        <div class="my-2">
            {!! form()->checkbox($key['name'], 'seo[meta][robots]['.$key['id'].']', ['value' => isset($item["meta"]["robots"]) ? (array_key_exists($key["id"], $item["meta"]["robots"]) ? 'true' : 'false') : 'false', 'center' => 'false']) !!}
        </div>
        @endforeach
    </ui-box>
</div>
