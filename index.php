
<?php

 require 'connect.php';
require 'facebook.php';

$facebook = new Facebook(array(
  'appId'  => '594426097255705',
  'secret' => '874c52194eb9e373b60327e3b4876270',
  
));

$user = $facebook->getUser();
$access_token = $facebook->getAccessToken();
$_SESSION['access_token'] =$access_token;
$_SESSION['uid'] = $user;

if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me');

  } catch (FacebookApiException $e) {

    error_log($e);
    $user = null;
  }
}

// Login or logout url will be needed depending on current user state.
if ($user) {
//$logoutUrl = $facebook->getLogoutUrl(array( 'next' =>'http://http://127.0.0.1/facebook-php-sdk-master/logout.php','access_token'=>$facebook->getAccessToken()));
  $logoutUrl = $facebook->destroySession();
  //$logoutUrl = $facebook->getLogoutUrl(array( 'next' => ($fbconfig['baseurl'].'logout.php') ));
} else {
  $loginUrl = $facebook->getLoginUrl(array(
    'scope' => 'email,publish_actions,user_birthday,user_groups'));

}






if ($_SESSION['uid']) {
               
              $attachment = array(
	'access_token' => $access_token,
    'message' => 'this is my message',
    'name' => 'This is my demo Facebook application!',
    'caption' => "Caption of the Post",
    'link' => 'http://localhost/link',
    'description' => 'this is a description',
    'picture' => 'http://www.google.co.in/url?sa=i&source=images&cd=&cad=rja&docid=_7BFqoaZ7h7TnM&tbnid=j20k9aDKM6I58M:&ved=&url=http%3A%2F%2Fwww.desktopas.com%2Fimages-19201200.html&ei=rSHdUZbqI8GIrQee6YAQ&psig=AFQjCNGAL9Kvw9S8z2Ip1yp-zD5cQnc53Q&ust=1373532973661974',
    'actions' => array(
        array(
            'name' => 'Get Search',
            'link' => 'http://www.google.com'
        )
    )
);
								$id = $user_profile['id'];
			                $email =$user_profile['email'];
			                $name =$user_profile['name'];
			                $dob=$user_profile['birthday'];
			               //  $grps=$user_profile['user_groups'];

echo $id.$email.$name.$dob.$grps;
/* $message= "--- test app FoCES ---message";
                                   $a = array(
	                                      'access_token' => $_SESSION['access_token'],
                                              'message' => $message,
                                              'name' => 'FoCES | Site Launch name ',
                                              'caption' => "http://foces.org ......caption",
                                              'link' => 'http://foces.org',
                                              'description' => 'this is a description',
                                              'picture' => 'http://www.foces.org/sitef/img/logo.png',
                                              'actions' => array(
                                                                 array(
                                                                       'name' => 'Get Search',
                                                                       'link' => 'http://www.google.com'
                                                                       )
                                                                 )
                                              );
                                   $facebook->api('/me/feed/', 'post', $a);
 */

 }

?>
<html>
		
					<div id="hbc"><a href="<?php echo $loginUrl; ?>"> <img src="fb.png"> </a><br/></div>

	
</html>  