<template>
	<header>
		<main-navbar :page="page"></main-navbar>
		<slot></slot>
	</header>
</template>

<script>
	import mainNavbar from './../main-navbar/main-navbar.vue';

	export default {
		props: ['page'],
		
		components: {mainNavbar}
	}
</script>