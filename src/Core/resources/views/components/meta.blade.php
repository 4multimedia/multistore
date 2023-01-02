<div>
    <ui-box header="Zawartość dla wyszukiwarki">
        {!! form()->text('Tytuł strony', 'seo.title', ['column' => true]) !!}
        {!! form()->text('Opis strony', 'seo.description', ['column' => true]) !!}
        {!! form()->text('Link kanoniczny', 'seo.canonical', ['column' => true]) !!}
        {!! form()->dropdown('Indeksowanie przez wyszukiwarki', 'seo.robots', ['column' => true]) !!}
    </ui-box>
</div>
