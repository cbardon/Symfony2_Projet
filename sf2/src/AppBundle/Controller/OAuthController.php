<?php
/*
namespace AppBundle\Controller;
 use Symfony\Component\DependencyInjection\ContainerAware;
  use Symfony\Component\HttpFoundation\RedirectResponse;
   use Symfony\Component\HttpKernel\Exception\NotFoundHttpException; 
   use Symfony\Component\HttpFoundation\Request;
   use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class TaskListController extends Controller
{
		  public function testAction()  
		     {
				 $googleService = $this->getContainer()->get('happyr.google.api.client');
				 $googleClient = $googleService->getGoogleClient();
				 $googleClient->setScope('https://www.googleapis.com/auth/tasks');
				 
				 
				 
			 }
			
}


<?php
*/
namespace AppBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
class OAuthController extends Controller {

public function connectionAction() {

$client = $this->get ('googleClient');


return $this->redirect ( filter_var ( $client->createAuthUrl(), FILTER_SANITIZE_URL ) );


// return $this->render('default/index.html.twig');
}

public function oauth2callbackAction(Request $request)
{
$client = $this->get ('googleClient');
$client->authenticate($request->query->get('code'));
var_dump($client->getTaskLists());
}

}