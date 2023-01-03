<template>
	<form method="post">
		<slot />
		<slot name="buttons">
			<button type="submit">ZAPISZ</button>
		</slot>
	</form>
</template>
