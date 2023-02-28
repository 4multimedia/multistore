<div class="form-radio" :class="{{ $model }} == '{{ $value }}' ? 'form-radio-active' : ''">
	<label>
		<input type="radio" name="{{ $name }}" value="{{ $value }}" @if($model) x-model="{{ $model }}" @endif />
		<span></span>

		<span class="form-radio-label">{{ $label }}</span>
	</label>
</div>
