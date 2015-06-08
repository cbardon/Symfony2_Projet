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
                 $task = $this->getDoctrine()->getManager();
                 $listRepository = $task->getRepository('AppBundle:ListeTaches');

                 $lists = $listRepository->findAll();

                 if(!$task){
                     throw $this->createNotFoundException('No List task !');
                 }
                 return $this->render('AppBundle:TaskList:listerListeTache.html.twig', array('title' => 'Show Task List','lists' => $lists));
			}
			
		public function ajouterAction(Request $request)  
		{ 
				 $task = new ListeTaches();


            $form = $this->get('form.factory')->createBuilder('form', $task)
            ->add('nom', 'text')
            ->add('save', 'submit')
            ->getForm();
            
            $form->handleRequest($request);
            if($form->isValid()){
                $em = $this->getDoctrine()->getManager();
                $em->persist($task);
                $em->flush();
			//	$request->request('nom');
                return $this->redirect($this->generateUrl('taskList_lister'));
            }
			
		return $this->render('AppBundle:TaskList:ajouterListeTache.html.twig', array(
            'form' => $form->createView(),'title' => 'Add List task'
        ));
		} 
						     
		public function modifierAction($id)
		{
            $em = $this->getDoctrine()->getManager();
            $itemRepo = $em->getRepository('AppBundle:ListeTaches');
            $item = $itemRepo->findOneById($id);
            if($item == null || ($item->getId() != $id)) {
                throw new NotFoundHttpException();
            }
            // Creation of the form
            $form = $this->createForm(new ListeTaches(), $item);
            // Exploitation of the form
            $request = $this->get('request');
            if($request->getMethod() == 'POST'){
                $form->handleRequest($request);
                if($form->isValid()) {
                    $em->flush();
                }
                }
/*

            $em = $this->getDoctrine()->getManager();
            $listeTask = $em->getRepository('AppBundle:TaskList')->find($id);

            if (!$listeTask) {
                throw $this->createNotFoundException(
                    'Aucune tache pour cet : '.$id
                );
            }

            $listeTask->setName('L etat à bien était mis à jours!');
            $em->flush();

            return $this->redirect($this->generateUrl('taskList_lister', array('title' => 'Task list')));
*/

		return $this->render('AppBundle:TaskList:modifierListeTache.html.twig', array('title' => 'Update Task List'));
		 } 
									     
		 public function supprimerAction($id) 
		 {
             $em = $this->getDoctrine()->getManager();
             $listeTask = $em->getRepository('AppBundle:ListeTaches')->find($id);

             $em->remove($listeTask);
             $em->flush();
             return $this->redirect($this->generateUrl('taskList_lister'));
		 }
	}
