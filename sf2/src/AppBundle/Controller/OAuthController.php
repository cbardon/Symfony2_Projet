<?php

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
