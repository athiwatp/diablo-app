<style lang="scss">
	@import './bounce.scss';
</style>

<template>
	<div class="spinner"
		 :style="style"
	>
	  <div class="bounce1"></div>
	  <div class="bounce2"></div>
	  <div class="bounce3"></div>
	</div>
</template>

<script>
	export default {
		props: ['style']
	}
</script>