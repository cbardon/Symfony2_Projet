<?php

namespace AppBundle\Controller;
 use Symfony\Component\DependencyInjection\ContainerAware;
  use Symfony\Component\HttpFoundation\RedirectResponse;
   use Symfony\Component\HttpKernel\Exception\NotFoundHttpException; 
   use AppBundle\Entity\ListeTaches;
   use Symfony\Component\HttpFoundation\Request;
   use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    //use MyApp\FilmothequeBundle\Form\ActeurForm;
    
    class TaskListController extends Controller
     {
		  public function listerAction()  
		     { 
			return $this->render('AppBundle:TaskList:listerListeTache.html.twig');   
			}
			
		public function ajouterAction(Request $request)  
		{ 
				 $task = new ListeTaches();
      
        $form = $this->createFormBuilder($task)
            ->add('nom', 'text')
            ->add('save', 'submit')
            ->getForm();
            
            $form->handleRequest($request);
            if($form->isValid()){
				$nom = $request->request('nom');
			    return $this->redirectToRoute('task_success');
			}
			
		return $this->render('AppBundle:TaskList:ajouterListeTache.html.twig', array(
            'form' => $form->createView(),
        ));
		} 
						     
		public function modifierAction($id) 
		{ 
		return $this->render('AppBundle:TaskList:modifierListeTache.html.twig'); 
		 } 
									     
		 public function supprimerAction($id) 
		 { 
			return $this->render('AppBundle:TaskList:supprimerListeTache.html.twig');  
		 }
	}
