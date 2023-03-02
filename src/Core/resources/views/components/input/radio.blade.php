<label class="form-radio" :class="{{ $model }} == '{{ $value }}' ? 'form-radio-active' : ''">
		<input type="radio" name="{{ $name }}" value="{{ $value }}" @if($model) x-model="{{ $model }}" @endif />
		<span></span>

		@if ($label) <span class="form-radio-label">{{ $label }}</span> @endif
        @if ($slot) {{ $slot }} @endif
</label>
