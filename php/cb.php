<?php
require_once('config.php');

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $_SESSION['accessToken']=$token;
}  
else{
    header("location: ../index.php");
}


$oAtuth = new Google\Service\Oauth2($client);
$user = $oAtuth->userinfo->get();

$_SESSION['username'] = $user-> name;
$_SESSION['useremail'] = $user-> email;
$_SESSION['userhd'] = $user-> hd;
$_SESSION['userpic'] = $user->picture;
header("Location: loggain.php");
exit();

?>