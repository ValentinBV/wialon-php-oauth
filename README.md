# wialon-php-oauth
Wialon-php-oauth allows authorization on the Wialon Remote API server in accordance with the documentation on the oauth protocol.

For example, in first, get authorize url:

    $auth = new valentinbv\WialonOAuth\OAuth(
	    'https://your-api-server.com/login.html
    );
    $auth->setRedirectUri('https://your-redirect-url.com/');
    $auth->getAuthorizeUrl();

When you have access token, you can login:

    if ($_GET['access_token']) {
	    $client = new GuzzleHttp\Client();
	    $token = new valentinbv\WialonOAuth\TokenLogin('https://hst-api.wialon.com/wialon/ajax.html', $client);
    try {
        $token->setToken($_GET['access_token']);
        $result = $token->login();
        } catch(\Exception  $e) { 
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
