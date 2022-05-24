<?php
 require_once ('googleApi/vendor/autoload.php');
 session_start();
 $client = new Google\Client();
 $client->setAuthConfig('client_credentials.json');
 $client->setRedirectUri("http://localhost/projekt/chat/php/cb.php");
 $client->addScope(Google\Service\Oauth2::USERINFO_EMAIL);
 $client->addScope(Google\Service\Oauth2::USERINFO_PROFILE);
?>