<label class="form-checkbox">
    <input type="checkbox" name="{{ $name }}" @if ($model) x-model="{{ $model }}" @endif value="1" />
    <span class="area">
        <span class="material-icons-outlined">done</span>
    </span>
    @if ($label) {{ $label }} @endif
    @if ($slot) {{ $slot }} @endif
</label>
