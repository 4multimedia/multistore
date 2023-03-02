<div class="form-dropdown">
	@if ($label) <label class="form-label">{{ $label }}</label> @endif
	<textarea @if($mask) x-mask="{{ $mask }}" @endif name="{{ $name }}" class="form-input"></textarea>
</div>
