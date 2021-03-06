<?php
	
require_once FL_BUILDER_DIR . 'includes/vendor/recaptcha/autoload.php';

$recaptcha_api = new \ReCaptcha\ReCaptcha($settings->recaptcha_secret_key);
$re_response = $recaptcha_api->verify($recaptcha, $_SERVER['REMOTE_ADDR']);

if ( $re_response->isSuccess() ) {
	$result['error'] = false;
}
else {
	$result['error'] = __('reCAPTCHA Error: ', 'fl-builder');
	$error_codes = array();
	foreach ($re_response->getErrorCodes() as $code) {
		$error_codes[] = $code;			               
    }
    $result['error'] .= implode(' | ', $error_codes);
}