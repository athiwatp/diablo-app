<style lang="scss">
    @import '../../../sass/_variables.scss';

    .alert {
        border-radius: 0px;
        background-color: $tertiary-color;
        border: $tertiary-color;
        color: $primary-color;
    }

    i.material-icons {
        vertical-align: bottom;
    }
</style>

<template>
	<div class="alert animated"
         :class="class"
         role="alert"
         transition="fade"
    >
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
		<slot></slot>
    </div>
</template>

<script>
	export default {
		computed: {
			class () {
				switch (this.type) {
					case 'success':
						return 'alert-success';
						break;
				}
			}
		},

		props: ['type']
	}
</script>