<div x-data="{open: false, value: {}, options:[]}" @if($url) x-init="options = await (await axios.post('{{ $url }}'))" @endif @click.outside="open = false" class="form-dropdown" :class="open ? 'form-dropdown-open' : ''">
	@if ($label) <label class="form-label">{{ $label }}</label> @endif
	<input type="hidden" name="{{ $name }}" x-model="value.id" />
	<div class="form-dropdown-value" x-on:click="open = !open">
		<span x-text="value.text"></span>
		<div class="handler"><span class="material-icons-outlined">expand_more</span></div>
	</div>
	<div x-show="open" class="form-dropdown-list">
		<ul>
			<template x-for="option in options">
				<li x-on:click="value = option"><span x-text="option.text"></span></li>
			</template>
		</ul>
	</div>
</div>
