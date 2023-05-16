@if($error)
<div>
    <ul>
        @foreach ($error as $item)
            <li>{{ $item }}</li>
        @endforeach
    </ul>
</div>
@endif
