<div>
    <div>{{ $label }}</div>
    {{ $slot }}

    <x-form-error :error="$error" />
</div>
