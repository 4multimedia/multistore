<div>
    <ui-box header="Zawartość dla wyszukiwarki">
        {!! form()->text('Tytuł strony', 'seo[title]', ['column' => true]) !!}
        {!! form()->text('Opis strony', 'seo[meta][description]', ['column' => true]) !!}
        {!! form()->text('Link kanoniczny', 'seo[meta][canonical]', ['column' => true]) !!}
    </ui-box>
    <ui-box header="Reguły indeksowania i wyświetlania">
        @foreach($robots as $item)
        <div class="my-2">
            {!! form()->checkbox($item['name'], 'seo[meta][robots]['.$item['id'].']', ['value' => 'false', 'center' => 'false']) !!}
        </div>
        @endforeach
    </ui-box>
</div>
