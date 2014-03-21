<?
require 'config.inc.php';

$path = $_CACHE .'facom-twitter/';

if (!file_exists ($path) && !@mkdir ($path, 0777))
	die ('Impossível criar diretório ['. $path .'].');

$file = $path . date ('Y-m-d-H');

if (file_exists ($file) && (int) filesize ($file))
	$output = file_get_contents ($file);
else
{
	if (!@set_include_path (get_include_path () . PATH_SEPARATOR . dirname (__FILE__) . PATH_SEPARATOR . $_TITAN .'extra/'))
		die ('Impossible to set include path. This cause Zend Framework load fail!');
	
	require 'Zend/Service/Twitter.php';
	
	$token = new Zend_Oauth_Token_Access;
	
	$token->setParams (array (	'oauth_token' => $_TWITTER ['token'], 
								'oauth_token_secret' => $_TWITTER ['secret']));
	
	$twitter = new Zend_Service_Twitter (array ('username' => $_TWITTER ['login'], 'accessToken' => $token));
	
	$response = $twitter->account->verifyCredentials ();
	
	foreach ($twitter->status->userTimeline (array ('count' => 1)) as $status)
	{
		$output = $status->text;
	}
	file_put_contents ($file, $output);
	
	$response = $twitter->account->endSession ();
}

echo $output;
?>
