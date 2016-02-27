<?php 

/**
	* Get Server Side Authorization
	*
	* @since    0.0.1
	* @return 	 String  $access_token  Google access token
	*
	*/
class Mplugin_Auth {

	public function __construct() {

		$this->load_dependencies();
	}

	public function load_dependencies() {

		require_once( MPLUGIN__PLUGIN_DIR . "inc/lib/google-api-php/Google/autoload.php");

	}

	public function get_google_access_token() {
		$key = file_get_contents(  __DIR__  . '/analytics_reporting_api_key.json' );

		$json = json_decode($key, true);

		$client_email = $json['client_email'];
		$private_key = $json['private_key'];
		$scopes = 	array( 	"https://www.googleapis.com/auth/analytics.readonly",
							"https://www.googleapis.com/auth/analytics.manage.users.readonly"
		 			);

		$credentials = new Google_Auth_AssertionCredentials(
			$client_email,
			$scopes,
			$private_key
		);


		$client = new Google_Client();


		$client->setAssertionCredentials( $credentials );


		if ( $client->getAuth()->isAccessTokenExpired() ) {
			try {
				$client->getAuth()->refreshTokenWithAssertion();
			}
			catch (Exception $e) {
				var_dump( $e->getMessage() );
			}
		}

		$token_json = json_decode($client->getAccessToken(), true);
		$access_token = $token_json['access_token'];
		return $access_token;
	}

} // Mplugin_Auth

/*
try {
	$service = new Google_Service_Analytics( $client );
}
catch ( Exception $e ) {
	var_dump( $e->getMessage() );
}*/