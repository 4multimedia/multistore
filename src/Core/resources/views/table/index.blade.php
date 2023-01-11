<div>
    <table class="table table-report">
        <thead>
            <tr>
            @foreach($fields as $field)
                <th class="whitespace-nowrap @if($field["headerClass"]) {{ $field["headerClass"] }} @endif">{{ $field["label"] }}</th>
            @endforeach

            @if(count($actions) > 0)
                <th class="w-16">Działanie</th>
            @endif
            </tr>
        </thead>
        <tbody>
            @foreach($values as $value)
            <tr class="intro-x">
                @foreach($fields as $field)
                    <td class="@if($field["bodyClass"]) {{ $field["bodyClass"] }} @endif">{!! $value[$field["id"]]["value"] !!}</td>
                @endforeach
                @if(count($actions) > 0)
                    <td class="w-16 text-right">
                        <div class="dropdown">
                            <button class="dropdown-toggle btn btn-default btn-action text-slate-300 hover:text-slate-500" aria-expanded="false" data-tw-toggle="dropdown">
                                <i data-lucide="settings"></i>
                            </button>
                            <div class="dropdown-menu w-40">
                                <ul class="dropdown-content">
                                    @foreach($value[$field["id"]]["actions"] as $action)
                                        <li>
                                            {!! $action["template"] !!}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
