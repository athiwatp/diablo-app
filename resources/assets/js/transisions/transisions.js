var fade = {
    css: false,

    enter (el, done) {
    	$(el).hide()
    		.fadeIn(done);
    },

    enterCancelled (el) {
    	$(el).stop();
    },

    leave (el, done) {
    	$(el).fadeOut(done);
    },

    leaveCancelled (el) {
    	$(el).stop();
    }
}

var slide = {
	css: false,

	enter (el, done) {
		$(el).hide()
			.slideDown(done);
	},

	enterCancelled (el) {
		$(el).stop();
	},

	leave (el, done) {
		$(el).slideUp(done);
	},

	leaveCancelled (el) {
		$(el).stop();
	}
}

export default {
    'fade': fade,
    'slide': slide
};