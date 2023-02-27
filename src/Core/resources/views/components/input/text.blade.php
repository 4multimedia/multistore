<div x-data="{open: false, value: {}, options:[]}" @if($url) x-init="options = await (await axios.post('{{ $url }}'))" @endif @click.outside="open = false" class="form-dropdown" :class="open ? 'form-dropdown-open' : ''">
	@if ($label) <label class="form-label">{{ $label }}</label> @endif
	<input type="text" name="{{ $name }}" class="form-input" />
</div>
