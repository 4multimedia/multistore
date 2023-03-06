<div class="mb-5">
    <div class="form-label">
        <div class="font-medium mb-3">{{ $label }}</div>
    </div>

    <div class="intro-y grid grid-cols-5 gap-2">
        @foreach ($items as $key => $value)
            <div>
                <input-checkbox name="dictionary[{{ $key }}]" @if (array_key_exists($key, $selected)) :value="true" @else :value="false" @endif label="{{ $value }}" />
            </div>
        @endforeach
    </div>

</div>
