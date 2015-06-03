<?php

namespace AppBundle\Controller;
 use Symfony\Component\DependencyInjection\ContainerAware;
  use Symfony\Component\HttpFoundation\RedirectResponse;
   use Symfony\Component\HttpKernel\Exception\NotFoundHttpException; 
   use AppBundle\Entity\Tache;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

    //use MyApp\FilmothequeBundle\Form\ActeurForm;
    
    class TaskController extends Controller
     {
		  public function listerAction(Request $request)  
		     { 
				 
				 
			return $this->render('AppBundle:Tache:listerTache.html.twig');   
			}
			
		public function ajouterAction(Request $request)  
		{ 
			 $task = new Tache();
      
        $form = $this->createFormBuilder($task)
            ->add('nom', 'text')
            ->add('liste','hidden', array('data' => this.getListe()))
                ->add('etat', 'checkbox', array(
                'label' => 'Check !', 'required' => false,))
            ->add('save', 'submit')
            ->getForm();
            
            $form->handleRequest($request);
            if($form->isValid()){
				$nom = $request->request('nom');
					$etat = $request->request('etat');
				return $this->redirectToRoute('task_success');
			}

      return $this->render('AppBundle:Tache:ajouterTache.html.twig', array(
            'form' => $form->createView(),
        ));
		
		} 
						     
		public function modifierAction($id,Request $request) 
		{ 
			
			
		return $this->render('AppBundle:Tache:modifierTache.html.twig'); 
		 } 
									     
		 public function supprimerAction($id,Request $request) 
		 { 
			return $this->render('AppBundle:Tache:supprimerTache.html.twig');  
		 }
	}
