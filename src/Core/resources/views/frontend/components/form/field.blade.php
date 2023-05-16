<div>
    <div>{{ $label }}</div>
    {{ $slot }}

    <x-frontend-form-error :error="$error" />
</div>
