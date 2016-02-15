<template>
	<header>
		<main-navbar></main-navbar>
		<slot></slot>
	</header>
</template>

<script>
	import mainNavbar from './../main-navbar/main-navbar.vue';

	export default {
		components: {mainNavbar}
	}
</script>