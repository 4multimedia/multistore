<div class="form-dropdown">
	@if ($label) <label class="form-label">{{ $label }}</label> @endif
	<input type="password" @if($mask) x-mask="{{ $mask }}" @endif name="{{ $name }}" class="form-input" />
</div>
