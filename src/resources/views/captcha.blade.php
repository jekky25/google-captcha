<script type="text/javascript" src="https://www.google.com/recaptcha/api.js?render={{ $reSiteKey }}"></script>
<script>
	grecaptcha.ready(function () {
		grecaptcha.execute('{{ $reSiteKey }}', { action: 'contact' }).then(function (token) {
			var recaptchaResponse = document.getElementById('recaptchaResponse');
			recaptchaResponse.value = token;
		});
	});
</script>
<input type="hidden" name="recaptcha_response" id="recaptchaResponse">