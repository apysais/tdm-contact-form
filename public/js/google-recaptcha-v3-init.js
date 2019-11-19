(function( $ ) {
	'use strict';
	 $( window ).load(function() {
		 $('.tcf-contact-form').submit(function(event) {
        event.preventDefault();

				grecaptcha.ready(function() {
	 				var recpatcha_v3_site_key = tcf.google_recaptcha_v3_site_key;
	 				grecaptcha.execute(recpatcha_v3_site_key, { action: 'contact' }).then(function (token) {
	 						$('.tcf-contact-form').prepend('<input type="hidden" name="token" value="' + token + '">');
	 						$('.tcf-contact-form').prepend('<input type="hidden" name="action" value="contact">');
	 						$('.tcf-contact-form').unbind('submit').submit();
	 				});
	 		 });

		 });

	 });
})( jQuery );
