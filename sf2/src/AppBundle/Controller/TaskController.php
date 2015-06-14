<?php

namespace AppBundle\Controller;

 use Symfony\Component\DependencyInjection\ContainerAware;
  use Symfony\Component\HttpFoundation\RedirectResponse;
   use Symfony\Component\HttpKernel\Exception\NotFoundHttpException; 
   use AppBundle\Entity\Tache;
      use AppBundle\Entity\ListeTaches;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
 use Symfony\Component\Form\FormEvent;
 use Symfony\Component\Form\FormEvents;
 use Symfony\Component\Form\FormBuilderInterface;

    //use MyApp\FilmothequeBundle\Form\ActeurForm;
    
    class TaskController extends Controller
    {
        public function listerAction($idList)
        {
            $task = $this->getDoctrine()->getManager();
            $listRepository = $task->getRepository('AppBundle:Tache');
			
            $lists = $listRepository->findByliste($idList);
       
          
            if (!$task) {
                throw $this->createNotFoundException('No task !');
            }
            return $this->render('AppBundle:List:listerTask.html.twig', array('title' => 'Show task', 'lists' => $lists, 'idlist' => $idList));
        }

        /**
         * @param Request $request
         * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
         */
        public function ajouterAction($idList,Request $request)
        {
            $task = new Tache();



			$listeTask = new ListeTaches();
            /* $data = $event->getData();

             $positions = $data->getSport()->getAvailablePositions();

             $form->add('position', 'entity', array('choices' => $positions));
       */
       
       
       
            $form = $this->createFormBuilder($task)
                ->add('nomTache', 'text')
               // ->add('liste','hidden', array('data' => $idList))
                ->add('etat', 'hidden', array('data' => 0))
                ->add('save', 'submit')
                ->getForm();

            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
             //   $em->persist($task);
             
            $listRepository = $em->getRepository('AppBundle:ListeTaches');
			
            $taskList = $listRepository->findOneById($idList);
            $task->setListe($taskList);
            
             $em->persist($task);
            
                $em->flush();
                //	$request->request('nom');
                return $this->redirect($this->generateUrl('task_lister', array('idList' => $idList)));
            }

            return $this->render('AppBundle:List:ajouterTask.html.twig', array(
                'form' => $form->createView(), 'title' => 'Add task'));

        }

        public function modifierAction($idList,$id)
        {

            $em = $this->getDoctrine()->getManager();
            $Task = $em->getRepository('AppBundle:Tache')->find($id);

            if (!$Task) {

                throw $this->createNotFoundException(
                    'Aucune tache pour l id: ' . $id
                );
            }
             
            if($Task->getEtat()== 1){
				 $Task->setEtat(0);
			}
			else{
            $Task->setEtat(1);
		}
            $em->flush();

            return $this->redirect($this->generateUrl('task_lister',array('idList' => $idList)));


        }


        public function modifierNomAction($idList,$id,Request $request)
        {

			$em = $this->getDoctrine()->getManager();
			$listRepository = $em->getRepository('AppBundle:Tache');
			$task = $listRepository->findOneById($id);
            $nom = $task->getNomTache();
            
            

            $form = $this->get('form.factory')->createBuilder('form', $task)
            ->add('nomTache', 'text',array('data' => $nom))
            ->add('update', 'submit')
            ->getForm();
            
            
			$form->handleRequest($request);
            if($form->isValid()){
				$data = $form->getData();
				
				 $task->setNomTache($data->getNomTache());
                $em->persist($task);
                
		
                $em->flush();
			//	$request->request('nom');
                return $this->redirect($this->generateUrl('task_lister',array('idList' => $idList)));
        }
        
		return $this->render('AppBundle:TaskList:modifierListeTache.html.twig', array('title' => 'Update Task List', 'form' => $form->createView()));
		
	}

        public function supprimerAction($idList,$id)
        {
            $em = $this->getDoctrine()->getManager();
            $task = $em->getRepository('AppBundle:Tache')->find($id);

            $em->remove($task);
            $em->flush();
            return $this->redirect($this->generateUrl('task_lister', array('idList' => $idList)));
        }
        
        public function getListe()
        {
			
		}
		
		
		/* public function findAllOrderedByName()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p FROM AcmeStoreBundle:Product p ORDER BY p.name ASC'
            )
            ->getResult();
    }
        */
    }
