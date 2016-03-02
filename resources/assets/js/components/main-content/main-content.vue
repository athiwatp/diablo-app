<template>
	<div class="content">
		<message></message>
		<slot></slot>
		<main-footer></main-footer>
	</div>
</template>

<script>
	import message from '../message/message.vue';
	import mainFooter from '../../components/main-footer/main-footer.vue';

	export default {
		components: {message, mainFooter}
	}
</script>