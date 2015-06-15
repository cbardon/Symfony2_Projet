<?php
namespace AppBundle\DependencyInjection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class GoogleClient extends \Google_Service_Tasks {
	
private $client;

private $session;

public function __construct($client, $session) {
$this->client = $client->getGoogleClient ();
$this->client->setScopes ( \Google_Service_Tasks::TASKS );
$this->session = $session;

parent::__construct ( $this->client );
}

public function authenticate($code) {
// try catch
$this->client->authenticate ( $code );
$this->session->set ( 'token', $this->client->getAccessToken () );
}
public function createAuthUrl() {
return $this->client->createAuthUrl ();
}
public function getTaskLists() {
$this->client->setAccessToken ( $this->session->get ( 'token' ) );

return $this->tasklists;
}
}
