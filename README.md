

# wialon-php-oauth
Wialon-php-oauth allows authorization on the Wialon Remote API server in accordance with the documentation on the oauth protocol.

For example, in first, get authorize url:

    $authHelper = new valentinbv\WialonOAuth\OAuthHelper(
	    'https://your-api-server.com/login.html
    );
    $authHelper->setRedirectUri('https://your-redirect-url.com/');
    $authHelper->getAuthorizationUrl();

When you have access token, you can login:

    if ($_GET['access_token']) {
	    $httpClient = new GuzzleHttp\Client();
	    $auth = new valentinbv\WialonOAuth\OAuthClient($httpClient);
	    try {
            $auth->setToken($_GET['access_token']);
            $result = $auth->login();
	    } catch(\Exception $e) { 
            echo $e->getMessage();
	    }
    }

The $result array contains the result of the query to the wialon server according to the documentation
https://sdk.wialon.com/wiki/en/sidebar/remoteapi/apiref/token/login

For install from packagist

**composer require valentinbv/wialon-php-oauth**

For install from git add to composer.json:

    {
        "repositories": [
            {
                "type": "vcs",
                "url": "https://github.com/ValentinBV/wialon-php-oauth.git"
            }
        ],
        "require": {
            "valentinbv/wialon-php-oauth": "dev-master"
        }
    }
