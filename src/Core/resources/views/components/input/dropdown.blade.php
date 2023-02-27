<div x-data="data()" x-init="{{ $watch }} $watch('value', newValue => console.log(newValue)); loadOptions('{{ $url ? $url : null }}', {{ $params }})" @click.outside="open = false" class="form-dropdown" :class="open ? 'form-dropdown-open' : ''">
	@if ($label) <label class="form-label">{{ $label }}</label> @endif
	<input type="hidden" x-ref="{{ $id }}" name="{{ $name }}" x-model="value.id" />
	<div class="form-dropdown-value" x-on:click="open = !open">
		<span x-text="value.name"></span>
		<div class="handler"><span class="material-icons-outlined">expand_more</span></div>
	</div>
	<div x-show="open" x-transition class="form-dropdown-list">
		<ul>
			<template x-for="option in options">
				<li x-on:click="value = option; open = false;"><span x-text="option.name"></span></li>
			</template>
		</ul>
	</div>
</div>

<script>
	function data() {
		return {
			open: false,
			value: {},
			options: [],
			async loadOptions(url, params) {
				this.options = [];
				if (url) {
					const request = await window.axios.post(url, params);
					this.options = request.data
				}
			}
		}
	}
</script>
